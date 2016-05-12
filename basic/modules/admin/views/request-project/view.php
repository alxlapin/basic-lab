<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RequestProject */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки на проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-project-view">

    <?php Pjax::begin(['enablePushState' => false]) ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'project',
                    'format' => 'raw',
                    'value' => Html::a($model->project->project_title, ['/project/index', 'id' => $model->project->id]),
                ],
                'request_date',
                'user_fio',
                'user_email:email',
                'user_phone',
                'request_quantity',
                [
                    'attribute' => 'request_status',
                    'format' => 'raw',
                    'value' => Html::tag('span', Html::encode($model->getStatusName()), [
                        'class' => $model->request_status == 0 ? 'label label-warning' : 'label label-success']),
                ]
            ],
        ]) ?>

        <div class="text-right">
            <p>
                <?php if (!$model->request_status) {
                    echo Html::a('Утвердить заявку', ['updatestatus', 'id' => $model->id], [
                        'class' => 'btnupd btn btn-success',
                    ]);
                } ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>

    <?php Pjax::end(); ?>

</div>
