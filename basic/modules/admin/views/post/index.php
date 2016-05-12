<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use app\modules\admin\components\SetColumn;
use app\models\Post;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <ul class="nav nav-tabs">
        <li class="active"><a href="<?= Url::toRoute('post/index') ?>">Новости</a></li>
        <li><a href="<?= Url::toRoute('tag/index') ?>">Теги</a></li>
    </ul>
    <div class="content-panel">
        <p>
            <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{summary}\n{items}\n<div class='text-right'>{pager}</div>",
            'tableOptions' => ['class' => 'table table-bordered table-striped'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'post_title',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $column) {
                        return Html::a($model->post_title, ['/post/view', 'id' => $model->id]);
                    },
                ],

                [
                    'attribute' => 'post_date',
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
                    'attribute' => 'updated_at',
                    'format' => 'datetime',
                ],
                //'post_author_id',
                //'post_announce:ntext',
                // 'post_desc:ntext',
                [
                    'class' => SetColumn::className(),
                    'filter' => Post::getStatusesArray(),
                    'attribute' => 'post_type',
                    'name' => 'statusName',
                    'cssCLasses' => [
                        Post::STATUS_DRAFT => 'label label-default',
                        Post::STATUS_COMMON => 'label label-warning',
                        Post::STATUS_TOP => 'label label-success',
                    ],
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'contentOptions' => ['style' => 'white-space: nowrap; text-align: center;'],
                ],

                ['class' => 'yii\grid\CheckboxColumn'],
            ],

            'pager' => [
                'maxButtonCount' => 5,
            ],

        ]); ?>
    </div>

</div>
