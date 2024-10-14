<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ApprovalStage */
/* @var $mode \app\components\Mode */
/* @var $referrer string */

$this->title = "Detail Approval Stage";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Approval Stage";
}
$this->params['breadcrumbs'][] = ['label' => 'Approval Stage', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Approval Stage"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode
]) ?>