<?php

use yii\db\Migration;

class m170906_214500_user_data extends Migration
{
    public function safeUp()
    {
        $security = new \yii\base\Security();
        $this->batchInsert('{{%user}}',
            [
                'username',
                'auth_key',
                'password_hash',
                'email',
                'created_at',
                'updated_at'
            ],
            [
                [
                    'user1',
                    $security->generateRandomString(32),
                    'password',
                    'user1@mail.com',
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s')
                ],
                [
                    'user2',
                    $security->generateRandomString(32),
                    'password',
                    'user2@mail.com',
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s')
                ]
            ]
        );
    }

    public function safeDown()
    {
        $this->truncateTable('{{%user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170906_214500_user_data cannot be reverted.\n";

        return false;
    }
    */
}
