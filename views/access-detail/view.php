<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccessDetail */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Access Detail";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Access Detail";
}
$this->params['breadcrumbs'][] = ['label' => 'Access Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Access Detail"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>