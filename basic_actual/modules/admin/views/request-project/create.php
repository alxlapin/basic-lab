<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RequestProject */

$this->title = 'Create Request Project';
$this->params['breadcrumbs'][] = ['label' => 'Request Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-project-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
