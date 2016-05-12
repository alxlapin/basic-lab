<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var app\models\Project $model */

?>

<div class="project-item">
    <h2><?= Html::a(Html::encode($model->project_title), ['/project/view', 'id' => $model->id], ['class' => "h2_title-link"]) ?></h2>
    <div class="author-list-container">
        <ul class="author-list">
            <li>Авторы:</li>
            <?php foreach ($model->authors as $author) : ?>
                <li class="author">
                    <?php if ($author->visibility != 0) : ?>
                        <?= Html::a(Html::encode($author->getFullName()), ['/user/view', 'id' => $author->id]); ?>
                    <?php else : echo Html::encode($author->getFullName()); endif ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="project-item_status">
        <span>Статус проекта:</span>
        <?php
        if ($model->project_status == 0) {
            $class = 'span-dev';
        } else {
            if ($model->project_status == 1) {
                $class = 'span-ready';
            } else {
                $class = 'span-old';
            }
        }
        ?>
        <span class="project_status <?= $class ?>"><?= $model->getStatusName(); ?></span>
    </div>
    <div class="hr-line"></div>
    <div class="project-item_announce">
        <?= $model->project_announce; ?>
    </div>
    <div class="project-item_info-bar clear-fx">
        <a href="<?= Url::to(['/project/view', 'id' => $model->id]); ?>" class="btn-more">Подробнее...</a>
    </div>
    <hr>
</div>
