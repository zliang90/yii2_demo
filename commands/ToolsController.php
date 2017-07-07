<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class ToolsController extends Controller {

    public function actionRandStr() {
        $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    }

}