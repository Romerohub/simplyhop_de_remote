<?php

/**
 * This is the model class for table "{{travels}}".
 *
 * The followings are the available columns in table '{{travels}}':
 * @property integer $id
 * @property integer $travel_owner_id
 * @property integer $position_from_id
 * @property string $position_from_name
 * @property integer $position_destination_id
 * @property string $position_destination_name
 * @property integer $is_active
 * @property integer $date_add
 * @property integer $date_edit
 * @property string $title
 * @property string $descrition
 * @property integer $form_stadt
 * @property integer $form_start
 * @property integer $form_ziel
 * @property string $form_automarke
 * @property string $form_sonstige_inweise
 * @property integer $form_freie_platze
 * @property integer $form_anzahl_von_gepack
 * @property integer $form_raucher
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 * @property User $travelOwner
 * @property Position $positionFrom
 * @property Position $positionDestination
 */
class Travels extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{travels}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('travel_owner_id, position_from_id, position_from_name, position_destination_id, position_destination_name, is_active, date_add, date_edit, title, descrition, form_stadt, form_start, form_ziel, form_automarke, form_sonstige_inweise, form_freie_platze, form_anzahl_von_gepack, form_raucher', 'required'),
			array('form_stadt, form_start,form_ziel, datum_start, datum_start_time,travel_owner_id,position_from_id, position_destination_id', 'required'),
			//array('travel_owner_id, position_from_id, position_destination_id, is_active, date_add, date_edit, form_stadt, form_start, form_ziel, form_freie_platze, form_anzahl_von_gepack, form_raucher', 'numerical', 'integerOnly'=>true),
			array('date_start_timestamp', 'numerical', 'integerOnly'=>true),
			array('form_stadt, form_start, form_ziel, form_automarke, estimate_time', 'length', 'max'=>255),
			array('form_sonstige_inweise, total_visits', 'length', 'max'=>555),
			array('form_umweg, form_max_2, form_raucher, form_gepack, form_freie_platze, date_add', 'length', 'max'=>55),
			//array('form_automarke', 'length', 'max'=>244),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, travel_owner_id, position_from_id, position_from_name, position_destination_id, position_destination_name, is_active, date_add, date_edit, title, descrition, form_stadt, form_start, form_ziel, form_automarke, form_sonstige_inweise, form_freie_platze, form_anzahl_von_gepack, form_raucher', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'travel_id'),
			'travelOwner' => array(self::BELONGS_TO, 'User', 'travel_owner_id'),
			'positionFrom' => array(self::BELONGS_TO, 'Position', 'position_from_id'),
			'positionDestination' => array(self::BELONGS_TO, 'Position', 'position_destination_id'),
            'travelId' => array(self::HAS_MANY, 'Request', 'travel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'travel_owner_id' => 'Travel Owner',
			'position_from_id' => 'Position From',
			'position_from_name' => 'Position From Name',
			'position_destination_id' => 'Position Destination',
			'position_destination_name' => 'Position Destination Name',
			'is_active' => 'Is Active',
			'date_add' => 'Date Add',
			'date_edit' => 'Date Edit',
			'title' => 'Title',
			'descrition' => 'Descrition',
			'form_stadt' => 'Form Stadt',
			'form_start' => 'Form Start',
			'form_ziel' => 'Form Ziel',
			'form_automarke' => 'Form Automarke',
			'form_sonstige_inweise' => 'Form Sonstige Inweise',
			'form_freie_platze' => 'Form Freie Platze',
			'form_anzahl_von_gepack' => 'Form Anzahl Von Gepack',
			'form_raucher' => 'Form Raucher',
			'estimate_time' => 'Form estimate_time',
			'date_start_timestamp' => 'date_start_timestamp',
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
		$criteria->compare('travel_owner_id',$this->travel_owner_id);
		$criteria->compare('position_from_id',$this->position_from_id);
		$criteria->compare('position_from_name',$this->position_from_name,true);
		$criteria->compare('position_destination_id',$this->position_destination_id);
		$criteria->compare('position_destination_name',$this->position_destination_name,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('date_add',$this->date_add);
		$criteria->compare('date_edit',$this->date_edit);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('descrition',$this->descrition,true);
		$criteria->compare('form_stadt',$this->form_stadt);
		$criteria->compare('form_start',$this->form_start);
		$criteria->compare('form_ziel',$this->form_ziel);
		$criteria->compare('form_automarke',$this->form_automarke,true);
		$criteria->compare('form_sonstige_inweise',$this->form_sonstige_inweise,true);
		$criteria->compare('form_freie_platze',$this->form_freie_platze);
		$criteria->compare('form_anzahl_von_gepack',$this->form_anzahl_von_gepack);
		$criteria->compare('form_raucher',$this->form_raucher);
		$criteria->compare('estimate_time',$this->estimate_time);
		$criteria->compare('date_start_timestamp',$this->date_start_timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Travels the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
