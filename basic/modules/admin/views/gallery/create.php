<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Gallery */

$this->title = Yii::t('app', 'Create Gallery');
$this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить изображение';
?>
<div id="gallery-create" class="gallery-create">

    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Выберите файлы...</span>
        <input id="fileupload" type="file" name="Gallery[uploadedImage]" accept="image/*" data-url="/index.php/admin/gallery/image-upload" multiple>
    </span>

    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
    </div>

    <div id="added-files"></div>

</div>
