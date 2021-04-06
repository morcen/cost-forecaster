<?php

namespace Forecost\Models\Interfaces;

interface StorageModelInterface
{
    public function computeMonthlyCost(): float | int;
}
