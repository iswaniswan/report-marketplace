<?php

namespace app\controllers;

use Yii;
use app\components\Mode;
use app\models\Role;
use app\models\RolePermissions;
use app\models\RoleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/* custom controller, theme uplon integrated */
/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
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
     * Lists all Role models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $referrer = $this->request->referrer;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'referrer' => $referrer,
            'mode' => Mode::READ
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Role();

        $referrer = Yii::$app->request->referrer;

        if ($model->load(Yii::$app->request->post())) {
            $referrer = $_POST['referrer'];
            if (@$_POST["Role"]["id"] != null) {
                $model->id = $_POST["Role"]["id"];
                $model->updateAttributes([
                    'name' => $model->name,
                    'code' => $model->name,
                    'status' => $model->status
                ]);
            }

            if ($model->id != null && $model->permissions != null) {
                $allRolePermissions = RolePermissions::getAllUserPermission($model->id);
                foreach (@$allRolePermissions as $rolePermissions) {                    
                    // only update permission read
                    $userPermissions = json_decode($rolePermissions->permission);

                    if (@$model->permissions[$rolePermissions->id] && 
                        @$model->permissions[$rolePermissions->id]['read'] == 'on') {
                            array_push($userPermissions, 'read'); 
                            $userPermissions = array_unique($userPermissions);
                            $rolePermissions->updateAttributes([
                                'permission' => json_encode($userPermissions)
                            ]);
                    } else {
                        $userPermissions = array_diff($userPermissions, ["read"]);
                        $userPermissions = array_values($userPermissions);
                        $rolePermissions->updateAttributes([
                            'permission' => json_encode($userPermissions)
                        ]);
                    }
                }

                Yii::$app->session->setFlash('success', 'Create success.');
                return $this->redirect($referrer);

            } else {

                if ($model->save()) {
                    
                    if ($model->permissions != null) {
                        // get all user permission
                        $allRolePermissions = RolePermissions::getAllUserPermission($model->id);
                        foreach (@$allRolePermissions as $rolePermissions) {                    
                            // only update permission read
                            $userPermissions = json_decode($rolePermissions->permission);
    
                            if (@$model->permissions[$rolePermissions->id] && 
                                @$model->permissions[$rolePermissions->id]['read'] == 'on') {
                                    array_push($userPermissions, 'read'); 
                                    $userPermissions = array_unique($userPermissions);
                                    $rolePermissions->updateAttributes([
                                        'permission' => json_encode($userPermissions)
                                    ]);
                            } else {
                                $userPermissions = array_diff($userPermissions, ["read"]);
                                $userPermissions = array_values($userPermissions);
                                $rolePermissions->updateAttributes([
                                    'permission' => json_encode($userPermissions)
                                ]);
                            }
                        }
                    } 
    
                    Yii::$app->session->setFlash('success', 'Create success.');
                    return $this->redirect($referrer);
                }
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
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $referrer = Yii::$app->request->referrer;

        if ($model->load(Yii::$app->request->post())) {
            $referrer = $_POST['referrer'];

            if ($model->code == null) {
                $model->code = $model->name;
            }

            if ($model->save()) {                

                if ($model->permissions != null) {
                    // get all user permission
                    $allRolePermissions = RolePermissions::getAllUserPermission($model->id);
                    foreach (@$allRolePermissions as $rolePermissions) {                    
                        // only update permission read
                        $userPermissions = json_decode($rolePermissions->permission);

                        if (@$model->permissions[$rolePermissions->id] && 
                            @$model->permissions[$rolePermissions->id]['read'] == 'on') {
                                array_push($userPermissions, 'read'); 
                                $userPermissions = array_unique($userPermissions);
                                $rolePermissions->updateAttributes([
                                    'permission' => json_encode($userPermissions)
                                ]);
                        } else {
                            $userPermissions = array_diff($userPermissions, ["read"]);
                            $userPermissions = array_values($userPermissions);
                            $rolePermissions->updateAttributes([
                                'permission' => json_encode($userPermissions)
                            ]);
                        }
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
            'mode' => Mode::UPDATE
        ]);
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_role = $model->id;

        if ($model->delete()) {
            RolePermissions::deleteAll(['id_role' => $id_role]);

            Yii::$app->session->setFlash('success', 'Delete success');
        } else {
            Yii::$app->session->setFlash('error', 'An error occured when delete.');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
