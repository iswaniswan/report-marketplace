<?php

use app\components\Mode;
use app\models\Menu;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $form yii\widgets\ActiveForm */
/* @var $referrer string */
/* @var $mode Mode */


$isDisabled = '';
$inputOptions = [];
if (@$mode == Mode::READ) {
    $inputOptions = ['disabled' => true];
    $isDisabled = 'disabled';
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

<style>
    #table-role-permissions tr th:not(:first-child),
    #table-role-permissions tr td:not(:first-child) {
        text-align: center;
    }
</style>

<div class="row">
    <div class="container-fluid">
        <div class="member-form card-box">
            <div class="card-body row">
                <div class="col-12" style="border-bottom: 1px solid #ccc; margin-bottom: 2rem;">
                    <h4 class="card-title mb-3">Role</h4>
                </div>

                <div class="container-fluid">
                    <?= $form->errorSummary($model) ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?php // $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                    <?php // $form->field($model, 'level')->textInput() ?>

                    <?=  $form->field($model, 'status')->dropDownList([
                            0 => 'Inactive',
                            1 => 'Active'
                    ], [
                            'prompt' => '- Pilih Status -',
                            'required' => true,
                            'value' => 1
                    ])->label('Status') ?>

                    <?php // $form->field($model, 'date_created')->textInput() ?>

                    <?php // $form->field($model, 'date_updated')->textInput() ?>

                </div>
                <?= Html::hiddenInput('referrer', $referrer) ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="container-fluid">
        <div class="role-permissions card-box">
            <div class="card-body row">
                <div class="col-12" style="display: flex; justify-content: space-between;">
                    <h4 class="card-title mb-3">Daftar Hak Akses</h4>
                    <div class="float-right ">
                        <input type="checkbox" id="check_all" <?= $isDisabled ?>>
                        <label for="check_all">Pilih Semua</label>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="table-role-permissions">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th style="width: 16%">Hak Akses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (@$allMenu as $menu) { ?>
                                    <tr>
                                        <?php $style= ''; $level = $menu->getLevel(); 
                                        if ($level > 0) {
                                            $style = 'padding-left:' . $level * 2 . 'rem';
                                        } ?>
                                        <td style="<?= @$style ?>"><?= $menu->name ?></td>
                                        
                                        <?php $isChecked = '';
                                            $permission = $menu->getRolePermission($idRole);
                                            $array_permission = json_decode(@$permission->permission) ?? [];
                                            if (in_array('read', $array_permission)) {
                                                $isChecked = 'checked';
                                            }
                                        ?>
                                        <td>
                                            <input type="checkbox" name="Role[id_menu][<?= $menu->id ?>]" id="cb_<?= $menu->id ?>" <?= @$isChecked ?> <?= $isDisabled ?> data-id="<?= $menu->id ?>" data-parent="<?= $menu->id_parent ?>">
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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

        //init check_all
        function initCheckedAll() {
            let isCheckedAll = true;
            $('#table-role-permissions input[type="checkbox"]').each(function() {
                if ($(this).is(':checked') == false) {
                    isCheckedAll = false;
                }

            })
            if (isCheckedAll) {
                $('#check_all').attr('checked', 'checked');
            }
        }
        initCheckedAll();

        $('#check_all').on('change', function() {
            $('#table-role-permissions input[type="checkbox"]').each(function() {
                $(this).prop('checked', false);
            })
            if ($(this).is(':checked')) {
                $('#table-role-permissions input[type="checkbox"]').prop('checked', 'checked');
            } 
        })

    });

    $(document).on('change', 'input[type="checkbox"]', function () {
        const checkParent = (childId) => {
            const parentId = $(`input[type="checkbox"][data-id="`+childId+`"]`).data('parent');
            if (parentId && parentId !== 0) {
                // Check the parent checkbox
                $(`input[type="checkbox"][data-id="`+parentId+`"]`).prop('checked', true);
                // Recursively check the upper-level parent
                checkParent(parentId);
            }
        };

        // When a checkbox is checked, start the recursive check for its parents
        if ($(this).is(':checked')) {
            const currentId = $(this).data('id');
            checkParent(currentId);
        }
    });



JS;


$this->registerJs($script, View::POS_READY);


?>