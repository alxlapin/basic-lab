<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PublicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'public_date') ?>

    <?= $form->field($model, 'public_type') ?>

    <?= $form->field($model, 'public_title') ?>

    <?php // echo $form->field($model, 'public_annotation') ?>

    <?php // echo $form->field($model, 'public_info') ?>

    <?php // echo $form->field($model, 'public_lang') ?>

    <?php // echo $form->field($model, 'public_file') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
