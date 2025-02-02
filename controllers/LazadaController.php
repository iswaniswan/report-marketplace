<?php

namespace app\controllers;

use Yii;
use app\components\Mode;
use app\models\Lazada;
use app\models\LazadaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/* custom controller, theme uplon integrated */
/**
 * LazadaController implements the CRUD actions for Lazada model.
 */
class LazadaController extends Controller
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
     * Lists all Lazada models.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->actionIndexServerside();

        $searchModel = new LazadaSearch();
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
            'status' => $request[1]['status'] ?? [],
        ];

        return $this->render('index-serverside', $params);
    }

    public function actionIndexSummary()
    {        
        $request = Yii::$app->request->get();
        
        /** temporary periode karena data kosong */
        $periode = $request[1]['periode'] ?? date('Y-m');   
        // $periode = $request[1]['periode'] ?? '2024-09';

        $date_start = date('Y-m-d', strtotime($periode. '-01'));
        $date_end = date('Y-m-t', strtotime($periode. '-01'));
        $summaryByDateRange = Lazada::getSummaryByDateRange($date_start, $date_end);
        $summaryTotal = Lazada::getSummaryByDateRange($date_start, $date_end, $is_total=true);

        // $jumlahTransaksi = Tiktok::getCountUnique('no_pesanan', [
        //     'status_pesanan' => 'Selesai'
        // ]);
        // ambil status pesanan yg tidak selesai
        $countStatusPesanan = Lazada::getCountStatusPesanan($date_start, $date_end);
        $allStatusPesanan = [];
        foreach (@$countStatusPesanan as $statusPesanan) {
            $key = strtolower($statusPesanan['status']); // Convert the key to lowercase
            $allStatusPesanan[$key] = (int)$statusPesanan['jumlah'];  
        }

        $allHjpPesanan = [];
        foreach (@$countStatusPesanan as $statusPesanan) {
            $key = strtolower($statusPesanan['status']); // Convert the key to lowercase
            $allHjpPesanan[$key] = (int)$statusPesanan['amount_hjp'];  
        }

        return $this->render('index-summary', [
            'periode' => $periode,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'summaryByDateRange' => $summaryByDateRange,
            'summaryTotal' => $summaryTotal,
            'allStatusPesanan' => $allStatusPesanan,
            'allHjpPesanan' => $allHjpPesanan
        ]);
    }

    /**
     * Displays a single Lazada model.
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
     * Creates a new Lazada model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Lazada();

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
     * Updates an existing Lazada model.
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
     * Deletes an existing Lazada model.
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
     * Finds the Lazada model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Lazada the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lazada::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionServerside()
    {
        $searchModel = new LazadaSearch();
        $searchModel->isServerside = true;

        // optional parameter
        // $searchModel->year = Yii::$app->request->get('year') ?? null;
        // $searchModel->month = Yii::$app->request->get('month') ?? null;
        $searchModel->date_start = Yii::$app->request->get('date_start') ?? null;
        $searchModel->date_end = Yii::$app->request->get('date_end') ?? null;
        $searchModel->status = Yii::$app->request->get('status') ?? [];
        
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
                'create_time' => $model->create_time,
                'order_item_id' => $model->order_item_id,
                'item_name' => $model->item_name,
                'seller_sku' => $model->seller_sku,
                'variation' => $model->variation,
                'status' => $model->status,
                'order_number' => $model->order_number,
                'unit_price' => number_format($model->unit_price),
                'seller_discount_total' => number_format(abs($model->seller_discount_total)),
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
        
        $query = Lazada::getExportAll($dateStart, $dateEnd, $status);

        $number = 0;
        $data = [];
        $data = [];
        foreach ($query->all() as $model) {
            $data[] = [
                '#' => ++$number, // Increment the sequence number for each row
                'Create Time' => $model->create_time,
                'Order Item ID' => $model->order_item_id,
                'Item Name' => $model->item_name,
                'Seller SKU' => $model->seller_sku,
                'Variation' => $model->variation,
                'Status' => $model->status,
                'Order Number' => $model->order_number,
                'Unit Price' => number_format($model->unit_price),
                'Seller Discount Total' => number_format(abs($model->seller_discount_total))
            ];
        }
    
        return $this->asJson(['data' => $data]);
    }    


}
