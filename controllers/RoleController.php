<?php

namespace app\controllers;

use Yii;
use app\components\Mode;
use app\models\Menu;
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
        $model = $this->findModel($id);

        $allMenu = Menu::getAllMenu($rootOnly=false);

        $referrer = $this->request->referrer;
        return $this->render('view', [
            'model' => $model,
            'referrer' => $referrer,
            'mode' => Mode::READ,
            'allMenu' => $allMenu,
            'idRole' => $id
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
        $allMenu = Menu::getAllMenu($rootOnly=false);

        $referrer = Yii::$app->request->referrer;

        if ($model->load(Yii::$app->request->post())) {
            $referrer = $_POST['referrer'];

            if ($model->code == null) {
                $code = str_replace(" ", "_", $model->name);
                $model->code = strtolower($code);
            }
            if ($model->save()) {

                $allIdMenu = array_keys($model->id_menu);
                $allMenu = Menu::getAllMenu();
                // update read access
                foreach ($allMenu as $menu) {
                    
                    if (in_array($menu->id, $allIdMenu)) {

                        $rolePermission = new RolePermissions([
                            'id_role' => $model->id,
                            'id_menu' => $menu->id,
                            'action' => 'index',
                            'permission' => json_encode(['read'])
                        ]);
    
                        $rolePermission->save();
                    } else {

                        $rolePermission = new RolePermissions([
                            'id_role' => $model->id,
                            'id_menu' => $menu->id,
                            'action' => 'index',
                            'permission' => json_encode([])
                        ]);
    
                        $rolePermission->save();
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
            'allMenu' => $allMenu,
            'idRole' => null
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
        $allMenu = Menu::getAllMenu($rootOnly=false);

        $referrer = Yii::$app->request->referrer;

        if ($model->load(Yii::$app->request->post())) {
            $referrer = $_POST['referrer'];

            if ($model->save()) {

                $allIdMenu = array_keys($model->id_menu);
                $allMenu = Menu::getAllMenu();
                // update read access
                foreach ($allMenu as $menu) {
                    
                    $rolePermission = RolePermissions::findOne(['id_menu' => $menu->id, 'id_role' => $model->id]);
                    if (in_array($menu->id, $allIdMenu)) {    

                        $newPermission = json_decode($rolePermission->permission) ;
                        array_push($newPermission, 'read'); 
                        $newPermission = array_unique($newPermission);
                        $rolePermission->updateAttributes([
                            'permission' => json_encode($newPermission)
                        ]);
                    } else {
                        $newPermission = json_decode($rolePermission->permission) ;
                        $newPermission = array_diff($newPermission, ["read"]);
                        $newPermission = array_values($newPermission);
                        $rolePermission->updateAttributes([
                            'permission' => json_encode($newPermission)
                        ]);
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
            'allMenu' => $allMenu,
            'idRole' => $id
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
