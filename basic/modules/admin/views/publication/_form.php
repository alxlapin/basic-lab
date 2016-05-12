<?php

use app\models\Keyword;
use app\models\Project;
use app\models\Publication;
use app\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Publication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-form">

    <?php
        $date_mass = [];
        $cur_year = (int) date('Y');
        while ($cur_year >= 2000) {
            $date_mass[$cur_year] = $cur_year;
            $cur_year--;
        }
    ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'public_type')->widget(Select2::className(), [
        'hideSearch' => true,
        'data' => Publication::getTypesArray(),
        'options' => ['placeholder' => 'Выберите тип публикации...'],
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ]); ?>

    <?= $form->field($model, 'authorIds')->widget(Select2::classname(), [
        'data' => User::getFullNames(),
        'options' => [
            'placeholder' => 'Выберите авторов...',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'keywordNames')->widget(Select2::classname(), [
        'data' => Keyword::getKeywords(),
        'options' => [
            'placeholder' => 'Выберите ключевые слова...',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'project_id')->widget(Select2::className(), [
        'data' => Project::getTitles(),
        'options' => ['placeholder' => 'Выберите проект для привязки...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

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

    <?= $form->field($model, 'public_lang')->widget(Select2::className(), [
        'hideSearch' => true,
        'data' => ['русский' => 'Русский', 'английский' => 'Английский', 'немецкий' => 'Немецкий', 'французский' => 'Французский'],
        'options' => ['placeholder' => 'Выберите тип публикации...'],
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ]); ?>

    <?= $form->field($model, 'public_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'public_annotation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'public_info')->textarea(['rows' => 6]) ?>

    <label class="control-label">Файл</label>

    <?php
        function human_filesize($bytes, $decimals = 1) {
            $sz = 'BKMGTP';
            $factor = floor((strlen($bytes) - 1) / 3);
            return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
        }

        if ($actionType == 'update') {
            if ($model->public_file) {
                echo "<div class='existing-files clearfix'>";
                echo "<div class='existing-file-text'>";
                echo "<span class='file-name'>" . "<a href='" . $model->public_file . "' target='_blank'>" . "Полный текст" . "</a> " . "(" . human_filesize(filesize(Yii::getAlias("@webroot") . $model->public_file)) . ")" . "</span>";
                echo "</div>";
                echo "</div>";
            }
        }
        echo $form->field($model, 'attach', ['template' => '{input}<div class="help-block"></div>'])->fileInput(['accept' => 'application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf']);
    ?>

    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
