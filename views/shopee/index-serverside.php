<?php

use app\assets\AppAsset;
use app\assets\DataTableAsset;
use app\assets\ExporterAsset;
use app\assets\Select2Asset;
use app\models\Shopee;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ShopeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Select2Asset::register($this);
DataTableAsset::register($this);
ExporterAsset::register($this);

$this->title = 'Tabel Shopee';
$this->params['breadcrumbs'][] = $this->title;

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'Shopee'
    ],
]);

$style = <<<CSS
    #table-serverside tbody tr td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #table-serverside tbody tr td:nth-child(8),
    #table-serverside tbody tr td:nth-child(9),
    #table-serverside tbody tr td:nth-child(10),
    #table-serverside tbody tr td:nth-child(11),
    #table-serverside tbody tr td:nth-child(12) {
        text-align: right
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #64b0f2 !important;
        border: none !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff !important;
    }
    .select2 .select2-container .select2-container--default {
        line-height: 25px;
    }

    .custom-checkbox input[type="checkbox"] {
        display: none;
    }

    /* Style the custom checkbox */
    .custom-checkbox span {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid #ccc;
        border-radius: 3px;
        background-color: transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    /* Change color when checkbox is checked */
    .custom-checkbox input[type="checkbox"]:checked + span {
        background-color: #64b0f2;
        border-color: #64b0f2;
    }

    .custom-checkbox input[type="checkbox"]:checked + span::before {
        content: '';
        position: absolute;
        top: -2px;
        left: 3px;
        width: 6px;
        height: 12px;
        border: solid #fff;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .select2-container .select2-selection--multiple {
        min-height: 36px !important;
    }

CSS;

$this->registerCss($style);

?>
<form action="<?= Url::to(['shopee/index-serverside']) ?>" method="GET">
    <div class="row mb-4">
        <div class="container-fluid">
            <div class="member-index card-box shadow mb-4">
                <div class="mb-4">
                    <h4 class="header-title" style="">Filter</h4>
                </div>            
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="date_start">Tanggal Awal</label>
                            <input type="date" onclick="this.showPicker()" class="form-control" id="date_start" name="1[date_start]" placeholder="" value="<?= @$date_start ?>"/>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="date_end">Tanggal Akhir</label>
                            <input type="date" onclick="this.showPicker()" class="form-control" id="date_end" name="1[date_end]" placeholder="" value="<?= $date_end ?>"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <label class="float-right custom-checkbox"><input type="checkbox" id="selectAll"><span></span> Select All </label>
                            <select name="1[status][]" id="status" class="form-control select2 select2-multiple" size="4" multiple>
                                <?php foreach (Shopee::getListStatus() as $_status) { ?>
                                    <?php $isSelected = (in_array($_status, @$status)) ? 'selected' : '' ?>
                                    <option value="<?= $_status ?>" <?= $isSelected ?>><?= $_status ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php /*
                    <div class="col-3">
                        <div class="form-group">
                            <label for="channel">Channel</label>
                            <select name="1[channel]" id="channel" class="form-control">
                                <option value="">Pilih channel</option>
                                <?php foreach (Shopee::getListChannel() as $_channel) { ?>
                                    <?php $isSelected = (@$channel == $_channel) ? 'selected' : '' ?>
                                    <option value="<?= $_channel ?>" <?= $isSelected ?>><?= $_channel ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    */ ?>
                    <div class="col-12">
                        <div class="form-group justify-content-start">
                            <button type="button" class="btn btn-secondary" id="btn-clear">
                                <i class="ti-reload"></i> Clear
                            </button>
                            <button type="submit" class="btn btn-primary" id="btn-submit">
                                <i class="ti-search"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="row mb-4">
    <div class="container-fluid">
        <div class="dt-button-wrapper">
            <?php // Html::a('<i class="ti-plus mr-2"></i> Add', ['create'], ['class' => 'btn btn-primary mb-1']) ?>
            <?= Html::a('<i class="ti-printer mr-2"></i> Print', 'javascript:void(0)', ['class' => 'btn btn-info mb-1', 'onclick' => 'dtPrint()' ]) ?>
            <div class="btn-group mr-1">
                <?= Html::a('<i class="ti-download mr-2"></i> Export', ['#'], [
                    'class' => 'btn btn-success mb-1 dropdown-toggle',
                    'data-toggle' => 'dropdown'
                ]) ?>
                <div class="dropdown-menu" x-placement="bottom-start">
                    <?= Html::a('Excel', 'javascript:void(0)', ['class' => 'dropdown-item', 'onclick' => 'dtExportExcel(event);']) ?>
                    <?= Html::a('Pdf', 'javascript:void(0)', ['class' => 'dropdown-item', 'onclick' => 'dtExportPdf()']) ?>
                </div>
            </div>
        </div>

        <div class="member-index card-box shadow mb-4">
            <div class="mb-4">
                <h4 class="header-title" style="">
                    <?= $this->title ?>
                </h4>
            </div>
            <div class="table-responsive">
               <table class="table table-hover table-bordered" id="table-serverside">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal<br/>Pembuatan</th>
                            <th>ID Pesanan</th>
                            <th>Nama Produk</th>
                            <th>Nomor<br/>Referensi SKU</th>
                            <th>Nama<br/>Variasi</th>
                            <th>Status</th>
                            <th>Harga<br/>Awal Produk</th>
                            <th>Total<br/>Diskon</th>
                            <th>Jumlah</th>
                            <th>Status<br/>Pengembalian</th>
                            <th>Jumlah<br/>Retur</th>
                            <th>Total<br/>Harga Produk</th>
                            <th>Total<br/>Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
               </table>
            </div>
        </div>
    </div>
</div>

<?php
$urlServerside = Url::to(['shopee/serverside']);
$urlExportAll = Url::to(['shopee/export-all']);

if ($date_start == null) {
    $date_start = "";
}

if ($date_end == null) {
    $date_end = "";
}

if ($status == null) {
    $status = "";
}

if (is_array($status)) {
    $status = json_encode($status);
}

if ($channel == null) {
    $channel = "";
}

$countAllStatus = count(Shopee::getListStatus());
$isAutoCheckedAll = (@$status == '' || empty(@$status) || @$status[0] == '') ? 1 : 0;

$script = <<<JS
    const dtPrint = () => {
        const dtBtn = $('.btn.buttons-print');
        dtBtn.trigger('click');
    }
    const dtExportPdf = () => {
        const dtBtn = $('.btn.buttons-pdf.buttons-html5');
        dtBtn.trigger('click');
    }
    const dtExportExcel = (e) => {
        const dtBtn = $('.btn.buttons-excel.buttons-html5');
        dtBtn.trigger('click');
    }

    $('#table-serverside').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: '$urlServerside',
            type: 'GET', // or 'POST' depending on your server configuration
            data: function (d) {
                return $.extend({}, d, {
                    // Additional data if needed
                    date_start: '$date_start',
                    date_end: '$date_end',
                    status: '$status',
                });
            }
        },
        columns: [
            { data: null, title: '#', orderable: false, searchable: false, defaultContent: ''},
            { data: 'waktu_pesanan_dibuat', orderable: false},
            { data: 'no_pesanan', orderable: false},
            { data: 'nama_produk', orderable: false, width: '250px'},
            { data: 'nomor_referensi_sku', orderable: false},
            { data: 'nama_variasi', orderable: false},
            { data: 'status_pesanan', orderable: false},
            { data: 'harga_awal', orderable: false},
            { data: 'total_diskon', orderable: false},
            { data: 'jumlah', orderable: false},            
            { data: 'status_pembatalan_pengembalian', orderable: false},
            { data: 'returned_quantity', orderable: false},
            { data: 'total_harga_produk', orderable: false},
            { data: 'total_pembayaran', orderable: false},
            { data: 'action', orderable: false},
        ],
        rowCallback: function(row, data, index) {
            var table = $('#table-serverside').DataTable();
            var pageInfo = table.page.info();
            // Calculate the sequence number based on the page index and page length
            $('td:eq(0)', row).html(pageInfo.start + index + 1);
        },
        dom: 'Blfrtip', // Include the 'B' in 'dom' to show buttons
        buttons: [
            { extend: 'copy', text: 'Copy' },
            { extend: 'csv', text: 'CSV' },
            // { extend: 'excel', text: 'Excel', exportOptions: {
            //     columns: ':not(:last-child)', // include visible columns only
            //     format: {
            //         body: function (data, row, column, node) {
            //             if (column === 0) {
            //                 // Adjust sequence number for PDF export
            //                 var pageInfo = $('#table-serverside').DataTable().page.info();
            //                 return pageInfo.start + row + 1;
            //             }
            //             return data;
            //         }
            //     }},
            // },
            { extend: 'excel', text: 'Export All to Excel',
                    action: function (e, dt, button, config) {
                        // Custom AJAX request to fetch all data based on parameters
                        $.ajax({
                            url: '$urlExportAll', // Endpoint to fetch all data
                            type: 'GET',
                            data: {
                                date_start: '$date_start',
                                date_end: '$date_end',
                                status: '$status',
                            },
                            success: function (response) {
                                // Use the response data to create an Excel file
                                let workbook = XLSX.utils.book_new(); // Create a new workbook
                                let worksheet = XLSX.utils.json_to_sheet(response.data); // Convert data to a worksheet
                                XLSX.utils.book_append_sheet(workbook, worksheet, 'Exported Data'); // Add the worksheet to the workbook

                                // Export the workbook as an Excel file
                                XLSX.writeFile(workbook, 'ExportedData.xlsx');
                            },
                            error: function () {
                                alert('Failed to fetch data for export.');
                            }
                        });
                    }
            },
            // { extend: 'pdf', text: 'PDF', exportOptions: {
            //     columns: ':not(:last-child)', // include visible columns only
            //     format: {
            //         body: function (data, row, column, node) {
            //             if (column === 0) {
            //                 // Adjust sequence number for PDF export
            //                 var pageInfo = $('#table-serverside').DataTable().page.info();
            //                 return pageInfo.start + row + 1;
            //             }
            //             return data;
            //         }
            //     }},
            //     customize: function (doc) {
            //         doc.pageOrientation = 'landscape';
            //         // Optional: Customize PDF document margins
            //         doc.pageMargins = [10, 5, 5, 5]; // Set custom margins for left, top, right, bottom
            //     }
            // },
            { extend: 'pdf', text: 'Export All to PDF',
                action: function (e, dt, button, config) {
                    $.ajax({
                        url: '$urlExportAll',
                        type: 'GET',
                        data: {
                            date_start: '$date_start',
                            date_end: '$date_end',
                            status: '$status',
                        },
                        success: function (response) {
                            // Initialize jsPDF
                            const { jsPDF } = window.jspdf;
                            const doc = new jsPDF({ orientation: 'landscape' });

                            // Add headers and data
                            let headers = Object.keys(response.data[0]);
                            let rows = response.data.map(item => headers.map(header => item[header]));

                            doc.autoTable({
                                head: [headers],
                                body: rows,
                                margin: { top: 10 },
                                styles: { fontSize: 8 },
                            });

                            // Save the PDF
                            doc.save('ExportedData.pdf');
                        },
                        error: function () {
                            alert('Failed to fetch data for export.');
                        }
                    });
                }
            },
            { extend: 'print', text: 'Print', exportOptions: {
                columns: ':not(:last-child)', // include visible columns only
                format: {
                    body: function (data, row, column, node) {
                        if (column === 0) {
                            // Adjust sequence number for PDF export
                            var pageInfo = $('#table-serverside').DataTable().page.info();
                            return pageInfo.start + row + 1;
                        }
                        return data;
                    }
                }},
            }
        ],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    });

    $('#btn-clear').on('click', function() {
        $('#date_start').val('');
        $('#date_end').val('');
        $('#status').val('');
    })

    $(document).ready(function() {
        $('#status').select2({
            placeholder: "Pilih Status",
            width: '100%'
        });        
        $('#selectAll').on('change', function() {
            if ($(this).is(':checked')) {
                $('#status > option').prop("selected", true);
            } else {
                $('#status > option').prop("selected", false);
            }
            $('#status').trigger('change'); // Update Select2 display
        });

        // Update Select All checkbox based on individual selections
        $('#status').on('change', function() {
            $('#selectAll').prop('checked', $('#status option:selected').length === $('#status option').length);
        });

        // isSelectedAll
        if ($countAllStatus == $('#status option:selected').length) {
            $('#selectAll').attr('checked', 'checked');
        }

        // auto checked all
        if ($isAutoCheckedAll == 1) {
            $('#selectAll').trigger('click');
        }

    })

JS;

$this->registerJs($script, \yii\web\View::POS_END);

?>