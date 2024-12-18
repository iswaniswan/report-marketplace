<?php

namespace app\assets;

use yii\web\AssetBundle;

class ExporterAsset extends AssetBundle
{
    public $sourcePath = '@themes/uplon/assets/libs';
    
    public $js = [
        'xlsx/xlsx.full.min.js',
        'jspdf/jspdf.umd.min.js',
        'jspdf-autotable/jspdf.plugin.autotable.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
