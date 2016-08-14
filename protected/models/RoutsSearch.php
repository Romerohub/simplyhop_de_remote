<?php

/**
 * This is the model class for table "{{routs_search}}".
 *
 * The followings are the available columns in table '{{routs_search}}':
 * @property integer $id
 * @property integer $travel_id
 * @property string $name_from
 * @property string $name_to
 */
class RoutsSearch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{routs_search}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('travel_id, name_from, name_to', 'required'),
			array('travel_id', 'numerical', 'integerOnly'=>true),
			array('name_from, name_to, full_name_from, full_name_to', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, travel_id, name_from, name_to, full_name_from, full_name_to', 'safe', 'on'=>'search'),
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
            'travel'=>array(self::BELONGS_TO, 'Travels', 'travel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'travel_id' => 'Travel',
			'name_from' => 'Name From',
			'name_to' => 'Name To',
            'full_name_from' => 'Name From',
			'full_name_to' => 'Name To',
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
		$criteria->compare('travel_id',$this->travel_id);
		$criteria->compare('name_from',$this->name_from,true);
		$criteria->compare('name_to',$this->name_to,true);
        $criteria->compare('full_name_from',$this->full_name_from,true);
		$criteria->compare('full_name_to',$this->full_name_to,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoutsSearch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
