<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ginee */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Ginee";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Ginee";
}
$this->params['breadcrumbs'][] = ['label' => 'Ginee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Ginee"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>