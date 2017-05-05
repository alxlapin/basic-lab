<?php

use app\models\Project;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var app\models\Project $model */

?>

<div class="project-item">
    <h2 class="title">
        <?= Html::a(Html::encode($model->project_title), ['/project/view', 'id' => $model->id], ['class' => "h2_title-link"]) ?>
        <?php
        if ($model->project_status == Project::STATUS_INDEV) {
            $class = 'flag_indev';
        } else {
            if ($model->project_status == Project::STATUS_READY) {
                $class = 'flag_ready';
            } else {
                $class = 'flag_old';
            }
        }
        ?>
        <span class="flag <?= $class; ?>"><?= mb_strtolower($model->getStatusName()); ?></span>
    </h2>
    <div class="author-list-container">
        <ul class="author-list">
            <li>Авторы:</li>
            <?php foreach ($model->authors as $author) : ?>
                <li class="author">
                    <?php
                    if ($author->visibility != 0) {
                        echo Html::a(Html::encode($author->getFullName()), ['/user/view', 'id' => $author->id], ['class' => 'user_isable']);
                    } else {
                        echo Html::a(Html::encode($author->getFullName()), false);
                    }
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <hr class="style_2">
    <div class="project-item_announce">
        <?= $model->project_announce; ?>
    </div>
    <div class="project-item_info-bar clear-fx">
        <a href="<?= Url::to(['/project/view', 'id' => $model->id]); ?>" class="btn-more">Подробнее...</a>
    </div>
</div>
<hr>
