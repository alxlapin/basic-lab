<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

    <p>
        <?= nl2br('Общество с ограниченной ответственностью «ВЕК-21» - это молодая инновационная компания, основанная в начале 2009 года.

        Основная цель компании – разработка новых решений в сфере IT. Большинство текущих разработок базируется на результатах научных исследований, которыми занимались сотрудники компании на протяжении последних лет, а также на базе успешно реализованных коммерческих проектов. Специалисты «ВЕК-21» имеют многолетний опыт в области компьютерных систем и сетей, беспроводных сенсорных сетей, систем мониторинга, виртуальной реальности и захвата движения. Также сотрудники компании готовы разработать программное обеспечение и беспроводные решения любой сложности, в том числе и для мобильных приложений.'); ?>
    </p>

    <hr class="hrdashed">

    <div>Вы можете отправить сообщение с помощью нашей формы обратной связи (не забудьте оставить актуальную контактную информацию):</div>

    <div class="send_request-form">
        <?php Pjax::begin(['id' => 'feedback-pjax', 'enablePushState' => false]); ?>
            <?php if ($statusString == 'saved') : ?>
                <div class="show_request-state">Спасибо, Ваш отклик учтен!</div>
            <?php else: ?>
                <?php $form = ActiveForm::begin(['id' => 'send_request-project', 'options' => ['data-pjax' => '1']]);?>
                    <?= $form->field($messageModel, 'user_name')->textInput(); ?>
                    <?= $form->field($messageModel, 'user_email')->textInput(); ?>
                    <?= $form->field($messageModel, 'user_phone')->textInput(); ?>
                    <?= $form->field($messageModel, 'message_topic')->textInput(); ?>
                    <?= $form->field($messageModel, 'message_text')->textarea(['rows' => 6]); ?>
                    <div class="form-group text-right">
                        <?= Html::submitButton('Отправить отклик', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>
        <?php Pjax::end(); ?>
    </div>

</div>
