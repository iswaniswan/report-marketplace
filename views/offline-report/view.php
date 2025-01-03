<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Offline */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Offline";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Offline";
}
$this->params['breadcrumbs'][] = ['label' => 'Offline', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Offline"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>