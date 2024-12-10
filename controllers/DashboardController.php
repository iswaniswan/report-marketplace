<?php

namespace app\controllers;

use app\models\Lazada;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Shopee;
use app\models\ShopeeIncome;
use app\models\Tokopedia;
use app\models\Tiktok;
use app\models\Offline;
use app\models\TableUpload;

use app\utils\StringHelper;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DashboardController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'index-summary', 'export-excel'],
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

    public function actionIndexSummary($asExport=false)
    {
        $request = Yii::$app->request->get();
        
        /** temporary periode karena data kosong */
        $periode = $request[1]['periode'] ?? date('Y-m');   
        // $periode = $request[1]['periode'] ?? '2024-09';

        $date_start = date('Y-m-d', strtotime($periode. '-01'));
        $date_end = date('Y-m-t', strtotime($periode. '-01'));
        $channel = $request[1]['channel'] ?? [];

        // summary
        $mergedTotal = [];
        $mergedData = [];
        $summaryChannel = [];
        $footerMarketplace = [];

        // data pie chart
        // ['name' => 'Tokopedia', 'y' => array_sum($dataChart['jumlahTransaksi'])],
        $pieData = [];

        $allStatusPesanan = [];
        $allHjpPesanan = [];

        // $shopee = [
        //     'summaryByDateRange' => ShopeeIncome::getSummaryByDateRange($date_start, $date_end),
        //     'summaryTotal' => ShopeeIncome::getSummaryByDateRange($date_start, $date_end, $is_total=true)
        // ];
        $footerMarketplace[] = $this->getDataFooterMarketplace($date_start, $date_end, 'shopee');
        if ($channel == [] || in_array(TableUpload::SHOPEE, $channel)) {
            // $summaryChannel = ShopeeIncome::getSummaryByDateRange($date_start, $date_end, $is_total=true);
            $summaryChannel = Shopee::getSummaryByDateRange($date_start, $date_end, $is_total=true);
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
            

            // $summaryChannel = ShopeeIncome::getSummaryByDateRange($date_start, $date_end);
            $summaryChannel = Shopee::getSummaryByDateRange($date_start, $date_end);
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

            // status pesanan
            $countStatusPesanan = Shopee::getCountStatusPesanan($date_start, $date_end);
            foreach (@$countStatusPesanan as $statusPesanan) {
                $key = strtolower($statusPesanan['status_pesanan']); // Convert the key to lowercase
                if (isset($allStatusPesanan[$key])) {
                    $allStatusPesanan[$key] += (int)$statusPesanan['jumlah'];  
                } else {
                    $allStatusPesanan[$key] = (int)$statusPesanan['jumlah'];  
                }

                if (isset($allHjpPesanan[$key])) {
                    $allHjpPesanan[$key] += (int)$statusPesanan['amount_hjp'];
                } else {
                    $allHjpPesanan[$key] = (int)$statusPesanan['amount_hjp'];  
                }
            }
        }    

        // $tokopedia = [
        //     'summaryByDateRange' => Tokopedia::getSummaryByDateRange($date_start, $date_end),
        //     'summaryTotal' => Tokopedia::getSummaryByDateRange($date_start, $date_end, $is_total=true),
        // ];
        $footerMarketplace[] = $this->getDataFooterMarketplace($date_start, $date_end, 'tokopedia');
        if ($channel == [] || in_array(TableUpload::TOKOPEDIA, $channel)) {
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

            $countStatusPesanan = Tokopedia::getCountStatusPesanan($date_start, $date_end);
            foreach (@$countStatusPesanan as $statusPesanan) {
                $key = strtolower($statusPesanan['status_terakhir']); // Convert the key to lowercase
                if (isset($allStatusPesanan[$key])) {
                    $allStatusPesanan[$key] += (int)$statusPesanan['jumlah'];
                } else {
                    $allStatusPesanan[$key] = (int)$statusPesanan['jumlah'];
                }

                if (isset($allHjpPesanan[$key])) {
                    $allHjpPesanan[$key] += (int)$statusPesanan['amount_hjp'];
                } else {
                    $allHjpPesanan[$key] = (int)$statusPesanan['amount_hjp'];
                }
            }
        }

        // $tiktok = [
        //     'summaryByDateRange' => Tiktok::getSummaryByDateRange($date_start, $date_end),
        //     'summaryTotal' => Tiktok::getSummaryByDateRange($date_start, $date_end, $is_total=true),
        // ];
        $footerMarketplace[] = $this->getDataFooterMarketplace($date_start, $date_end, 'tiktok');
        if ($channel == [] || in_array(TableUpload::TIKTOK, $channel)) {
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

            $countStatusPesanan = Tiktok::getCountStatusPesanan($date_start, $date_end);
            foreach (@$countStatusPesanan as $statusPesanan) {
                $key = strtolower($statusPesanan['order_status']); // Convert the key to lowercase
                if (isset($allStatusPesanan[$key])) {
                    $allStatusPesanan[$key] += (int)$statusPesanan['jumlah'];
                } else {
                    $allStatusPesanan[$key] = (int)$statusPesanan['jumlah'];
                }

                if (isset($allHjpPesanan[$key])) {
                    $allHjpPesanan[$key] += (int)$statusPesanan['amount_hjp'];
                } else {
                    $allHjpPesanan[$key] = (int)$statusPesanan['amount_hjp'];
                }
            }
        }
        
        // echo '<pre>'; var_dump($mergedData); echo '</pre>'; die();
        // $lazada = [];
        $footerMarketplace[] = $this->getDataFooterMarketplace($date_start, $date_end, 'lazada');
        if ($channel == [] || in_array(TableUpload::LAZADA, $channel)) {
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
                        "fee_marketplace" => (int) abs($data['fee_marketplace']),
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

            $countStatusPesanan = Lazada::getCountStatusPesanan($date_start, $date_end);
            foreach (@$countStatusPesanan as $statusPesanan) {
                $key = strtolower($statusPesanan['status']); // Convert the key to lowercase
                if (isset($allStatusPesanan[$key])) {
                    $allStatusPesanan[$key] += (int)$statusPesanan['jumlah'];
                } else {
                    $allStatusPesanan[$key] = (int)$statusPesanan['jumlah'];
                }

                if (isset($allHjpPesanan[$key])) {
                    $allHjpPesanan[$key] += (int)$statusPesanan['amount_hjp'];
                } else {
                    $allHjpPesanan[$key] = (int)$statusPesanan['amount_hjp'];
                }
            }
        }

        // $offline = [];
        $footerMarketplace[] = $this->getDataFooterMarketplace($date_start, $date_end, 'offline');
        if ($channel == [] || in_array(TableUpload::OFFLINE, $channel)) {
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

        $allStatusPesanan = $this->mergeStatus($allStatusPesanan);
        $allHjpPesanan = $this->mergeStatus($allHjpPesanan);

        if ($asExport) {
            return [
                'periode' => $periode,
                'channel' => $channel,
                'summaryByDateRange' => $mergedData,
                'summaryTotal' => $mergedTotal,
                'dataChart' => $dataChart,
                'pieData' => $pieData,
                'footerMarketplace' => $footerMarketplace,
                'allStatusPesanan' => $allStatusPesanan,
                'allHjpPesanan' => $allHjpPesanan
            ];
        }

        $this->layout = 'main';
        return $this->render('index', [
            'periode' => $periode,
            'channel' => $channel,
            'summaryByDateRange' => $mergedData,
            'summaryTotal' => $mergedTotal,
            'dataChart' => $dataChart,
            'pieData' => $pieData,
            'footerMarketplace' => $footerMarketplace,
            'allStatusPesanan' => $allStatusPesanan,
            'allHjpPesanan' => $allHjpPesanan
        ]);
    }

    private function mergeStatus($array=[])
    {
        $groups = [
            "batal" => ["batal", "dibatalkan", "canceled"],
            "sedang dikirim" => ["sedang dikirim", 'shipped', 'to ship']
        ];
        
        // Initialize the result array
        $result = [];
        
        // Group and sum up the values
        foreach ($groups as $groupKey => $aliases) {
            $result[$groupKey] = 0; // Initialize group value
            foreach ($aliases as $alias) {
                if (isset($array[$alias])) {
                    $result[$groupKey] += $array[$alias];
                }
            }
        }

        return $result;
    }

    private function getDataFooterMarketplace($date_start, $date_end, $marketplace='')
    {
        switch (true) {
            case $marketplace == 'shopee': {
                $query = Shopee::getSummaryByDateRange($date_start, $date_end, $is_total=true);
                $data = (array) $query[0];
                return [
                    'shopee' => [
                        'jumlah_transaksi' => (int) $data['jumlah_transaksi'],
                        'jumlah' => (int) $data['jumlah'],
                        'amount_hjp' => (int) $data['amount_hjp'],
                        'fee_marketplace' => (int) $data['amount_hjp'] - (int) $data['amount_net'],
                        'amount_net' => (int) $data['amount_net'],
                    ]
                ];
                break;
            }

            case $marketplace == 'tokopedia': {
                $query = Tokopedia::getSummaryByDateRange($date_start, $date_end, $is_total=true);
                $data = (array) $query[0];
                return [
                    'tokopedia' => [
                        'jumlah_transaksi' => (int) $data['jumlah_transaksi'],
                        'jumlah' => (int) $data['quantity'],
                        'amount_hjp' => (int) $data['amount_hjp'],
                        'fee_marketplace' => (int) $data['fee_marketplace'],
                        'amount_net' => (int) $data['amount_net'],
                    ]
                ];
                break;
            }

            case $marketplace == 'tiktok': {
                $query = Tiktok::getSummaryByDateRange($date_start, $date_end, $is_total=true);
                $data = (array) $query[0];
                return [
                    'tiktok' => [
                        'jumlah_transaksi' => (int) $data['jumlah_transaksi'],
                        'jumlah' => (int) $data['quantity'],
                        'amount_hjp' => (int) $data['amount_hjp'],
                        'fee_marketplace' => (int) $data['fee_marketplace'],
                        'amount_net' => (int) $data['total_settlement_amount'],
                    ]
                ];
                break;
            }

            case $marketplace == 'lazada': {
                $query = Lazada::getSummaryByDateRange($date_start, $date_end, $is_total=true);
                $data = (array) $query[0];
                return [
                    'lazada' => [
                        'jumlah_transaksi' => (int) $data['jumlah_transaksi'],
                        'jumlah' => (int) $data['quantity'],
                        'amount_hjp' => (int) $data['amount_hjp'],
                        'fee_marketplace' => (int) $data['fee_marketplace'],
                        'amount_net' => (int) $data['amount_net'],
                    ]
                ];

                break;
            }

            case $marketplace == 'offline': {
                $query = OFFLINE::getSummaryByDateRange($date_start, $date_end, $is_total=true);
                $data = (array) $query[0];
                return [
                    'offline' => [
                        'jumlah_transaksi' => (int) $data['jumlah_transaksi'],
                        'jumlah' => (int) $data['quantity'],
                        'amount_hjp' => 0,
                        'fee_marketplace' => 0,
                        'amount_net' => (int) $data['amount_net'],
                    ]
                ];
                break;
            }

            default: 
            break;
        }
    }

    public function actionExportExcel($periode=null, $channel=null)
    {   
        $channel = json_decode($channel); 
        if ($periode == null) {
            $periode = date('Y-m');
        }

        $titleChart = 'Semua Channel';
        if (!empty($channel)) {
            $_titleChart = [];
            foreach ($channel as $key) {
                $_text = TableUpload::getListChannel()[$key];
                $_titleChart[] = ucwords($_text);
            }
            $titleChart = join(" & ", $_titleChart);
        }

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();


        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);

        $sheet->setCellValue('A1', 'Detail Per Month ('.$titleChart.')');
        $sheet->setCellValue('A3', 'Tanggal');
        $sheet->setCellValue('B3', 'Jumlah Transaksi');
        $sheet->setCellValue('C3', 'Qty');
        $sheet->setCellValue('D3', 'Amount HJP');
        $sheet->setCellValue('E3', 'Amount Net');
        $sheet->setCellValue('F3', 'Fee Marketplace');
        $sheet->setCellValue('G3', '%Fee Marketplace');

        $row = 3;
        $i=1;

        $_GET[1]['periode'] = $periode;
        $_GET[1]['channel'] = $channel;
        $query = $this->actionIndexSummary($asExport=true);
        $summaryByDateRange = $query['summaryByDateRange'];

        $grand_jumlah_transaksi = 0;
        $grand_jumlah = 0;
        $grand_amount_hjp = 0;
        $grand_amount_net = 0;
        $grand_fee_marketplace = 0;

        foreach($summaryByDateRange as $data){
            $result = (object) $data;
            $grand_jumlah_transaksi += $result->jumlah_transaksi;
            $grand_jumlah += $result->jumlah;
            $grand_amount_hjp += $result->amount_hjp;
            $grand_amount_net += $result->amount_net;
            $grand_fee_marketplace += $result->fee_marketplace;

            $row++;
            $sheet->setCellValue('A' . $row, date('d-m-Y', strtotime($result->waktu_pesanan_dibuat)));
            $sheet->setCellValue('B' . $row, $result->jumlah_transaksi);
            $sheet->setCellValue('C' . $row, $result->jumlah);
            $sheet->setCellValue('D' . $row, $result->amount_hjp);
            $sheet->setCellValue('E' . $row, $result->amount_net);
            $sheet->setCellValue('F' . $row, $result->fee_marketplace);

            $persenMarketplace = 0;
            if ((int) @$result->amount_hjp > 0) {
                $persenMarketplace = round($result->fee_marketplace/$result->amount_hjp * 100, 2);
            }

            $sheet->setCellValue('G' . $row, $persenMarketplace);

            $i++;
        }

        $row += 2;
        $sheet->setCellValue('A' . $row, 'Grand Total Per Marketplace - ' . date('F Y', strtotime($periode . '-01')));
        $row += 2;

        $sheet->setCellValue('A' . $row, 'Channel');
        $sheet->setCellValue('B' . $row, 'Jumlah Transaksi');
        $sheet->setCellValue('C' . $row, 'Qty');
        $sheet->setCellValue('D' . $row, 'Amount HJP');
        $sheet->setCellValue('E' . $row, 'Amount Net');
        $sheet->setCellValue('F' . $row, 'Fee Marketplace');
        $sheet->setCellValue('G' . $row, '%Fee Marketplace');

        $footerMarketplace = $query['footerMarketplace'];
        foreach($footerMarketplace as $object) {
            $addNewRow = true;

            foreach ($object as $key => $items) {
                // if (strtolower($key) == strtolower($titleChart)) { continue; }
                if (in_array(TableUpload::getListValue(strtolower($key)), @$channel)) { 
                    $addNewRow = false; 
                    continue; 
                }

                $sheet->setCellValue('A' . $row, ucwords($key));
                $sheet->setCellValue('B' . $row, $items['jumlah_transaksi']);
                $sheet->setCellValue('C' . $row, $items['jumlah']);
                $sheet->setCellValue('D' . $row, $items['amount_hjp']);
                $sheet->setCellValue('E' . $row, $items['amount_net']);
                $sheet->setCellValue('F' . $row, $items['fee_marketplace']);

                $persenFeeMarketplace = 0;
                if ($items['amount_hjp'] > 0) {
                    $persenFeeMarketplace = round($items['fee_marketplace']/$items['amount_hjp'] * 100, 2);
                } 
                $sheet->setCellValue('G' . $row, $persenFeeMarketplace);
            }

            if ($addNewRow) {
                $row++;
                $i++;
            }
        }

        $path = '../files/';
        $filename = date('YmdHis') . '- Summary ' . $periode;
        $filename = strtoupper($filename);
        $filename = $filename.'.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($path . $filename);
        return $this->redirect(['file/get', 'fileName' => $filename]);
    }

}
