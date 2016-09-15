<?php
use yii\widgets\Breadcrumbs;
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\feedback\api\Feedback;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;

$page = Page::get('success');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>

<br/>
<br/>

<?= $page->text ?>

<br/>
<br/>
