<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<a title="Автор публикации" class="author_link" href="<?= Url::to(['/user/view', 'id' => $author->id]); ?>">
    <img src="<?= $author->user_photo ?>" class="author_pic"><?= Html::encode($author->user_login); ?>
</a>