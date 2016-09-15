<?php
use yii\easyii\modules\feedback\api\Feedback;
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\text\api\Text;
use yii\bootstrap\Carousel;

$page = Page::get('contact');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>

<style>.carousel {width: auto; height: auto}</style>

<h2 class="text-center project-title"><?=$page->seo('h1', $page->title)?></h2>
<hr class="col-xs-1 float-none" /><br class="hidden-xs"/><br/>

<div class="row text-center">
    <div class="col-md-12">
        <?= $page->text ?>
    </div>
</div>

<div class="col-md-4 text-center float-none">
    <div><h2><?= Text::get('phone') ?></h2></div>
    <a href="tel:<?= preg_replace('/\s+/','', Text::get('phone')) ?>"><button class="btn btn-cstm">Позвонить</button></a>
</div><br/>
<hr style="width:30px"/><br/>


<div class="col-md-4 float-none feedcontact">
    <?php if(Yii::$app->request->get(Feedback::SENT_VAR)) : ?>
        <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> Это успех! Сообщение ушло!</h4>
        <br/><br/>
    <?php else : ?>
        <div class="text-center">
            <?= Feedback::form() ?>
        </div>
    <?php endif; ?>
</div><br/>
<hr style="width:30px"/><br/>

<div class="col-md-4 text-center float-none">
    <div><h3 style="line-height:2"><?= Text::get('address') ?></h3></div>
</div>

<br/><br/><br/>
