<?php

use app\models\Interest;
use app\models\User;
use kartik\select2\Select2;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id' => 'user-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <fieldset>
        <legend>Учетные данные</legend>
        <div class="field-outer">
            <?= $form->field($model, 'user_login', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>
            <?php if($model->scenario != User::SCENARIO_UPDATE) {
                echo  $form->field($model, 'user_password')->passwordInput(['maxlength' => true]);
            } ?>
        </div>
        <div class="field-outer">
            <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description')) ?>
            <?= $form->field($model, 'visibility')->dropDownList(User::getStatusesArray()) ?>
        </div>
    </fieldset>

    <fieldset>
        <legend>Личные данные</legend>
        <div class="field-outer">
            <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'user_surname')->textInput(['maxlength' => true]) ?>
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

    <label class="control-label">Файл</label>

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

    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
