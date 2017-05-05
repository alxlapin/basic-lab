<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var app\models\Post $model */

?>

<div class="article">
    <h2><?= Html::a(Html::encode($model->post_title), ['/post/view', 'id' => $model->id], ['class' => "h2_title-link"]) ?></h2>
</div>
<hr>