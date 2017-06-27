<?php
/**
 * Created by PhpStorm.
 * User: shark.zhang
 * Date: 2017/6/27 027
 * Time: 9:04
 */

namespace app\components;

class ActionHello extends \yii\base\Action {
    public function run() {
        return 'Hello World';
    }
}