<?php
use yii\easyii\helpers\Image;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $cat->seo('title', $cat->model->title);

?>
<h2 class="text-center project-title"><?=$cat->seo('title', $cat->model->title)?></h2>
<hr class="col-xs-1 float-none" /><br class="hidden-xs"/><br/>

<?php if(count($children) && !count($items)) : ?>
    <?php foreach($children as $k => $cata) : ?>
        <div class="row art-row <?=(($k % 2 == 0) ? (odd) : (even))?>">
            <div class="col-xs-1 hidden-xs void pull-<?=(($k % 2 == 0) ? (right) : (left))?>"></div>
            <div class="brief col-xs-8 col-sm-6 text-left pull-<?=(($k % 2 == 0) ? (right) : (left))?>">
                <br class="visible-xs"/>
                <h3 onclick="$(this).parent().find('.a-show')[0].click();"><?= $cata['title'] ?></h3>
                <br class="hidden-xs"/>
                <div><?= $cata['short'] ?></div><br class="hidden-xs"/><br class="hidden-xs"/><br class="hidden-xs"/>
                <?= Html::a('Смотреть', ['articles/cat', 'slug' => $cata['slug']], ['class' => 'a-show']) ?>
            </div>
            <div class="kite col-xs-3 col-sm-4 pull-<?=(($k % 2 == 0) ? (left) : (right))?>">
                <div class="image pull-<?=(($k % 2 == 0) ? (right) : (left))?>" onclick="$(this).parent().parent().find('.a-show')[0].click();"><?= Html::img(Image::thumb($cata['image'], 450, 320)) ?></div>
                <div class="shade pull-<?=(($k % 2 == 0) ? (right) : (left))?>"></div>
            </div>
        </div>
        <br class="hidden-xs"/>
    <?php endforeach; ?>
<?php endif; ?>

<?php if(count($items)) : ?>
    <?php foreach($items as $key => $article) : ?>
        <div class="row art-row <?=(($key % 2 == 0) ? (odd) : (even))?>">
            <div class="col-xs-1 hidden-xs void pull-<?=(($key % 2 == 0) ? (right) : (left))?>"></div>
            <div class="brief col-xs-8 col-sm-6 text-left pull-<?=(($key % 2 == 0) ? (right) : (left))?>">
                <br class="visible-xs"/>
                <h3 onclick="$(this).parent().find('.a-show')[0].click();" style="text-transform:none;"><?= $article->title ?></h3>
                <br class="hidden-xs"/>
                <div><?= $article->short ?></div><br class="hidden-xs"/><br class="hidden-xs"/><br class="hidden-xs"/>
                <?= Html::a('Смотреть', ['articles/view', 'slug' => $article->slug], ['class' => 'a-show']) ?>
            </div>
            <div class="kite col-xs-3 col-sm-4 pull-<?=(($key % 2 == 0) ? (left) : (right))?>">
                <div class="image pull-<?=(($key % 2 == 0) ? (right) : (left))?>" onclick="$(this).parent().parent().find('.a-show')[0].click();"><?= Html::img($article->thumb(450, 320)) ?></div>
                <div class="shade pull-<?=(($key % 2 == 0) ? (right) : (left))?>"></div>
            </div>
        </div>
        <br class="hidden-xs"/>
    <?php endforeach; ?>
<?php endif; ?>

<?php if(!count($items) && !count($children)) : ?>
    <p class="text-center">Пока тут пусто... Это не надолго...</p>
<?php endif; ?>

<?= $cat->pages() ?>
