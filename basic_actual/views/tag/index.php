<?php
/* @var $this yii\web\View */

use yii\widgets\ListView;

/* @var \app\models\Tag $model */

?>

    <h2>Результаты поиска по категории: <?= $model->tag_name; ?></h2>

<?php

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '/post/_post',
    'options' => [
        'tag' => 'div',
        'class' => 'articles_container',
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