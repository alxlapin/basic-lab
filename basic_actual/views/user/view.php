<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var \app\models\User $model */

?>

<div class="labuser-one labuser-view">
    <div class="labuser-topinfo">
        <div class="user_photoimg">
            <img src="<?= $model->getImageLink(); ?>" alt="">
        </div>
        <div class="user_maininfo">
            <div class="user_name ">
                <?= $model->user_surname ?>
                <?= $model->user_name ?>
                <?= $model->user_patronymic ?>
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
            <?php if ($model->user_resume) {
                $extension = substr(strrchr($model->user_resume, '.'), 1);
                if ($extension == 'doc' || $extension == 'docx') {
                    $extclass = 'ext_doc';
                } else {
                    if ($extension == 'pdf') {
                        $extclass = 'ext_pdf';
                    }
                } ?>
                <a class="user_resume <?= $extclass?>" href="<?= $model->user_resume ?>" target="_blank">Резюме</a>
            <?php } ?>
            <hr class="hrnormal">
            <div class="user_contact">
                <?php if ($model->user_phone) { ?>
                    <div class="user_phone">
                        +7 <?= $model->user_phone ?>
                    </div>
                <?php } ?>
                <div class="user_mail">
                    <a href="mailto: <?= $model->user_email ?>"><?= $model->user_email ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="labuser-mainblock">
        <ul class="nav nav-tabs" style="height: 35px;">
            <li role="presentation" class="active"><a href="#labuser-about" data-toggle="tab">Биография</a></li>
            <li role="presentation"><a href="#labuser-publics" data-toggle="tab">Публикации</a></li>
            <li role="presentation"><a href="#labuser-projects" data-toggle="tab">Проекты</a></li>
            <li role="presentation"><a href="#labuser-achieves" data-toggle="tab">Достижения</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="labuser-about"><?= $model->user_biography ?></div>
            <div class="tab-pane" id="labuser-publics">
                <?php foreach($model->publics as $onepublic) { ?>
                    <div class="rel-public">
                        <?php
                        if ($onepublic->public_type == 0) {
                            $class = 'flag_article';
                        } else {
                            if ($onepublic->public_type == 1) {
                                $class = 'flag_chapter';
                            } else {
                                $class = 'flag_book';
                            }
                        }
                        ?>
                        <span  class="flag <?= $class; ?>"><?= mb_strtolower($onepublic->getTypeName()); ?></span>
                        <div class="rel-authors">
                            <?php
                            $total = count($onepublic->authors);
                            $counter = 0;
                            foreach ($onepublic->authors as $relAuthor) { $counter++; ?>
                                <span class="rel-author">
                                    <?php
                                    if ($relAuthor->visibility != 0) {
                                        echo Html::a($relAuthor->getFullName(), ['/user/view', 'id' => $relAuthor->id]);
                                    } else {
                                        echo $relAuthor->getFullName();
                                    }
                                    if ($counter != $total) { echo ', '; }
                                    ?>
                                </span>
                            <?php } ?>
                        </div>
                        <div class="rel-title">
                            <a href="<?= Url::to(['/publication/index']) ?>#title-<?= $onepublic->id ?>"><?= $onepublic->public_title ?></a>
                        </div>
                        <hr class="hrnormal hrdashed">
                    </div>
                <?php } ?>
            </div>
            <div class="tab-pane" id="labuser-projects">
                <?php foreach($model->projects as $oneproject) { ?>
                    <div class="rel-project">
                        <div class="rel-authors">
                            <?php
                            $total = count($oneproject->authors);
                            $counter = 0;
                            foreach ($oneproject->authors as $relAuthor) { $counter++; ?>
                                <span class="rel-author">
                                    <?php
                                    if ($relAuthor->visibility != 0) {
                                        echo Html::a($relAuthor->getFullName(), ['/user/view', 'id' => $relAuthor->id]);
                                    } else {
                                        echo $relAuthor->getFullName();
                                    }
                                    if ($counter != $total) { echo ', '; }
                                    ?>
                                </span>
                            <?php } ?>
                        </div>
                        <div class="rel-title">
                            <a href="<?= Url::to(['/project/index']) ?>"><?= $oneproject->project_title ?></a>
                        </div>
                        <hr class="hrnormal hrdashed">
                    </div>
                <?php } ?>
            </div>
            <div class="tab-pane" id="labuser-achieves">
                <?php foreach($model->achievements as $oneachieve) { ?>
                    <div class="rel-achieve">
                        <div class="rel-title">
                            <?= $oneachieve->achieve_desc . ' ' . '(' .  substr($oneachieve->achieve_date,0,4) . ' г.)' ?>
                        </div>
                        <hr class="hrnormal hrdashed">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>