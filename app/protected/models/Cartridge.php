<?php

/**
 * This is the model class for table "cartridge".
 *
 * The followings are the available columns in table 'cartridge':
 * @property integer $id
 * @property string $model
 * @property string $manufacturer
 * @property string $printer
 * @property string $description
 *
 * The followings are the available model relations:
 * @property CartridgeInventory[] $cartridgeInventories
 */
class Cartridge extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cartridge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model', 'required', 'message' => 'поле "{attribute}" обязательно для заполнения'),
			array('manufacturer, printer, description', 'safe'),
			array('manufacturer, printer, description', 'filter', 'filter'=>'trim'),
			array('id, model, manufacturer, printer, description', 'safe', 'on'=>'search'),
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
			'cartridgeInventories' => array(self::HAS_MANY, 'CartridgeInventory', 'cartridge_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'model' => 'Модель',
			'manufacturer' => 'Производитель',
			'printer' => 'Принтер',
			'description' => 'Описание',
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
		$criteria->compare('model',$this->model,true);
		$criteria->compare('manufacturer',$this->manufacturer,true);
		$criteria->compare('printer',$this->printer,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cartridge the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
