<?php

use app\models\Post;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Tag;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $uploadModel app\models\UploadForm */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => 'post-form', 'enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'post_date')->widget(DateTimePicker::classname(), [
        'options' => ['value' => (new DateTime($model->post_date))->format('d.m.Y H:i')],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd.mm.yyyy hh:ii'
        ]
    ]); ?>

    <?= $form->field($model, 'post_type')->widget(Select2::className(), [
        'hideSearch' => true,
        'data' => Post::getStatusesArray(),
        'options' => ['placeholder' => 'Выберите статус...'],
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ]); ?>

    <?= $form->field($model, 'tagNames')->widget(Select2::classname(), [
        'data' => Tag::getTags(),
        'maintainOrder' => true,
        'options' => [
            'placeholder' => 'Выберите теги...',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'post_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_announce')->widget(Widget::classname(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 500,
            'imageUpload' => Url::to(['/admin/default/image-upload']),
            'imageManagerJson' => Url::to(['/admin/default/images-get']),
            'plugins' => [
                'video',
                'table',
                'fullscreen',
                'imagemanager'
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'post_desc')->widget(Widget::classname(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 500,
            'imageUpload' => Url::to(['/admin/default/image-upload']),
            'imageManagerJson' => Url::to(['/admin/default/images-get']),
            'plugins' => [
                'video',
                'table',
                'fullscreen',
                'imagemanager'
            ]
        ]
    ]); ?>

    <label class="control-label">Документы</label>

    <?php
        if ($actionType == 'update') {
            echo "<div class='existing-files clearfix'>";
            foreach($model->storages as $fileInfo) {
                echo "<div class='existing-file-" . $fileInfo->id . "'>";
                echo "<span class='file-name'>" . $fileInfo->file_name . "</span>";
                echo "<span class='delete-file' data-id='" . $fileInfo->id . "'></span>";
                echo "</div>";
            }
            echo "</div>";
        }
    ?>

    <div class="form-group field-uploadform-files">
        <input class="post-input-file" type="file" name="UploadForm[files][]" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf">
    </div>

    <span id="add-input-btn" class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span></span>
    </span>
<!--    <div id="add-file"></div>-->

    <div id="files-to-delete"></div>

    <div id="s-b-form" class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
