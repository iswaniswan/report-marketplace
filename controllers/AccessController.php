<?php

namespace app\controllers;

use app\models\AccessDetail;
use app\models\Menu;
use app\models\MenuSearch;
use Yii;
use app\components\Mode;
use app\models\Access;
use app\models\AccessSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/* custom controller, theme uplon integrated */
/**
 * AccessController implements the CRUD actions for Access model.
 */
class AccessController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Access models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AccessSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Access model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $referrer = $this->request->referrer;

        $menuSearch = new MenuSearch();
        $menuProvider = $menuSearch->search($this->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'referrer' => $referrer,
            'mode' => Mode::READ,
            'menuProvider' => $menuProvider
        ]);
    }

    /**
     * Creates a new Access model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Access();

        $referrer = Yii::$app->request->referrer;

        $menuSearch = new MenuSearch();
        $menuProvider = $menuSearch->search($this->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {
            $referrer = $_POST['referrer'];

            /** use json text */
            // decode permission
//            $permission = [];
//            foreach ($model->menu as $id_menu => $array) {
//                $_permission = [];
//                foreach ($array as $key => $value) {
//                    $_permission[] = $key;
//                }
//                $permission[] = [$id_menu => $_permission];
//            }
//
//            $model->permission = json_encode($permission);

            if ($model->save()) {
                /** use model */
                foreach ($model->menu as $id_menu => $array) {
                    $accessDetail = new AccessDetail();
                    $accessDetail->id_access = $model->id;
                    $accessDetail->id_menu = $id_menu;
                    foreach ($array as $key => $value) {
                        if ($value == 'on') {
                            $accessDetail->{$key} = 1;
                        }
                    }

                    if (!$accessDetail->save()) {
                        var_dump($accessDetail->errors); die();
                    }
                }

                Yii::$app->session->setFlash('success', 'Create success.');
                return $this->redirect($referrer);
            }

            Yii::$app->session->setFlash('error', 'An error occured when create.');
        }

        return $this->render('view', [
            'model' => $model,
            'referrer' => $referrer,
            'mode' => Mode::CREATE,
            'menuProvider' => $menuProvider
        ]);
    }

    /**
     * Updates an existing Access model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $referrer = Yii::$app->request->referrer;

        $menuSearch = new MenuSearch();
        $menuProvider = $menuSearch->search($this->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {
            $referrer = $_POST['referrer'];

            if ($model->save()) {
                /** delete old data */
                $model->deleteAccessDetail();
                /** use model */
                foreach ($model->menu as $id_menu => $array) {
                    $accessDetail = new AccessDetail();
                    $accessDetail->id_access = $model->id;
                    $accessDetail->id_menu = $id_menu;
                    foreach ($array as $key => $value) {
                        if ($value == 'on') {
                            $accessDetail->{$key} = 1;
                        }
                    }

                    if (!$accessDetail->save()) {
                        var_dump($accessDetail->errors); die();
                    }
                }

                Yii::$app->session->setFlash('success', 'Update success.');
                return $this->redirect($referrer);
            }

            Yii::$app->session->setFlash('error', 'An error occured when update.');
        }

        return $this->render('view', [
            'model' => $model,
            'referrer' => $referrer,
            'mode' => Mode::UPDATE,
            'menuProvider' => $menuProvider
        ]);
    }

    /**
     * Deletes an existing Access model.
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
     * Finds the Access model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Access the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Access::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
