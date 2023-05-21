<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m230521_182748_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'subject_name' => $this->string(255)->notNull(),
            'subject_id' => $this->integer(11)->notNull(),
            'username' => $this->string(255)->null()->defaultValue(''),
            'comment' => $this->text()->notNull(),
            'ip_address' => $this->string(15)->notNull(),
            'user_agent' => $this->text()->notNull(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(\app\models\Comment::STATUS_NEW),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),

        ]);

        $this->createIndex(
            'idx-comments-subject_name',
            '{{%comments}}',
            'subject_name'
        );

        $this->createIndex(
            'idx-comments-subject_id',
            '{{%comments}}',
            'subject_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropIndex(
            'idx-comments-subject_name',
            '{{%comments}}'
        );

        $this->dropIndex(
            'idx-comments-subject_id',
            '{{%comments}}',
            );

        $this->dropTable('{{%comments}}');
    }
}
