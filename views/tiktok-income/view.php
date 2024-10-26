<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TiktokIncome */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Tiktok Income";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Tiktok Income";
}
$this->params['breadcrumbs'][] = ['label' => 'Tiktok Income', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Tiktok Income"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>