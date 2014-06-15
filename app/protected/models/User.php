<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $f_name
 * @property string $l_name
 * @property string $role
 * @property integer $storage_id
 *
 * The followings are the available model relations:
 * @property CartridgeInventory[] $cartridgeInventories
 * @property Storage $storage
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}


    public function beforeSave()
    {
        if ($this->scenario !== 'update') {
            $this->password = CPasswordHelper::hashPassword($this->password);
        }
        return parent::beforeSave();
    }

    public function afterSave()
    {
        if ($this->scenario === 'update') {
            $this->revokeAllPrivileges();
        }
        if (in_array($this->scenario, array('insert', 'update'))) {
            Yii::app()->authManager->assign($this->role, $this->id);
        }
        parent::afterSave();
    }

    public function afterDelete()
    {
        $this->revokeAllPrivileges();
        parent::afterDelete();
    }

    protected function revokeAllPrivileges()
    {
        $authManager = Yii::app()->authManager;
        $items = $authManager->getRoles($this->id);
        foreach ($items as $item) {
            $authManager->revoke($item->name, $this->id);
        }
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('email, password, f_name, l_name, repeat, role', 'required', 'message' => 'поле "{attribute}" обязательно для заполнения', 'on' => 'insert'),
            array('password, repeat', 'required', 'message' => 'поле "{attribute}" обязательно для заполнения', 'on' => 'update_password'),
            array('email, f_name, l_name, role', 'required', 'message' => 'Обязательное поле', 'on' => 'update'),
            array('email', 'email', 'message' => 'неверный формат email'),
            array('email','unique', 'message'=>'этот email уже есть в системе', 'on' => 'insert'),
            array('password', 'compare', 'compareAttribute' => 'repeat', 'on' => 'insert', 'message' => 'повторение пароля не идентично'),
            array('password', 'compare', 'compareAttribute' => 'repeat', 'on' => 'update_password', 'message' => 'повторение пароля не идентично'),
            array('role', 'checkRole', 'on' => 'update'),
            array('role', 'checkRole', 'on' => 'insert'),
            array('email, f_name, l_name', 'filter', 'filter'=>'trim'),
            array('storage_id', 'numerical', 'integerOnly'=>true),
			array('role', 'safe'),
			array('id, email, password, f_name, l_name, role, storage_id', 'safe', 'on'=>'search'),
		);
	}

    public function checkRole($attribute, $param) {
        $roles = Yii::app()->authManager->roles;
        if ($this->role !== 'admin') {
            unset($roles['admin']);
        }
        if (!array_key_exists($this->role, $roles)) {
            $this->addError($attribute, 'данный уровень доступа недоступен');
        }
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'cartridgeInventories' => array(self::HAS_MANY, 'CartridgeInventory', 'last_modified_by'),
			'storage' => array(self::BELONGS_TO, 'Storage', 'storage_id'),
		);
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Пароль',
            'f_name' => 'Имя',
            'l_name' => 'Фамилия',
            'role' => 'Роль',
            'storage_id' => 'Место работы',
        );
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('f_name',$this->f_name,true);
        $criteria->compare('l_name',$this->l_name,true);
        $criteria->compare('role',$this->role,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getFullNameList($includeAdmin = false)
    {
        $data = $this->findAll(array(
            'condition' => $includeAdmin ? '1' : "role <> 'admin'",
            'select' => array('id', 'f_name', 'l_name'),
            'order' => 'l_name'
        ));
        $users = array();
        foreach ($data as $user) {
            $users[$user->id] = sprintf('%s %s', $user->f_name, $user->l_name);
        }
        return $users;
    }
}
