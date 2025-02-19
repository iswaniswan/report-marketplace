<?php

use app\assets\DropifyAsset;
use app\components\Mode;
use app\components\Session;
use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $referrer string */
/* @var $mode string|null */

DropifyAsset::register($this);

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

                    <div class="col-md-12 mb-4">
                        <?php
                        $initialPreview = '';
                        if ($model->image) {
                            $src = Yii::getAlias('@web').'/uploads/'.$model->image;
                            $initialPreview = Html::img($src, [
                                    'class'=>'file-preview-image img-rounded elevation-2 p-2 profile-picture'
                            ]);
                        }
                        ?>
                        <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                            'pluginOptions' => [
                                'initialPreview'=> $initialPreview,
                                'browseClass' => 'btn btn-success',
                                'showCaption' => false,
                                'showCancel' => false,
                                'showUpload' => false,
                                'removeClass' => 'btn btn-danger',
                                'removeIcon' => '<span class="ti-trash"></span> ',
                                'maxFileSize' => 2800
                            ],
                            'attribute' => 'file',
                            'options' => [
                                'multiple' => false,
                                'accept' => 'image/*',
                                'style' => 'margin-bottom: 200px;'
                            ]
                        ])->label('Profile Picture') ?>
                    </div>

                    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

                    <?php // $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    <?php // $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                    <div class="mb-3 row field-user-password required" style="padding:unset">
                        <label class="col-2" for="user-password">Password</label>
                        <div class="col">
                            <div class="input-group mb-3 mr-3">
                                <input type="password" class="form-control" id="user-password" name="User[password]" value="<?= $model->password ?>" maxlength="255" aria-required="true">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="button" id="btn-toggle-password">
                                        <i id="icon-show-password" class="far fa-eye" style="display: none;"></i>
                                        <i id="icon-hide-password" class="far fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="invalid-feedback "></div>
                        </div>
                    </div>

                    <?php // $form->field($model, 'id_role')->textInput() ?>


                    <!-- Yang bisa ganti role hanya admin -->
                    <?php if (Session::isAdmin()) { ?>
                        <?= $form->field($model, 'id_role')->dropDownList(\app\models\Role::getList(), [
                                'prompt' => '- Pilih Role -',
                                'required' => true,
                        ])->label('Role') ?>
                    <?php } ?>

                    <?php // $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

                    <?php // $form->field($model, 'access_token')->textInput(['maxlength' => true]) ?>

                    <?php // $form->field($model, 'is_deleted')->textInput() ?>

                    <?php // $form->field($model, 'date_create')->textInput() ?>

                </div>
                <?= Html::hiddenInput('referrer', $referrer) ?>
            </div>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="container-fluid">
        <?= Html::a('<i class="ti-arrow-left"></i><span class="ml-2">Back</span>', ['/user'], ['class' => 'btn btn-info mb-1']) ?>
        <?php if ($mode == Mode::READ) { ?>
            <?= Html::a('<i class="ti-pencil-alt"></i><span class="ml-2">Edit</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning mb-1']) ?>
        <?php } else { ?>
            <?= Html::submitButton('<i class="ti-check"></i><span class="ml-2">Update</span>', ['class' => 'btn btn-primary mb-1']) ?>
        <?php } ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php 

$script = <<<JS

    $(".dropify").dropify({
        messages: {
            default: "Drag and drop a file here or click",
            replace: "Drag and drop or click to replace",
            remove: "Remove",
            error: "Ooops, something wrong appended."
        },
        error: {
            fileSize: "The file size is too big (1M max)."
        }
    });


    $('#btn-toggle-password').on('click', function() {
        var password = $('#user-password');
        var iconShow = $('#icon-show-password');
        var iconHide = $('#icon-hide-password');

        if (password.attr('type') === 'password') {
            password.attr('type', 'text');
            iconShow.show();
            iconHide.hide();
        } else {
            password.attr('type', 'password');
            iconShow.hide();
            iconHide.show();
        }
    });

JS;

$this->registerJs($script, View::POS_END);

?>