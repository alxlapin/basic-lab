<?php

use app\models\Course;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var app\models\Course $model */

?>

<div class="course-item">
    <h2><?= Html::a(Html::encode($model->course_title), ['/course/view', 'id' => $model->id], ['class' => "h2_title-link"]) ?></h2>

    <?php
    if ($model->course_status == Course::STATUS_OPEN_REG) {
        $class = 'status-open';
        $message = 'Регистрация на курс открыта!';
    } else {
        if ($model->course_status == Course::STATUS_CLOSE_REG) {
            $class = 'status-close';
            $message = 'Регистрация на курс приостановлена!';
        }
    }
    ?>
    <div class="course-item_status <?= $class ?>"><?= $message; ?></div>
    <div class="hr-line"></div>
    <div class="course-item_announce">
        <?= $model->course_announce; ?>
    </div>
    <div class="course-item_info-bar clear-fx">
        <a href="<?= Url::to(['/course/view', 'id' => $model->id]); ?>" class="btn-more">Подробнее...</a>
    </div>
    <hr>
</div>