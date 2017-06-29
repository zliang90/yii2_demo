<?php
/**
 * Created by PhpStorm.
 * User: zhangliang
 * Date: 17-6-24
 * Time: 下午12:18
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($model, 'image')->fileInput() ?>
<!--<button type="submit">Submit</button>-->
<?= Html::submitButton('上传', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>
