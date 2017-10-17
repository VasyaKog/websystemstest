<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.10.2017
 * Time: 14:11
 */

namespace app\components;


use yii\helpers\FileHelper;

class DirChecker
{
    public static function checkDir($path)
    {
        if (!is_dir($path)) {
            echo "Directory {$path} not exist\n";
            FileHelper::createDirectory($path);
            echo "Create ok\n";
        } else {
            echo "Directory {$path} already exist\n";
        }
    }
}