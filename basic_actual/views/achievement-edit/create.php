<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Achievement */

$this->title = 'Профиль: добавление достижения';
?>

<h2><?= $this->title ?></h2>

<div class="achievement-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
