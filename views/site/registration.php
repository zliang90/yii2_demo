<?php
/**
 * Created by PhpStorm.
 * User: zhangliang
 * Date: 17-6-24
 * Time: 上午12:31
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <?php $form = ActiveForm::begin(['id' => 'registration-form']); ?>

        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'photos[]')->fileInput(['multiple' => 'multiple']) ?>
        <?= $form->field($model, 'subscriptions[]')->checkboxList(['a' => 'Item A',
            'b' => 'Item B', 'c' => 'Item C']) ?>

        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary',
                'name' => 'registration-button']) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-lg-3"></div>
</div>
