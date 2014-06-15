<?php

/**
 * This is the model class for table "cartridge_inventory".
 *
 * The followings are the available columns in table 'cartridge_inventory':
 * @property integer $id
 * @property integer $cartridge_id
 * @property integer $storage_id
 * @property integer $quantity
 * @property integer $last_modified_at
 * @property integer $last_modified_by
 *
 * The followings are the available model relations:
 * @property User $lastModifiedBy
 * @property Storage $storage
 * @property Cartridge $cartridge
 */
class CartridgeInventory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cartridge_inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('cartridge_id, storage_id, quantity, last_modified_at, last_modified_by', 'required',
                'message' => 'поле "{attribute}" обязательно для заполнения'
            ),
			array('cartridge_id, storage_id, quantity, last_modified_at, last_modified_by',
                'numerical',
                'integerOnly'=>true,
                'message' => 'поле "{attribute}" должно быть цифрой'
            ),
            array('quantity', 'numerical', 'min' => 1, 'message' => 'поле "{attribute}" должно быть больше {min}'),
			array('id, cartridge_id, storage_id, quantity, last_modified_at, last_modified_by', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'last_modified_by'),
			'storage' => array(self::BELONGS_TO, 'Storage', 'storage_id'),
			'cartridge' => array(self::BELONGS_TO, 'Cartridge', 'cartridge_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cartridge_id' => 'Картридж',
			'storage_id' => 'Место хранения',
			'quantity' => 'Количество',
			'last_modified_at' => 'Дата последнего изменения',
			'last_modified_by' => 'Последнее изменение сделано',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('cartridge_id',$this->cartridge_id);
		$criteria->compare('storage_id',$this->storage_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('last_modified_at',$this->last_modified_at);
		$criteria->compare('last_modified_by',$this->last_modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CartridgeInventory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
