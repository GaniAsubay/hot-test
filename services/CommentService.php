<?php
namespace app\services;

use app\models\Comment;
use Yii;

class CommentService
{
    public function setAdditionalAttributes(Comment $model) {
        $model->ip_address = Yii::$app->getRequest()->getUserIP();
        $model->user_agent = Yii::$app->getRequest()->getUserAgent();
        $model->status = Comment::STATUS_NEW;
    }
}