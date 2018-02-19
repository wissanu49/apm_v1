<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "energies".
 *
 * @property int $id
 * @property string $peroid รอบเดือน
 * @property int $water_unit เลขมิเตอร์น้ำ
 * @property int $electric_unit เลขมิเตอร์ไฟฟ้า
 * @property int $rooms_id
 * @property int $users_id ผู้จดบันทึก
 * @property string $record_date วันที่บันทึก
 *
 * @property Rooms $rooms
 * @property Users $users
 */
class Energies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'energies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['peroid', 'water_unit', 'electric_unit', 'rooms_id', 'users_id', 'record_date'], 'required'],
            [['water_unit', 'electric_unit', 'rooms_id', 'users_id'], 'integer'],
            [['record_date'], 'safe'],
            [['peroid'], 'string', 'max' => 45],
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
            'peroid' => 'รอบเดือน',
            'water_unit' => 'เลขมิเตอร์น้ำ',
            'electric_unit' => 'เลขมิเตอร์ไฟฟ้า',
            'rooms_id' => 'Rooms ID',
            'users_id' => 'ผู้จดบันทึก',
            'record_date' => 'วันที่บันทึก',
        ];
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
     * {@inheritdoc}
     * @return EnergiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EnergiesQuery(get_called_class());
    }
}
