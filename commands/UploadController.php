<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\FileSource;
use app\models\TableUpload;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UploadController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = null)
    {
        if ($message == null) {
            $message = 'Upload ' . __FUNCTION__;
        }

        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionRemoveUnmatchPeriode()
    {
        /** shopee */
        $query = FileSource::find()->where([
            'id_table' => TableUpload::SHOPEE
        ]);

        foreach ($query->all() as $row) {
            $date_start = date('Y-m-01', strtotime($row->year. '-' . $row->month));
            $date_end = date('Y-m-t', strtotime($row->year. '-' . $row->month));

            $sql = <<<SQL
                DELETE FROM shopee
                WHERE id_file_source = $row->id AND STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') NOT BETWEEN '$date_start' AND '$date_end';
            SQL;

            $command = Yii::$app->db->createCommand($sql);
            $command->queryAll();
        }

        /** shopee income */
        $query = FileSource::find()->where([
            'id_table' => TableUpload::SHOPEE_INCOME
        ]);

        foreach ($query->all() as $row) {
            $date_start = date('Y-m-01', strtotime($row->year. '-' . $row->month));
            $date_end = date('Y-m-t', strtotime($row->year. '-' . $row->month));

            $sql = <<<SQL
                DELETE FROM shopee_income
                WHERE id_file_source = $row->id AND STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') NOT BETWEEN '$date_start' AND '$date_end';
            SQL;

            $command = Yii::$app->db->createCommand($sql);
            $command->queryAll();
        }

        /** tokopedia */
        $query = FileSource::find()->where([
            'id_table' => TableUpload::TOKOPEDIA
        ]);

        foreach ($query->all() as $row) {
            $date_start = date('Y-m-01', strtotime($row->year. '-' . $row->month));
            $date_end = date('Y-m-t', strtotime($row->year. '-' . $row->month));

            $sql = <<<SQL
                DELETE FROM tokopedia
                WHERE id_file_source = $row->id AND STR_TO_DATE(tanggal_pembayaran, '%d-%m-%Y') NOT BETWEEN '$date_start' AND '$date_end';
            SQL;

            $command = Yii::$app->db->createCommand($sql);
            $command->queryAll();
        }

        /** tokopedia keuangan PENDING */
        // $query = FileSource::find()->where([
        //     'id_table' => 'tokopedia'
        // ]);

        // foreach ($query->all() as $row) {
        //     $date_start = date('Y-m-01', strtotime($row->year. '-' . $row->month));
        //     $date_end = date('Y-m-t', strtotime($row->year. '-' . $row->month));

        //     $sql = <<<SQL
        //         DELETE FROM tokopedia
        //         WHERE id_file_source = $row->id AND STR_TO_DATE(tanggal_pembayaran, '%d-%m-%Y') NOT BETWEEN '$date_start' AND '$date_end';
        //     SQL;

        //     $command = Yii::$app->db->createCommand($sql);
        //     $command->queryAll();
        // }

        /** tiktok */
        $query = FileSource::find()->where([
            'id_table' => TableUpload::TIKTOK
        ]);

        foreach ($query->all() as $row) {
            $date_start = date('Y-m-01', strtotime($row->year. '-' . $row->month));
            $date_end = date('Y-m-t', strtotime($row->year. '-' . $row->month));

            $sql = <<<SQL
                DELETE FROM tiktok
                WHERE id_file_source = $row->id AND STR_TO_DATE(created_time, '%d/%m/%Y') NOT BETWEEN '$date_start' AND '$date_end'
            SQL;

            $command = Yii::$app->db->createCommand($sql);
            $command->queryAll();
        }

        /** tiktok income PENDING */
        // $query = FileSource::find()->where([
        //     'id_table' => TableUpload::TIKTOK_INCOME
        // ]);

        // foreach ($query->all() as $row) {
        //     $date_start = date('Y-m-01', strtotime($row->year. '-' . $row->month));
        //     $date_end = date('Y-m-t', strtotime($row->year. '-' . $row->month));

        //     $sql = <<<SQL
        //         DELETE FROM tiktok_income
        //         WHERE id_file_source = $row->id AND STR_TO_DATE(created_time, '%d/%m/%Y') NOT BETWEEN '$date_start' AND '$date_end'
        //     SQL;

        //     $command = Yii::$app->db->createCommand($sql);
        //     $command->queryAll();
        // }

        /** lazada */
        $query = FileSource::find()->where([
            'id_table' => TableUpload::LAZADA
        ]);

        foreach ($query->all() as $row) {
            $date_start = date('Y-m-01', strtotime($row->year. '-' . $row->month));
            $date_end = date('Y-m-t', strtotime($row->year. '-' . $row->month));

            $sql = <<<SQL
                DELETE FROM lazada
                WHERE id_file_source = $row->id AND STR_TO_DATE(create_time, '%d %b %Y') NOT BETWEEN '$date_start' AND '$date_end'
            SQL;

            $command = Yii::$app->db->createCommand($sql);
            $command->queryAll();
        }

        /** lazada income PENDING */
        // $query = FileSource::find()->where([
        //     'id_table' => TableUpload::LAZADA_INCOME
        // ]);

        // foreach ($query->all() as $row) {
        //     $date_start = date('Y-m-01', strtotime($row->year. '-' . $row->month));
        //     $date_end = date('Y-m-t', strtotime($row->year. '-' . $row->month));

        //     $sql = <<<SQL
        //         DELETE FROM lazada_income
        //         WHERE id_file_source = $row->id AND STR_TO_DATE(order_creation_date, '%d %b %Y') NOT BETWEEN '$date_start' AND '$date_end'
        //     SQL;

        //     $command = Yii::$app->db->createCommand($sql);
        //     $command->queryAll();
        // }
        $sql = <<<SQL
            DELETE FROM lazada_income
            WHERE STR_TO_DATE(order_creation_date, '%d %b %Y') IS NULL
        SQL;

        $command = Yii::$app->db->createCommand($sql);
        $command->queryAll();

    }

}
