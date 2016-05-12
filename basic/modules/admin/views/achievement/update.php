<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Achievement */

$this->title = 'Update Achievement: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Достижения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="achievement-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
