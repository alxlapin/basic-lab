<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\KeywordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ключевые слова';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keyword-index">

    <ul class="nav nav-tabs">
        <li><a href="<?= Url::toRoute('publication/index') ?>">Новости</a></li>
        <li class="active"><a href="<?= Url::toRoute('keyword/index') ?>">Ключевые слова</a></li>
    </ul>

    <div class="content-panel">
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
                'keyword_name',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'contentOptions' => ['style' => 'white-space: nowrap; text-align: center;'],
                ],
                ['class' => 'yii\grid\CheckboxColumn'],
            ],
        ]); ?>
    </div>
</div>
