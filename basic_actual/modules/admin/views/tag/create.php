<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tag */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => 'Новостные теги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
