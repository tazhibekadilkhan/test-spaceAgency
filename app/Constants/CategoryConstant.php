<?php

namespace App\Constants;

class CategoryConstant
{
    public const TABLE_NAME = 'categories';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';

    public const FILLABLE = [
        self::FIELD_NAME,
    ];
}
