<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\grid\GridView;
use app\modules\admin\models\Message;
use app\modules\admin\components\SetColumn;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

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

            'message_topic',
            'user_email:email',
            [
                'attribute' => 'message_date',
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
                'filter' => Message::getStatusesArray(),
                'attribute' => 'message_status',
                'name' => 'statusName',
                'cssCLasses' => [
                    Message::STATUS_FINISH => 'label label-success',
                    Message::STATUS_WAIT => 'label label-warning',
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
