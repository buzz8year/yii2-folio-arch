<?php
namespace app\assets;

class ColorAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/media';
    public $js = [
        'js/bgcolor.js',
        'js/particles/particles.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
