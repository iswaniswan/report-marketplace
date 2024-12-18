<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
\app\assets\UplonAsset::register($this);

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .box-center {
        display: flex;
        justify-content: center;
        align-items:center;
        height: 80vh;
        width: 80vw;
        margin:auto;
    }
    a.dropdown-item, a.dropdown-item *:hover {
        cursor: pointer;
        background-color: transparent !important;
    }

    .leaves {
        border-radius: 28px 2px 2px 2px
    }
    .radius-top-left {
        border-radius: 28px 2px 2px 2px !important;
    }
    .h1-icon {
        width: fit-content;
        /* height: fit-content; */
        margin-left: auto;
        margin-right: auto;
        border: 2px solid #64b0f2;
        padding: 1rem 1.2rem;
        border-radius: 50%;
    }

    .leaves-sm {
        border-radius: 18px 2px 2px 2px;
    }

    .rounded {
        border-radius: 18px !important;
    }
    .shadow-primary {
        box-shadow: 0 0 35px 0 rgba(100, 176, 242, .5) !important;
    }

    /** placeholder color */
    input::placeholder {
        color: #64b0f2 !important; /* Change this to your desired color */
        opacity: 1; /* Optional: Ensures full color opacity */
    }
    input::-webkit-input-placeholder { /* Chrome, Safari, Opera */
        color: #64b0f2 !important
    }

    input:-moz-placeholder { /* Firefox 18- */
        color: #64b0f2 !important
    }

    input::-moz-placeholder { /* Firefox 19+ */
        color: #64b0f2 !important
    }

    input:-ms-input-placeholder { /* IE 10+ */
        color: #64b0f2 !important
    }

    .checkbox label::before {
        border: 1px solid #64b0f2 !important;
    }
</style>

<div class="row mb-4 justify-content-center box-center">    
    <div class="col-md-6" style="max-width: 20rem">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
//                'template' => "{label}\n{input}\n{error}",
                'template' => "{label}\n{input}",
                'labelOptions' => ['class' => 'col-12 col-form-label text-secondary', 'style' => 'font-weight: 400', 'icon' => '<i></i>'],
                'inputOptions' => ['class' => 'col-12 form-control text-secondary rounded border-primary'],
            //    'errorOptions' => ['class' => 'col-12 invalid-feedback'],
                'horizontalCssClasses' => [
                    'field' => 'mb-4',
                ]
            ]
        ]); ?>
        <div class="card p-2 leaves shadow-primary">
            <div class="card-header bg-transparent radius-top-left">
                <div class="text-center">
                    <div class="d-none">
                        <a href="#">
                            <span><img src="<?= Yii::getAlias('@web').'/images/logo2.png' ?>" alt="" height="" style="width: 100%"></span>
                        </a>
                    </div>
                    <h1 class="bg-primary text-uppercase h1-icon">
                        <i class="ti-user text-white"></i>
                        <?php // Html::encode($this->title) ?>
                    </h1>
                </div>
            </div>
            <div class="card-body">
                <?= $form->field($model, 'username')->textInput([
                    'autofocus' => true,
                    'placeholder' => 'Username',
                    'autocomplete' => 'on'
                ])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput([
                    'placeholder' => 'Password',
                    'autocomplete' => 'current-password'
                ])->label(false) ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"col-12 checkbox checkbox-primary ml-2 text-primary\">{input} {label}</div>\n<div class=\"col-12\">{error}</div>",
                ]) ?>

                <div class="" style="padding: 0.5rem 0rem;">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-block btn-primary rounded', 'name' => 'login-button']) ?>
                </div>
            </div> <!-- end card-body -->
        </div>
        <?php ActiveForm::end(); ?>
        <!-- end card -->
        <div class="row mt-3 d-none">
            <div class="col-12 text-center">
                <p class="text-primary">Don't have an account? <a href="<?= \yii\helpers\Url::to(['/site/register']) ?>" class="text-primary ml-1"><b>Register</b></a></p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>



