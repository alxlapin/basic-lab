<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var app\models\Post $model */

?>

<div class="article article-view">
    <h2><?= Html::encode($model->post_title); ?></h2>
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
    <div class="article_desc">
        <?= $model->post_desc; ?>
    </div>
    <?php if ($model->storages) { ?>
        <div class="article_docs clear-fx">
            <div class="docs">Документы:</div>
            <div class="docs doclist">
                <ul>
                    <?php
                        foreach ($model->storages as $storage) {
                            $extension = substr(strrchr($storage->storage_path, '.'), 1);
                            if ($extension == 'doc' || $extension == 'docx') {
                                $extclass = 'ext_doc';
                            } else {
                                if ($extension == 'pdf') {
                                    $extclass = 'ext_pdf';
                                }
                            }
                        ?>
                        <li class="docname <?= $extclass ?>">
                            <a href="<?= $storage->storage_path; ?>" target="_blank"><?= $storage->file_name; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>
    <hr class="hrnormal">
    <div class="article_infobar clear-fx">
        <div class="published">
            <span></span>
            <span class="published_date"><?= (new Datetime($model->post_date))->format('d.m.Y, H:i'); ?></span>
        </div>
        <div class="social-btns">
            <div class="share-btn twtr-share-btn">
                <a href="https://twitter.com/share" class="twitter-share-button" data-via="thealxi">Tweet</a>
            </div>
            <div class="share-btn fb-share-button"
                 data-href="http://www.your-domain.com/your-page.html"
                 data-layout="button_count">
            </div>
            <div class="share-btn">
                <div class="g-plusone" data-size="medium"></div>
            </div>
        </div>
    </div>
</div>

