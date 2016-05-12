<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var app\models\Post $model */

?>

<div class="news-item">
    <h2><?= Html::a(Html::encode($model->post_title), ['/post/view', 'id' => $model->id], ['class' => "h2_title-link"]) ?></h2>
    <div class="news-item_taginfo">
        <ul class="tags-list">
            <li>Категории:</li>
            <?php foreach ($model->tags as $tag) { ?>
                <li class="news-item_tag">
                    <a href="<?= Url::to(['/tag/index', 'id' => $tag->id]); ?>"><?= Html::encode($tag->tag_name); ?></a><?php if ($tag != end($model->tags)) { echo ','; } ?>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="hr-line"></div>
    <div class="news-item_announce">
        <?= $model->post_announce; ?>
    </div>
    <div class="news-item_info-bar clear-fx">
        <div class="published">
            <span>Дата: </span>
            <span class="published_date"><?= (new Datetime($model->post_date))->format('d M Y, H:i'); ?></span>
        </div>
        <a href="<?= Url::to(['/post/view', 'id' => $model->id]); ?>" class="btn-more">Подробнее...</a>
    </div>
    <hr>
</div>
