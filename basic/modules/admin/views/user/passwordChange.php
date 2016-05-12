<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $pswrd_model app\modules\admin\models\PasswordChangeForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['action' => Url::to(['update', 'id' => $user_id, 'type' => 2])]); ?>

    <?= $form->field($pswrd_model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($pswrd_model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($pswrd_model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>