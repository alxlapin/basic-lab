<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gallery */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Gallery',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="gallery-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
