<?php
/**
 * Created by PhpStorm.
 * User: shark.zhang
 * Date: 2017/6/21 021
 * Time: 8:50
 */

use yii\helpers\Html;

?>

<p>You have entered the following information:</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Email</label>: <?= Html::encode($model->email) ?></li>
</ul>
