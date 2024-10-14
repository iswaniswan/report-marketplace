<?php

use app\components\Mode;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Access */
/* @var $mode \app\components\Mode */
/* @var $referrer string */
/* @var $all_menu array */
/* @var $menuProvider array */

$this->title = "Detail Access";
if ($mode !== Mode::READ) {
    $this->title = ucwords($mode) . " Access";
}
$this->params['breadcrumbs'][] = ['label' => 'Access', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => " Access"
    ],
]) ?>

<?= $this->render('_form', [
    'model' => $model,
    'referrer'=> @$referrer,
    'mode' => $mode,
    'menuProvider' => $menuProvider
]) ?>