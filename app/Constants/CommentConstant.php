<?php

namespace App\Constants;

class CommentConstant
{
    public const TABLE_NAME = 'comments';

    public const FIELD_ID = 'id';
    public const FIELD_CONTENT = 'content';
    public const FIELD_USER_ID = 'user_id';
    public const FIELD_COMMENT_ID = 'comment_id';

    public const FILLABLE = [
        self::FIELD_CONTENT,
        self::FIELD_USER_ID,
        self::FIELD_COMMENT_ID,
    ];
}
