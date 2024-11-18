<?php

namespace app\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;

/**
 * Class FileController
 * Untuk mengambil file di dalam protected.
 * @package app\controllers
 */
class FileController extends \yii\web\Controller
{
    public $defaultAction = 'get';

    /**
     * @param null $fileName
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionGet($fileName = null, $folder = 'files')
    {
        $storagePath = Yii::getAlias('@app/' . $folder);

        $path = "$storagePath/$fileName";
        if (!is_file($path)) {
            throw new NotFoundHttpException('File tidak ditemukan.');
        }
        $mime = FileHelper::getMimeType($path);
        return Yii::$app->response->sendFile($path, $fileName, ['inline' => in_array($mime, self::getAllowedTypes(), true)]);
    }

    protected static function getAllowedTypes()
    {
        return [
            'image/png',
            'image/gif',
            'image/jpeg',
            'application/pdf',
        ];
    }
}
