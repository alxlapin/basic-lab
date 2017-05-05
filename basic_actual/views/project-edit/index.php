<?php

use app\models\Project;
use app\modules\admin\components\SetColumn;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectEditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Профиль: просмотр проектов';
?>

<h2><?= $this->title ?></h2>

<div class="project-edit-index form-common">

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
                    $val .= Html::a($name, ['/user/view', 'id' => $author->id]);
                    $val .= ', ';
                }
                return mb_substr($val, 0, -2);
            },
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
