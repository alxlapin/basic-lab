<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\modules\admin\assets\AdminAsset;
use yii\widgets\Pjax;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <?= Html::csrfMetaTags() ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php $this->head() ?>
</head>
<body style="position: relative;">
<?php $this->beginBody() ?>

<div class="wrapper">
    <div class="header">
        <div class="header-container">
            <div class="logo">
                <a href="" class="logo-img"><img src="../../../images/icons/logo.png" alt=""></a>
                <div class="logo-title">WiseNet Lab</div>
            </div>
            <div class="right-bar">
                <div class="cur_user-info">
                    <div id="top_user-link" class="cur_user-link">
                        <span class="cur_user-name"><?= Yii::$app->user->identity->user_name; ?></span>
                        <img class="cur_user-img" src="<?= Yii::$app->user->identity->getThumbLink(); ?>">
                        <span class="cur_user-more"></span>
                    </div>
                    <div id="top_user-opts" class="cur_user-opts">
                        <?= Html::a('Профиль', ['/user/view', 'id' => Yii::$app->user->identity->id], ['class' => 'opts-row cur_user-profile']) ?>
                        <?= Html::a('Выйти', ['/site/logout'], ['class' => 'opts-row cur_user-logout', 'data-method' => 'post']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="content_menu-container">
            <div class="content_container">
                <div class="content_menu-title">Контент</div>
                <ul class="content_menu">
                    <li class="content_item"><?= Html::a('Новости', ['/admin/post/index']) ?></li>
                    <li class="content_item"><?= Html::a('Публикации', ['/admin/publication/index']) ?></li>
                    <li class="content_item"><?= Html::a('Проекты', ['/admin/project/index']) ?></li>
                    <li class="content_item"><?= Html::a('Курсы', ['/admin/course/index']) ?></li>
                    <li class="content_item"><?= Html::a('Достижения', ['/admin/achievement/index']) ?></li>
                    <li class="content_item"><?= Html::a('Сотрудники', ['/admin/user/index']) ?></li>
                    <li class="content_item"><?= Html::a('Галерея', ['/admin/gallery/index']) ?></li>
                </ul>
            </div>
            <div class="feedback_container">
                <div class="content_menu-title">Обратная связь</div>
                <ul class="feedback">
                    <li class="content_item">
                        <a href="<?= urldecode(Url::to(['/admin/request-course/index']))?>" class="req-course-link">Заявки на курсы</a>
                        <?php $req_num = Yii::$app->db->createCommand("SELECT count(*) FROM `request_course` WHERE `request_status` = 0")->queryScalar();
                        if ($req_num) {
                            echo "<span class=\"request-num\">" . "+" . $req_num . "</span>";
                        }
                        ?>
                    </li>
                    <li class="content_item">
                        <a href="<?= Url::to(['/admin/request-project/index'])?>" class="req-project-link">Заявки на проекты</a>
                        <?php $req_num = Yii::$app->db->createCommand("SELECT count(*) FROM `request_project` WHERE `request_status` = 0")->queryScalar();
                        if ($req_num) {
                            echo "<span class=\"request-num\">" . "+" . $req_num . "</span>";
                        }
                        ?>
                    </li>
                    <li class="content_item">
                        <a href="<?= Url::to(['/admin/message/index'])?>" class="req-message-link">Сообщения</a>
                        <?php $req_num = Yii::$app->db->createCommand("SELECT count(*) FROM `message` WHERE `message_status` = 0")->queryScalar();
                        if ($req_num) {
                            echo "<span class=\"request-num\">" . "+" . $req_num . "</span>";
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content; ?>
        </div>
    </div>
</div>

<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; My Company --><?//= date('Y') ?><!--</p>-->
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
