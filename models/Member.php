<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property int|null $id_user
 * @property int|null $id_paket
 * @property string|null $nama
 * @property string|null $no_ktp
 * @property string|null $phone
 * @property string|null $alamat
 * @property int|null $id_reff_kotakab
 * @property int|null $id_reff_provinsi
 * @property string|null $kotakab
 * @property string|null $provinsi
 * @property string|null $kodepos
 * @property string|null $info
 * @property string|null $bank
 * @property string|null $rekening
 * @property string|null $rekening_an
 * @property string|null $refferal_code
 * @property int|null $id_member_sponsor
 * @property int|null $id_member_upline
 * @property string|null $photo
 * @property int|null $is_verified
 * @property int $is_active
 * @property string|null $date_active
 * @property string|null $date_created
 * @property int $is_deleted
 * @property Paket $paket
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user'], 'integer'],
            [['id_paket', 'id_reff_kotakab', 'id_reff_provinsi', 'id_member_sponsor', 'id_member_upline', 'is_verified', 'is_active', 'is_deleted'], 'safe'],
            [['info'], 'string'],
            [['date_active', 'date_created'], 'safe'],
            [['nama', 'alamat', 'kotakab', 'provinsi', 'refferal_code', 'photo'], 'string', 'max' => 255],
            [['no_ktp'], 'string', 'max' => 16],
            [['phone'], 'string', 'max' => 15],
            [['kodepos', 'rekening', 'rekening_an'], 'string', 'max' => 100],
            [['bank'], 'string', 'max' => 50],
            [['id_user'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'User',
            'id_paket' => 'Paket',
            'nama' => 'Nama',
            'no_ktp' => 'No Ktp',
            'phone' => 'Phone',
            'alamat' => 'Alamat',
            'id_reff_kotakab' => 'Kotakab',
            'id_reff_provinsi' => 'Provinsi',
            'kotakab' => 'Kotakab',
            'provinsi' => 'Provinsi',
            'kodepos' => 'Kodepos',
            'info' => 'Info',
            'bank' => 'Bank',
            'rekening' => 'Rekening',
            'rekening_an' => 'Rekening An',
            'refferal_code' => 'Refferal Code',
            'id_member_sponsor' => 'Id Member Sponsor',
            'id_member_upline' => 'Id Member Upline',
            'photo' => 'Photo',
            'is_verified' => 'Is Verified',
            'is_active' => 'Is Active',
            'date_active' => 'Date Active',
            'date_created' => 'Date Created',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public function getPaket()
    {
        return $this->hasOne(Paket::class, ['id' => 'id_paket']);
    }

}
