<?php
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;

$page = Page::get('page-news');

$this->title = $page->seo('title', 'Nadezhda Ponomareva');
$this->params['breadcrumbs'][] = 'Содержание';
?>
<br/>

<?php foreach($news as $item) : ?>
    <div class="row text-center">
        <div class="col-md-12 footer-title">
            <h3><?= Html::a($item->title, ['news/view', 'slug' => $item->slug]) ?></h3>
        </div>
    </div>
<?php endforeach; ?>

<?= News::pages() ?>
