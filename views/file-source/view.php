<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FileSource */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail File Source";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " File Source";
}
$this->params['breadcrumbs'][] = ['label' => 'File Source', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " File Source"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>