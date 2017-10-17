<?php

use yii\db\Migration;

class m170906_202728_add_post_from_user_foreign_key extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'FK_user',
            '{{%post}}',
            'user_id',
            "{{%user}}",
            'id',
            'cascade',
            'cascade'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'FK_user',
            '{{%post}}'
        );
    }

}
