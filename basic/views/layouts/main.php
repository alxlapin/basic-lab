<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Post;
use app\models\PostTag;
use app\models\Tag;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="shortcut icon" href="/images/icons/logo.png" type="image/png">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:url" content="http://dltest.ru">
    <meta property="og:type" content="website">
    <meta property="og:title" content="WiSeNet Laboratory">
    <meta property="og:description" content="WiSeNet Laboratory">
    <meta property="og:image" content="http://dltest.ru/images/icons/logo.png">
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
    <script src="https://apis.google.com/js/platform.js" async defer>
        {lang: 'ru'}
    </script>
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

<div id="main_container">
    <div class="header-outer">
        <div class="header-inner">
            <div class="lab-logo_wrap">
                <a href="<?= Url::home(); ?>" class="lab-logo"></a>
            </div>
            <div class="nav-bar_wrap">
                <?= Menu::widget([
                    'options' => ['class' => 'nav-bar'],
                    'items' => [
                        ['label' => 'Главная', 'url' => ['post/index']],
                        ['label' => 'Публикации', 'url' => ['publication/index']],
                        ['label' => 'Проекты', 'url' => ['project/index']],
                        ['label' => 'Курсы', 'url' => ['course/index']],
                        ['label' => 'Сотрудники', 'url' => ['user/index']],
                        ['label' => 'Галерея', 'url' => ['gallery/index']],
                        ['label' => 'О нас', 'url' => ['site/about']],
                    ],
                    'itemOptions' => ['class' => 'nav-bar_item']
                ]); ?>
            </div>
        </div>
    </div>
    <div class="content_wrap clear-fx">
        <div class="sidebar">
            <?php
            if (isset($this->blocks['block3'])) {
                echo $this->blocks['block3'];
            }
            if (isset($this->blocks['block1'])) {
                echo $this->blocks['block1'];
            }
            ?>
            <?php if (Yii::$app->controller->id == 'post' || Yii::$app->controller->id == 'tag') {
//                (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'view')
                $taglist = PostTag::getTagsCount(); ?>
                <div class="tags-container">
                    <div class="side-title"><span>Категории</span></div>
                    <div class="tags-container_body">
                        <?php foreach ($taglist as $tag) { ?>
                            <div class="tag-single">
                                <a href="<?= Url::to(['/tag/index', 'id' => $tag['tag_id']])?>" class="tag-single_name" data-cnt="<?= $tag['cnt'] ?>"><?= Tag::getTagName($tag['tag_id']); ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php
                if (!(Yii::$app->controller->id == 'post' && Yii::$app->controller->action->id == 'index')) {
                    $latests = Post::getLatestNews();
                    if (!empty($latests)) { ?>
                        <div class="sidebar-articles">
                            <div class="side-title"><span>Последние новости</span></div>
                            <?php foreach ($latests as $latest) { ?>
                                <div class="top_single">
                                    <div class="top_single-date">
                                        <?= (new Datetime($latest->post_date))->format('d.m.Y, H:i'); ?>
                                    </div>
                                    <div class="top_single-title rel-title">
                                        <a href="<?= Url::to(['/post/view', 'id' => $latest->id]) ?>"><?= $latest->post_title ?></a>
                                    </div>
                                    <hr class="sidenormal">
                                </div>
                            <?php } ?>
                        </div>
                    <?php }} ?>
            <?php
                $toplatests = Post::getTopNews();
                if (!empty($toplatests)) { ?>
                    <div class="sidebar-articles top_articles">
                        <div class="side-title"><span>Важное</span></div>
                        <?php foreach ($toplatests as $toplatest) { ?>
                            <div class="top_single">
                                <div class="top_single-date">
                                    <?= (new Datetime($toplatest->post_date))->format('d.m.Y, H:i'); ?>
                                </div>
                                <div class="top_single-title rel-title">
                                    <a href="<?= Url::to(['/post/view', 'id' => $toplatest->id]) ?>"><?= $toplatest->post_title ?></a>
                                </div>
                                <hr class="sidenormal">
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
        </div>
        <div class="content_common">
            <?= $content ?>
        </div>
    </div>
</div>

<div id="footer">
    <div class="footer-outer">
        <div class="footer-inner">
            <p class="pull-left">&copy; WiSeNet Laboratory <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
