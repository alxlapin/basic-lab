<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'Профиль: добавление проекта';
?>
<h2><?= $this->title ?></h2>
<div class="project-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
