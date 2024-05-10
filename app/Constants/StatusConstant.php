<?php

namespace App\Constants;

class StatusConstant
{
    public const TABLE_NAME = 'statuses';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';

    public const FILLABLE = [
        self::FIELD_NAME,
    ];
}
