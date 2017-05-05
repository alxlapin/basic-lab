<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Keyword */

$this->title = 'Update Keyword: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ключевые слова', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="keyword-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
