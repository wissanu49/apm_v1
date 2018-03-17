<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "building".
 *
 * @property int $id
 * @property string $building_name
 * @property string $building_address
 *
 * @property Rooms[] $rooms
 */
class Building extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'building';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['building_name'], 'required'],
            [['building_name', 'building_address'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'building_name' => 'ชื่ออาคาร',
            'building_address' => 'ที่อยู่/สถานที่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms() {
        return $this->hasMany(Rooms::className(), ['building_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BuildingQuery the active query used by this AR class.
     */
    public static function find() {
        return new BuildingQuery(get_called_class());
    }

    public static function getBuilding() {
        $query = Building::find()->all();
        return $query;
    }

    public static function getBuildingName($id) {
        $query = Building::find()->select('building_name')->where(['id'=>$id])->one();
        echo $query->building_name;
    }

}
