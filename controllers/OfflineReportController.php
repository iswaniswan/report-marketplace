<?php

namespace app\controllers;

use Yii;
use app\components\Mode;
use app\models\Offline;
use app\models\OfflineReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/* custom controller, theme uplon integrated */
/**
 * OfflineReportController implements the CRUD actions for Offline model.
 */
class OfflineReportController extends Controller
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
     * Lists all Offline models.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->actionIndexServerside();

        $searchModel = new OfflineReportSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexServerside()
    {        
        $request = Yii::$app->request->get();
        $params = [
            'date_start' => $request[1]['date_start'] ?? date('Y-m-01'),
            'date_end' => $request[1]['date_end'] ?? date('Y-m-t'),
        ];

        return $this->render('index-serverside', $params);
    }

    public function actionIndexSummary()
    {        
        $request = Yii::$app->request->get();
        
        /** temporary periode karena data kosong */
        $periode = $request[1]['periode'] ?? date('Y-m');   
        // $periode = $request[1]['periode'] ?? '2024-10';

        $date_start = date('Y-m-d', strtotime($periode. '-01'));
        $date_end = date('Y-m-t', strtotime($periode. '-01'));
        
        $summaryByDateRange = Offline::getSummaryByDateRange($date_start, $date_end);
        $summaryTotal = Offline::getSummaryByDateRange($date_start, $date_end, $is_total=true);
        // echo '<pre>'; var_dump($summaryByDateRange); echo '</pre>'; die();

        return $this->render('index-summary', [
            'periode' => $periode,
            'summaryTotal' => $summaryTotal,
            'summaryByDateRange' => $summaryByDateRange
        ]);
    }

    /**
     * Displays a single Offline model.
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
     * Creates a new Offline model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Offline();

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
     * Updates an existing Offline model.
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

    /**
     * Deletes an existing Offline model.
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
     * Finds the Offline model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Offline the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Offline::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionServerside()
    {
        $searchModel = new OfflineReportSearch();
        $searchModel->isServerside = true;

        // optional parameter
        // $searchModel->year = Yii::$app->request->get('year') ?? null;
        // $searchModel->month = Yii::$app->request->get('month') ?? null;
        $searchModel->date_start = Yii::$app->request->get('date_start') ?? null;
        $searchModel->date_end = Yii::$app->request->get('date_end') ?? null;
        $searchModel->status = Yii::$app->request->get('status') ?? null;
        $searchModel->channel = Yii::$app->request->get('channel') ?? null;
        
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Extract order information from the request
        $orderData = Yii::$app->request->get('order', []);
        $columns = Yii::$app->request->get('columns', []);

        // Set pagination based on DataTables parameters
        $pageSize = Yii::$app->request->get('length', 10);
        $page = Yii::$app->request->get('start', 0) / $pageSize;

        $dataProvider->setPagination([
            'pageSize' => $pageSize,
            'page' => $page,
        ]);

        // Handle ordering if order data is provided
        // $modelClass = $dataProvider->query->modelClass;
        if (!empty($orderData)) {
            foreach ($orderData as $order) {
                $columnIndex = intval($order['column']);
                $direction = $order['dir'] === 'asc' ? SORT_ASC : SORT_DESC;

                // Ensure the column name corresponds to a valid attribute from the model
                if (isset($columns[$columnIndex]['data']) && !empty($columns[$columnIndex]['data'])) {
                    $columnName = $columns[$columnIndex]['data'];
                    // Apply ordering to the query
                    $dataProvider->query->addOrderBy([$columnName => $direction]);
                }
            }
        }

        $number = $page * $pageSize; // Adjust the sequence number based on the page
        $data = [];
        foreach ($dataProvider->getModels() as $model) {
            $data[] = [
                'number' => ++$number, // Increment the sequence number for each row
                'tanggal_invoice' => date('d M Y', strtotime($model->tanggal_invoice)),
                'no_invoice' => $model->no_invoice,
                'nama_barang' => $model->nama_barang,
                'kode_sku' => $model->kode_sku,
                'tanggal_bayar' => date('d M Y', strtotime($model->tanggal_bayar)),
                'subtotal' => number_format($model->subtotal),
                'action' => Html::a('<i class="ti-eye"></i>', ['view', 'id' => $model->id], ['title' => 'Detail', 'data-pjax' => '0']),
            ];
        }

        return \yii\helpers\Json::encode([
            'draw' => Yii::$app->request->get('draw'),
            'recordsTotal' => $dataProvider->getTotalCount(),
            'recordsFiltered' => $dataProvider->getTotalCount(),
            'data' => $data,
        ]);
    }

    public function actionExportAll() 
    {
        $dateStart = Yii::$app->request->get('date_start');
        $dateEnd = Yii::$app->request->get('date_end');
        $status = Yii::$app->request->get('status');
        
        $query = Offline::getExportAll($dateStart, $dateEnd, $status);

        $number = 0;
        $data = [];
        foreach ($query->all() as $model) {
            $data[] = [
                '#' => ++$number, // Increment the sequence number for each row
                'Tanggal Invoice' => date('d M Y', strtotime($model->tanggal_invoice)),
                'No Invoice' => $model->no_invoice,
                'Nama Barang' => $model->nama_barang,
                'Kode SKU' => $model->kode_sku,
                'Tanggal Bayar' => date('d M Y', strtotime($model->tanggal_bayar)),
                'Subtotal' => number_format($model->subtotal)
            ];
        }
        
    
        return $this->asJson(['data' => $data]);
    }    


}
