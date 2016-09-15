<?php
use yii\easyii\modules\feedback\api\Feedback;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\carousel\models\Carousel as CarouselModel;
use yii\easyii\modules\text\api\Text;
use yii\easyii\modules\article\models\Category;

$bgs = CarouselModel::find()->status(CarouselModel::STATUS_ON)->sort()->all();
shuffle($bgs);

function toMenu() {
  $cats = Article::tree();
  $urls = [
    ['label' => 'Контакты', 'url' => ['/contact']],
    ['label' => 'Что такое дизайн проект?', 'url' => ['/faq']]
  ];
  foreach ($cats as $cat) {
    $subcats = [];
    foreach ($cat->children as $subcat)
        $subcats[] = [
          'label' => $subcat->title,
          'url' => ['/articles/cat/' . $subcat->slug],
        ];
    if ($cat->slug && $cat->category_id != 1 && $cat->slug != 'static')
      foreach (Article::cat($cat->slug)->items() as $service)
          $subcats[] = [
            'label' => $service->title,
            'url' => ['/articles/view/' . $service->slug],
          ];
    if ($cat->slug && $cat->slug == 'static')
      foreach (array_reverse(Article::cat($cat->slug)->items()) as $static)
          $urls[] = [
            'label' => $static->title,
            'url' => ['/articles/view/' . $static->slug],
          ];
    if ($cat->slug && $cat->slug != 'static')
      $urls[] = [
        'label' => $cat->title,
        'url' => ['/articles/cat/' . $cat->slug],
        'items' => $subcats,
      ];
  }

  return array_reverse($urls);
}
?>

<?php $this->beginContent('@app/views/layouts/base.php'); ?>

<style>
.bg-body {
    background-image: url(<?= $bgs[0]->image ?>);
}
</style>

<div class="bg-body"></div>
<div class="car-filter"></div>
<div class="nav-filter text-center">
  <div class="fltr-close"></div>
  <div class="collapse navbar-collapse" id="navbar-menu">
    <?= Menu::widget([
      'options' => ['class' => 'nav-mobi'],
      'items' => toMenu(),
    ])?>
  </div>
</div>

<!-- <div id="particles-js"></div> -->

<div id="wrapper" class="container"><br/>
    <header class="<?= ($this->context->id != 'site') ? 'm' : '' ?>">
        <nav class="navbar text-center <?= ($this->context->id != 'site') ? 'hidden-lg' : '' ?>">
            <div class="container-fluid">


                <div class="navbar-header text-center">
                    <button type="button" class="navbar-toggle collapsed" onclick="$('#navbar-menu').fadeIn().addClass('in');$('.nav-filter, .fltr-close').addClass('x');">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span>МЕНЮ</span>
                    </button>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?php if ($this->context->id != 'site') : ?>
            <div class="nav-logo"><a href="/"></a></div>
            <?= Menu::widget([
              'options' => ['class' => 'nav-cstm hidden-xs hidden-sm'],
              'items' => toMenu(),
            ])?>
        <?php endif; ?>
        <?= $content ?>
        <div class="push"></div>
    </main>
</div>

<footer>
    <div class="container footer-content text-center <?= ((($this->context->id == 'site') || ($this->context->id == 'articles' && $this->context->action->id != 'view'))?'':'small') ?>" >
      <?php if ( $this->context->id == 'site' || ($this->context->id == 'articles' && $this->context->action->id != 'view') ) : ?>
            <?php if ( $this->context->id != 'contact' ) : ?>
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 float-none easy-step">
              <div>
                <h3 class="hidden-xs">Сделать первый шаг. Легко</h3>
                <h4 class="visible-xs">Сделать первый шаг. Легко</h4>
              </div><hr/><br/>
            </div>
            <?php endif; ?>

            <div class="col-xs-12 footer-slider">
              <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 float-none address">
                  <div><h3><i class="glyphicon glyphicon-map-marker"></i> <?= Text::get('address') ?></h3></div>
                  <button class="btn btn-cstm">Наш адрес</button>
              </div>
            </div>
            <div class="col-xs-12 footer-slider">
              <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 float-none telephone">
                  <div>
                    <h1 class="hidden-xs"><?= Text::get('phone') ?></h1>
                    <h2 class="visible-xs"><?= Text::get('phone') ?></h2>
                  </div>
                  <a href="tel:<?= preg_replace('/\s+/','', Text::get('phone')) ?>"><button class="btn btn-cstm">Позвоните нам</button></a>
              </div>
            </div>
            <div class="col-xs-12 footer-slider">
              <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 float-none feedback" id="fdbck">
                  <?php if(Yii::$app->request->get(Feedback::SENT_VAR)) : ?>
                      <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> Это успех! Сообщение ушло!</h4>
                      <br/><br/>
                  <?php else : ?>
                      <div class="text-center">
                          <?= Feedback::form() ?>
                      </div>
                  <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-1 pull-left void"></div>
            <div class="col-xs-4 col-sm-2 a-footer pull-left">
              <a class="to-address">Наш адрес</a>
              <a class="to-telephone">Позвонить</a>
            </div>
            <div class="col-xs-1 pull-right void"></div>
            <div class="col-xs-4 col-sm-2 a-footer pull-right">
              <a class="to-feedback">Написать</a>
              <a class="to-telephone">Позвонить</a>
            </div>

      <?php else : ?>
        <div class="col-xs-1 footer-logo" onclick="$('.nav-logo a')[0].click();"></div>
        <div class="col-xs-1 pull-left void"></div>
        <div class="col-xs-4 col-sm-2 a-footer pull-left">
          <?php foreach (Category::cats() as $key => $cat): ?>
              <?php if($cat->status == 2 && $cat->category_id == 1): ?>
                  <a href="/articles/cat/<?= $cat->slug ?>"><?= $cat->title ?></a>
              <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <div class="col-xs-1 pull-right void"></div>
        <?php if ( $this->context->id != 'contact' ) : ?>
        <div class="col-xs-4 col-sm-2 a-footer pull-right">
          <a href="/contact">Контакты</a>
        </div>
        <?php else : ?>
        <div class="col-xs-4 a-footer pull-right">
          <?php foreach (Category::cats() as $key => $cat): ?>
              <?php if($cat->status == 2 && $cat->category_id != 1): ?>
                  <a href="/articles/cat/<?= $cat->slug ?>"><?= $cat->title ?></a>
              <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <div class="footer-filter <?= ((($this->context->id == 'site') || ($this->context->id == 'articles' && $this->context->action->id != 'view'))?'':'small') ?>"></div>
</footer>



<div class="modal fade" id="feed-success" style="padding-right:0!important">
    <div class="modal-content col-xs-10 float-none">
        <div class="modal-body">
            <h4 class="text-center"><i class="glyphicon glyphicon-ok text-success"></i> Это успех! Сообщение ушло!</h4>
        </div>
    </div>
</div>



<?php $this->endContent(); ?>

<!-- <script type="text/javascript">

(function (d, w, c) {

  (w[c] = w[c] || []).push(function() {
    try {
      w.yaCounter35833165 = new Ya.Metrika({
        id:35833165,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
      });
    } catch (e) { }
  });

  var n = d.getElementsByTagName("script")[0],
  s = d.createElement("script"),
  f = function () { n.parentNode.insertBefore(s, n); };
  s.type = "text/javascript";
  s.async = true;
  s.src = "https://mc.yandex.ru/metrika/watch.js";

  if (w.opera == "[object Opera]") {
    d.addEventListener("DOMContentLoaded", f, false);
  } else { f(); }

})(document, window, "yandex_metrika_callbacks");

</script>

<noscript>
  <div>
    <img src="https://mc.yandex.ru/watch/35833165" style="position:absolute; left:-9999px;" alt="" />
  </div>
</noscript> -->
