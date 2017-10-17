<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.10.2017
 * Time: 14:43
 */

namespace app\components;


use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use Yii;

/**
 * Class ViewImageBehavior
 *
 * @package app\components
 *
 * @property string $thumbnail
 */
class ViewImageBehavior extends Behavior
{
    public $field = 'photo';

    public $path = '@uploads';


    public function getThumbnail()
    {
        return Yii::getAlias('@uploadsImgUrl') . '/' . $this->owner->{$this->field};
    }
}