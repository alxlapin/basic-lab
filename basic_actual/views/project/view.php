<?php

use app\models\Project;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var app\models\Project $model */
/* @var app\modules\admin\models\RequestProject $requestModel */

?>

<div class="project-item">
    <h2 class="title">
        <?= Html::encode($model->project_title); ?>
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
            <div class="share-btn">
                <div class="g-plusone" data-size="medium"></div>
            </div>
        </div>
    </div>
    <?php if ($model->project_status == 1) : ?>
        <hr>
        <div style="margin-top: 15px;">Вы можете воспользоваться формой ниже, чтобы оформить заказ на проект:</div>
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

<?php
    if (!empty($model->posts)) { ?>
        <?php $this->beginBlock('block3'); ?>
            <div class="sidebar-articles">
                <div class="side-title"><span>Новости по проекту</span></div>
                <?php foreach ($model->posts as $ppost) { ?>
                    <div class="top_single">
                        <div class="top_single-date">
                            <?= (new Datetime($ppost->post_date))->format('d.m.Y, H:i'); ?>
                        </div>
                        <div class="top_single-title rel-title">
                            <a href="<?= Url::to(['/post/view', 'id' => $ppost->id]) ?>"><?= $ppost->post_title ?></a>
                        </div>
                        <hr class="sidenormal">
                    </div>
                <?php } ?>
            </div>
        <?php $this->endBlock(); ?>
<?php } ?>


<?php
    if (!empty($model->publications)) { ?>
        <?php $this->beginBlock('block1'); ?>
            <div class="related-publics">
                <div class="side-title"><span>Публикации по проекту</span></div>
                <?php foreach ($model->publications as $related) { ?>
                    <div class="rel-public">
                        <div class="rel-type"><span class="type_name"><?= $related->getTypeName(); ?></span></div>
                        <div class="rel-title">
                            <a href="<?= Url::to(['/publication/index']) ?>#title-<?= $related->id ?>"><?= $related->public_title ?></a>
                        </div>
                        <div class="rel-authors">
                            <?php
                            $total = count($related->authors);
                            $counter = 0;
                            foreach ($related->authors as $relAuthor) { $counter++; ?>
                                <span class="rel-author">
                                    <?php
                                        if ($relAuthor->visibility != 0) {
                                            echo Html::a($relAuthor->getFullName(), ['/user/view', 'id' => $relAuthor->id]);
                                        } else {
                                            echo $relAuthor->getFullName();
                                        }
                                        if ($counter != $total) { echo ', '; }
                                    ?>
                                </span>
                            <?php } ?>
                        </div>
                        <hr class="sidenormal">
                    </div>
                <?php } ?>
            </div>
    <?php $this->endBlock(); ?>
<?php } ?>