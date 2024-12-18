<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'main-error'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return Response
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        return $this->redirect(['/dashboard/index']);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $this->layout = 'main-login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->login()) {
                return $this->actionIndex();
            }

            Yii::$app->session->setFlash('error', 'Invalid login');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        Yii::$app->session->setFlash('info', 'Thank you for using the Apps.. see you later :)');

        return $this->redirect([
            'site/login',
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegister($params=[])
    {
        $this->layout = 'main-register';
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $plain_password = $model->password;
            $hashPassword = Yii::$app->getSecurity()->generatePasswordHash($plain_password);
            $model->password = $hashPassword;

            if ($model->save()) {

                /** autologin model */
                $login = new LoginForm([
                    'username' => $model->username,
                    'password' => $plain_password
                ]);

                $login->login();

                Yii::$app->session->setFlash('success', 'Registration success');
                /** registration success, then send email */
                //$model->sendEmail();
                return $this->actionIndex();
            }

            Yii::$app->session->setFlash('error', 'An error occured when register');
        }

        $model->password = '';
        return $this->render('register', [
            'model' => $model,
        ]);
    }

}
