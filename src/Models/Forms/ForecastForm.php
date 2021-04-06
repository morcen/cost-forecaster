<?php

namespace Forecost\Models\Forms;

use JetBrains\PhpStorm\ArrayShape;
use Forecost\Models\Interfaces\FormInterfaces;

class ForecastForm implements FormInterfaces
{
    #[ArrayShape(['studyCount' => "string", 'studyGrowth' => "string", 'months' => "string"])]
    public function rules(): array
    {
        return [
            'studyCount' => 'required|numeric|min:1',
            'studyGrowth' => 'required|numeric|min:1',
            'months' => 'required|numeric|min:1',
        ];
    }
}
