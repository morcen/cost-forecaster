<?php

namespace LSM\Services;

use LSM\Models\Interfaces\FormInterfaces;
use LSM\Models\Serializables\ValidationErrors;

class ValidationService
{
    private array $errors = [];

    public function __construct(private FormInterfaces $form)
    {
    }

    /**
     * @param  array  $fields
     * @return bool
     */
    public function validate(array $fields): bool
    {
        $rules = $this->form->rules();

        foreach ($fields as $field => $value) {
            if (isset($rules[$field])) {
                $this->check($field, $value, $rules);
            }
        }

        if (count(($this->errors))) {
            // return the error to the frontend
            header('Content-Type: application/json');
            http_response_code(400); // Bad request
            echo json_encode(new ValidationErrors($this->errors));
            exit;
        }

        return true;
    }

    /**
     * @param  string  $field
     * @param  string  $value
     * @param  array  $rules
     */
    public function check(string $field, string $value, array $rules)
    {
        $fieldRules = explode('|', $rules[$field]);

        foreach ($fieldRules as $fieldRule) {
            switch ($fieldRule) {
                case 'required':
                    if (empty($value)) {
                        $this->errors[] = [
                            'field' => $field,
                            'message' => "This field can not be empty."
                        ];
                        return; // immediately stop further validations
                    }
                    break;
                case 'numeric':
                    if (!is_numeric($value)) {
                        $this->errors[] = [
                            'field' => $field,
                            'message' => "This field should be a number."
                        ];
                        return; // immediately stop further validations
                    }
                    break;
                case str_starts_with($fieldRule, 'min'):
                    [$min, $length] = explode(':', $fieldRule);

                    if ($length > $value) {
                        $this->errors[] = [
                            'field' => $field,
                            'message' => "This field must be greater than or equal to {$length}"
                        ];
                        return; // immediately stop further validations
                    }
                    break;
            }
        }
    }
}
