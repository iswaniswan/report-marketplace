<?php

namespace app\widgets;

use app\assets\DataTableAsset;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

class DataTables extends \yii\grid\GridView
{

    /**
     * @var array the HTML attributes for the container tag of the datatables view.
     * The "tag" element specifies the tag name of the container element and defaults to "div".
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the HTML attributes for the datatables table element.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $tableOptions = ["class"=>"table table-striped table-bordered","cellspacing"=>"0", "width"=>"100%"];

    /**
     * @var array the HTML attributes for the datatables table element.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $clientOptions = [];


    /**
     * Runs the widget.
     */
    public function run()
    {
        $clientOptions = $this->getClientOptions();
        // echo '<pre>'; var_dump($clientOptions); echo '</pre>'; die();
        
        $view = $this->getView();
        $id = $this->tableOptions['id'];

        //Bootstrap3 Asset by default
//        DataTablesBootstrapAsset::register($view);
        DataTableAsset::register($view);

        //TableTools Asset if needed
//        if (isset($clientOptions["tableTools"]) || (isset($clientOptions["dom"]) && strpos($clientOptions["dom"], 'T')>=0)){
//            $tableTools = DataTablesTableToolsAsset::register($view);
//            //SWF copy and download path overwrite
//            $clientOptions["tableTools"]["sSwfPath"] = $tableTools->baseUrl."/swf/copy_csv_xls_pdf.swf";
//        }
        $options = Json::encode($clientOptions);
        $view->registerJs("jQuery('#$id').DataTable($options);");

        //base list view run
        if ($this->showOnEmpty || $this->dataProvider->getCount() > 0) {
            $content = preg_replace_callback("/{\\w+}/", function ($matches) {
                $content = $this->renderSection($matches[0]);

                return $content === false ? $matches[0] : $content;
            }, $this->layout);
        } else {
            $content = $this->renderEmpty();
        }
        $tag = ArrayHelper::remove($this->options, 'tag', 'div');
        echo Html::tag($tag, $content, $this->options);
    }

    /**
     * Initializes the datatables widget disabling some GridView options like
     * search, sort and pagination and using DataTables JS functionalities
     * instead.
     */
    public function init()
    {
        parent::init();

        //disable filter model by grid view
        $this->filterModel = null;

        //disable sort by grid view
        $this->dataProvider->sort = false;

        //disable pagination by grid view
        $this->dataProvider->pagination = false;
        // Enable pagination by grid view with a default configuration
        // $this->dataProvider->pagination = new Pagination([
        //     'pageSize' => 10, // Set the desired number of items per page
        //     'pageSizeLimit' => [1, 100], // Optional: limit the page sizes allowed
        // ]);

        // $this->clientOptions = [
        //     'serverSide' => true, // Enable server-side processing
        //     'processing' => true, // Show processing indicator
        //     'ajax' => \yii\helpers\Url::to(['ginee/serverside']),
        //     'paging' => true,
        //     'searching' => 'true',
        //     'info' => true,
        //     'lengthChange' => true,
        //     'pageLength' => 10,
        //     'dom' => 'lfrtipB',
        //     'buttons' => ['copy', 'csv', 'excel', 'pdf', 'print'],
        //     'columns' => [
        //         ['data' => 'id_pesanan'],
        //         ['data' => 'nama_toko'],
        //         ['data' => 'nama_produk'],
        //         ['data' => 'variant_produk'],
        //         ['data' => 'jumlah'],
        //         ['data' => 'total'],
        //         ['data' => 'action']
        //     ],
        // ];
        // $this->clientOptions = [];
        //layout showing only items
        $this->layout = "{items}";
        // $this->layout = "{searchBox}\n{items}\n{summary}\n{pager}";

        //the table id must be set
        if (!isset($this->tableOptions['id'])) {
            $this->tableOptions['id'] = 'datatables_'.$this->getId();
        }
    }
    /**
     * Returns the options for the datatables view JS widget.
     * @return array the options
     */
    protected function getClientOptions()
    {
        return $this->clientOptions;
    }
}