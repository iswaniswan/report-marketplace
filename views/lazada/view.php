<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lazada */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Lazada";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Lazada";
}
$this->params['breadcrumbs'][] = ['label' => 'Lazada', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Lazada"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>