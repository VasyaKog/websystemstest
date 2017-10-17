<?php

namespace app\models;

use app\components\DateTimeBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $photo
 * @property string $content
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Post[] $posts
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function behaviors()
    {
        return [
            DateTimeBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token, 'status' => User::STATUS_ACTIVE]);
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password_hash === $password;
    }

    /**
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => User::STATUS_ACTIVE]);
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }
}
