<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LazadaIncome */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Lazada Income";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Lazada Income";
}
$this->params['breadcrumbs'][] = ['label' => 'Lazada Income', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Lazada Income"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>