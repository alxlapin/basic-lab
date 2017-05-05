<?php

use app\models\Publication;
use app\modules\admin\components\SetColumn;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PublicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="publication-index">

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
                        $val .= Html::a($name, ['/user/index']);
                        $val .= ', ';
                    }
                    return mb_substr($val, 0, -2);
                },
            ],
            [
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => ['format' => 'yyyy-mm', 'clearBtn' => true]
                ]),
                'attribute' => 'public_date',
                'format' => ['date', 'php:M, Y'],
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

    <ul class="nav nav-tabs">
        <li class="active"><a href="<?= Url::toRoute('publication/index') ?>">Публикации</a></li>
        <li><a href="<?= Url::toRoute('keyword/index') ?>">Ключевые слова</a></li>
    </ul>

    <div class="content-panel">
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

</div>
