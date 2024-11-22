<?php

use app\components\Mode;
use app\models\Menu;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
/* @var $referrer string */
/* @var $mode Mode */


$inputOptions = [];
if (@$mode == Mode::READ) {
    $inputOptions = ['disabled' => true];
}

?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-2',
            'wrapper' => 'col',
            'error' => '',
            'hint' => '',
            'field' => 'mb-3 row',
        ],
        'options' => ['style' => 'padding:unset'],
        'inputOptions' => $inputOptions,
    ],
    'enableClientScript' => false
]); ?>

<div class="row">
    <div class="container-fluid">
        <div class="member-form card-box">
            <div class="card-body row">
                <div class="col-12" style="border-bottom: 1px solid #ccc; margin-bottom: 2rem;">
                    <h4 class="card-title mb-3"><?= $this->title ?></h4>
                </div>

                <div class="container-fluid">
                    <?= $form->errorSummary($model) ?>

                    <?php /* $form->field($model, 'id_parent')->dropDownList(\app\models\Menu::getListMenu(), [
                        'prompt' => '- Pilih Menu Parent -',
                    ])->label('Parent') */?>

                    <div class="mb-3 row field-menu-id_parent" style="padding:unset">
                        <label class="col-2" for="menu-id_parent">Parent</label>
                        <div class="col">
                            <select id="menu-id_parent" class="form-select form-control" name="Menu[id_parent]">
                                <option value="">Pilih Menu Parent</option>

                                <?php $allMenu = Menu::getListMenu(); ?>
                                <?php foreach ($allMenu as $menu) { ?>
                                    <?php $indentation = ''; $level = $menu->getLevel(); 
                                    for ($i=0; $i<$level; $i++) {
                                        $indentation .= ' - ';
                                    }
                                    ?>
                                    <option value="<?= $menu->id ?>" data-parent=<?= $menu->id_parent ?>>
                                        <?= $indentation ?><?= ucwords($menu->name) ?>
                                    </option>
                                <?php } ?>

                            </select>
                            <div class="invalid-feedback "></div>
                        </div>
                    </div>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

                    <?php /* $form->field($model, 'route')->textInput(['maxlength' => true]) */?>

                    <?php /* $form->field($model, 'status')->textInput() */?>

                </div>
                <?= Html::hiddenInput('referrer', $referrer) ?>
            </div>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="container-fluid">
        <?= Html::a('<i class="ti-arrow-left"></i><span class="ml-2">Back</span>', ['index'], ['class' => 'btn btn-info mb-1']) ?>
        <?php if ($mode == Mode::READ) { ?>
            <?= Html::a('<i class="ti-pencil-alt"></i><span class="ml-2">Edit</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning mb-1']) ?>
        <?php } else { ?>
            <?= Html::submitButton('<i class="ti-check"></i><span class="ml-2">' . ucwords('update') .'</span>', ['class' => 'btn btn-primary mb-1']) ?>
        <?php } ?>
    </div>
</div>

<?php ActiveForm::end(); ?>