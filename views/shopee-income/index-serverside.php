<?php

use app\assets\DataTableAsset;
use app\assets\ExporterAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ShopeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

DataTableAsset::register($this);
ExporterAsset::register($this);

$this->title = 'Tabel Shopee Income';
$this->params['breadcrumbs'][] = $this->title;

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'Shopee Income'
    ],
]);

$style = <<<CSS
    #table-serverside tbody tr td:nth-child(4),
    #table-serverside tbody tr td:nth-child(5),
    #table-serverside tbody tr td:nth-child(6),
    #table-serverside tbody tr td:nth-child(7) {
        text-align: right
    }
CSS;

$this->registerCss($style);

?>
<form action="<?= Url::to(['shopee-income/index-serverside']) ?>" method="GET">
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
                            <th style="width: 4%">#</th>
                            <th>Tanggal<br/>Pembuatan</th>
                            <th style="width: 16%">ID Pesanan</th>
                            <th style="width: 16%">Harga Asli Produk</th>
                            <th style="width: 16%">Total Diskon Produk</th>
                            <th style="width: 16%">Total Pengeluaran</th>
                            <th style="width: 16%">Total Penghasilan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
               </table>
            </div>
        </div>
    </div>
</div>

<?php
$urlServerside = Url::to(['shopee-income/serverside']);
$urlExportAll = Url::to(['shopee-income/export-all']);

if ($date_start == null) {
    $date_start = "";
}

if ($date_end == null) {
    $date_end = "";
}

$headerPrint = 'Shopee Income' . date('d M Y', strtotime($date_start)) . ' - ' . date('d M Y', strtotime($date_end));

$script = <<<JS
    $(document).on('click', '.dt-buttons button', function(e) {
        e.preventDefault(); // Prevents reload
    });

    
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
            { data: 'harga_asli_produk', orderable: false},
            { data: 'total_diskon_produk', orderable: false},
            { data: 'total_pengeluaran', orderable: false},
            { data: 'total_penghasilan', orderable: false},
            { data: 'action', orderable: false, createdCell: function (td) {
                $(td).css('text-align', 'left'); // Example right-align
            }},
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
            // { extend: 'print', text: 'Print', exportOptions: {
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
            //     }}
            // }
            { extend: 'print', text: 'Print All',
                action: function (e, dt, button, config) {
                    $.ajax({
                        url: '$urlExportAll', // Endpoint to fetch all data
                        type: 'GET',
                        data: {
                            date_start: '$date_start',
                            date_end: '$date_end',
                            status: '$status',
                        },
                        success: function (response) {
                            let headers = Object.keys(response.data[0]);
                            let rows = response.data.map(item => headers.map(header => item[header]));

                            let printWindow = window.open('', '_blank');
                            printWindow.document.write('<html><head><title>Print</title></head><body>');
                            printWindow.document.write('<h2>$headerPrint</h2>');
                            printWindow.document.write('<table border="1" style="width: 100%; border-collapse: collapse;">');
                            
                            // Add headers
                            printWindow.document.write('<thead><tr>');
                            headers.forEach(header => {
                                printWindow.document.write(`<th style="padding: 8px; text-align: left; border: 1px solid black;">`+header+`</th>`);
                            });
                            printWindow.document.write('</tr></thead>');
                            
                            // Add rows
                            printWindow.document.write('<tbody>');
                            rows.forEach(row => {
                                printWindow.document.write('<tr>');
                                row.forEach(cell => {
                                    printWindow.document.write(`<td style="padding: 8px; text-align: left; border: 1px solid black;">`+cell || ''+`</td>`);
                                });
                                printWindow.document.write('</tr>');
                            });
                            printWindow.document.write('</tbody>');
                            printWindow.document.write('</table>');
                            printWindow.document.write('</body></html>');
                            printWindow.document.close();
                            printWindow.print();
                        },
                        error: function () {
                            alert('Failed to fetch data for printing.');
                        }
                    });
                }
            }
        ],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    });

    $('#btn-clear').on('click', function() {
        $('#date_start').val('');
        $('#date_end').val('');
        $('#status').val('');
    })

JS;

$this->registerJs($script, \yii\web\View::POS_END);

?>