<?php
use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\guestbook\api\Guestbook;
use yii\easyii\modules\article\models\Category;
use yii\easyii\modules\article\models\Item;
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\text\api\Text;
use yii\easyii\helpers\Image;
use yii\helpers\Html;

$asset = \app\assets\ColorAsset::register($this);

$page = Page::get('home');

$this->title = $page->seo('title', $page->model->title);

function renderNode($key, $node){
    if(!count($node->children) && $node->depth && $node->tree == 1){
        $html = '<div class="row art-row ' . (($key % 2 == 0) ? (odd) : (even)) . '">
                    <div class="col-xs-1 hidden-xs void pull-' .(($key % 2 == 0) ? (right) : (left)). '"></div>
                    <div class="brief col-xs-8 col-sm-6 text-left pull-' .(($key % 2 == 0) ? (right) : (left)). '">
                        <br class="visible-xs"/>
                        <h3 onclick="$(this).parent().find(\'a\')[0].click();">' . $node->title . '</h3>
                        <br class="hidden-xs"/>
                        <div>' . $node->short . '</div><br class="hidden-xs"/>
                        ' . Html::a('Смотреть', ['articles/cat', 'slug' => $node->slug], ['class' => 'a-show']) . '
                    </div>
                    <div class="kite col-xs-3 col-sm-4 pull-' .(($key % 2 == 0) ? (left) : (right)). '">
                        <div class="image pull-' .(($key % 2 == 0) ? (right) : (left)). '" onclick="$(this).parent().parent().find(\'a\')[0].click();">' . Html::img(Image::thumb($node->image, 450, 320)) . '</div>
                        <div class="shade pull-' .(($key % 2 == 0) ? (right) : (left)). '"></div>
                    </div>
                 </div>';


    } else {
        foreach($node->children as $key => $child) $html .= renderNode($key, $child);
    }
    return $html;
}

foreach (Category::cats() as $key => $cat)
    if($cat->status != 2)
        $items = Article::items(['where' => ['status' => 2]]);

?>

<style>
.car-filter {
  background-color: rgba(0,0,0,0.65);
}
</style>


<div class="text-center logo-wrp"><br/><br/>
  <button type="button" class="hidden navbar-toggle collapsed" onclick="$('#navbar-menu').fadeIn().addClass('in');$('.nav-filter, .fltr-close').addClass('x');">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span>МЕНЮ</span>
  </button>
  <div class="col-xs-2 a-index text-right pull-left hidden-xs">
      <?php if($items[0]):?>
          <a href="/articles/view/<?= $items[0]->slug ?>"><?= $items[0]->title ?></a>
      <?php endif; ?>
  </div>
  <div class="col-xs-12 col-sm-8 logo-page text-center"><br/>
    <div><img src="../uploads/pages/arch_np.svg"/></div><br/>
    <h2 class="hidden-xs">NADEZHDA PONOMAREVA<br/></h2>
    <h4 class="visible-xs">NADEZHDA PONOMAREVA</h4>
    <div style="font-size:16px">architecture buro</div>
  </div>
  <div class="col-xs-2 a-index text-left pull-right hidden-xs">
      <?php if($items[1]):?>
          <a href="/articles/view/<?= $items[1]->slug ?>"><?= $items[1]->title ?></a>
      <?php else: ?>
          <a href="/contact">Контакты</a>
      <?php endif; ?>
  </div>
  <div class="col-xs-12 a-index text-vert">
    <?php foreach (Category::cats() as $key => $cat): ?>
        <?php if($cat->status == 2 && $cat->category_id == 1): ?>
            <a><?= $cat->title ?></a>
        <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>

<!-- <div class="hidden logo-filter"></div> -->

<br/>
<div class="text-center magic-wrap">

      <?php foreach(Article::tree() as $key => $node) echo renderNode($key, $node); ?>

</div>

<br class="br-void" />
<br class="br-void" />
<br class="br-void" />
