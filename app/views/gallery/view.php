<?php
use yii\easyii\modules\gallery\api\Gallery;

$this->title = $album->seo('title', $album->model->title);
$this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['gallery/index']];
// $this->params['breadcrumbs'][] = $album->model->title;
?>
<style>
#wrapper {
    min-height: 0;
    height: auto;
}
</style>
<h1 class="text-center common-title"><?=$album->seo('title', $album->model->title)?><hr/></h1>
<div class="text-center common-title"><?=$album->model->short?></div>
<hr style="width:90px"/>
<div class="text-center common-title"><?=count($photos)?> ФОТО</div>
<hr style="width:30px"/>
<?php if(count($photos)) : ?>
    <div class="gallery-wrap">
        <?php foreach($photos as $photo) : ?>
            <div class="kite small">
                <div class="image"><?= $photo->box(300, 215) ?></div>
            </div>
        <?php endforeach;?>
        <?php Gallery::plugin() ?>
    </div>
    <br/>
<?php else : ?>
    <p>Здесь пока пусто... Это не надолго...</p>
<?php endif; ?>
<?= $album->pages() ?>
