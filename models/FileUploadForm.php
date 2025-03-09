<?php 

namespace app\models;

use app\utils\StringHelper;
use yii;
use yii\base\Model;
use yii\web\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use app\utils\StringHelper as UtilsStringHelper;


class FileUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;
    public $filePath;
    public $path;

    public $is_unmerge_cells;
    public $is_header_otomatis;
    public $is_proses_data;
    public $id_table;
    public $periode;
    public $year;
    public $month;

    public $id_file_source;

    protected $table_ginee = 'ginee';
    protected $table_shopee = 'shopee';
    protected $table_shopee_income = 'shopee_income';
    protected $table_tiktok = 'tiktok';
    protected $table_tiktok_income = 'tiktok_income';
    protected $table_tokopedia = 'tokopedia';
    protected $table_tokopedia_keuangan = 'tokopedia_keuangan';
    protected $table_lazada = 'lazada';
    protected $table_lazada_income = 'lazada_income';

    private $tiktokColumnsNumeric = [
        'quantity', 'sku_quantity_ofreturn', 'sku_unit_original_price', 'sku_subtotal_before_discount',
        'sku_platform_discount', 'sku_seller_discount', 'sku_subtotal_after_discount', 'shipping_fee_after_discount',
        'original_shipping_fee', 'shipping_fee_seller_discount', 'shipping_fee_platform_discount', 'payment_platform_discount',
        'buyer_service_fee', 'taxes', 'order_amount', 'order_refund_amount'
    ];

    private $tiktokIncomeColumnsNumeric = [
        'total_settlement_amount', 'total_revenue', 'subtotal_after_seller_discounts', 'subtotal_before_discounts', 'seller_discounts',
        'refund_subtotal_after_seller_discounts', 'refund_subtotal_before_seller_discounts', 'refund_of_seller_discounts', 'total_fees',
        'tiktok_shop_commission_fee', 'flat_fee', 'sales_fee', 'mall_service_fee', 'payment_fee', 'shipping_cost', 'shipping_costs_passed_on_to_the_logistics_provider',
        'shipping_cost_borne_by_the_platform', 'shipping_cost_paid_by_the_customer', 'refunded_shipping_cost_paid_by_the_customer', 'return_shipping_costs_passed_on_to_the_customer',
        'shipping_cost_subsidy', 'affiliate_commission', 'affiliate_partner_commission', 'affiliate_shop_ads_commission', 'sfp_service_fee', 
        'live_specials_service_fee', 'bonus_cashback_service_fee', 'ajustment_amount', 'customer_payment', 'customer_refund', 'seller_co_funded_voucher_discount',
        'refund_of_seller_co_funded_voucher_discount', 'platform_discounts', 'refund_of_platform_discounts', 'platform_co_funded_voucher_discounts', 'refund_of_platform_co_funded_voucher_discounts',
        'seller_shipping_cost_discount', 'estimated_package_weight_g', 'actual_package_weight_g'
    ];

    private $tokopediaColumnsVarchar = [
        'nomor_invoice', 'tanggal_pembayaran', 'status_terakhir', 'tanggal_pesanan_selesai', 'waktu_pesanan_selesai', 'tanggal_pesanan_dibatalkan',
        'waktu_pesanan_dibatalkan', 'nama_produk', 'tipe_produk', 'nomor_sku', 'jenis_kupon_toko_terpakai', 'kode_kupon_toko_yang_digunakan', 
        'biaya_pengiriman_tunai_idr', 'biaya_asuransi_pengiriman_idr', 'total_biaya_pengiriman_idr',
        'nama_pembeli', 'no_telp_pembeli', 'nama_penerima', 'no_telp_penerima', 'alamat_pengiriman', 'kota', 'provinsi', 'nama_kurir','tipe_pengiriman_regular_same_day_etc',
        'no_resi__kode_booking', 'tanggal_pengiriman_barang', 'waktu_pengiriman_barang', 'gudang_pengiriman',
        'nama_campaign', 'nama_bundling', 'tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt',
        'cod', 'jumlah_produk_yang_dikurangkan', 'total_pengurangan_idr','nama_penawaran_terpakai',
        'tingkatan_promosi_terpakai','diskon_penawaran_terpakai_idr'
    ];

    private $tokopediaColumnsNumeric = [
        'nomor', 'jumlah_produk_dibeli', 'harga_awal_idr', 'harga_satuan_bundling_idr', 'diskon_produk_idr', 'harga_jual_idr', 'jumlah_subsidi_tokopedia_idr',
        'nilai_kupon_toko_terpakai_idr', 'total_penjualan_idr'
    ];

    private $tokopediaKeuanganColumnsVarchar = [
        'nomor_invoice', 'tanggal_pembayaran', 'status_terakhir', 'tanggal_pesanan_selesai', 'waktu_pesanan_selesai',
        'tanggal_pesanan_dibatalkan', 'waktu_pesanan_dibatalkan', 'nama_produk', 'jenis_kupon_toko_terpakai', 
        'kode_kupon_toko_yang_digunakan', 'nama_biaya_layanan', 'persentase_biaya_layanan',

    ];

    private $tokopediaKeuanganColumnsNumeric = [
        'nomor', 'jumlah_produk_dibeli', 'harga_jual_idr', 'jumlah_subsidi_tokopedia_idr', 'nilai_kupon_toko_terpakai_idr',
        'jumlah_produk_yang_dikurangkan', 'total_pengurangan_idr', 'biaya_layanan_termasuk_ppn_dan_pph_idr', 
        'biaya_layanan_di_luar_ppn_dan_pph_idr', 'ppn_idr', 'pph_idr'
    ];

    private $lazadaColumnsNumeric = [
        'paid_price', 'unit_price', 'seller_discount_total', 'shipping_fee', 'wallet_credit', 'bundle_discount', 'refund_amount'
    ];

    private $lazadaIncomeColumnsNumeric = [
    'amount_include_tax', 'vat_amount', 'wht_amount'
    ];

    private $shopeeIncomeColumnsNumeric = [       
        'no', 'harga_asli_produk', 'total_diskon_produk', 'jumlah_pengembalian_dana_ke_pembeli', 'diskon_produk_dari_shopee', 'diskon_voucher_ditanggung_penjual', 'cashback_koin_yang_ditanggung_penjual', 'ongkir_dibayar_pembeli', 'diskon_ongkir_ditanggung_jasa_kirim',
        'gratis_ongkir_dari_shopee', 'ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim', 'ongkos_kirim_pengembalian_barang', 'pengembalian_biaya_kirim', 'biaya_komisi_ams', 'biaya_administrasi_termasuk_ppn_11', 'biaya_layanan_termasuk_ppn_11', 'premi', 'biaya_program',
        'biaya_kartu_kredit', 'biaya_kampanye', 'bea_masuk_ppn_pph', 'total_penghasilan', 'kompensasi', 'promo_gratis_ongkir_dari_penjual',
        'pengembalian_dana_ke_pembeli', 'pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang', 'pro_rata_voucher_shopee_untuk_pengembalian_barang',
        'pro_rated_bank_payment_channel_promotion_for_return_refund_items', 'pro_rated_shopee_payment_channel_promotion_for_return_refund_ite'
    ];

    protected $allColumnTiktok = [
        "id","id_file_source","order_id","order_status","order_substatus","cancelation_return_type","normal_or_pre_order","sku_id","seller_sku","product_name","variation","quantity","sku_quantity_of_return","sku_unit_original_price","sku_subtotal_before_discount","sku_platform_discount","sku_seller_discount","sku_subtotal_after_discount","shipping_fee_after_discount","original_shipping_fee","shipping_fee_seller_discount","shipping_fee_platform_discount","payment_platform_discount","buyer_service_fee","taxes","order_amount","order_refund_amount","created_time","paid_time","rts_time","shipped_time","delivered_time","cancelled_time","cancel_by","cancel_reason","fulfillment_type","warehouse_name","tracking_id","delivery_option","shipping_provider_name","buyer_message","buyer_username","recipient","phone","zipcode","country","province","regency_and_city","districts","villages","detail_address","additional_address_information","payment_method","weight_kg","product_category","package_id","seller_note","checked_status","checked_marked_by","order_adjustment_id","`type`","order_created_time_utc","order_settled_time_utc","currency","total_settlement_amount","total_revenue","subtotal_after_seller_discounts","subtotal_before_discounts","seller_discounts","refund_subtotal_after_seller_discounts","refund_subtotal_before_seller_discounts","refund_of_seller_discounts","total_fees","tiktok_shop_commission_fee","flat_fee","sales_fee","mall_service_fee","payment_fee","shipping_cost","shipping_costs_passed_on_to_the_logistics_provider","shipping_cost_borne_by_the_platform","shipping_cost_paid_by_the_customer","refunded_shipping_cost_paid_by_the_customer","return_shipping_costs_passed_on_to_the_customer","shipping_cost_subsidy","affiliate_commission","affiliate_partner_commission","affiliate_shop_ads_commission","sfp_service_fee","live_specials_service_fee","bonus_cashback_service_fee","ajustment_amount","related_order_id","`_`","customer_payment","customer_refund","seller_co_funded_voucher_discount","refund_of_seller_co_funded_voucher_discount","platform_discounts","refund_of_platform_discounts","platform_co_funded_voucher_discounts","refund_of_platform_co_funded_voucher_discounts","seller_shipping_cost_discount","estimated_package_weight_g","actual_package_weight_g","shopping_center_items"
    ];

    protected $allColumnTiktokIncome = [
        "id","id_file_source","order_adjustment_id","`type`","order_created_time_utc","order_settled_time_utc","currency","total_settlement_amount","total_revenue","subtotal_after_seller_discounts","subtotal_before_discounts","seller_discounts","refund_subtotal_after_seller_discounts","refund_subtotal_before_seller_discounts","refund_of_seller_discounts","total_fees","tiktok_shop_commission_fee","flat_fee","sales_fee","mall_service_fee","payment_fee","shipping_cost","shipping_costs_passed_on_to_the_logistics_provider","shipping_cost_borne_by_the_platform","shipping_cost_paid_by_the_customer","refunded_shipping_cost_paid_by_the_customer","return_shipping_costs_passed_on_to_the_customer","shipping_cost_subsidy","affiliate_commission","affiliate_partner_commission","affiliate_shop_ads_commission","sfp_service_fee","live_specials_service_fee","bonus_cashback_service_fee","ajustment_amount","related_order_id","`#`","customer_payment","customer_refund","seller_co_funded_voucher_discount","refund_of_seller_co_funded_voucher_discount","platform_discounts","refund_of_platform_discounts","platform_co_funded_voucher_discounts","refund_of_platform_co_funded_voucher_discounts","seller_shipping_cost_discount","estimated_package_weight_g","actual_package_weight_g","shopping_center_items"
    ];

    protected $allColumnLazada = [
        "id","id_file_source","order_item_id","order_type","guarantee","delivery_type","lazada_id","seller_sku","lazada_sku","ware_house","create_time","update_time","rts_sla","tts_sla","order_number","invoice_required","invoice_number","delivered_date","customer_name","customer_email","national_registration_number","shipping_name","shipping_address","shipping_address2","shipping_address3","shipping_address4","shipping_address5","shipping_phone","shipping_phone2","shipping_city","shipping_post_code","shipping_country","shipping_region","billing_name","billing_addr","billing_addr2","billing_addr3","billing_addr4","billing_addr5","billing_phone","billing_phone2","billing_city","billing_post_code","billing_country","tax_code","branch_number","tax_invoice_requested","pay_method","paid_price","unit_price","seller_discount_total","shipping_fee","wallet_credit","item_name","variation","cd_shipping_provider","shipping_provider","shipment_type_name","shipping_provider_type","cd_tracking_code","tracking_code","tracking_url","shipping_provider_fm","tracking_code_fm","tracking_url_fm","promised_shipping_time","premium","status","buyer_failed_delivery_return_initiator","buyer_failed_delivery_reason","buyer_failed_delivery_detail","buyer_failed_delivery_user_name","bundle_id","semi_managed","flexible_delivery_time","bundle_discount","refund_amount","seller_note"
    ];

    protected $allColumnLazadaIncome = [
        "id","id_file_source","statement_period","statement_number","transaction_date","fee_name","amount_include_tax","vat_amount","release_status","release_date","comment","order_creation_date","order_number","order_line_id","seller_sku","lazada_sku","wht_amount","wht_included_in_amount","order_status","product_name"
    ];

    protected $allColumnShopee = [
        "id","id_file_source","no_pesanan","status_pesanan","alasan_pembatalan","status_pembatalan_pengembalian","no_resi","opsi_pengiriman","antar_ke_counter_pick_up","pesanan_harus_dikirimkan_sebelum_menghindari_keterlambatan","waktu_pengiriman_diatur","waktu_pesanan_dibuat","waktu_pembayaran_dilakukan","metode_pembayaran","sku_induk","nama_produk","nomor_referensi_sku","nama_variasi","harga_awal","harga_setelah_diskon","jumlah","returned_quantity","total_harga_produk","total_diskon","diskon_dari_penjual","diskon_dari_shopee","berat_produk","jumlah_produk_di_pesan","total_berat","voucher_ditanggung_penjual","cashback_koin","voucher_ditanggung_shopee","paket_diskon","paket_diskon_diskon_dari_shopee","paket_diskon_diskon_dari_penjual","potongan_koin_shopee","diskon_kartu_kredit","ongkos_kirim_dibayar_oleh_pembeli","estimasi_potongan_biaya_pengiriman","ongkos_kirim_pengembalian_barang","total_pembayaran","perkiraan_ongkos_kirim","catatan_dari_pembeli","catatan","username_pembeli","nama_penerima","no_telepon","alamat_pengiriman","kota_kabupaten","provinsi","waktu_pesanan_selesai"
    ];

    protected $allColumnShopeeIncome = [
        "id","id_file_source","no","no_pesanan","no_pengajuan","username_pembeli","waktu_pesanan_dibuat","metode_pembayaran_pembeli","tanggal_dana_dilepaskan","harga_asli_produk","total_diskon_produk","jumlah_pengembalian_dana_ke_pembeli","diskon_produk_dari_shopee","diskon_voucher_ditanggung_penjual","cashback_koin_yang_ditanggung_penjual","ongkir_dibayar_pembeli","diskon_ongkir_ditanggung_jasa_kirim","gratis_ongkir_dari_shopee","ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim","ongkos_kirim_pengembalian_barang","pengembalian_biaya_kirim","biaya_komisi_ams","biaya_administrasi_termasuk_ppn_11","biaya_layanan_termasuk_ppn_11","premi","biaya_program","biaya_kartu_kredit","biaya_kampanye","bea_masuk_ppn_pph","total_penghasilan","kode_voucher","kompensasi","promo_gratis_ongkir_dari_penjual","jasa_kirim","nama_kurir","`#`","pengembalian_dana_ke_pembeli","pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang","pro_rata_voucher_shopee_untuk_pengembalian_barang","pro_rated_bank_payment_channel_promotion_for_return_refund_items","pro_rated_shopee_payment_channel_promotion_for_return_refund_ite"
    ];

    protected $allColumnTokopedia = [
        "id","id_file_source","nomor","nomor_invoice","tanggal_pembayaran","status_terakhir","tanggal_pesanan_selesai","waktu_pesanan_selesai","tanggal_pesanan_dibatalkan","waktu_pesanan_dibatalkan","nama_produk","tipe_produk","nomor_sku","catatan_produk_pembeli","catatan_produk_penjual","jumlah_produk_dibeli","harga_awal_idr","harga_satuan_bundling_idr","diskon_produk_idr","harga_jual_idr","jumlah_subsidi_tokopedia_idr","nilai_kupon_toko_terpakai_idr","jenis_kupon_toko_terpakai","kode_kupon_toko_yang_digunakan","biaya_pengiriman_tunai_idr","biaya_asuransi_pengiriman_idr","total_biaya_pengiriman_idr","total_penjualan_idr","nama_pembeli","no_telp_pembeli","nama_penerima","no_telp_penerima","alamat_pengiriman","kota","provinsi","nama_kurir","tipe_pengiriman_regular_same_day_etc","no_resi_kode_booking","tanggal_pengiriman_barang","waktu_pengiriman_barang","gudang_pengiriman","nama_campaign","nama_bundling","tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt","cod","jumlah_produk_yang_dikurangkan","total_pengurangan_idr","nama_penawaran_terpakai","tingkatan_promosi_terpakai","diskon_penawaran_terpakai_idr"
    ];

    protected $allColumnTokopediaKeuangan = [
        "id","id_file_source","nomor","nomor_invoice","tanggal_pembayaran","status_terakhir","tanggal_pesanan_selesai","waktu_pesanan_selesai","tanggal_pesanan_dibatalkan","waktu_pesanan_dibatalkan","nama_produk","jumlah_produk_dibeli","harga_jual_idr","jumlah_subsidi_tokopedia_idr","nilai_kupon_toko_terpakai_idr","jenis_kupon_toko_terpakai","kode_kupon_toko_yang_digunakan","jumlah_produk_yang_dikurangkan","total_pengurangan_idr","nama_biaya_layanan","persentase_biaya_layanan","biaya_layanan_termasuk_ppn_dan_pph_idr","biaya_layanan_di_luar_ppn_dan_pph_idr","ppn_idr","pph_idr"
    ];

    private $emptyColumnCount = 0;

    public function rules()
    {
        return [
            [['is_proses_data', 'is_unmerge_cells', 'is_header_otomatis', 'id_table', 'periode', 'year', 'month', 'id_file_source'], 'safe'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx', 'checkExtensionByMimeType' => false, 'maxSize' => 50 * 1024 * 1024],
        ];
    }

    public function upload()
    {
        // $filePath = Yii::getAlias('@app').'/web/uploads/' . $this->file->baseName . '.' . $this->file->extension;
        // $this->filePath = $filePath;

        $filePath = Yii::getAlias('@app').'/web/uploads/' . $this->getCodeName() . '.' . $this->file->extension;
        $this->filePath = $filePath;

        $this->path = '/web/uploads/' . $this->getCodeName() . '.' . $this->file->extension;
        
        $isDeleteInsert = false;
        // Check if the file already exists and delete it
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the existing file

            // delete the existing data from table
            $isDeleteInsert = true;            
        }
        
        if ($this->validate()) {
            $this->file->saveAs($this->filePath);
            
            if ($this->id_table != null && (int) $this->id_table > 0 && $this->id_file_source != null && (int) $this->id_file_source > 0) {
                switch ($this->id_table) {
                    case TableUpload::GINEE: {
                        $this->importToGinee($isDeleteInsert);
                        break;
                    }

                    case TableUpload::SHOPEE: {
                        $this->importToShopee($isDeleteInsert);
                        break;
                    }

                    case TableUpload::SHOPEE_INCOME: {
                        $this->importToShopeeIncome($isDeleteInsert);
                        break;
                    }

                    case TableUpload::TIKTOK: {
                        $this->importToTiktok($isDeleteInsert);
                        break;
                    }

                    case TableUpload::TIKTOK_INCOME: {
                        $this->importToTiktokIncome($isDeleteInsert);
                        break;
                    }

                    case TableUpload::TOKOPEDIA: {
                        $this->importToTokopedia($isDeleteInsert);
                        break;
                    }

                    case TableUpload::LAZADA: {
                        $this->importToLazada($isDeleteInsert);
                        break;
                    }

                    case TableUpload::LAZADA_INCOME: {
                        $this->importToLazadaIncome($isDeleteInsert);
                        break;
                    }

                    default: break;
                }
            }

            return true;
        } else {
            // Yii::error('Failed to save file to path: ' . $this->filePath);
            var_dump($this->file->extension).PHP_EOL;
            var_dump($this->errors);
            die('Failed to save file to path: ' . $this->filePath);
            return false;
        }
    }

    public function deleteFile($fileName, $codeName)
    {        
        $filePath = 'uploads/' . $fileName;
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        
        $filePath = 'uploads/' . $codeName . '.xlsx';        
        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return true;
    }

    public function deleteTable($id, $id_table)
    {
        $isDeleted = false;

        switch ($id_table) {
            case TableUpload::GINEE: {
                $model = Ginee::deleteAll(['id_file_source' => $id]);
                $isDeleted = true;
                break;
            }

            case TableUpload::SHOPEE: {
                $model = Shopee::deleteAll(['id_file_source' => $id]);
                $isDeleted = true;
                break;
            }

            case TableUpload::SHOPEE_INCOME: {
                $model = ShopeeIncome::deleteAll(['id_file_source' => $id]);
                $isDeleted = true;
                break;
            }

            case TableUpload::TIKTOK: {
                $model = Tiktok::deleteAll(['id_file_source' => $id]);
                $isDeleted = true;
                break;
            }

            case TableUpload::TIKTOK_INCOME: {
                $model = TiktokIncome::deleteAll(['id_file_source' => $id]);
                $isDeleted = true;
                break;
            }

            case TableUpload::TOKOPEDIA: {
                $model = Tokopedia::deleteAll(['id_file_source' => $id]);
                $isDeleted = true;
                break;
            }

            case TableUpload::LAZADA: {
                $model = Lazada::deleteAll(['id_file_source' => $id]);
                $isDeleted = true;
                break;
            }

            case TableUpload::LAZADA_INCOME: {
                $model = LazadaIncome::deleteAll(['id_file_source' => $id]);
                $isDeleted = true;
                break;
            }
            default: break;
        }

        return $isDeleted;
    }

    public function importToGinee($isDeleteInsert=false)
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $this->unmergeCells($spreadsheet, $this->filePath);
    
        $header = [];
        $data = [];

        // init id_table
        if ($this->id_file_source == null) { 
            Yii::error('Error ID File Source !!!'); die();
        }
        
        if ($isDeleteInsert) {
            // delete existing data from table ginee
            Ginee::deleteAll([
                'id_file_source' => $this->id_file_source
            ]);
        }
    
        // Read the header row
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                // Standardize header values using a utility function if needed
                $header[] = StringHelper::sanitizeColumnName($cell->getValue());
            }
        }
            
        $header[] = 'id_file_source';

        // Maximum number of rows to insert per batch
        $batchSize = 1000;

        // Read the data rows
        foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
    
            foreach ($cellIterator as $cell) {                
                $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value                
                $value = StringHelper::sanitizeValue($cell->getValue());
                $rowData[$headerValue] = $value;
                $columnIndex++;
            }
    
            $rowData['id_file_source'] = $this->id_file_source;
            if (!empty($rowData)) {
                $data[] = $rowData; // Store the row data
            }

            // echo '<pre>'; var_dump($header);
            // echo '<pre>'; var_dump($rowData); echo '</pre>'; die();
    
            // Insert in batches of 1000 rows
            if (count($data) >= $batchSize) {
                // echo '<pre>'; var_dump($data); echo '</pre>'; die();
                // $this->insertOrUpdateBatch($header, $data);
                $this->insertIgnoreBatch($header, $data);
                $data = []; // Clear the data array after each batch insert
            }
        }        
    
        // Insert any remaining data that didn't complete a full batch
        if (!empty($data)) {
            // $this->insertOrUpdateBatch($header, $data);
            $this->insertIgnoreBatch($header, $data);
        }
    }
    

    public function unmergeCells($spreadsheet, $filePath, $sheetIndex=0)
    {        
        if ($sheetIndex > 0) {
            $spreadsheet->setActiveSheetIndex($sheetIndex);
        }
        $worksheet = $spreadsheet->getActiveSheet();
        // Get all merged cell ranges in the sheet
        $mergedCells = $worksheet->getMergeCells();
        
        if (!empty($mergedCells)) {
            // Loop through each merged cell range
            foreach ($mergedCells as $mergedRange) {
                // Unmerge the cells
                $worksheet->unmergeCells($mergedRange);
                // Get the starting cell of the merged range
                $startCell = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::extractAllCellReferencesInRange($mergedRange)[0];
                $value = $worksheet->getCell($startCell)->getValue();
                if ($worksheet->getCell($startCell)->isFormula()) {
                    // $value = $worksheet->getCell($startCell)->getCalculatedValue();
                    $value = '';
                }
    
                // Fill all cells in the range with the original merged value
                $cellsInRange = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::extractAllCellReferencesInRange($mergedRange);
                foreach ($cellsInRange as $cell) {
                    $worksheet->setCellValue($cell, $value);
                }
            }
    
            // Save the unmerged spreadsheet to a new file
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filePath);
        }

        // reload after saved
        // $spreadsheet = IOFactory::load($filePath);
        // $worksheet = $spreadsheet->getActiveSheet();
        return $worksheet;
    }

        /**
     * Function to insert or update batch of data.
     * 
     * @param array $header Column names
     * @param array $data Data to insert
     */
    private function insertOrUpdateBatch($header, $data)
    {
        $db = Yii::$app->db;
        $sql = $db->queryBuilder->batchInsert($this->table_ginee, $header, $data);
        $sql .= ' ON DUPLICATE KEY UPDATE ';

        // Append update part of the SQL query
        $updates = [];
        foreach ($header as $column) {
            $updates[] = "$column = VALUES($column)";
        }
        $sql .= implode(', ', $updates);

        $db->createCommand($sql)->execute();
    }

    private function insertIgnoreBatch($header, $data, $tableName=null)
    {
        /** default table ginee */
        if ($tableName == null) {
            $tableName = $this->table_ginee;
        }

        $db = Yii::$app->db;
        $batchSize = 1000; // Maximum batch size

        foreach (array_chunk($data, $batchSize) as $batch) {
            // Build the base SQL for batch insert using INSERT IGNORE
            $sql = 'INSERT IGNORE INTO ' . $tableName . ' (' . implode(', ', $header) . ') VALUES ';

            // Build the values part of the SQL query
            $valuePlaceholders = [];
            $params = [];
            foreach ($batch as $row) {
                $placeholders = [];
                foreach ($row as $value) {
                    $placeholder = ':param' . count($params); // Create a unique placeholder
                    $placeholders[] = $placeholder;
                    $params[$placeholder] = $value;
                }
                $valuePlaceholders[] = '(' . implode(', ', $placeholders) . ')';
            }

            $sql .= implode(', ', $valuePlaceholders);

            // Execute the command
            try {
                // $command = $db->createCommand($sql, $params);
                // var_dump($command->getRawSql()); die();  // Outputs the raw SQL query
                // $command->execute();
                $db->createCommand($sql, $params)->execute();
            } catch (\yii\db\Exception $e) {
                Yii::error('Error inserting batch: ' . $e->getMessage());
            }
        }
    }


    public function readData($filePath)
    {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        if ($this->is_unmerge_cells) {
            // Get all merged cell ranges in the sheet
            $mergedCells = $worksheet->getMergeCells();

            // Loop through each merged cell range
            foreach ($mergedCells as $mergedRange) {
                // Unmerge the cells
                $worksheet->unmergeCells($mergedRange);

                // Get the starting cell of the merged range
                $startCell = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::extractAllCellReferencesInRange($mergedRange)[0];
                $value = $worksheet->getCell($startCell)->getValue();

                // Fill all cells in the range with the original merged value
                $cellsInRange = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::extractAllCellReferencesInRange($mergedRange);
                foreach ($cellsInRange as $cell) {
                    $worksheet->setCellValue($cell, $value);
                }
            }

            // Save the unmerged spreadsheet to a new file
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filePath);

            // reload after saved
            // $spreadsheet = IOFactory::load($filePath);
            // $worksheet = $spreadsheet->getActiveSheet();
        }

        // $header = [];
        // $data = [];

        // // Read the header row
        // foreach ($worksheet->getRowIterator(1, 1) as $row) {
        //     $cellIterator = $row->getCellIterator();
        //     $cellIterator->setIterateOnlyExistingCells(false);
        //     foreach ($cellIterator as $cell) {
        //         $header[] = $cell->getValue(); // Store header values
        //     }
        // }

        // // echo '<pre>'; var_dump($header); echo '</pre>'; 

        // // Read the data rows
        // foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
        //     $rowData = [];
        //     $cellIterator = $row->getCellIterator();
        //     $cellIterator->setIterateOnlyExistingCells(false);
        //     $columnIndex = 0;
        //     foreach ($cellIterator as $cell) {
        //         $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value
        //         $rowData[$headerValue] = $cell->getValue(); // Map data to header
        //         $columnIndex++;
        //     }
        //     $data[] = $rowData; // Store the row data
        // }

    }

    public function getYear()
    {
        if ($this->year == null && $this->periode != null) {
            $this->year = explode('-', $this->periode)[0];
        }
        return $this->year;
    }

    public function getMonth()
    {
        if ($this->month == null && $this->periode != null) {
            $this->month = explode('-', $this->periode)[1];
        }
        return $this->month;
    }

    public function getTableUploadName()
    {
        return TableUpload::getList()[$this->id_table] ?? null;
    }

    public function getCodeName()
    {
        $tableName = $this->getTableUploadName();

        return $tableName . $this->getYear() . $this->getMonth();
    }

    public function importToShopee($isDeleteInsert=false)
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $this->unmergeCells($spreadsheet, $this->filePath);
    
        $header = [];
        $data = [];

        // init id_table
        if ($this->id_file_source == null) { 
            Yii::error('Error ID File Source !!!'); die();
        }
        
        if ($isDeleteInsert) {
            // delete existing data from table ginee
            Shopee::deleteAll([
                'id_file_source' => $this->id_file_source
            ]);
        }

        // sterilize column according to table column name
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
        
            $columnIndex = 1; // Start from the first column
            while ($columnIndex <= \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($worksheet->getHighestColumn())) {
                $cell = $worksheet->getCellByColumnAndRow($columnIndex, 1);
                $headerValue = StringHelper::sanitizeColumnName($cell->getValue());

                if (!in_array($headerValue, $this->allColumnShopee)) {
                    // Remove the column if it's not in the allowed list
                    $worksheet->removeColumnByIndex($columnIndex);
                    // Skip incrementing columnIndex to re-check the new column at the same position
                    continue;
                }

                $columnIndex++; // Increment only if the column is kept
            }
        }  
    
        // Read the header row
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                // Standardize header values using a utility function if needed
                $header[] = StringHelper::sanitizeColumnName($cell->getValue());
            }
        }
            
        $header[] = 'id_file_source';

        // Maximum number of rows to insert per batch
        $batchSize = 1000;

        // Read the data rows
        foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
    
            foreach ($cellIterator as $cell) {                
                $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value                
                $value = StringHelper::sanitizeValue($cell->getValue());
                $rowData[$headerValue] = $value;
                $columnIndex++;
            }
    
            $rowData['id_file_source'] = $this->id_file_source;
            if (!empty($rowData)) {
                $data[] = $rowData; // Store the row data
            }

            // echo '<pre>'; var_dump($header);
            // echo '<pre>'; var_dump($rowData); echo '</pre>'; die();
    
            // Insert in batches of 1000 rows
            if (count($data) >= $batchSize) {
                // echo '<pre>'; var_dump($data); echo '</pre>'; die();
                // $this->insertOrUpdateBatch($header, $data);
                $this->insertIgnoreBatch($header, $data, $this->table_shopee);
                $data = []; // Clear the data array after each batch insert
            }
        }        
    
        // Insert any remaining data that didn't complete a full batch
        if (!empty($data)) {
            // $this->insertOrUpdateBatch($header, $data);
            $this->insertIgnoreBatch($header, $data, $this->table_shopee);
        }
    }

    public function importToTiktok($isDeleteInsert=false)
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $this->unmergeCells($spreadsheet, $this->filePath);
    
        $header = [];
        $data = [];

        // init id_table
        if ($this->id_file_source == null) { 
            Yii::error('Error ID File Source !!!'); die();
        }
        
        if ($isDeleteInsert) {
            // delete existing data from table ginee
            Tiktok::deleteAll([
                'id_file_source' => $this->id_file_source
            ]);
        }
    
        // sterilize column according to table column name
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
        
            $columnIndex = 1; // Start from the first column
            while ($columnIndex <= \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($worksheet->getHighestColumn())) {
                $cell = $worksheet->getCellByColumnAndRow($columnIndex, 1);
                $headerValue = StringHelper::sanitizeColumnName($cell->getValue());

                if (!in_array($headerValue, $this->allColumnTiktok)) {
                    // Remove the column if it's not in the allowed list
                    $worksheet->removeColumnByIndex($columnIndex);
                    // Skip incrementing columnIndex to re-check the new column at the same position
                    continue;
                }

                $columnIndex++; // Increment only if the column is kept
            }
        }        

        // Read the header row
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                // Standardize header values using a utility function if needed
                $headerValue = StringHelper::sanitizeColumnName($cell->getValue());
                $header[] = $headerValue;
            }
        }
            
        $header[] = 'id_file_source';

        // Maximum number of rows to insert per batch
        $batchSize = 1000;

        // Read the data rows        
        foreach ($worksheet->getRowIterator(3) as $row) { // 
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
    
            foreach ($cellIterator as $cell) {           
                // Ensure that the $header matches the current column
                if (!isset($header[$columnIndex])) {
                    $columnIndex++;
                    continue; // Skip columns that do not have a corresponding header
                }     

                $headerValue = $header[$columnIndex]; // Map header to column
                $value = StringHelper::sanitizeValue($cell->getValue());
                
                if (in_array($headerValue, $this->tiktokColumnsNumeric)) {
                    // var_dump($value);
                    $value = str_replace('.', '', $value);
                    $value = str_replace('IDR', '', $value);
                    $value = StringHelper::sanitizeValue($value);                    
                    // $value = StringHelper::sanitizeCurrency($value);
                    // var_dump($value); die();
                }
                $rowData[$headerValue] = $value;
                $columnIndex++;
            }
    
            $rowData['id_file_source'] = $this->id_file_source;
            if (!empty($rowData)) {
                $data[] = $rowData; // Store the row data
            }

            // echo '<pre>'; var_dump($header);
            // echo '<pre>'; var_dump($rowData); echo '</pre>'; die();
    
            // Insert in batches of 1000 rows
            if (count($data) >= $batchSize) {
                // echo '<pre>'; var_dump($data); echo '</pre>'; die();
                // $this->insertOrUpdateBatch($header, $data);
                $this->insertIgnoreBatch($header, $data, $this->table_tiktok);
                $data = []; // Clear the data array after each batch insert
            }
        }        
    
        // Insert any remaining data that didn't complete a full batch
        if (!empty($data)) {
            // $this->insertOrUpdateBatch($header, $data);
            $this->insertIgnoreBatch($header, $data, $this->table_tiktok);
        }
    }

    public function importToTiktokIncome($isDeleteInsert=false)
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $this->unmergeCells($spreadsheet, $this->filePath);
    
        $header = [];
        $data = [];

        // init id_table
        if ($this->id_file_source == null) { 
            Yii::error('Error ID File Source !!!'); die();
        }
        
        if ($isDeleteInsert) {
            // delete existing data from table ginee
            TiktokIncome::deleteAll([
                'id_file_source' => $this->id_file_source
            ]);
        }
    
        // sterilize column according to table column name
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
        
            $columnIndex = 1; // Start from the first column
            while ($columnIndex <= \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($worksheet->getHighestColumn())) {
                $cell = $worksheet->getCellByColumnAndRow($columnIndex, 1);
                $headerValue = StringHelper::sanitizeColumnName($cell->getValue());

                if (!in_array($headerValue, $this->allColumnTiktokIncome)) {
                    // Remove the column if it's not in the allowed list
                    $worksheet->removeColumnByIndex($columnIndex);
                    // Skip incrementing columnIndex to re-check the new column at the same position
                    continue;
                }

                $columnIndex++; // Increment only if the column is kept
            }
        }  

        // Read the header row
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                // Standardize header values using a utility function if needed
                $headerValue = StringHelper::sanitizeColumnName($cell->getValue());
                $header[] = $headerValue;
            }
        }
            
        $header[] = 'id_file_source';

        // Maximum number of rows to insert per batch
        $batchSize = 1000;

        // Read the data rows
        foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
    
            foreach ($cellIterator as $cell) {      
                // Ensure that the $header matches the current column
                if (!isset($header[$columnIndex])) {
                    $columnIndex++;
                    continue; // Skip columns that do not have a corresponding header
                }   
                
                $headerValue = $header[$columnIndex]; // Map header to column
                $value = StringHelper::sanitizeValue($cell->getValue());
                
                if (in_array($headerValue, $this->tiktokColumnsNumeric)) {
                    // var_dump($value);
                    $value = str_replace('.', '', $value);
                    $value = str_replace('IDR', '', $value);
                    $value = StringHelper::sanitizeValue($value);    
                }
                $rowData[$headerValue] = $value;
                $columnIndex++;
            }
    
            $rowData['id_file_source'] = $this->id_file_source;
            if (!empty($rowData)) {
                if ($rowData['order_adjustment_id'] == '' || $rowData['order_adjustment_id'] == null) {
                    continue;
                }
                $data[] = $rowData; // Store the row data
            }

            // echo '<pre>'; var_dump($header);
            // echo '<pre>'; var_dump($rowData); echo '</pre>'; die();
    
            // Insert in batches of 1000 rows
            if (count($data) >= $batchSize) {
                // echo '<pre>'; var_dump($data); echo '</pre>'; die();
                // $this->insertOrUpdateBatch($header, $data);
                $this->insertIgnoreBatch($header, $data, $this->table_tiktok_income);
                $data = []; // Clear the data array after each batch insert
            }
        }        
    
        // Insert any remaining data that didn't complete a full batch
        if (!empty($data)) {
            // $this->insertOrUpdateBatch($header, $data);
            $this->insertIgnoreBatch($header, $data, $this->table_tiktok_income);
        }
    }

    private function renameEmptyColumnName() {
        $text = '';
        for ($i=0; $i<$this->emptyColumnCount; $i++) {
            $text .= '#';
        }

        return $text;
    }

    /** tokopedia 2 sheet */
    public function importToTokopedia($isDeleteInsert=false)
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $this->unmergeCells($spreadsheet, $this->filePath);
    
        // sheet 1 -> Laporan Penjualan
        $header = [];
        $data = [];

        // init id_table
        if ($this->id_file_source == null) { 
            Yii::error('Error ID File Source !!!'); die();
        }
        
        if ($isDeleteInsert) {
            // delete existing data from table ginee
            Tokopedia::deleteAll([
                'id_file_source' => $this->id_file_source
            ]);
        }
    
        // Read the header row
        foreach ($worksheet->getRowIterator(5, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                // Standardize header values using a utility function if needed
                $header[] = StringHelper::sanitizeColumnName($cell->getValue());
            }
        }
            
        $header[] = 'id_file_source';

        // Maximum number of rows to insert per batch
        $batchSize = 1000;

        // Read the data rows
        // foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
        foreach ($worksheet->getRowIterator(6) as $row) { // 
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
    
            foreach ($cellIterator as $cell) {                
                $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value                
                $value = StringHelper::sanitizeValue($cell->getValue());
                if (in_array($headerValue, $this->tokopediaColumnsNumeric)) {
                    $value = StringHelper::sanitizeCurrency($value);
                }
                $rowData[$headerValue] = $value;
                $columnIndex++;
            }
    
            $rowData['id_file_source'] = $this->id_file_source;
            if (!empty($rowData)) {
                $data[] = $rowData; // Store the row data
            }

            // echo '<pre>'; var_dump($header);
            // echo '<pre>'; var_dump($rowData); echo '</pre>'; die();
    
            // Insert in batches of 1000 rows
            if (count($data) >= $batchSize) {
                // echo '<pre>'; var_dump($data); echo '</pre>'; die();
                // $this->insertOrUpdateBatch($header, $data);
                $this->insertIgnoreBatch($header, $data, $this->table_tokopedia);
                $data = []; // Clear the data array after each batch insert
            }
        }        
    
        // Insert any remaining data that didn't complete a full batch
        if (!empty($data)) {
            // $this->insertOrUpdateBatch($header, $data);
            $this->insertIgnoreBatch($header, $data, $this->table_tokopedia);
        }

        /* ========================================================================================= */
        // sheet 2 -> Laporan Penjualan
        $worksheet = $this->unmergeCells($spreadsheet, $this->filePath, $sheetIndex=1);

        $header = [];
        $data = [];

        // init id_table
        if ($this->id_file_source == null) { 
            Yii::error('Error ID File Source !!!'); die();
        }
        
        if ($isDeleteInsert) {
            // delete existing data from table ginee
            TokopediaKeuangan::deleteAll([
                'id_file_source' => $this->id_file_source
            ]);
        }
    
        // Read the header row
        foreach ($worksheet->getRowIterator(7, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                // Standardize header values using a utility function if needed
                $header[] = StringHelper::sanitizeColumnName($cell->getValue());
            }
        }
            
        $header[] = 'id_file_source';

        // Maximum number of rows to insert per batch
        $batchSize = 1000;

        // Read the data rows
        // foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
        foreach ($worksheet->getRowIterator(8) as $row) { // 
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
    
            foreach ($cellIterator as $cell) {                
                $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value                
                $value = StringHelper::sanitizeValue($cell->getValue());
                if (in_array($headerValue, $this->tokopediaKeuanganColumnsNumeric)) {
                    $value = StringHelper::sanitizeCurrency($value);
                }
                $rowData[$headerValue] = $value;
                $columnIndex++;
            }
    
            $rowData['id_file_source'] = $this->id_file_source;
            if (!empty($rowData)) {
                $data[] = $rowData; // Store the row data
            }

            // echo '<pre>'; var_dump($header);
            // echo '<pre>'; var_dump($rowData); echo '</pre>'; die();
    
            // Insert in batches of 1000 rows
            if (count($data) >= $batchSize) {
                // echo '<pre>'; var_dump($data); echo '</pre>'; die();
                // $this->insertOrUpdateBatch($header, $data);
                $this->insertIgnoreBatch($header, $data, $this->table_tokopedia_keuangan);
                $data = []; // Clear the data array after each batch insert
            }
        }        
    
        // Insert any remaining data that didn't complete a full batch
        if (!empty($data)) {
            // $this->insertOrUpdateBatch($header, $data);
            $this->insertIgnoreBatch($header, $data, $this->table_tokopedia_keuangan);
        }
    }

    public function importToLazada($isDeleteInsert=false)
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $this->unmergeCells($spreadsheet, $this->filePath);
    
        $header = [];
        $data = [];

        // init id_table
        if ($this->id_file_source == null) { 
            Yii::error('Error ID File Source !!!'); die();
        }
        
        if ($isDeleteInsert) {
            // delete existing data from table ginee
            Lazada::deleteAll([
                'id_file_source' => $this->id_file_source
            ]);
        }
    
        // Read the header row
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                // Standardize header values using a utility function if needed
                $columnName = UtilsStringHelper::camelToSnakeCase($cell->getValue());
                $header[] = StringHelper::sanitizeColumnName($columnName);
            }
        }
            
        $header[] = 'id_file_source';

        // Maximum number of rows to insert per batch
        $batchSize = 1000;

        // Read the data rows
        foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
    
            foreach ($cellIterator as $cell) {                
                $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value                
                $value = StringHelper::sanitizeValue($cell->getValue());
                if (in_array($headerValue, $this->tiktokColumnsNumeric)) {
                    $value = StringHelper::sanitizeCurrency($value);
                }
                $rowData[$headerValue] = $value;
                $columnIndex++;
            }
    
            $rowData['id_file_source'] = $this->id_file_source;
            if (!empty($rowData)) {
                $data[] = $rowData; // Store the row data
            }

            // echo '<pre>'; var_dump($header);
            // echo '<pre>'; var_dump($rowData); echo '</pre>'; die();
    
            // Insert in batches of 1000 rows
            if (count($data) >= $batchSize) {
                // echo '<pre>'; var_dump($data); echo '</pre>'; die();
                // $this->insertOrUpdateBatch($header, $data);
                $this->insertIgnoreBatch($header, $data, $this->table_lazada);
                $data = []; // Clear the data array after each batch insert
            }
        }        
    
        // Insert any remaining data that didn't complete a full batch
        if (!empty($data)) {
            // $this->insertOrUpdateBatch($header, $data);
            $this->insertIgnoreBatch($header, $data, $this->table_lazada);
        }
    }

    public function importToLazadaIncome($isDeleteInsert=false)
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $this->unmergeCells($spreadsheet, $this->filePath);
    
        $header = [];
        $data = [];

        // init id_table
        if ($this->id_file_source == null) { 
            Yii::error('Error ID File Source !!!'); die();
        }
        
        if ($isDeleteInsert) {
            // delete existing data from table ginee
            LazadaIncome::deleteAll([
                'id_file_source' => $this->id_file_source
            ]);
        }
    
        $skippedColumns = [];
        // Read the header row
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
            foreach ($cellIterator as $cell) {
                $cellValue = $cell->getValue();
                //  echo '<pre>'; var_dump($cellValue); echo '</pre>';
                // Standardize header values using a utility function if needed
                if ($cellValue === '' || $cellValue == NULL) {
                    $skippedColumns[] = $columnIndex;
                    continue;
                    // $this->emptyColumnCount += 1;
                    // $cellValue = $this->renameEmptyColumnName();
                }
                // echo '<pre>'; var_dump($cellValue); echo '</pre>';
                $header[] = StringHelper::sanitizeColumnName($cellValue);
                $columnIndex++;
            }
        }
            
        $header[] = 'id_file_source';

        // Maximum number of rows to insert per batch
        $batchSize = 1000;

        // Read the data rows
        foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
    
            foreach ($cellIterator as $cell) {    
                // Skip columns if they are in the skippedColumns array
                if (in_array($columnIndex, $skippedColumns)) {
                    $columnIndex++;
                    continue;
                }
                            
                $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value    
                if ($headerValue == 'undefined') {
                    continue;
                }  
                
                if (in_array($headerValue, $this->tiktokIncomeColumnsNumeric)) {
                    $value = StringHelper::sanitizeCurrencyAbs($cell->getValue());
                } else {
                    $value = StringHelper::sanitizeValue($cell->getValue());
                }

                $rowData[$headerValue] = $value;
                $columnIndex++;
            }
    
            $rowData['id_file_source'] = $this->id_file_source;            

            // cek bari kosong
            if (@$rowData['order_number'] != null && $rowData['order_number'] == '') {
                continue;
            }

            if (!empty($rowData)) {
                $data[] = $rowData; // Store the row data
            }

            // echo '<pre>'; var_dump($header);
            // echo '<pre>'; var_dump($rowData); echo '</pre>'; die();
    
            // Insert in batches of 1000 rows
            if (count($data) >= $batchSize) {
                // echo '<pre>'; var_dump($data); echo '</pre>'; die();
                // $this->insertOrUpdateBatch($header, $data);
                $this->insertIgnoreBatch($header, $data, $this->table_lazada_income);
                $data = []; // Clear the data array after each batch insert
            }
        }        
    
        // Insert any remaining data that didn't complete a full batch
        if (!empty($data)) {
            // $this->insertOrUpdateBatch($header, $data);
            $this->insertIgnoreBatch($header, $data, $this->table_lazada_income);
        }
    }

    public function importToShopeeIncome($isDeleteInsert=false)
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $this->unmergeCells($spreadsheet, $this->filePath, $sheetIndex = 1);
        $header = [];
        $data = [];
        // init id_table
        if ($this->id_file_source == null) { 
            Yii::error('Error ID File Source !!!'); die();
        }
        
        if ($isDeleteInsert) {
            // delete existing data from table ginee
            ShopeeIncome::deleteAll([
                'id_file_source' => $this->id_file_source
            ]);
        }    

        
        // sterilize column according to table column name
        foreach ($worksheet->getRowIterator(6) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            
            $columnIndex = 1; // Start from the first column
            while ($columnIndex <= \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($worksheet->getHighestColumn())) {
                $cell = $worksheet->getCellByColumnAndRow($columnIndex, 6);
                $headerValue = StringHelper::sanitizeColumnName($cell->getValue());

                if (!in_array($headerValue, $this->allColumnShopeeIncome)) {
                    // Remove the column if it's not in the allowed list
                    $worksheet->removeColumnByIndex($columnIndex);
                    // Skip incrementing columnIndex to re-check the new column at the same position
                    continue;
                }

                $columnIndex++; // Increment only if the column is kept
            }
        }  
            
        // Read the header row
        foreach ($worksheet->getRowIterator(6, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
            foreach ($cellIterator as $cell) {
                $cellValue = StringHelper::sanitizeColumnName($cell->getValue());
                $header[] = StringHelper::truncateString($cellValue);
            }
        }
        
        $header[] = 'id_file_source';        

        // Maximum number of rows to insert per batch
        $batchSize = 1000;

        // Read the data rows
        foreach ($worksheet->getRowIterator(7) as $row) { // Start from row 2 to skip the header
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
    
            foreach ($cellIterator as $cell) {                                 
                $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value                    
                
                if (in_array($headerValue, $this->shopeeIncomeColumnsNumeric)) {
                    $value = StringHelper::sanitizeCurrencyAbs($cell->getValue());
                } else {
                    $value = StringHelper::sanitizeValue($cell->getValue());
                }

                $rowData[$headerValue] = $value;
                $columnIndex++;
            }
    
            $rowData['id_file_source'] = $this->id_file_source;
            if (!empty($rowData)) {
                $data[] = $rowData; // Store the row data
            }
    
            // Insert in batches of 1000 rows
            if (count($data) >= $batchSize) {
                // echo '<pre>'; var_dump($data); echo '</pre>'; die();
                // $this->insertOrUpdateBatch($header, $data);
                $this->insertIgnoreBatch($header, $data, $this->table_shopee_income);
                $data = []; // Clear the data array after each batch insert
            }
        }        
    
        // Insert any remaining data that didn't complete a full batch
        if (!empty($data)) {
            // $this->insertOrUpdateBatch($header, $data);
            $this->insertIgnoreBatch($header, $data, $this->table_shopee_income);
        }
    }


}
