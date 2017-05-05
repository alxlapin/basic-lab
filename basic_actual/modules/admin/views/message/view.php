<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Message */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Сообщения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

    <?= DetailView::widget([
        'id' => 'message_table',
        'model' => $model,
        'attributes' => [
            'message_topic',
            'user_name',
            'user_email:email',
            'user_phone',
            'message_text:ntext',
            [
                'attribute' => 'message_status',
                'format' => 'raw',
                'value' => Html::tag('span', Html::encode($model->getStatusName()), [
                    'class' => $model->message_status == 0 ? 'label label-warning' : 'label label-success']),
            ],
        ],
    ]) ?>

    <div class="text-right">
        <p>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>

</div>
