<?php
/* @var $this yii\web\View */

use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_image',
    'options' => [
        'tag' => 'div',
        'class' => 'gallery-show',
        'id' => false,
    ],
    'layout' => "{items}\n<div class='text-center'>{pager}</div>",
    'itemOptions' => [
        'tag' => false,
    ],
    'pager' => [
        'firstPageLabel' => 'Первая',
        'lastPageLabel' => 'Последняя',
        'nextPageLabel' => 'Следующая',
        'prevPageLabel' => 'Предыдущая',
        'maxButtonCount' => 5,
    ]
]);