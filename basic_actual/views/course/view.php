<?php

use app\models\Course;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var app\models\Course $model */
/* @var app\modules\admin\models\RequestCourse $requestModel */

?>

<div class="course-item">
    <h2><?= Html::encode($model->course_title) ?></h2>

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
    <hr class="style_2">
    <div class="course-item_announce" style="margin-top: 10px;">
        <?= $model->course_announce; ?>
    </div>
    <div class="course-item_desc">
        <?= $model->course_desc; ?>
    </div>
    <hr>
    <div class="course-item_info-bar clear-fx">
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
    <?php if ($model->course_status == Course::STATUS_OPEN_REG) : ?>
        <hr>
        <div style="margin-top: 15px;">Вы можете воспользоваться формой ниже, чтобы зарегистрироваться на курс:</div>
        <div class="send_request-form">
            <?php Pjax::begin(['id' => 'my-pjax', 'enablePushState' => false]); ?>
                <?php if ($statusString == 'saved') : ?>
                    <div class="show_request-state">Спасибо, Ваша заявка принята!</div>
                <?php else: ?>
                    <?php $form = ActiveForm::begin(['id' => 'send_request-project', 'options' => ['data-pjax' => '1']]);?>
                    <?= $form->field($requestModel, 'user_fio')->textInput(); ?>
                    <?= $form->field($requestModel, 'user_email')->textInput(); ?>
                    <?= $form->field($requestModel, 'user_phone')->textInput(); ?>
                    <?= $form->field($requestModel, 'user_company')->textInput(); ?>
                    <?= $form->field($requestModel, 'user_rank')->textInput(); ?>
                    <?= $form->field($requestModel, 'addtext')->textarea(['rows' => 6]); ?>
                    <div class="form-group text-right">
                        <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                <?php endif; ?>
            <?php Pjax::end(); ?>
        </div>

    <?php endif; ?>
</div>