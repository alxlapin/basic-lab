<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var app\models\Post $model */

?>

<div class="news-item">
    <h2><?= Html::encode($model->post_title); ?></h2>
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
    <div class="news-item_desc">
        <?= $model->post_desc; ?>
    </div>
    <?php if ($model->storages) { ?>
        <div class="news-item_docs clear-fx">
            <div class="docs">Документы:</div>
            <div class="docs docs-list">
                <ul>
                    <?php foreach ($model->storages as $storage) : ?>
                        <li class="doc-item"><a href="<?= $storage->storage_path; ?>"><?= $storage->file_name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php } ?>
    <hr>
    <div class="news-item_info-bar clear-fx">
        <div class="published">
            <span>Дата: </span>
            <span class="published_date"><?= (new Datetime($model->post_date))->format('d M Y, H:i'); ?></span>
        </div>
        <div class="social-btns">
            <div class="share-btn twtr-share-btn">
                <a href="https://twitter.com/share" class="twitter-share-button" data-via="thealxi">Tweet</a>
            </div>
            <div class="share-btn">
                <div class="fb-share-button"
                     data-href="http://www.your-domain.com/your-page.html"
                     data-layout="button_count">
                </div>
            </div>
        </div>
    </div>
</div>

