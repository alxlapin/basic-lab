<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_post',
    'options' => [
        'tag' => 'div',
        'class' => 'articles_container',
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

?>
