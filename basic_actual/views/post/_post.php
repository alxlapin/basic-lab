<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var app\models\Post $model */

?>

<div class="article">
    <h2><?= Html::a(Html::encode($model->post_title), ['/post/view', 'id' => $model->id], ['class' => "h2_title-link"]) ?></h2>
    <div class="taglist-outer">
        <i class="tags_icon"></i>
        <?php foreach ($model->tags as $tag) { ?>
            <a class="tagname" href="<?= Url::to(['/tag/index', 'id' => $tag->id]); ?>"><?= Html::encode($tag->tag_name); ?></a>
        <?php } ?>
    </div>
    <hr class="style_2">
    <div class="article_announce">
        <?= $model->post_announce; ?>
    </div>
    <div class="article_infobar clear-fx">
        <div class="published">
            <span></span>
            <span class="published_date"><?= (new Datetime($model->post_date))->format('d.m.Y, H:i'); ?></span>
        </div>
        <a href="<?= Url::to(['/post/view', 'id' => $model->id]); ?>" class="btn-more">Подробнее...</a>
    </div>
</div>
<hr>
