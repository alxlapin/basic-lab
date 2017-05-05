<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var app\models\Gallery $model */

?>

<div class="image-item">
    <a class="fancybox-button" rel="fancybox-button" href="<?= $model->getImageLink() ?>" title="<?= $model->image_desc ?>">
        <?= Html::img($model->getThumbLink(), ['alt' => '']) ?>
    </a>
</div>
