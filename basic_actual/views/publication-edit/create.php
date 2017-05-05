<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Publication */

$this->title = 'Профиль: добавление публикации';

?>

<h2><?= $this->title ?></h2>

<div class="publication-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
