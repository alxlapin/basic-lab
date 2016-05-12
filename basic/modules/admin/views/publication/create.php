<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Publication */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => 'Публикации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
