<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ShopeeIncome */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Shopee Income";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Shopee Income";
}
$this->params['breadcrumbs'][] = ['label' => 'Shopee Income', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Shopee Income"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>