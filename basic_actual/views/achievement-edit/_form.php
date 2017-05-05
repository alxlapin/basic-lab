<?php

use app\models\User;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Achievement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="achievement-form form-common">

    <?php
    $date_mass = [];
    $cur_year = (int) date('Y');
    while ($cur_year >= 2000) {
        $date_mass[$cur_year] = $cur_year;
        $cur_year--;
    }
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <div class="field-date_outer">
        <?= $form->field($model, 'month')->widget(Select2::className(), [
            'hideSearch' => true,
            'data' => [
                '01' => 'Январь',
                '02' => 'Февраль',
                '03' => 'Март',
                '04' => 'Апрель',
                '05' => 'Май',
                '06' => 'Июнь',
                '07' => 'Июль',
                '08' => 'Август',
                '09' => 'Сентябрь',
                '10' => 'Октябрь',
                '11' => 'Ноябрь',
                '12' => 'Декабрь',
            ],
            'options' => ['placeholder' => 'Выберите месяц...'],
            'pluginOptions' => [
                'allowClear' => false,
            ],
        ]); ?>

        <?= $form->field($model, 'year')->widget(Select2::className(), [
            'hideSearch' => true,
            'data' => $date_mass,
            'options' => ['placeholder' => 'Выберите год...'],
            'pluginOptions' => [
                'allowClear' => false,
            ],
        ]); ?>
    </div>

    <?= $form->field($model, 'achieve_desc')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
