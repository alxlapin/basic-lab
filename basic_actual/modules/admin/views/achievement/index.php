<?php

use kartik\date\DatePicker;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AchievementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Достижения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievement-index">

    <?php
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

            'achieve_desc:text',
            [
                'attribute' => 'person',
                'label' => 'Имя сотрудника',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    $name = $model->user->user_surname . ' ' . mb_substr($model->user->user_name, 0 , 1) . '.' . mb_substr($model->user->user_patronymic, 0 , 1) . '.';
                    return Html::a($name, ['/user/index']);
                },
            ],
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
        <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'hiddenColumns'=> [4, 5],
            'target' => ExportMenu::TARGET_SELF,
            'exportConfig' => [
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_CSV => false,
            ]
        ]); ?>
        <?= Html::a('Удалить выбранные (' . '<span>0</span>' . ')', false, [
            'class' => 'btn btn-danger multi-delete',
            'data-url' => Url::to(['multi-delete'])]) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{items}\n<div class='text-right'>{pager}</div>",
        'tableOptions' => ['class' => 'table table-bordered table-striped'],
        'columns' => $gridColumns,
    ]); ?>

</div>
