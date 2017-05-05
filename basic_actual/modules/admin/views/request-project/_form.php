<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RequestProject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'request_project_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_date')->textInput() ?>

    <?= $form->field($model, 'user_fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
