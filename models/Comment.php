<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $subject_name
 * @property int $subject_id
 * @property string|null $username
 * @property string $comment
 * @property string $ip_address
 * @property string $user_agent
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Comment extends \yii\db\ActiveRecord
{

    const STATUS_NEW = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_name', 'subject_id', 'comment', 'ip_address', 'user_agent', 'status'], 'required'],
            [['subject_id', 'status'], 'integer'],
            [['comment', 'user_agent'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['subject_name', 'username'], 'string', 'max' => 255],
            [['ip_address'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_name' => 'Subject',
            'subject_id' => 'Subject ID',
            'username' => 'Username',
            'comment' => 'Comment',
            'ip_address' => 'Ip Address',
            'user_agent' => 'User Agent',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_APPROVED => 'Approved',
            self::STATUS_REJECTED => 'Rejected'
        ];
    }

    public function getStatusLabel()
    {
        return self::getStatuses()[$this->status];
    }
}
