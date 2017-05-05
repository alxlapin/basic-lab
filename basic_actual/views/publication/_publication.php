<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/**
 * @var \app\models\Publication $model
 */

?>

<div class="public-item">
    <h2 class="title">
        <a class="title-anchor" name="title-<?= $model->id; ?>"><?= Html::encode($model->public_title); ?></a>
        <?php
            if ($model->public_type == 0) {
                $class = 'flag_article';
            } else {
                if ($model->public_type == 1) {
                    $class = 'flag_chapter';
                } else {
                    $class = 'flag_book';
                }
            }
        ?>
        <span class="flag <?= $class; ?>"><?= mb_strtolower($model->getTypeName()); ?></span>
    </h2>
    <div class="public-item_info">
        <?php if($model->public_type == 1) : ?>
            В кн.:
        <?php endif; ?>
        <?= Html::encode($model->public_info); ?>
    </div>
    <?php if ($model->project) : ?>
        <div class="public-item_project">Подготовлена по результатам проекта:
            <?= Html::a(Html::encode($model->project->project_title), ['/project/view', 'id' => $model->project->id]); ?>
        </div>
    <?php endif; ?>
    <div class="keyword-list-container">
        <ul class="keyword-list">
            <li>Ключевые слова:</li>
            <?php foreach ($model->keywords as $keyword) { ?>
                <li class="keyword">
                    <?= Html::a(Html::encode($keyword->keyword_name), ['/keyword/index', 'id' => $keyword->id]); ?><?php if ($keyword != end($model->keywords)) { echo ','; } ?>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="author-list-container">
        <ul class="author-list">
            <li>Авторы:</li>
            <?php foreach ($model->authors as $author) { ?>
                <li class="author">
                    <?php
                    if ($author->visibility != 0) {
                        echo Html::a(Html::encode($author->getFullName()), ['/user/view', 'id' => $author->id], ['class' => 'user_isable']);
                    } else {
                        echo Html::a(Html::encode($author->getFullName()), false);
                    }
                    ?>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="text-right"><button class="show-desc">Подробнее <span class="show-desc_icon"></button></div>
    <div class="public-item_desc">
        <div class="public-item_desc-container">
            <p class="public-document">
                <?php
                $extension = substr(strrchr($model->public_file, '.'), 1);
                if ($extension == 'pdf')
                    $class= 'ext_pdf';
                else if (in_array($extension, ['doc', 'docx']))
                    $class = 'ext_doc';
                ?>
                <?= Html::a('Полный текст', $model->public_file, ['target' => '_blank', 'class' => $class]) ?>
            </p>
            <p class="annotation">
                <?= nl2br($model->public_annotation); ?>
            </p>
        </div>
    </div>
</div>
<hr>
