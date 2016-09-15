<?php
use yii\helpers\Html;
$this->title = $name;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="alert alert-danger">
    <?= nl2br(Html::encode($message)) ?>
</div>

<p>
    Данная страница - результат обработки запроса.
</p>
<p>
    Свяжитесь с нами, если вам кажется, что ошибка затаилась на нашей стороне. Заранее благодарим!
</p>
