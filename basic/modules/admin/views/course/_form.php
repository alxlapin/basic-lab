<?php

use app\models\Course;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_status')->widget(Select2::className(), [
        'hideSearch' => true,
        'data' => Course::getStatusesArray(),
        'options' => ['placeholder' => 'Выберите статус...'],
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ]); ?>

    <?= $form->field($model, 'course_announce')->widget(Widget::classname(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 400,
            'imageUpload' => Url::to(['/admin/default/image-upload']),
            'imageManagerJson' => Url::to(['/admin/default/images-get']),
            'plugins' => [
                'table',
                'fullscreen',
                'imagemanager'
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'course_desc')->widget(Widget::classname(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 400,
            'imageUpload' => Url::to(['/admin/default/image-upload']),
            'imageManagerJson' => Url::to(['/admin/default/images-get']),
            'plugins' => [
                'table',
                'fullscreen',
                'imagemanager'
            ]
        ]
    ]); ?>


    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
