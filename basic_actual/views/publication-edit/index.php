<?php

use app\models\Publication;
use app\modules\admin\components\SetColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PublicationEditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Профиль: просмотр публикаций';
?>

<h2><?= $this->title ?></h2>

<div class="publication-edit-index">

    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'public_title',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $column) {
                return Html::a(Html::encode($model->public_title), ['/publication/index' . '#title-' . $model->id]);
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
            'filter' => Publication::getTypesArray(),
            'attribute' => 'public_type',
            'name' => 'typeName',
            'cssCLasses' => [
                Publication::TYPE_ARTICLE => 'label label-default',
                Publication::TYPE_CHAPTER => 'label label-warning',
                Publication::TYPE_BOOK => 'label label-success',
            ],
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'contentOptions' => ['style' => 'white-space: nowrap; text-align: center;'],
        ],

        ['class' => 'yii\grid\CheckboxColumn'],
    ];

    ?>

    <div class="content-panel">
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

</div>
