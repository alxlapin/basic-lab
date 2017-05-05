<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\RequestProject;
use app\modules\admin\components\SetColumn;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RequestProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-project-index">

    <p class="text-right">
        <?= Html::a('Удалить выбранные (' . '<span>0</span>' . ')', false, [
            'class' => 'btn btn-danger multi-delete',
            'data-url' => Url::to(['multi-delete'])]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{items}\n<div class='text-right'>{pager}</div>",
        'tableOptions' => ['class' => 'table table-bordered table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'project',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->project->project_title, ['/project/view', 'id' => $model->project->id]);
                },
            ],

            'user_email:email',

            [
                'attribute' => 'request_date',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => ['format' => 'yyyy-mm-dd']
                ]),
                'format' => 'datetime'
            ],

            [
                'class' => SetColumn::className(),
                'filter' => RequestProject::getStatusesArray(),
                'attribute' => 'request_status',
                'name' => 'statusName',
                'cssCLasses' => [
                    RequestProject::STATUS_FINISH => 'label label-success',
                    RequestProject::STATUS_WAIT => 'label label-warning',
                ],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'contentOptions' => ['style' => 'white-space: nowrap; text-align: center;'],
            ],

            ['class' => 'yii\grid\CheckboxColumn'],
        ],
    ]); ?>

</div>
