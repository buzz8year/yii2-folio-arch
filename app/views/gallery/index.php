<?php
use yii\easyii\helpers\Image;
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;

$page = Page::get('page-gallery');

$this->title = $page->seo('title', 'Галерея');
$this->params['breadcrumbs'][] = 'Галерея';
?>
<div style="padding: 0 100px 100px 100px;">

<?php foreach(array_reverse(Gallery::cats()) as $album) : ?>
    <?php $photos = Gallery::cat($album->slug)->photos(); ?>
    <div class="row">
        <h4 class="photo-counter" style="position: relative; top: 190px; margin-left: 40px; cursor: default"><?=count($photos)?> ФОТО</h4>
        <div class="kite col-md-4">
            <div class="image"><?= Html::img(Image::thumb($album->image, 450, 320)) ?></div>
            <div class="shade"></div>
        </div>
        <div class="col-md-1"></div>
        <div class="brief col-md-7 text-left">
            <h3><?= $album->title ?></h3>
            <div style="margin-right: 30%"><?= $album->short ?></div><br/>
            <?= Html::a('Смотреть', ['gallery/view', 'slug' => $album->slug]) ?>
        </div>
    </div>
<?php endforeach; ?>
</div>
