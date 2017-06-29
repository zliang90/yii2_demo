<?php
/**
 * Created by PhpStorm.
 * User: zhangliang
 * Date: 17-6-24
 * Time: 上午11:49
 */

use yii\bootstrap\Alert;
use yii\data\Sort;

echo Alert::widget([
    'options' => ['class' => 'alert-info'],
    'body' => Yii::$app->session->getFlash('greeting'),
]);
?>
