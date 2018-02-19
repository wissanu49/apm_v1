<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property string $id
 * @property string $leasing_id
 * @property int $room_price
 * @property int $electric_unit หน่วยไฟฟ้า
 * @property int $electric_price ค่าไฟฟ้า
 * @property int $water_unit หน่วยน้ำปะปา
 * @property int $water_price ค่าน้ำ
 * @property string $additional_1 ค่าใช้จ่ายเพิ่มเติม
 * @property int $additional_1_price บาท
 * @property string $additional_2 ค่าใช้จ่ายเพิ่มเติม
 * @property int $additional_2_price บาท
 * @property string $additional_3 ค่าใช้จ่ายเพิ่มเติม
 * @property int $additional_3_price บาท
 * @property string $additional_4 ค่าใช้จ่ายเพิ่มเติม
 * @property int $additional_4_price บาท
 * @property string $additional_5 ค่าใช้จ่ายเพิ่มเติม
 * @property int $additional_5_price บาท
 * @property string $refun_1 คืนเงิน
 * @property int $refun_1_price
 * @property string $refun_2 คืนเงิน
 * @property int $refun_2_price
 * @property int $total รวม
 * @property string $comment หมายเหตุ
 * @property string $appointment วันกำหนดชำระ
 * @property string $status สถานะการชำระ
 * @property int $users_id
 * @property string $invoice_date วันที่ออกใบแจ้งหนี้
 *
 * @property Users $users
 * @property Leasing $leasing
 * @property Receipt[] $receipts
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'leasing_id', 'room_price', 'electric_unit', 'electric_price', 'water_unit', 'water_price', 'total', 'appointment', 'users_id', 'invoice_date'], 'required'],
            [['room_price', 'electric_unit', 'electric_price', 'water_unit', 'water_price', 'additional_1_price', 'additional_2_price', 'additional_3_price', 'additional_4_price', 'additional_5_price', 'refun_1_price', 'refun_2_price', 'total', 'users_id'], 'integer'],
            [['appointment', 'invoice_date'], 'safe'],
            [['status'], 'string'],
            [['id', 'leasing_id'], 'string', 'max' => 25],
            [['additional_1', 'additional_2', 'additional_3', 'additional_4', 'additional_5', 'refun_1', 'refun_2'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['users_id' => 'id']],
            [['leasing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leasing::className(), 'targetAttribute' => ['leasing_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'leasing_id' => 'Leasing ID',
            'room_price' => 'Room Price',
            'electric_unit' => 'หน่วยไฟฟ้า',
            'electric_price' => 'ค่าไฟฟ้า',
            'water_unit' => 'หน่วยน้ำปะปา',
            'water_price' => 'ค่าน้ำ',
            'additional_1' => 'ค่าใช้จ่ายเพิ่มเติม',
            'additional_1_price' => 'บาท',
            'additional_2' => 'ค่าใช้จ่ายเพิ่มเติม',
            'additional_2_price' => 'บาท',
            'additional_3' => 'ค่าใช้จ่ายเพิ่มเติม',
            'additional_3_price' => 'บาท',
            'additional_4' => 'ค่าใช้จ่ายเพิ่มเติม',
            'additional_4_price' => 'บาท',
            'additional_5' => 'ค่าใช้จ่ายเพิ่มเติม',
            'additional_5_price' => 'บาท',
            'refun_1' => 'คืนเงิน',
            'refun_1_price' => 'Refun 1 Price',
            'refun_2' => 'คืนเงิน',
            'refun_2_price' => 'Refun 2 Price',
            'total' => 'รวม',
            'comment' => 'หมายเหตุ',
            'appointment' => 'วันกำหนดชำระ',
            'status' => 'สถานะการชำระ',
            'users_id' => 'Users ID',
            'invoice_date' => 'วันที่ออกใบแจ้งหนี้',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'users_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeasing()
    {
        return $this->hasOne(Leasing::className(), ['id' => 'leasing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(Receipt::className(), ['invoice_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return InvoiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InvoiceQuery(get_called_class());
    }
}
