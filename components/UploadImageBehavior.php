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
 * Class UploadImageBehavior
 *
 * @package app\components
 */
class UploadImageBehavior extends Behavior
{
    public $field = 'photo';

    public $path = '@uploads';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
        ];
    }

    public function beforeSave()
    {
        $file = UploadedFile::getInstance($this->owner, $this->field);
        if (isset($file)) {
            $filename = uniqid() . '.' . $file->extension;
            $path = Yii::getAlias($this->path) . DIRECTORY_SEPARATOR . $filename;
            if ($file->saveAs($path)) {
                $this->owner->{$this->field} = $filename;
            }
        }
    }
}