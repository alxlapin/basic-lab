<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AchievementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Достижения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievement-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{items}\n<div class='text-right'>{pager}</div>",
        'tableOptions' => ['class' => 'table table-bordered table-striped'],
        'columns' => [
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
        ],
    ]); ?>
</div>
