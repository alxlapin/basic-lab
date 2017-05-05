<?php
/**
 * Created by PhpStorm.
 * User: Alx
 * Date: 26.03.2016
 * Time: 14:00
 */

namespace app\modules\admin\assets;


use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{

    public $sourcePath = __DIR__ . '/files';

    public $css = [
        'css/admin.css',
        'fileupload/css/jquery.fileupload.css',
        'fancybox/source/jquery.fancybox.css',
    ];
    public $js = [
        'js/admin.js',
        'js/jquery.maskedinput.js',
        'fileupload/js/vendor/jquery.ui.widget.js',
        'fileupload/js/jquery.fileupload.js',
        'fileupload/js/jquery.iframe-transport.js',
        'fancybox/source/jquery.fancybox.pack.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}