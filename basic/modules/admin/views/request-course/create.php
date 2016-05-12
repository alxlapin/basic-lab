<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RequestCourse */

$this->title = 'Create Request Course';
$this->params['breadcrumbs'][] = ['label' => 'Request Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
