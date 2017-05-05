<?php
/* @var $this yii\web\View */

use yii\widgets\ListView;

/* @var \app\models\Interest $model */

?>

<h2>Результаты поиска по интересу: <?= $model->interest_name ?></h2>

<?php

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '/user/_user',
    'options' => [
        'tag' => 'div',
        'class' => 'labusers-list',
    ],
    'layout' => "{items}\n{pager}",
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