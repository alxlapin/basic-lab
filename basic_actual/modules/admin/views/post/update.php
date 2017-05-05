<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $uploadModel app\models\UploadForm */

$this->title = 'Update Post: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="post-update">

    <?= $this->render('_form', [
        'model' => $model,
        'uploadModel' => $uploadModel,
        'actionType' => 'update',
    ]) ?>

</div>
