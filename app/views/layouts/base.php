<?php
use yii\helpers\Html;
$asset = \app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'> -->
        <?php $this->head() ?>
    </head>
    <body class="<?= ($this->context->id == 'site') ? 'hm' : '' ?>">
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
