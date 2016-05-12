<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $pswrd_model app\modules\admin\models\PasswordChangeForm */

$this->title = 'Update User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_login, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="user-update">

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" <?php if ($type == 1) echo "class='active'" ?>><a href="#user_data" aria-controls="user_data" role="tab" data-toggle="tab">Основное</a></li>
        <li role="presentation" <?php if ($type == 2) echo "class='active'" ?>><a href="#user_account" aria-controls="#user_account" role="tab" data-toggle="tab">Изменение пароля</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane <?php if ($type == 1) echo "active" ?>" id="user_data">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
        <div role="tabpanel" class="tab-pane <?php if ($type == 2) echo "active" ?>" id="user_account">
            <?= $this->render('passwordChange', [
                'pswrd_model' => $pswrd_model,
                'user_id' => $model->id,
            ]) ?>
        </div>

    </div>

</div>
