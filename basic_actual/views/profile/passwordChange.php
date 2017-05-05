<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PasswordChangeForm */
?>

<div class="user-profile-password-change">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>