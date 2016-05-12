<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\RequestCourse;
use app\modules\admin\components\SetColumn;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
//use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RequestCourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на курсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-course-index">

    <?php Pjax::begin() ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{summary}\n{items}\n<div class='text-right'>{pager}</div>",
            'tableOptions' => ['class' => 'table table-bordered table-striped'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],


                [
                    'attribute' => 'course',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $column) {
                        return Html::a($model->course->course_title, ['/course/view', 'id' => $model->course->id]);
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
                    'filter' => RequestCourse::getStatusesArray(),
                    'attribute' => 'request_status',
                    'name' => 'statusName',
                    'cssCLasses' => [
                        RequestCourse::STATUS_FINISH => 'label label-success',
                        RequestCourse::STATUS_WAIT => 'label label-warning',
                    ],
                ],
//                'user_fio',
//                'user_email:email',
                // 'user_phone',
                // 'user_company',
                // 'user_rank',
                // 'request_status',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                    'contentOptions' => ['style' => 'white-space: nowrap; text-align: center;'],
                ],

                ['class' => 'yii\grid\CheckboxColumn'],
            ],
        ]); ?>
    <?php Pjax::end() ?>

</div>
