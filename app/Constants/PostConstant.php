<?php

namespace App\Constants;

class PostConstant
{
    public const TABLE_NAME = 'tasks';

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_CATEGORY_ID = 'category_id';
    public const FIELD_USER_ID = 'user_id';

    public const FILLABLE = [
        self::FIELD_NAME,
        self::FIELD_DESCRIPTION,
        self::FIELD_CATEGORY_ID,
        self::FIELD_USER_ID,
    ];
}
