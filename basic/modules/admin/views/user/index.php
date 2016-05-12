<?php

use app\models\User;
use app\modules\admin\components\RoleColumn;
use app\modules\admin\components\SetColumn;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{items}\n<div class='text-right'>{pager}</div>",
        'tableOptions' => ['class' => 'table table-bordered table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                'format' => 'datetime',
            ],
            [
                'attribute' => 'user_login',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a(Html::encode($model->user_login), ['view', 'id' => $model->id]);
                }
            ],
            'user_email:email',
            [
                'class' => RoleColumn::className(),
                'filter' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'),
                'attribute' => 'role',
            ],
            [
                'contentOptions' =>['style' => 'vertical-align: middle; text-align: center;'],
                'class' => SetColumn::className(),
                'filter' => User::getStatusesArray(),
                'attribute' => 'visibility',
                'name' => 'statusName',
                'cssCLasses' => [
                    User::STATUS_HIDDEN => 'glyphicon glyphicon-remove text-danger',
                    User::STATUS_VISIBLE => 'glyphicon glyphicon-ok text-success',
                ],
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
