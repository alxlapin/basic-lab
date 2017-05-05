<?php

use app\models\Project;
use app\models\User;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authorIds')->widget(Select2::classname(), [
        'data' => User::getFullNames(),
        'options' => [
            'placeholder' => 'Выберите авторов...',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'project_status')->widget(Select2::className(), [
        'hideSearch' => true,
        'data' => Project::getStatusesArray(),
        'options' => ['placeholder' => 'Выберите статус...'],
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ]); ?>

    <?= $form->field($model, 'project_announce')->widget(Widget::classname(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload' => Url::to(['/admin/default/image-upload']),
            'imageManagerJson' => Url::to(['/admin/default/images-get']),
            'plugins' => [
                'table',
                'fullscreen',
                'imagemanager'
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'project_desc')->widget(Widget::classname(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload' => Url::to(['/admin/default/image-upload']),
            'imageManagerJson' => Url::to(['/admin/default/images-get']),
            'plugins' => [
                'table',
                'fullscreen',
                'imagemanager'
            ]
        ]
    ]); ?>

    <label class="control-label">Цена</label>
    <?= $form->field($model, 'project_price', [
        'template' => '<div class="input-group" style="width: 220px;">{input}<span class="input-group-addon">руб.</span></div><div class="help-block"></div>'])->textInput(); ?>

    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
