<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username ชื่อผู้ใช้งาน
 * @property string $password รหัสผ่าน
 * @property string $fullname ชื่อ-นามสกุล
 * @property string $role สิทธิ์การใช้งาน
 * @property string $status สถานะ
 *
 * @property Expenses[] $expenses
 * @property Invoice[] $invoices
 * @property Leasing[] $leasings
 * @property Receipt[] $receipts
 * @property RecordEnergies[] $recordEnergies
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['username', 'password', 'fullname'], 'required'],
            [['role', 'status'], 'string'],
            [['username', 'password', 'fullname'], 'string', 'max' => 100],
            [['authKey'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'ชื่อผู้ใช้งาน',
            'password' => 'รหัสผ่าน',
            'fullname' => 'ชื่อ-นามสกุล',
            'role' => 'สิทธิ์การใช้งาน',
            'status' => 'สถานะ',
            'authKey' => 'authkey',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenses() {
        return $this->hasMany(Expenses::className(), ['users_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices() {
        return $this->hasMany(Invoice::className(), ['users_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeasings() {
        return $this->hasMany(Leasing::className(), ['users_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts() {
        return $this->hasMany(Receipt::className(), ['users_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecordEnergies() {
        return $this->hasMany(RecordEnergies::className(), ['users_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

    /**
     * {@inheritdoc}
     * @return usersQuery the active query used by this AR class.
     */
    public static function find() {
        return new usersQuery(get_called_class());
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) { // <---- the difference
                $this->authKey = Yii::$app->getSecurity()->generateRandomString();
                $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            } //else {
                //$this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
                //$this->authKey = Yii::$app->getSecurity()->generateRandomString();
            //}
            return true;
        }
        return false;
    }
    
    public function getRole() {
        $profile = Users::find()->where(['id' => $this->id])->one();
        if ($profile !== null) {
            return $profile->role;
        } else {
            return false;
        }
    }
    
}
