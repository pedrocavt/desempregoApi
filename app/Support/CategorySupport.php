<?php

namespace App\Support;

class CategorySupport
{
    const JUNIOR = 'Junior';

    const PLENO = 'Pleno';

    const SENIOR = 'Senior';

    public static function getAllCategories()
    {
        return [
            self::JUNIOR,
            self::PLENO,
            self::SENIOR
        ];
    }
}
