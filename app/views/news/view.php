<?php
use yii\easyii\modules\news\api\News;
use yii\helpers\Url;

$this->title = $news->seo('title', $news->model->title);
// $this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['news/index']];
$this->params['breadcrumbs'][] = $news->model->title;
?>
<br/>
<div class="redactor-wrap">
<h1 class="text-center"><?= $news->seo('h1', $news->title) ?></h1><br/><br/>
<?= $news->text ?>
</div>

<?php if(count($news->photos)) : ?>
    <div>
        <h4>Изображения:</h4>
        <?php foreach($news->photos as $photo) : ?>
            <?= $photo->box(100, 100) ?>
        <?php endforeach;?>
        <?php News::plugin() ?>
    </div>
    <br/>
<?php endif; ?>
<p>
    <?php foreach($news->tags as $tag) : ?>
        <a href="<?= Url::to(['/news', 'tag' => $tag]) ?>" class="label label-info"><?= $tag ?></a>
    <?php endforeach; ?>
</p>
</div>
<br/>
<br/>
