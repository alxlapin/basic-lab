<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:url" content="http://basic/index.php">
    <meta property="og:type" content="website">
    <meta property="og:title" content="WiSeNet Laboratory">
    <meta property="og:description" content="WiSeNet Laboratory">
    <meta property="og:image" content="http://basic/images/checkmark.png">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script>window.twttr = (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function(f) {
                t._e.push(f);
            };

            return t;
        }(document, "script", "twitter-wjs"));</script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div id="wrapper">
    <div class="header-outer">
        <div class="header-inner">
            <div class="lab-logo_wrap">
                <a href="<?= Url::to(['/site/index']); ?>" class="lab-logo">WiSeNet Lab</a>
            </div>
            <div class="nav-bar_wrap">
                <ul class="nav-bar">
                    <li class="nav-bar_item"><a href="<?= Url::to(['/site/index']); ?>">Главная</a></li>
                    <li class="nav-bar_item"><a href="<?= Url::to(['/post/index']); ?>">Новости</a></li>
                    <li class="nav-bar_item"><a href="<?= Url::to(['/publication/index']); ?>">Публикации</a></li>
                    <li class="nav-bar_item"><a href="<?= Url::to(['/project/index']); ?>">Проекты</a></li>
                    <li class="nav-bar_item"><a href="<?= Url::to(['/course/index']); ?>">Курсы</a></li>
                    <li class="nav-bar_item"><a href="<?= Url::to(['/user/index']); ?>">Сотрудники</a></li>
                    <li class="nav-bar_item"><a href="<?= Url::to(['/gallery/index']); ?>">Галерея</a></li>
                    <li class="nav-bar_item"><a href="<?= Url::to(['/site/about']); ?>">Контакты</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-container">
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>
        <div class="main_right-bar"></div>
        <?php if ((Yii::$app->controller->id == 'post') and (Yii::$app->controller->action->id == 'index'))  {
        } ?>
        <div class="main_left-bar">
            <?= $content ?>
        </div>
    </div>
    <div id="footer">
        <div class="footer-outer">
            <div class="footer-inner">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
