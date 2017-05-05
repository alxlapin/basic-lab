<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AchievementEditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Профиль: просмотр достижений';
?>

<h2><?= $this->title ?></h2>

<div class="achievement-edit-index form-common">

    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],

        'achieve_desc:text',

        [
            'filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'date_from',
                'attribute2' => 'date_to',
                'type' => DatePicker::TYPE_RANGE,
                'separator' => '-',
                'pluginOptions' => ['format' => 'yyyy-mm', 'clearBtn' => true]
            ]),
            'attribute' => 'achieve_date',
            'format' => ['date', 'php:M Y'],
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'contentOptions' => ['style' => 'white-space: nowrap; text-align: center;'],
        ],

        ['class' => 'yii\grid\CheckboxColumn'],
    ]
    ?>

    <div class="text-left top_opts">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{items}\n<div class='text-right'>{pager}</div>",
        'tableOptions' => ['class' => 'table table-bordered table-striped'],
        'columns' => $gridColumns,
    ]); ?>

</div>
