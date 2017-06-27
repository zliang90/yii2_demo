<?php
/**
 * Created by PhpStorm.
 * User: shark.zhang
 * Date: 2017/6/27 027
 * Time: 9:04
 */

namespace app\components;

use yii\base\Action;

class ActionHello extends Action {
    public function run() {
        return 'Hello World';
    }
}