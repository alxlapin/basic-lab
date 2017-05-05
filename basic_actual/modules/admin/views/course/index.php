<?php

use app\models\Course;
use app\modules\admin\components\SetColumn;
use kartik\date\DatePicker;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Курсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <?php
        $gridColumns =[
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'course_title',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->course_title, ['/course/view', 'id' => $model->id]);
                },
            ],

            [
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => ['format' => 'yyyy-mm-dd']
                ]),
                'attribute' => 'created_at',
                'format' => ['datetime']
            ],

            [
                'class' => SetColumn::className(),
                'filter' => Course::getStatusesArray(),
                'attribute' => 'course_status',
                'name' => 'statusName',
                'cssCLasses' => [
                    Course::STATUS_CLOSE_REG => 'label label-warning',
                    Course::STATUS_OPEN_REG => 'label label-success',
                    COURSE::STATUS_CLOSE => 'label label-default',
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
        'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'columns' => $gridColumns,
    ]); ?>

</div>
