<?php
/**
 * Created by PhpStorm.
 * User: shark.zhang
 * Date: 2017/6/21 021
 * Time: 16:54
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Country';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'email'); ?>

<div class='form-group'>
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']); ?>
</div>

<?php ActiveForm::end(); ?>
