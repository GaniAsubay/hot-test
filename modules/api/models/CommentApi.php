<?php

namespace app\modules\api\models;

use app\models\Comment;


class CommentApi extends Comment
{
    public function fields()
    {
        return [
            'subject_name',
            'subject_id',
            'username',
            'created_at',
            'comment'
        ];
    }
}