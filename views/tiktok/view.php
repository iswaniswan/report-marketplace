<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tiktok */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Tiktok";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Tiktok";
}
$this->params['breadcrumbs'][] = ['label' => 'Tiktok', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Tiktok"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>