<?php

use app\models\Project;
use app\modules\admin\components\SetColumn;
use kartik\date\DatePicker;
use kartik\export\ExportMenu;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <?php
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

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
        ]
    ?>

    <div class="text-left top_opts">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'hiddenColumns'=> [5, 6],
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
