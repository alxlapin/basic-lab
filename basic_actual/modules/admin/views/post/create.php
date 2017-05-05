<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $uploadModel app\models\UploadForm */

$this->title = 'Добавить новость';
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <?= $this->render('_form', [
        'model' => $model,
        'uploadModel' => $uploadModel,
    ]) ?>

</div>
