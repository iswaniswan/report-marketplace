<?php

use app\components\Mode;
use app\models\RolePermissions;
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
                    <h4 class="card-title mb-3">Edit Role</h4>
                </div>

                <div class="container-fluid">
                    <?= $form->errorSummary($model) ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?php // $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

<?php // $form->field($model, 'level')->textInput() ?>

<?php // $form->field($model, 'status')->textInput() ?>

<?=  $form->field($model, 'status')->dropDownList([
                            0 => 'Inactive',
                            1 => 'Active'
                    ], [
                            'prompt' => '- Pilih Status -',
                            'required' => true,
                            'value' => 1
                    ])->label('Status') ?>

<?php /* $form->field($model, 'date_created')->textInput([
    'disabled' => 'disabled'
]) */ ?>

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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="table-role-permissions">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th style="width: 16%">Hak Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $permissions = RolePermissions::getDefaultPermissions(); ?>
                            <?php $rootMenu = RolePermissions::getAllUserPermission($model->id, true); ?>
                            <?php if ($rootMenu == null) {
                                $rootMenu = RolePermissions::getRootMenu();
                            } ?>                            


                            <?php if ($model->id == null) {
                                $_id_role = (array) $rootMenu[0]['id_role'];
                                $model->id = $_id_role[0];
                            } ?>

                            <?= $form->field($model, 'id')->hiddenInput([
                                'value' => @$model->id
                            ])->label(false) ?>

                            <?php foreach (@$rootMenu as $rolePermssions) { ?>
                                <tr>
                                    <td><?= $rolePermssions->alias ?></td>

                                    <?php $countChecked = 0; ?>
                                    <?php foreach (@$permissions as $permission) {?>
                                        <?php $arrayHasPermission = json_decode($rolePermssions->permission) ?>
                                        <?php $isChecked = ''; if (in_array($permission, $arrayHasPermission)) {
                                            $countChecked += 1;
                                            $isChecked = 'checked';
                                        } ?>

                                        <td>
                                            <input type="checkbox" name="Role[permissions][<?= $rolePermssions->id ?>][<?= $permission ?>]" id="cb_<?= $permission . '_' . $rolePermssions->id ?>" <?= $isChecked ?> <?= $isDisabled ?>>
                                        </td>
                                    <?php } ?>      
                                </tr>

                                <?php /** sementara tampilkan root menu saja */ continue; ?>

                                <?php $allChild = RolePermissions::getChildMenu($rolePermssions->id) ?>
                                <?php foreach (@$allChild as $child) { ?>
                                    <tr>
                                        <td style="padding-left: 2rem;"><?= $child->alias ?></td>

                                        <?php $countChecked = 0; ?>
                                        <?php foreach (@$permissions as $permission) {?>
                                            <?php $arrayHasPermission = json_decode($child->permission) ?>
                                            <?php $isChecked = ''; if (in_array($permission, $arrayHasPermission)) {
                                                $countChecked += 1;
                                                $isChecked = 'checked';
                                            } ?>
                                            <td>
                                                <input type="checkbox" name="Role[permissions][<?= $child->id ?>][<?= $permission ?>]" id="cb_<?= $permission . '_' . $child->id ?>" <?= $isChecked ?> <?= $isDisabled ?>>
                                            </td>
                                        <?php } ?>   

                                    </tr>

                                    <?php $allGrandChild = RolePermissions::getChildMenu($child->id) ?>
                                    <?php foreach (@$allGrandChild as $grandChild) { ?>
                                        <tr>
                                            <td style="padding-left: 4rem"><?= $grandChild->alias ?></td>

                                            <?php $countChecked = 0; ?>
                                            <?php foreach (@$permissions as $permission) {?>
                                                <?php $arrayHasPermission = json_decode($grandChild->permission) ?>
                                                <?php $isChecked = ''; if (in_array($permission, $arrayHasPermission)) {
                                                    $countChecked += 1;
                                                    $isChecked = 'checked';
                                                } ?>
                                                <td>                                                    
                                                    <input type="checkbox" name="Role[permissions][<?= $grandChild->id ?>][<?= $permission ?>]" id="cb_<?= $permission . '_' . $grandChild->id ?>" <?= $isChecked ?> <?= $isDisabled ?>>
                                                </td>
                                            <?php } ?>  
                                            
                                        </tr>
                                    <?php } ?>

                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php /* all permissions
<div class="row">
    <div class="container-fluid">
        <div class="role-permissions card-box">
            <div class="card-body row">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="table-role-permissions">
                        <thead>
                            <tr>
                                <th>Menu</th>    
                                <?php $permissions = RolePermissions::getDefaultPermissions(); ?>
                                <?php foreach (@$permissions as $permission) {?>
                                    <td><?= ucwords($permission) ?></td>
                                <?php } ?>     
                                <td>#</td>                       
                            </tr>
                        </thead>
                        <tbody>
                            <?php $rootMenu = RolePermissions::getRootMenu(); ?>
                            <?php foreach (@$rootMenu as $rolePermssions) { ?>
                                <tr>
                                    <td><?= $rolePermssions->alias ?></td>

                                    <?php $countChecked = 0; ?>
                                    <?php foreach (@$permissions as $permission) {?>
                                        <?php $arrayHasPermission = json_decode($rolePermssions->permission) ?>
                                        <?php $isChecked = ''; if (in_array($permission, $arrayHasPermission)) {
                                            $countChecked += 1;
                                            $isChecked = 'checked';
                                        } ?>

                                        <td>
                                            <input type="checkbox" id="cb_<?= $permission . '_' . $rolePermssions->id ?>" <?= $isChecked ?>>
                                        </td>
                                    <?php } ?>                                    
                                    <td>
                                        <input type="checkbox" id="cb_all_<?= $rolePermssions->id ?>" <?= ($countChecked == 6) ? 'checked' : '' ?>>
                                    </td>
                                </tr>

                                <?php $allChild = RolePermissions::getChildMenu($rolePermssions->id) ?>
                                <?php foreach (@$allChild as $child) { ?>
                                    <tr>
                                        <td style="padding-left: 2rem;"><?= $child->alias ?></td>

                                        <?php $countChecked = 0; ?>
                                        <?php foreach (@$permissions as $permission) {?>
                                            <?php $arrayHasPermission = json_decode($child->permission) ?>
                                            <?php $isChecked = ''; if (in_array($permission, $arrayHasPermission)) {
                                                $countChecked += 1;
                                                $isChecked = 'checked';
                                            } ?>
                                            <td>
                                                <input type="checkbox" id="cb_<?= $permission . '_' . $child->id ?>" <?= $isChecked ?>>
                                            </td>
                                        <?php } ?>                                    
                                        <td>
                                            <input type="checkbox" id="cb_all_<?= $rolePermssions->id ?>" <?= ($countChecked == 6) ? 'checked' : '' ?>>
                                        </td>

                                    </tr>

                                    <?php $allGrandChild = RolePermissions::getChildMenu($child->id) ?>
                                    <?php foreach (@$allGrandChild as $grandChild) { ?>
                                        <tr>
                                            <td style="padding-left: 4rem"><?= $grandChild->alias ?></td>

                                            <?php $countChecked = 0; ?>
                                            <?php foreach (@$permissions as $permission) {?>
                                                <?php $arrayHasPermission = json_decode($grandChild->permission) ?>
                                                <?php $isChecked = ''; if (in_array($permission, $arrayHasPermission)) {
                                                    $countChecked += 1;
                                                    $isChecked = 'checked';
                                                } ?>
                                                <td>                                                    
                                                    <input type="checkbox" id="cb_<?= $permission . '_' . $grandChild->id ?>" <?= $isChecked ?>>
                                                </td>
                                            <?php } ?>                                    
                                            <td>
                                                <input type="checkbox" id="cb_all_<?= $rolePermssions->id ?>" <?= ($countChecked == 6) ? 'checked' : '' ?>>
                                            </td>
                                            
                                        </tr>
                                    <?php } ?>

                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
*/ ?>


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

JS;


$this->registerJs($script, View::POS_READY);


?>