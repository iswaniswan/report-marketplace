<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

use \app\utils\Permission;

/* @var $this yii\web\View */
/* @var $model app\models\Access */
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
    'enableClientScript' => false,
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
    ]
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

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?php // $form->field($model, 'permission')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'status')->textInput() ?>

                    <div class="mb-3 pt-3 row field-access-permission" style="padding:unset">
                        <label class="col-12" for="access-permission">Permission Table</label>
                        <div class="container-fluid">
                            <table class="table table-hover table-bordered" id="table-permission">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <?php foreach (Permission::getList() as $permission) { ?>
                                            <th class="text-center"><?= ucwords(strtolower(Permission::get($permission))) ?></th>
                                        <?php } ?>
                                        <th class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($menuProvider->models as $menu) { ?>
                                        <tr>
                                            <?php $paddingLeft = (@$menu->parent != null) ? '32px' : 'auto'; ?>
                                            <td style="padding-left: <?= $paddingLeft ?>"><?= ucwords($menu->name) ?></td>
                                            <?php $checked_count = 0; ?>
                                            <?php foreach (Permission::getList() as $permission) { ?>
                                                <td class="text-center">
                                                    <?php
                                                    $is_checked = '';
                                                    if (\app\models\Menu::isCan($menu->id, @$model->id, Permission::get($permission))) {
                                                        $is_checked = 'checked';
                                                        $checked_count++;
                                                    }
                                                    ?>
                                                    <input type="checkbox" name="Access[menu][<?= $menu->id ?>][<?= 'is_'.strtolower(Permission::get($permission)) ?>]" <?= $is_checked ?>>
                                                </td>
                                            <?php } ?>
                                            <td class="text-center">
                                                <?php $is_all_checked = ($checked_count == 7) ? 'checked' : ''; ?>
                                                <input type="checkbox" id="cb_<?= $menu->id ?>_all" <?= $is_all_checked ?>>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

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

<?php

$script = <<<JS

    $(document).ready(function() {
        console.log(1234);
        $('#table-permission input[type="checkbox"][id]').each(function(e) {
            const t = $(this);            
            t.change(function(e) {
                e.stopPropagation();
                if (t.is(':checked')) {
                    t.closest('tr').find('input[type="checkbox"]').prop('checked', true);
                } else {
                    t.closest('tr').find('input[type="checkbox"]').prop('checked', false);
                }
            })
        })
    })
JS;
$this->registerJs($script, \yii\web\View::POS_READY);


?>
