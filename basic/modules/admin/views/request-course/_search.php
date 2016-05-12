<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RequestCourseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-course-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'request_course_id') ?>

    <?= $form->field($model, 'request_date') ?>

    <?= $form->field($model, 'user_fio') ?>

    <?= $form->field($model, 'user_email') ?>

    <?php // echo $form->field($model, 'user_phone') ?>

    <?php // echo $form->field($model, 'user_company') ?>

    <?php // echo $form->field($model, 'user_rank') ?>

    <?php // echo $form->field($model, 'request_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
