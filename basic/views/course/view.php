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
    <div class="course-item_desc">
        <?= $model->course_desc; ?>
    </div>
    <hr>
    <?php if ($model->course_status == Course::STATUS_OPEN_REG) : ?>
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
                <div class="form-group text-right">
                    <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>
            <?php Pjax::end(); ?>
        </div>

    <?php endif; ?>
</div>