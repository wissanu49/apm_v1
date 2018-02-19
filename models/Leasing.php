<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leasing".
 *
 * @property string $id
 * @property string $move_in วันที่ย้ายเข้า
 * @property string $move_out วันที่ย้ายออก
 * @property int $users_id
 * @property int $rooms_id
 * @property int $customers_id
 * @property string $leasing_date วันที่บันทึก
 * @property string $status สถานะสัญญาเช่า
 * @property string $comment หมายเหตุ
 * @property int $deposit ค่าประกันห้อง
 *
 * @property Invoice[] $invoices
 * @property Customers $customers
 * @property Rooms $rooms
 * @property Users $users
 * @property Receipt[] $receipts
 */
class Leasing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leasing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'move_in', 'users_id', 'rooms_id', 'customers_id', 'leasing_date'], 'required'],
            [['move_in', 'move_out', 'leasing_date'], 'safe'],
            [['users_id', 'rooms_id', 'customers_id', 'deposit'], 'integer'],
            [['status', 'comment'], 'string'],
            [['id'], 'string', 'max' => 25],
            [['id'], 'unique'],
            [['customers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customers_id' => 'id']],
            [['rooms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['rooms_id' => 'id']],
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
            'move_in' => 'วันที่ย้ายเข้า',
            'move_out' => 'วันที่ย้ายออก',
            'users_id' => 'Users ID',
            'rooms_id' => 'Rooms ID',
            'customers_id' => 'Customers ID',
            'leasing_date' => 'วันที่บันทึก',
            'status' => 'สถานะสัญญาเช่า',
            'comment' => 'หมายเหตุ',
            'deposit' => 'ค่าประกันห้อง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['leasing_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customers_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'rooms_id']);
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
    public function getReceipts()
    {
        return $this->hasMany(Receipt::className(), ['leasing_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return LeasingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LeasingQuery(get_called_class());
    }
}
