<?php
/**
 * Created by PhpStorm.
 * User: Alx
 * Date: 03.02.2016
 * Time: 18:35
 */

use yii\helpers\Html;

?>

<p>Вы ввели следующую информацию:</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Email</label> <?= Html::encode($model->email) ?></li>
</ul>
