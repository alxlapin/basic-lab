<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = 'Добавить курс';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
