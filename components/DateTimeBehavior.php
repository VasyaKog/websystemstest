<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.09.2017
 * Time: 0:08
 */

namespace app\components;


use yii\behaviors\TimestampBehavior;

/**
 * Class DateTimeBehavior
 * @package app\components
 */
class DateTimeBehavior extends TimestampBehavior
{
    protected function getValue($event)
    {
        if ($this->value === null) {
            return date('Y-m-d H:i:s');
        }
        return parent::getValue($event);
    }
}