<?php

namespace app\models;

use app\components\DateTimeBehavior;
use app\components\UploadImageBehavior;
use app\components\ViewImageBehavior;
use Yii;

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
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function behaviors()
    {
        return [
            DateTimeBehavior::className(),
            [
                'class' => UploadImageBehavior::className(),
                'path' => '@uploadsImg',
                'field' => 'photo'
            ],
            [
                'class' => ViewImageBehavior::className(),
                'path' => '@uploadsImgUrl',
                'field' => 'photo'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'content'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['content', 'photo'], 'string'],
            [['photo'], 'image', 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 1],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'photo' => Yii::t('app', 'Photo'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        return self::getStatuses()[$this->status];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
            self::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
        ];
    }
}
