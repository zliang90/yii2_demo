<?php
/**
 * Created by PhpStorm.
 * User: shark.zhang
 * Date: 2017/6/21 021
 * Time: 17:35
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>

    <h1>Countries</h1>

    <table class="table table-hover">
        <caption></caption>
        <thead>
        <tr>
            <?php foreach (array_keys($sort->attributes) as $field): ?>
                <th> <?= $sort->link($field); ?> </th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($countries as $country): ?>
            <tr>
                <td><?= $country->code ?></td>
                <td><?= $country->name ?></td>
                <td><?= $country->population ?></td>
                <td>
                    <?= Html::button('修改', ['class' => 'btn btn-sm']) ?>
                    <?= Html::button('删除', ['class' => 'btn btn-sm']) ?>
                    <!--                    <button class="btn btn-sm">修改</button>&nbsp;<button class="btn btn-sm">删除</button>-->
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?= LinkPager::widget(['pagination' => $pagination]); ?>