<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Shopee */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Shopee";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Shopee";
}
$this->params['breadcrumbs'][] = ['label' => 'Shopee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Shopee"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>