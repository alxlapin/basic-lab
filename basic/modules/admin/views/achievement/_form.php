<?php

use app\models\User;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Achievement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="achievement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => User::getFullNames(),
        'options' => [
            'placeholder' => 'Выберите автора...',
        ],
        'pluginOptions' => [
            'allowClear' => false,
        ]
    ]); ?>

    <div class="field-date_outer">
        <?= $form->field($model, 'month')->widget(Select2::className(), [
            'hideSearch' => true,
            'data' => ['01' => 'Январь', '02' => 'Февраль'],
            'options' => ['placeholder' => 'Выберите месяц...'],
            'pluginOptions' => [
                'allowClear' => false,
            ],
        ]); ?>

        <?= $form->field($model, 'year')->widget(Select2::className(), [
            'hideSearch' => true,
            'data' => ['2015' => '2015', '2016' => '2016'],
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
