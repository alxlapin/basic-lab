<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'fancybox/source/jquery.fancybox.css',
        'fileupload/css/jquery.fileupload.css',
    ];
    public $js = [
        'js/site.js',
        'js/jquery.maskedinput.js',
        'js/tab.js',
        'fancybox/source/jquery.fancybox.pack.js',
        'fileupload/js/vendor/jquery.ui.widget.js',
        'fileupload/js/jquery.fileupload.js',
        'fileupload/js/jquery.iframe-transport.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
