<?php

namespace App\Support;

class CategorySupport
{
    const JUNIOR = 'Junior';

    const PLENO = 'Pleno';

    const SENIOR = 'Senior';

    /**
     * getAllCategories
     *
     * @return array
     */
    public static function getAllCategories(): array
    {
        return [
            self::JUNIOR,
            self::PLENO,
            self::SENIOR
        ];
    }
}
