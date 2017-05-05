<?php

use app\models\Interest;
use app\models\User;
use kartik\select2\Select2;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <div class="user-img">
        <img id="user_img" src="<?= $model->scenario == User::SCENARIO_UPDATE ? $model->getImageLink() : '/images/users/user-default.png'?>" alt="">
        <span class="btn btn-success fileinput-button">
            <span>Изображение...</span>
            <input id="fileupload2" type="file" name="Avatar[user_photo]" accept="image/*" data-url="<?= Url::to(['image-upload'])?>">
        </span>
        <?php if ($model->scenario == User::SCENARIO_UPDATE) {
            if ($model->user_photo != 'user-default.png') {
                $imgName = $model->user_photo;
                $display = 'inline-block';
                $dataid = $model->id;
            } else {
                $imgName = '';
                $display = 'none';
                $dataid = '';
            }
        } ?>
        <a id="delete-avatar" class="btn btn-danger" data-id="<?= $dataid ?>" data-image="<?= $imgName ?>" data-url="<?= Url::to(['image-delete'])?>" style="display: <?= $display ?>;">Удалить</a>
    </div>
    <hr>

    <?php $form = ActiveForm::begin(['id' => 'user-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <fieldset>
        <legend>Учетные данные</legend>
        <div class="field-outer">
            <?= $form->field($model, 'user_login', ['enableAjaxValidation' => true])->textInput() ?>
            <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description')) ?>
            <?= $form->field($model, 'visibility')->dropDownList(User::getStatusesArray()) ?>
        </div>
        <div class="field-outer">
            <?= $form->field($model, 'newPassword')->passwordInput() ?>
            <?= $form->field($model, 'newPasswordRepeat')->passwordInput() ?>
        </div>
    </fieldset>

    <fieldset>
        <legend>Личные данные</legend>
        <div class="field-outer">
            <?= $form->field($model, 'user_surname')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'user_patronymic')->textInput(['maxlength' => true]) ?>
        </div>
    </fieldset>

    <fieldset>
        <legend>Контактные данные</legend>
        <div class="field-outer">
            <?= $form->field($model, 'user_email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'user_phone')->textInput(['maxlength' => true]) ?>
        </div>
    </fieldset>

    <fieldset>
        <legend>Наука</legend>
        <div class="field-outer">
            <?= $form->field($model, 'user_acdegree')->widget(Select2::className(), [
                'hideSearch' => true,
                'data' => User::getDegrees(),
                'options' => ['placeholder' => 'Ученая степень...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]); ?>
            <?= $form->field($model, 'user_acrank')->widget(Select2::className(), [
                'hideSearch' => true,
                'data' => User::getRanks(),
                'options' => ['placeholder' => 'Ученое звание...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]); ?>
            <?= $form->field($model, 'spin_id')->textInput() ?>
            <?= $form->field($model, 'orcid')->textInput() ?>
            <?= $form->field($model, 'researcher_id')->textInput() ?>
            <?= $form->field($model, 'scopus_id')->textInput() ?>
        </div>
    </fieldset>

    <?= $form->field($model, 'interestNames')->widget(Select2::classname(), [
        'data' => Interest::getInterests(),
        'maintainOrder' => true,
        'options' => [
            'placeholder' => 'Выберите интересы...',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'user_biography')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'buttons' => ['orderedlist', 'unorderedlist', 'outdent', 'indent', 'link', 'horizotalrule']
        ]
    ]); ?>

    <label class="control-label">Резюме</label>

    <?php
        if ($model->scenario == User::SCENARIO_UPDATE) {
            if ($model->user_resume) {
                echo "<div class='existing-files clearfix'>";
                echo "<div class='existing-file-text'>";
                echo "<span class='file-name'>" . "<a href='" . $model->user_resume . "' target='_blank'>" . "Резюме" . "</a></span>";
                echo "</div>";
                echo "</div>";
            }
        }
    ?>

    <?= $form->field($model, 'resume', ['template' => '{input}<div class="help-block"></div>'])->fileInput(['accept' => 'application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf']); ?>
    <input type="hidden" name="avatar" value="">
    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
