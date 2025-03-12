<?php

namespace app\controllers;

use Yii;
use app\components\Mode;
use app\models\FileSource;
use app\models\FileSourceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\FileUploadForm;
use app\models\TableUpload;
use app\utils\StringHelper;
use yii\helpers\Url;

/* custom controller, theme uplon integrated */
/**
 * FileSourceController implements the CRUD actions for FileSource model.
 */
date_default_timezone_set('Asia/Jakarta');
class FileSourceController extends Controller
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
     * Lists all FileSource models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FileSourceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexCalendar($year=null)
    {
        $searchModel = new FileSourceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if ($year == null) {
            $year = date('Y');
        }
        $listCodeName = FileSource::getListCodeName($year);

        return $this->render('index-calendar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listCodeName' => $listCodeName,
            'year' => $year
        ]);
    }

    /**
     * Displays a single FileSource model.
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

    public function actionShow($id)
    {
        $model = $this->findModel($id);
        if ($model != null) {
            $route = TableUpload::getList()[$model->id_table];
            $route = str_replace(' ', '-', $route);
            $route .= '/index-serverside';

            $date_start = date('Y-m-d', strtotime($model->getYear() . '-' . $model->getMonth() . '-01'));
            $date_end = date('Y-m-t', strtotime($model->getYear() . '-' . $model->getMonth() . '-01'));
            $params = [
                'date_start' => $date_start,
                'date_end' => $date_end
            ];

            return $this->redirect([$route, $params]);
        }
        
        Yii::$app->session->setFlash('error', 'Data tidak ditemukan');
        return $this->redirect(['index']);
    }

    /**
     * Creates a new FileSource model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new FileSource();

        $referrer = Yii::$app->request->referrer;

        if ($model->load(Yii::$app->request->post())) {
            $referrer = $_POST['referrer'];

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
     * Updates an existing FileSource model.
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

            if ($model->save()) {
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

    public function actionUploadCalendar($code_name=null, $year=null, $month=null, $code=null)
    {        
        $model = new FileUploadForm();
        $fileSource = new FileSource();
        if ($code_name != null) {
            $fileSource = FileSource::find()->where([
                'code_name' => $code_name
            ])->one();
        }

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            $filename = $model->file->baseName . '.'. $model->file->extension;
            $codeName = $model->getCodeName();
            $fileSourceExists = FileSource::isFileExists($codeName);

            if ($fileSourceExists) {                    
                $fileSourceExists->updateAttributes([
                    'date_updated' => date('Y-m-d H:i:s')
                ]);
            } else {   
                $fileSource = new FileSource();
                $fileSource->id_table = $model->id_table;
                $fileSource->periode = $model->periode;
                $fileSource->filename = $filename;
                $fileSource->path = $model->path;
                $code_name = TableUpload::getList()[$fileSource->id_table];
                $fileSource->code_name = $code_name . $fileSource->getYear() . $fileSource->getMonth();
                if ($fileSource->save()) {
                    $fileSourceExists = $fileSource;
                }
            }
            
            $model->id_file_source = $fileSourceExists->id;
            // file is uploaded successfully
            if ($model->upload()) {
                /** clear unmatched periode 
                 * @see app\commands\UploadController
                */
                try {
                    $model->removeUnmatchPeriode();
                } catch (\Throwable $th) {
                    //throw $th;
                }
                
                Yii::$app->session->setFlash('success', 'File uploaded successfully.');
                return $this->redirect(['index']);
            } else {
                $fileSourceExists->delete();
                // var_dump($model->errors); die();
                Yii::$app->session->setFlash('error', 'Terjadi kesalahan');
            }
        }

        return $this->render('upload', [
            'model' => $model,
            'fileSource' => $fileSource,
            'referrer' => $this->request->referrer,
            'year' => $year,
            'month' => $month,
            'code' => $code
        ]);
    }

    /**
     * Deletes an existing FileSource model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $fileUploadForm = new FileUploadForm();
        // $isDeleted = $fileUploadForm->deleteFile($model->filename, $model->code_name);
        $isDeleted = $fileUploadForm->deleteTable($id, $model->id_table);

        if ($isDeleted && $model->delete()) {
            Yii::$app->session->setFlash('success', 'Delete success');
        } else {
            Yii::$app->session->setFlash('error', 'An error occured when delete.');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the FileSource model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return FileSource the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileSource::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpload($id=null)
    {
        $model = new FileUploadForm();
        $fileSource = new FileSource();
        if ($id != null) {
            $fileSource = FileSource::findOne($id);
        }

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            $filename = $model->file->baseName . '.'. $model->file->extension;
            $codeName = $model->getCodeName();
            $fileSourceExists = FileSource::isFileExists($codeName);

            if ($fileSourceExists) {                    
                $fileSourceExists->updateAttributes([
                    'date_updated' => date('Y-m-d H:i:s')
                ]);
            } else {   
                $fileSource = new FileSource();
                $fileSource->id_table = $model->id_table;
                $fileSource->periode = $model->periode;
                $fileSource->filename = $filename;
                $fileSource->path = $model->path;
                $code_name = TableUpload::getList()[$fileSource->id_table];
                $fileSource->code_name = $code_name . $fileSource->getYear() . $fileSource->getMonth();
                if ($fileSource->save()) {
                    $fileSourceExists = $fileSource;
                }
            }
            
            $model->id_file_source = $fileSourceExists->id;
            // file is uploaded successfully
            if ($model->upload()) {
                /** clear unmatched periode 
                 * @see app\commands\UploadController
                */
                try {
                    $model->removeUnmatchPeriode();
                } catch (\Throwable $th) {
                    //throw $th;
                }

                Yii::$app->session->setFlash('success', 'File uploaded successfully.');
                return $this->redirect(['index']);
            } else {
                $fileSourceExists->delete();
                // var_dump($model->errors); die();
                Yii::$app->session->setFlash('error', 'Terjadi kesalahan');
            }
        }

        return $this->render('upload', [
            'model' => $model,
            'fileSource' => $fileSource,
            'referrer' => $this->request->referrer
        ]);
    }

    public function actionDownload($id) {
        $model = $this->findModel($id);
        
        $filename = $model->code_name . '.xlsx';

        if ($model) {
            return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . '/uploads/' . $filename);
        }

        die('file not found');
    }

}
