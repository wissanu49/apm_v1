<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expenses".
 *
 * @property int $id
 * @property string $expenses_1 ค่าใช้จ่าย
 * @property int $expenses_1_price
 * @property string $expenses_2 ค่าใช้จ่าย
 * @property int $expenses_2_price
 * @property string $expenses_3 ค่าใช้จ่าย
 * @property int $expenses_3_price
 * @property string $expenses_4 ค่าใช้จ่าย
 * @property int $expenses_4_price
 * @property string $expenses_5 ค่าใช้จ่าย
 * @property int $expenses_5_price
 * @property int $total รวมค่าใช้จ่าย
 * @property string $date_record วันที่บึนทึก
 * @property int $users_id
 *
 * @property Users $users
 */
class Expenses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expenses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expenses_1', 'expenses_1_price', 'total', 'users_id'], 'required'],
            [['users_id'], 'integer'],
            [['expenses_1_price', 'expenses_2_price', 'expenses_3_price', 'expenses_4_price', 'expenses_5_price', 'total'], 'double'],
            [['date_record'], 'safe'],
            [['expenses_1', 'expenses_2', 'expenses_3', 'expenses_4', 'expenses_5'], 'string', 'max' => 200],
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
            'expenses_1' => 'ค่าใช้จ่าย',
            'expenses_1_price' => 'จำนวนเงิน',
            'expenses_2' => 'ค่าใช้จ่าย',
            'expenses_2_price' => 'จำนวนเงิน',
            'expenses_3' => 'ค่าใช้จ่าย',
            'expenses_3_price' => 'จำนวนเงิน',
            'expenses_4' => 'ค่าใช้จ่าย',
            'expenses_4_price' => 'จำนวนเงิน',
            'expenses_5' => 'ค่าใช้จ่าย',
            'expenses_5_price' => 'จำนวนเงิน',
            'total' => 'รวมค่าใช้จ่าย',
            'date_record' => 'วันที่บึนทึก',
            'users_id' => 'ผู้บันทึก',
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
     * {@inheritdoc}
     * @return ExpensesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExpensesQuery(get_called_class());
    }
}
