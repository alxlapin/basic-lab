<?php
/* @var $this yii\web\View */

use yii\widgets\ListView;

/* @var \app\models\Keyword $model */

?>

<h2>Результаты поиска по слову: <?= $model->keyword_name; ?></h2>

<?php

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '/publication/_publication',
    'options' => [
        'tag' => 'div',
        'class' => 'publication-list',
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
