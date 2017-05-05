<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Galleries');
$this->params['breadcrumbs'][] = 'Галерея';
?>
<div class="gallery-index">

    <p class="top_opts">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
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

            'image_desc',

            [
                'label' => 'Изображение',
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                    return "<a class='single_2' href='/images/gallery/" . $model->image_name . "' title='" . $model->image_desc . "'>" .
                            Html::img('/images/gallery/thumbs/' . $model->image_name, [
                                'alt' => '',
                            ]) . "</a>";
                }
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
