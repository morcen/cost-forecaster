<?php

namespace LSM\Models\Interfaces;

interface StorageModelInterface
{
    public function computeMonthlyCost(): float | int;
}
