<?php

namespace app\controllers;

use Yii;
use app\components\Mode;
use app\models\ShopeeIncome;
use app\models\ShopeeIncomeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/* custom controller, theme uplon integrated */
/**
 * ShopeeIncomeController implements the CRUD actions for ShopeeIncome model.
 */
class ShopeeIncomeController extends Controller
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
     * Lists all ShopeeIncome models.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->actionIndexServerside();

        $searchModel = new ShopeeIncomeSearch();
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
            'status' => $request[1]['status'] ?? null,
        ];

        return $this->render('index-serverside', $params);
    }

    /**
     * Displays a single ShopeeIncome model.
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
     * Creates a new ShopeeIncome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ShopeeIncome();

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
     * Updates an existing ShopeeIncome model.
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
     * Deletes an existing ShopeeIncome model.
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
     * Finds the ShopeeIncome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ShopeeIncome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopeeIncome::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionServerside()
    {
        $searchModel = new ShopeeIncomeSearch();
        $searchModel->isServerside = true;

        // optional parameter
        // $searchModel->year = Yii::$app->request->get('year') ?? null;
        // $searchModel->month = Yii::$app->request->get('month') ?? null;
        $searchModel->date_start = Yii::$app->request->get('date_start') ?? null;
        $searchModel->date_end = Yii::$app->request->get('date_end') ?? null;
        $searchModel->status = Yii::$app->request->get('status') ?? null;
        
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
            /*Total Diskon Produk
            Jumlah Pengembalian Dana ke Pembeli	
            Diskon Produk dari Shopee	
            Diskon Voucher Ditanggung Penjual	
            Cashback Koin yang Ditanggung Penjual	
            Ongkir Dibayar Pembeli	
            Diskon Ongkir Ditanggung Jasa Kirim
            Gratis Ongkir dari Shopee
            Ongkir yang Diteruskan oleh Shopee ke Jasa Kirim
            Ongkos Kirim Pengembalian Barang
            Pengembalian Biaya Kirim
            Biaya Komisi AMS
            Biaya Administrasi (termasuk PPN 11%)
            Biaya Layanan (termasuk PPN 11%)
            Premi	
            Biaya Program	
            Biaya Kartu Kredit
            Biaya Kampanye	
            Bea Masuk, PPN & PPh
            */
            $totalPengeluaran = 
                ($model->jumlah_pengembalian_dana_ke_pembeli
                + $model->diskon_produk_dari_shopee
                + $model->diskon_voucher_ditanggung_penjual
                + $model->cashback_koin_yang_ditanggung_penjual
                + $model->ongkir_dibayar_pembeli
                + $model->diskon_ongkir_ditanggung_jasa_kirim
                + $model->gratis_ongkir_dari_shopee
                + $model->ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim
                + $model->ongkos_kirim_pengembalian_barang
                + $model->pengembalian_biaya_kirim
                + $model->biaya_komisi_ams
                + $model->biaya_administrasi_termasuk_ppn_11
                + $model->biaya_layanan_termasuk_ppn_11
                + $model->premi
                + $model->biaya_program
                + $model->biaya_kartu_kredit
                + $model->biaya_kampanye
                + $model->bea_masuk_ppn_pph
                + $model->kompensasi
                + $model->promo_gratis_ongkir_dari_penjual
                + $model->pengembalian_dana_ke_pembeli
                + $model->pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang
                + $model->pro_rata_voucher_shopee_untuk_pengembalian_barang);

            $data[] = [
                'number' => ++$number,
                // Increment the sequence number for each row
                'waktu_pesanan_dibuat' => $model->waktu_pesanan_dibuat,
                'no_pesanan' => $model->no_pesanan,
                'harga_asli_produk' => number_format($model->harga_asli_produk),
                'total_diskon_produk' => number_format(abs($model->total_diskon_produk)),
                'total_pengeluaran' => number_format(abs($totalPengeluaran)),
                'total_penghasilan' => number_format($model->total_penghasilan),
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
        
        $query = ShopeeIncome::getExportAll($dateStart, $dateEnd, $status);

        $number = 0;
        $data = [];
        foreach ($query->all() as $model) {
            $totalPengeluaran = 
                ($model->jumlah_pengembalian_dana_ke_pembeli
                + $model->diskon_produk_dari_shopee
                + $model->diskon_voucher_ditanggung_penjual
                + $model->cashback_koin_yang_ditanggung_penjual
                + $model->ongkir_dibayar_pembeli
                + $model->diskon_ongkir_ditanggung_jasa_kirim
                + $model->gratis_ongkir_dari_shopee
                + $model->ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim
                + $model->ongkos_kirim_pengembalian_barang
                + $model->pengembalian_biaya_kirim
                + $model->biaya_komisi_ams
                + $model->biaya_administrasi_termasuk_ppn_11
                + $model->biaya_layanan_termasuk_ppn_11
                + $model->premi
                + $model->biaya_program
                + $model->biaya_kartu_kredit
                + $model->biaya_kampanye
                + $model->bea_masuk_ppn_pph
                + $model->kompensasi
                + $model->promo_gratis_ongkir_dari_penjual
                + $model->pengembalian_dana_ke_pembeli
                + $model->pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang
                + $model->pro_rata_voucher_shopee_untuk_pengembalian_barang);

            $data[] = [
                '#' => ++$number,
                'Waktu Pesanan Dibuat' => $model->waktu_pesanan_dibuat,
                'No Pesanan' => $model->no_pesanan,
                'Harga Asli Produk' => number_format($model->harga_asli_produk),
                'Total Diskon Produk' => number_format(abs($model->total_diskon_produk)),
                'Total Pengeluaran' => number_format(abs($totalPengeluaran)),
                'Total Penghasilan' => number_format($model->total_penghasilan)
            ];
        }
    
        return $this->asJson(['data' => $data]);
    }    

}
