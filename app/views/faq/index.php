<?php
use yii\easyii\modules\faq\api\Faq;
use yii\easyii\modules\page\api\Page;

$page = Page::get('faq');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>

<h2 class="text-center project-title"><?=$page->seo('title', $page->title)?></h2>
<hr class="col-xs-1 float-none" /><br class="hidden-xs"/><br/>

<div class="redactor-wrap">

<?php foreach(Faq::items() as $item) : ?>
    <p><?= $item->question ?></p>
    <blockquote><?= $item->answer ?></blockquote>
<?php endforeach; ?>

</div>
