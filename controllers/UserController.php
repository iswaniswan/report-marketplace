<?php

namespace app\controllers;

use app\components\Mode;
use app\components\Session;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/* custom controller, theme uplon integrated */
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    // public function behaviors()
    // {
    //     return array_merge(
    //         parent::behaviors(),
    //         [
    //             'verbs' => [
    //                 'class' => VerbFilter::className(),
    //                 'actions' => [
    //                     'delete' => ['POST'],
    //                 ],
    //             ],
    //         ]
    //     );
    // }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'update', 'delete'], // Specify the actions you want to control
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update', 'delete'],
                        'roles' => ['@'], // This means the user must be logged in
                        'matchCallback' => function ($rule, $action) {
                            // Check if the user is an admin or the logged-in user accessing their own data
                            $userId = Yii::$app->user->id;
                            return Session::isAdmin() || Yii::$app->request->get('id') == $userId;
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $isValid = Session::getIdUser() == $id || Session::isAdmin();
        if (!$isValid) {
            Yii::$app->session->setFlash('error', 'Forbidden AcCcess');
            return $this->redirect(['site/index']);
        }

        $referrer = $this->request->referrer;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'referrer' => $referrer,
            'mode' => Mode::READ
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        $referrer = Yii::$app->request->referrer;

        if ($model->load(Yii::$app->request->post())) {
            $referrer = $_POST['referrer'];

            $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Create success.');
                return $this->redirect($referrer);
            }

            Yii::$app->session->setFlash('error', 'An error occured when create.');
        }

        return $this->render('view', [
            'model' => $model,
            'referrer' => $referrer,
            'mode' => Mode::CREATE
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->image;

        $referrer = Yii::$app->request->referrer;

        if ($model->load(Yii::$app->request->post())) {
            $referrer = $_POST['referrer'];

            $upload = UploadedFile::getInstanceByName('User[image]');
            if ($upload !== null) {
                $model->image = $upload->baseName . Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s')) . '.' . $upload->extension;
            } else {
                $model->image = $oldImage;
            }

            $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);

            if ($model->save()) {

                if ($upload !== null) {
                    $path = Yii::getAlias('@app').'/web/uploads/';
                    $upload->saveAs($path.$model->image, false);
                }

                Yii::$app->session->setFlash('success', 'Update success.');

                if (Session::isAdmin() == false) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

                return $this->redirect(['index']);
            }

            Yii::$app->session->setFlash('error', 'An error occured when update.');
        }

        return $this->render('view', [
            'model' => $model,
            'referrer' => $referrer,
            'mode' => Mode::UPDATE
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Delete success');
        } else {
            Yii::$app->session->setFlash('error', 'An error occured when delete.');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSoftDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->softDelete()) {
            Yii::$app->session->setFlash('success', 'Delete success');
        } else {
            Yii::$app->session->setFlash('error', 'An error occured when delete.');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }


}
