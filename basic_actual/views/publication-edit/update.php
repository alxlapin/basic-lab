<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Publication */

$this->title = 'Профиль: редактирование публикации';

?>
<h2><?= $this->title ?></h2>

<div class="publication-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
