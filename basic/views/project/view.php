<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var app\models\Project $model */
/* @var app\modules\admin\models\RequestProject $requestModel */

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
    <div class="project-item_desc">
        <?= $model->project_desc; ?>
    </div>
    <hr>
    <div class="project-item_info-bar clear-fx">
        <div class="social-btns">
            <div class="share-btn twtr-share-btn">
                <a href="https://twitter.com/share" class="twitter-share-button" data-via="thealxi">Tweet</a>
            </div>
            <div class="share-btn fb-share-button"
                 data-href="http://www.your-domain.com/your-page.html"
                 data-layout="button_count">
            </div>
        </div>
    </div>
    <?php if ($model->project_status == 1) : ?>
        <hr>
        <div class="send_request-form">
            <?php Pjax::begin(['id' => 'my-pjax', 'enablePushState' => false]); ?>
            <?php if ($statusString == 'saved') : ?>
                <div class="show_request-state">Спасибо, Ваша заявка принята!</div>
            <?php else: ?>
                <?php $form = ActiveForm::begin(['id' => 'send_request-project', 'options' => ['data-pjax' => '1']]);?>
                <?= $form->field($requestModel, 'user_fio')->textInput(); ?>
                <?= $form->field($requestModel, 'user_email')->textInput(); ?>
                <?= $form->field($requestModel, 'user_phone')->textInput(); ?>
                <?= $form->field($requestModel, 'request_quantity')->textInput(); ?>
                <div class="form-group text-right">
                    <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>
            <?php Pjax::end(); ?>
        </div>

    <?php endif; ?>
</div>