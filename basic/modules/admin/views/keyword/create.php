<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Keyword */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => 'Ключевые слова', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keyword-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
