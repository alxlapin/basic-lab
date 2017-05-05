<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var \app\models\User $model */

?>

<div class="labuser-one labuser-common">
    <div class="labuser-topinfo">
        <div class="user_photoimg">
            <a href="<?= Url::to(['/user/view', 'id' => $model->id]) ?>"><img src="<?= $model->getThumbLink(); ?>" alt=""></a>
        </div>
        <div class="user_contact">
            <?php if ($model->user_phone) { ?>
                <div class="user_phone">
                    <span>+7 <?= $model->user_phone ?></span>
                </div>
            <?php } ?>
            <div class="user_mail">
                <span><a href="mailto: <?= $model->user_email ?>"><?= $model->user_email ?></a></span>
            </div>
        </div>
        <div class="user_maininfo">
            <div class="user_name">
                <a href="<?= Url::to(['/user/view', 'id' => $model->id]) ?>">
                    <?= $model->user_surname ?>
                    <?= $model->user_name ?>
                    <?= $model->user_patronymic ?>
                </a>
            </div>
            <div class="user_academic">
                <div class="user_rank">
                    <?php if ($model->user_acdegree) { ?>
                        <div class="academic-item">Ученая степень: <span class="academic-title"><?= $model->user_acdegree; ?></span></div>
                    <?php } ?>
                    <?php if ($model->user_acrank) { ?>
                        <div class="academic-item">Ученое звание: <span class="academic-title"><?= $model->user_acrank; ?></span></div>
                    <?php } ?>
                </div>
            </div>
            <div class="user_interests">
                <?php if ($model->interests) { ?>
                    <div class="academic-title">Профессиональные интересы:</div>
                    <?php foreach ($model->interests as $interest) { ?>
                        <a class="interestname" href="<?= Url::to(['/interest/index', 'id' => $interest->id]); ?>">
                            <?= Html::encode($interest->interest_name); ?>
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<hr>
