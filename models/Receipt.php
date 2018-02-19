<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipt".
 *
 * @property string $id
 * @property string $leasing_id
 * @property int $room_price
 * @property int $electric_price ค่าไฟฟ้า
 * @property int $water_price ค่าน้ำ
 * @property string $additional_1 ค่าใช้จ่ายเพิ่มเติม
 * @property int $additional_1_price
 * @property string $additional_2
 * @property int $additional_2_price
 * @property string $additional_3
 * @property int $additional_3_price
 * @property string $additional_4
 * @property int $additional_4_price
 * @property string $additional_5
 * @property int $additional_5_price
 * @property string $refun_1
 * @property int $refun_1_price
 * @property string $refun_2
 * @property int $refun_2_price
 * @property int $total
 * @property string $comment หมายเหตุ
 * @property string $invoice_id
 * @property int $users_id
 * @property string $receipt_date
 *
 * @property Leasing $leasing
 * @property Invoice $invoice
 * @property Users $users
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'leasing_id', 'room_price', 'total', 'invoice_id', 'users_id'], 'required'],
            [['room_price', 'electric_price', 'water_price', 'additional_1_price', 'additional_2_price', 'additional_3_price', 'additional_4_price', 'additional_5_price', 'refun_1_price', 'refun_2_price', 'total', 'users_id'], 'integer'],
            [['receipt_date'], 'safe'],
            [['id', 'leasing_id', 'invoice_id'], 'string', 'max' => 25],
            [['additional_1', 'additional_2', 'additional_3', 'additional_4', 'additional_5', 'refun_1', 'refun_2'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['leasing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leasing::className(), 'targetAttribute' => ['leasing_id' => 'id']],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['users_id' => 'id']],
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
            'electric_price' => 'ค่าไฟฟ้า',
            'water_price' => 'ค่าน้ำ',
            'additional_1' => 'ค่าใช้จ่ายเพิ่มเติม',
            'additional_1_price' => 'Additional 1 Price',
            'additional_2' => 'Additional 2',
            'additional_2_price' => 'Additional 2 Price',
            'additional_3' => 'Additional 3',
            'additional_3_price' => 'Additional 3 Price',
            'additional_4' => 'Additional 4',
            'additional_4_price' => 'Additional 4 Price',
            'additional_5' => 'Additional 5',
            'additional_5_price' => 'Additional 5 Price',
            'refun_1' => 'Refun 1',
            'refun_1_price' => 'Refun 1 Price',
            'refun_2' => 'Refun 2',
            'refun_2_price' => 'Refun 2 Price',
            'total' => 'Total',
            'comment' => 'หมายเหตุ',
            'invoice_id' => 'Invoice ID',
            'users_id' => 'Users ID',
            'receipt_date' => 'Receipt Date',
        ];
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
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'users_id']);
    }

    /**
     * {@inheritdoc}
     * @return ReceiptQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReceiptQuery(get_called_class());
    }
}
