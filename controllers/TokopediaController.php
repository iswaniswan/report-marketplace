<?php

namespace app\controllers;

use Yii;
use app\components\Mode;
use app\models\Tokopedia;
use app\models\TokopediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/* custom controller, theme uplon integrated */
/**
 * TokopediaController implements the CRUD actions for Tokopedia model.
 */
class TokopediaController extends Controller
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
     * Lists all Tokopedia models.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->actionIndexServerside();

        $searchModel = new TokopediaSearch();
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
        $summaryByDateRange = Tokopedia::getSummaryByDateRange($date_start, $date_end);
        $summaryTotal = Tokopedia::getSummaryByDateRange($date_start, $date_end, $is_total=true);

        // $jumlahTransaksi = Tiktok::getCountUnique('no_pesanan', [
        //     'status_pesanan' => 'Selesai'
        // ]);
        // ambil status pesanan yg tidak selesai
        $countStatusPesanan = Tokopedia::getCountStatusPesanan($date_start, $date_end);
        $allStatusPesanan = [];
        foreach (@$countStatusPesanan as $statusPesanan) {
            $key = strtolower($statusPesanan['status_terakhir']); // Convert the key to lowercase
            $allStatusPesanan[$key] = (int)$statusPesanan['jumlah'];  
        }

        $allHjpPesanan = [];
        foreach (@$countStatusPesanan as $statusPesanan) {
            $key = strtolower($statusPesanan['status_terakhir']); // Convert the key to lowercase
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
     * Displays a single Tokopedia model.
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
     * Creates a new Tokopedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tokopedia();

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
     * Updates an existing Tokopedia model.
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
     * Deletes an existing Tokopedia model.
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
     * Finds the Tokopedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tokopedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tokopedia::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionServerside()
    {
        $searchModel = new TokopediaSearch();
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
            $totalPenjualan = (int) $model->jumlah_produk_dibeli * (int) $model->harga_jual_idr;

            $data[] = [
                'number' => ++$number, // Increment the sequence number for each row
                'tanggal_pembayaran' => $model->tanggal_pembayaran,
                'nomor_invoice' => $model->nomor_invoice,
                'nama_produk' => $model->nama_produk,
                'nomor_sku' => $model->nomor_sku,
                'tipe_produk' => $model->tipe_produk,
                'status_terakhir' => $model->status_terakhir,
                'jumlah_produk_dibeli' => number_format($model->jumlah_produk_dibeli),
                'harga_jual_idr' => number_format($model->harga_jual_idr),
                'total_penjualan' => number_format($totalPenjualan),
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

}
