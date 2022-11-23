<?php

namespace App\UseCases;

use App\Models\Spec;

class SpecsCases
{
    public static function GetSpecs()
    {
        return Spec::all();
    }
}
