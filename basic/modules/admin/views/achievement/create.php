<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Achievement */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => 'Достижения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievement-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
