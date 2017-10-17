<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\DirChecker;
use yii\console\Controller;
use Yii;
use yii\helpers\FileHelper;


class DefaultController extends Controller
{
    public function actionCreateFolders()
    {
        DirChecker::checkDir(Yii::getAlias('@uploads'));
        DirChecker::checkDir(Yii::getAlias('@uploadsImg'));
        echo "Ok\n";
    }
}
