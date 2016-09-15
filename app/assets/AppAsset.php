<?php
namespace app\assets;

class AppAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/media';
    public $css = [
        'css/styles.css',
        // 'css/mobsm.css',
        // 'css/mobmd.css',
        // 'css/moblg.css',
    ];
    public $js = [
        'js/scripts.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
