<?php

namespace App\Constants;

class PriorityConstant
{
    public const TABLE_NAME = 'priorities';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';

    public const FILLABLE = [
        self::FIELD_NAME,
    ];
}
