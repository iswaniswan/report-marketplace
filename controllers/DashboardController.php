<?php

namespace app\controllers;

use app\models\Lazada;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\ShopeeIncome;
use app\models\Tokopedia;
use app\models\Tiktok;
use app\models\Offline;
use app\models\TableUpload;

use app\utils\StringHelper;

class DashboardController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'index-summary'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->actionIndexSummary();

        // $this->layout = 'main';
        // return $this->render('index');
    }

    public function actionIndexSummary()
    {
        $request = Yii::$app->request->get();
        
        /** temporary periode karena data kosong */
        $periode = $request[1]['periode'] ?? date('Y-m');   
        // $periode = $request[1]['periode'] ?? '2024-09';

        $date_start = date('Y-m-d', strtotime($periode. '-01'));
        $date_end = date('Y-m-t', strtotime($periode. '-01'));
        $channel = $request[1]['channel'] ?? null;        

        // summary
        $mergedTotal = [];
        $mergedData = [];
        $summaryChannel = [];

        // data pie chart
        // ['name' => 'Tokopedia', 'y' => array_sum($dataChart['jumlahTransaksi'])],
        $pieData = [];

        // $shopee = [
        //     'summaryByDateRange' => ShopeeIncome::getSummaryByDateRange($date_start, $date_end),
        //     'summaryTotal' => ShopeeIncome::getSummaryByDateRange($date_start, $date_end, $is_total=true)
        // ];
        
        if ($channel == null || $channel == TableUpload::SHOPEE) {
            $summaryChannel = ShopeeIncome::getSummaryByDateRange($date_start, $date_end, $is_total=true);
            foreach (@$summaryChannel as $data) { $data = (array) $data;
                // total card
                if (!isset($mergedTotal['jumlah_transaksi'])) {
                    $mergedTotal = [
                        "jumlah_transaksi" => (int) $data['jumlah_transaksi'],
                        "jumlah" => (int) $data['jumlah'],
                        "amount_hjp" => (int) $data['amount_hjp'],
                        "fee_marketplace" => (int) $data['amount_hjp'] - (int) $data['amount_net'],
                        "amount_net" => (int) $data['amount_net']
                    ];
                } else {
                    $mergedTotal['jumlah_transaksi'] += (int) $data['jumlah_transaksi'];
                    $mergedTotal['jumlah'] += (int) $data['jumlah'];
                    $mergedTotal['amount_hjp'] += (int) $data['amount_hjp'];
                    $mergedTotal['fee_marketplace'] += (int) $data['amount_hjp'] - (int) $data['amount_net'];
                    $mergedTotal['amount_net'] += (int) $data['amount_net'];
                }

                $pieData[] = ['name' => 'Shopee', 'y' => (int) $data['amount_net']];
            }
            

            $summaryChannel = ShopeeIncome::getSummaryByDateRange($date_start, $date_end);
            foreach (@$summaryChannel as $data) { $data = (array) $data;
                $date = $data["waktu_pesanan_dibuat"];
    
                // standarized key name
                if (!isset($mergedData[$date])) {
                    $mergedData[$date] = [
                        "waktu_pesanan_dibuat" => $date,
                        "jumlah_transaksi" => (int) $data['jumlah_transaksi'],
                        "jumlah" => (int) $data['jumlah'],
                        "amount_hjp" => (int) $data['amount_hjp'],
                        "fee_marketplace" => (int) $data['amount_hjp'] - (int) $data['amount_net'],
                        "amount_net" => (int) $data['amount_net']
                    ];
                } else {
                    $mergedData[$date] = [
                        "waktu_pesanan_dibuat" => $date,
                        "jumlah_transaksi" => $mergedData[$date]['jumlah_transaksi'] += (int) $data['jumlah_transaksi'],
                        "jumlah" => $mergedData[$date]['jumlah'] += (int) $data['jumlah'],
                        "amount_hjp" => $mergedData[$date]['amount_hjp'] += (int) $data['amount_hjp'],
                        "fee_marketplace" => $mergedData[$date]['fee_marketplace'] += (int) $data['amount_hjp'] - (int) $data['amount_net'],
                        "amount_net" => $mergedData[$date]['amount_net'] += (int) $data['amount_net']
                    ];
                }
            }
        }                

        // $tokopedia = [
        //     'summaryByDateRange' => Tokopedia::getSummaryByDateRange($date_start, $date_end),
        //     'summaryTotal' => Tokopedia::getSummaryByDateRange($date_start, $date_end, $is_total=true),
        // ];
        if ($channel == null || $channel == TableUpload::TOKOPEDIA) {
            $summaryChannel = Tokopedia::getSummaryByDateRange($date_start, $date_end, $is_total=true);
            foreach (@$summaryChannel as $data) { $data = (array) $data;
                // total card
                if (!isset($mergedTotal['jumlah_transaksi'])) {
                    $mergedTotal = [
                        "jumlah_transaksi" => (int) $data['jumlah_transaksi'],
                        "jumlah" => (int) $data['quantity'],
                        "amount_hjp" => (int) $data['amount_hjp'],
                        "fee_marketplace" => (int) $data['fee_marketplace'],
                        "amount_net" => (int) $data['amount_net']
                    ];
                } else {                    
                    $mergedTotal['jumlah_transaksi'] += (int) $data['jumlah_transaksi'];
                    $mergedTotal['jumlah'] += (int) $data['quantity'];
                    $mergedTotal['amount_hjp'] += (int) $data['amount_hjp'];
                    $mergedTotal['fee_marketplace'] += (int) $data['fee_marketplace'];
                    $mergedTotal['amount_net'] += (int) $data['amount_net'];
                }

                $pieData[] = ['name' => 'Tokopedia', 'y' => (int) $data['amount_net']];
            }

            $summaryChannel = Tokopedia::getSummaryByDateRange($date_start, $date_end);
            foreach (@$summaryChannel as $data) { $data = (array) $data;

                // standarized key name
                $date = $data["tanggal"];
                if (!isset($mergedData[$date])) {
                    $mergedData[$date] = [
                        "waktu_pesanan_dibuat" => $date,
                        "jumlah_transaksi" => (int) $data['jumlah_transaksi'],
                        "jumlah" => (int) $data['quantity'],
                        "amount_hjp" => (int) $data['amount_hjp'],
                        "fee_marketplace" => (int) $data['fee_marketplace'],
                        "amount_net" => (int) $data['amount_net']
                    ];
                } else {
                    $mergedData[$date] = [
                        "waktu_pesanan_dibuat" => $date,
                        "jumlah_transaksi" => $mergedData[$date]['jumlah_transaksi'] += (int) $data['jumlah_transaksi'],
                        "jumlah" => $mergedData[$date]['jumlah'] += (int) $data['quantity'],
                        "amount_hjp" => $mergedData[$date]['amount_hjp'] += (int) $data['amount_hjp'],
                        "fee_marketplace" => $mergedData[$date]['fee_marketplace'] += (int) $data['fee_marketplace'],
                        "amount_net" => $mergedData[$date]['amount_net'] += (int) $data['amount_net']
                    ];
                }
            }  
        }

        // $tiktok = [
        //     'summaryByDateRange' => Tiktok::getSummaryByDateRange($date_start, $date_end),
        //     'summaryTotal' => Tiktok::getSummaryByDateRange($date_start, $date_end, $is_total=true),
        // ];
        if ($channel == null || $channel == TableUpload::TIKTOK) {
            $summaryChannel = Tiktok::getSummaryByDateRange($date_start, $date_end, $is_total=true);
            foreach (@$summaryChannel as $data) { $data = (array) $data; 
                // total card
                if (!isset($mergedTotal['jumlah_transaksi'])) {
                    $mergedTotal = [
                        "jumlah_transaksi" => (int) $data['jumlah_transaksi'],
                        "jumlah" => (int) $data['quantity'],
                        "amount_hjp" => (int) $data['amount_hjp'],
                        "fee_marketplace" => (int) $data['fee_marketplace'],
                        "amount_net" => (int) $data['total_settlement_amount']
                    ];
                } else {                    
                    $mergedTotal['jumlah_transaksi'] += (int) $data['jumlah_transaksi'];
                    $mergedTotal['jumlah'] += (int) $data['quantity'];
                    $mergedTotal['amount_hjp'] += (int) $data['amount_hjp'];
                    $mergedTotal['fee_marketplace'] += (int) $data['fee_marketplace'];
                    $mergedTotal['amount_net'] += (int) $data['total_settlement_amount'];                    
                }

                $pieData[] = ['name' => 'Tiktok', 'y' => (int) $data['total_settlement_amount']];
            }

            $summaryChannel = Tiktok::getSummaryByDateRange($date_start, $date_end);
            foreach (@$summaryChannel as $data) { $data = (array) $data;

                // standarized key name
                $date = $data["tanggal"];
                if (!isset($mergedData[$date])) {
                    $mergedData[$date] = [
                        "waktu_pesanan_dibuat" => $date,
                        "jumlah_transaksi" => (int) $data['jumlah_transaksi'],
                        "jumlah" => (int) $data['quantity'],
                        "amount_hjp" => (int) $data['amount_hjp'],
                        "fee_marketplace" => (int) $data['fee_marketplace'],
                        "amount_net" => (int) $data['total_settlement_amount']
                    ];
                } else {
                    $mergedData[$date] = [
                        "waktu_pesanan_dibuat" => $date,
                        "jumlah_transaksi" => $mergedData[$date]['jumlah_transaksi'] += (int) $data['jumlah_transaksi'],
                        "jumlah" => $mergedData[$date]['jumlah'] += (int) $data['quantity'],
                        "amount_hjp" => $mergedData[$date]['amount_hjp'] += (int) $data['amount_hjp'],
                        "fee_marketplace" => $mergedData[$date]['fee_marketplace'] += (int) $data['fee_marketplace'],
                        "amount_net" => $mergedData[$date]['amount_net'] += (int) $data['total_settlement_amount']
                    ];
                }
            }  
        }
        
        // echo '<pre>'; var_dump($mergedData); echo '</pre>'; die();
        // $lazada = [];
        if ($channel == null || $channel == TableUpload::LAZADA) {
            $summaryChannel = Lazada::getSummaryByDateRange($date_start, $date_end, $is_total=true);
            foreach (@$summaryChannel as $data) { $data = (array) $data; 
                // total card
                if (!isset($mergedTotal['jumlah_transaksi'])) {
                    $mergedTotal = [
                        "jumlah_transaksi" => (int) $data['jumlah_transaksi'],
                        "jumlah" => (int) $data['quantity'],
                        "amount_hjp" => (int) $data['amount_hjp'],
                        "fee_marketplace" => (int) $data['fee_marketplace'],
                        "amount_net" => (int) $data['amount_net']
                    ];
                } else {                    
                    $mergedTotal['jumlah_transaksi'] += (int) $data['jumlah_transaksi'];
                    $mergedTotal['jumlah'] += (int) $data['quantity'];
                    $mergedTotal['amount_hjp'] += (int) $data['amount_hjp'];
                    $mergedTotal['fee_marketplace'] += (int) $data['fee_marketplace'];
                    $mergedTotal['amount_net'] += (int) $data['amount_net'];                    
                }

                $pieData[] = ['name' => 'Lazada', 'y' => (int) $data['amount_net']];
            }

            $summaryChannel = Lazada::getSummaryByDateRange($date_start, $date_end);
            foreach (@$summaryChannel as $data) { $data = (array) $data;

                // standarized key name
                $date = $data["tanggal"];
                if (!isset($mergedData[$date])) {
                    $mergedData[$date] = [
                        "waktu_pesanan_dibuat" => $date,
                        "jumlah_transaksi" => (int) $data['jumlah_transaksi'],
                        "jumlah" => (int) $data['quantity'],
                        "amount_hjp" => (int) $data['amount_hjp'],
                        "fee_marketplace" => (int) $data['fee_marketplace'],
                        "amount_net" => (int) $data['amount_net']
                    ];
                } else {
                    $mergedData[$date] = [
                        "waktu_pesanan_dibuat" => $date,
                        "jumlah_transaksi" => $mergedData[$date]['jumlah_transaksi'] += (int) $data['jumlah_transaksi'],
                        "jumlah" => $mergedData[$date]['jumlah'] += (int) $data['quantity'],
                        "amount_hjp" => $mergedData[$date]['amount_hjp'] += (int) $data['amount_hjp'],
                        "fee_marketplace" => $mergedData[$date]['fee_marketplace'] += (int) $data['fee_marketplace'],
                        "amount_net" => $mergedData[$date]['amount_net'] += (int) $data['amount_net']
                    ];
                }
            }  
        }

        // $offline = [];
        if ($channel == null || $channel == TableUpload::OFFLINE) {
            $summaryChannel = OFFLINE::getSummaryByDateRange($date_start, $date_end, $is_total=true);
            foreach (@$summaryChannel as $data) { $data = (array) $data; 
                // total card
                if (!isset($mergedTotal['jumlah_transaksi'])) {
                    $mergedTotal = [
                        "jumlah_transaksi" => (int) $data['jumlah_transaksi'],
                        "jumlah" => (int) $data['quantity'],
                        "amount_hjp" => 0,
                        "fee_marketplace" => 0,
                        "amount_net" => (int) $data['amount_net']
                    ];
                } else {                    
                    $mergedTotal['jumlah_transaksi'] += (int) $data['jumlah_transaksi'];
                    $mergedTotal['jumlah'] += (int) $data['quantity'];
                    $mergedTotal['amount_hjp'] += 0;
                    $mergedTotal['fee_marketplace'] += 0;
                    $mergedTotal['amount_net'] += (int) $data['amount_net'];                    
                }

                $pieData[] = ['name' => 'Offline', 'y' => (int) $data['amount_net']];
            }

            $summaryChannel = OFFLINE::getSummaryByDateRange($date_start, $date_end);
            foreach (@$summaryChannel as $data) { $data = (array) $data;

                // standarized key name
                $date = $data["tanggal"];
                if (!isset($mergedData[$date])) {
                    $mergedData[$date] = [
                        "waktu_pesanan_dibuat" => $date,
                        "jumlah_transaksi" => (int) $data['jumlah_transaksi'],
                        "jumlah" => (int) $data['quantity'],
                        "amount_hjp" => 0,
                        "fee_marketplace" => 0,
                        "amount_net" => (int) $data['amount_net']
                    ];
                } else {
                    $mergedData[$date] = [
                        "waktu_pesanan_dibuat" => $date,
                        "jumlah_transaksi" => $mergedData[$date]['jumlah_transaksi'] += (int) $data['jumlah_transaksi'],
                        "jumlah" => $mergedData[$date]['jumlah'] += (int) $data['quantity'],
                        "amount_hjp" => $mergedData[$date]['amount_hjp'] += 0,
                        "fee_marketplace" => $mergedData[$date]['fee_marketplace'] += 0,
                        "amount_net" => $mergedData[$date]['amount_net'] += (int) $data['amount_net']
                    ];
                }
            }  
        }

        /** data chart */
        $dates = [];
        $jumlahTransaksi = [];
        $jumlah = [];
        $amountHjp = [];
        $amountNet = [];

        foreach ($mergedData as $date => $values) {
            $dates[] = StringHelper::trimDateToMonthToDay($date, ['15']);
            $jumlahTransaksi[] = $values['jumlah_transaksi'] ?? 0;
            $jumlah[] = $values['jumlah'] ?? 0;
            $amountHjp[] = $values['amount_hjp'] ?? 0;
            $amountNet[] = $values['amount_net'] ?? 0;
        }

        $dataChart = [
            'dates' => $dates,
            'jumlahTransaksi' => $jumlahTransaksi,
            'jumlah' => $jumlah,
            'amountHjp' => $amountHjp,
            'amountNet' => $amountNet
        ];

        $this->layout = 'main';
        return $this->render('index', [
            'periode' => $periode,
            'channel' => $channel,
            'summaryByDateRange' => $mergedData,
            'summaryTotal' => $mergedTotal,
            'dataChart' => $dataChart,
            'pieData' => $pieData
        ]);
    }


}
