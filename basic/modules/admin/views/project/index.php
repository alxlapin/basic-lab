<?php

use app\models\Project;
use app\modules\admin\components\SetColumn;
use kartik\date\DatePicker;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <p>
        <?= Html::a('Добавить проект', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{items}\n<div class='text-right'>{pager}</div>",
        'tableOptions' => ['class' => 'table table-bordered table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'project_title',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->project_title, ['/project/view', 'id' => $model->id]);
                },
            ],

            [
                'attribute' => 'authors',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    $val = '';
                    foreach ($model->authors as $author) {
                        $name = $author->user_surname . ' ' . mb_substr($author->user_name, 0 , 1) . '.' . mb_substr($author->user_patronymic, 0 , 1) . '.';
                        $val .= Html::a($name, ['/user/index']);
                        $val .= ', ';
                    }
                    return mb_substr($val, 0, -2);
                },
            ],

            [
                'attribute' => 'created_at',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => ['format' => 'yyyy-mm-dd']
                ]),
                'format' => 'datetime',
            ],

            [
                'class' => SetColumn::className(),
                'filter' => Project::getStatusesArray(),
                'attribute' => 'project_status',
                'name' => 'statusName',
                'cssCLasses' => [
                    Project::STATUS_INDEV => 'label label-warning',
                    Project::STATUS_READY => 'label label-success',
                    Project::STATUS_OLD => 'label label-default',
                ],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'contentOptions' => ['style' => 'white-space: nowrap; text-align: center;'],
            ],

            ['class' => CheckboxColumn::className()],
        ],
    ]); ?>

</div>
