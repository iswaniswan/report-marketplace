<?php

namespace app\controllers;

use Yii;
use app\components\Mode;
use app\models\Ginee;
use app\models\GineeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/* custom controller, theme uplon integrated */
/**
 * GineeController implements the CRUD actions for Ginee model.
 */
class GineeController extends Controller
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
     * Lists all Ginee models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GineeSearch();
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
            'date_start' => $request[1]['date_start'] ?? null,
            'date_end' => $request[1]['date_end'] ?? null,
            'status' => $request[1]['status'] ?? null,
            'channel' => $request[1]['channel'] ?? null,
        ];

        return $this->render('index-serverside', $params);
    }

    public function actionIndexSummary()
    {        
        $produkTerjual = Ginee::getSum('jumlah', [], []);

        $produkSelesai = Ginee::getSum('jumlah', [
            'status' => 'Selesai',
        ], []);

        $produkBatal = Ginee::getSum('jumlah', [
            'status' => ['Dibatalkan', 'Return/Refund'],
        ], []);

        $produkDikirim = Ginee::getSum('jumlah', [
            'status' => 'Sedang dikirim',
        ], []);

        $totalHargaTotalPromosi = Ginee::getSum('harga_total_promosi');

        $totalTotal = Ginee::getSum('total');

        return $this->render('index-summary', [
            'produkTerjual' => $produkTerjual,
            'produkSelesai' => $produkSelesai,
            'produkBatal' => $produkBatal,
            'produkDikirim' => $produkDikirim,
            'totalHargaTotalPromosi' => $totalHargaTotalPromosi,
            'totalTotal' => $totalTotal
        ]);
    }

    /**
     * Displays a single Ginee model.
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
     * Creates a new Ginee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ginee();

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
     * Updates an existing Ginee model.
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
     * Deletes an existing Ginee model.
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
     * Finds the Ginee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ginee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ginee::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionServerside()
    {
        $searchModel = new GineeSearch();
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
                'tanggal_pembuatan' => date('d-m-Y', strtotime($model->tanggal_pembuatan)),
                'id_pesanan' => $model->id_pesanan,
                'status' => $model->status,
                'channel' => $model->channel,
                'harga_awal_produk' => number_format($model->harga_awal_produk, 2),
                'harga_promosi' => number_format($model->harga_promosi, 2),
                'jumlah' => $model->jumlah,
                'harga_total_promosi' => number_format($model->harga_total_promosi, 2),
                'subtotal' => number_format($model->subtotal, 2),
                'total' => number_format($model->total, 2),
                // 'nama_toko' => $model->nama_toko,
                // 'nama_produk' => $model->nama_produk,
                // 'variant_produk' => $model->variant_produk,
                // 'jumlah' => $model->jumlah,
                // 'total' => $model->mata_uang . ' ' . number_format($model->total, 2),
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
