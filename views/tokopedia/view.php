<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tokopedia */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Tokopedia";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Tokopedia";
}
$this->params['breadcrumbs'][] = ['label' => 'Tokopedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Tokopedia"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>