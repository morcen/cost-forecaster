<?php

namespace Forecost\Models\Serializables;

class ValidationErrors implements \JsonSerializable
{
    public function __construct(private array $errors)
    {
    }

    public function jsonSerialize()
    {
        return ['errors' => $this->errors];
    }
}
