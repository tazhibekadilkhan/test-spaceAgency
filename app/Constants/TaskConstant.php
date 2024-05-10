<?php

namespace App\Constants;

class TaskConstant
{
    public const TABLE_NAME = 'tasks';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_STATUS_ID = 'status_id';
    public const FIELD_PRIORITY_ID = 'priority_id';
    public const FIELD_USER_ID = 'user_id';
    public const FIELD_DEADLINE = 'deadline';

    public const FILLABLE = [
        self::FIELD_NAME,
        self::FIELD_DESCRIPTION,
        self::FIELD_DEADLINE,
        self::FIELD_STATUS_ID,
        self::FIELD_PRIORITY_ID,
        self::FIELD_USER_ID,
    ];
}
