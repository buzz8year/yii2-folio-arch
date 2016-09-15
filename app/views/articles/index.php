<?php
use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\easyii\helpers\Image;

$page = Page::get('magic');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;

function renderNode($key, $node){
    if(!count($node->children) && $node->depth){
        $html = '<div class="row ' . (($key % 2 == 0) ? (odd) : (even)) . '">
                    <div class="col-xs-1 hidden-xs pull-' .(($key % 2 == 0) ? (right) : (left)). '"></div>
                    <div class="brief col-xs-8 col-sm-6 text-left pull-' .(($key % 2 == 0) ? (right) : (left)). '">
                        <h3 onclick="$(this).parent().find(\'.a-show\')[0].click();">' . $node->title . '</h3>
                        <div>' . $node->short . '</div><br class="hidden-xs"/>
                        ' . Html::a('Смотреть', ['articles/cat', 'slug' => $node->slug], ['class' => 'a-show']) . '
                    </div>
                    <div class="kite col-xs-3 col-sm-4 pull-' .(($key % 2 == 0) ? (left) : (right)). '">
                        <div class="image pull-' .(($key % 2 == 0) ? (right) : (left)). '" onclick="$(this).parent().parent().find(\'.a-show\')[0].click();">' . Html::img(Image::thumb($node->image, 450, 320)) . '</div>
                        <div class="shade pull-' .(($key % 2 == 0) ? (right) : (left)). '"></div>
                    </div>
                 </div>';
    } else {
        foreach($node->children as $key => $child) $html .= renderNode($key, $child);
    }
    return $html;
}
?>

<style>
.magic-wrap > div {
    z-index: 0;
    opacity: 1;
}
</style>

<br/>
<div class="text-center magic-wrap">

      <?php foreach(Article::tree() as $key => $node) echo renderNode($key, $node); ?>

</div>
