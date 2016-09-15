<?php
use yii\easyii\modules\article\api\Article;
use yii\easyii\helpers\Image;
use yii\helpers\Html;
use yii\helpers\Url;
use owl\carousel\Owl;

$this->title = $article->seo('title', $article->model->title);
$img = Html::a(Html::img(Image::thumb(50, 50)), $article->model->image, [
    'class' => 'easyii-box',
    // 'rel' => 'article-'.$article->model->item_id,
    // 'title' => $this->description
]);
Article::plugin()
?>

<?php if($article->getCat()->depth != 1 && $article->model['image']) : ?>
<div class="row" style="height:250px;overflow:hidden;background:url(<?=$article->model['image']?>) center no-repeat;background-size:cover;cursor:pointer;border-top: 1px solid #fafafa;border-bottom: 1px solid #fafafa;box-shadow: inset 0 -10px 10px -10px #777, inset 0 10px 10px -10px #777" onclick="$(this).find('a')[0].click();">
    <div class="hidden"><?=$img?></div>
</div><br/>
<?php endif; ?>

<h1 class="text-center project-title"><?= $article->seo('h1', $article->title) ?></h1>
<hr class="col-xs-1 float-none" /><br/><br class="hidden-xs"/><br class="hidden-xs"/>

<?=
Owl::widget([
    'options' => [
        'init' => true,
        'class' => 'owl'
    ],
])
?>

<?php if(count($article->photos)) : ?>
    <div class="project">
        <h4 class="photo-counter" onclick="$('.kite:first-of-type .image a').click();"><?=count($article->photos)?> ФОТО</h4>
        <?php foreach($article->photos as $key => $photo) : ?>
          <?php if ($key <= 1) : ?>
            <div class="kite col-xs-12 col-sm-6">
              <div class="image"><?= $photo->box(450, 320) ?></div>
              <div class="shade"></div>
            </div>
          <?php else : ?>
            <div class="hidden"><?= $photo->box(50, 50) ?></div>
          <?php endif; ?>
        <?php endforeach;?>
    </div>
    <br/>
<?php endif; ?>

<div class="redactor-wrap <?=(count($article->photos))?'w':''?>">
<?//= Yii::$app->shortcodes->parse($article->text) ?>
<?= $article->text ?>

<?php if(count($article->pics)) : ?>
  <br/><br/>
  <div onclick="$('.draft-wrap a:first-of-type').trigger('click');" class="pull-right">
    <u style="cursor:pointer">Посмотреть эскизы</u> &nbsp;
    <i class="project-piture"></i>
  </div>
  <div class="hidden draft-wrap">
    <?php foreach($article->pics as $key => $pic) echo $pic->box(50, 50, 'draft-box'); ?>
  </div>
  <?php Article::plugin('.draft-box') ?>
<?php endif; ?>

<?php if(count($article->files)) : ?>
  <br/><br/>
  <div class="pull-right text-right">
    <?php $file = $article->files[0]; ?>
    <a href="<?=$file->file?>" target="_blank" style="color:#444"><?=$file->title?></a> &nbsp;
    <i class="project-file"></i><br/>
    <small class="text-muted text-lowercase">(<?= Yii::$app->formatter->asShortSize($file->size, 0) ?>, <?='*.'.explode('.', $file->file)[1]?>)</small> &nbsp; &nbsp; &nbsp; &nbsp;
  </div>
<?php endif; ?>

</div>

<?php if($article->getCat()->depth == 1) : ?>
<div class="col-xs-12" style="margin-top:50px">
  <div class="col-md-11 col-xs-12 float-none">
    <div class="a-project pull-left text-left">
      <a href="/articles/view/<?=$cousins['left']->slug?>"><?=$cousins['left']->title?></a>
    </div>
    <div class="a-project pull-right text-right">
      <a href="/articles/view/<?=$cousins['right']->slug?>"><?=$cousins['right']->title?></a>
    </div>
  </div>
</div>
<?php endif; ?>
