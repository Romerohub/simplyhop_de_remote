<?php

/**
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $profile
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return static the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('username, password, email', 'length', 'max'=>128),
			array('geburtsdatum', 'date', 'format'=>'d.M.yyyy'),
			array('profile', 'safe'),
             array(
                 'farbe,
                 fb_id,
                geschlecht,
                vorname,
                nachname,
                email,
                form_stadt,
                form_handy,
                form_automarke,
                geburtsdatum,
                form_uber_mich,
                raucher ,
                haustiere,
                 musik,
                 last_visit,
                 last_visit_time,
                 date_create' ,'safe'
            )

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
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
			'userRequestId' => array(self::HAS_MANY, 'Requests', 'user_request_id'),
		);
	}
    /**
     * Returns User model by its email
     *
     * @param string $email
     * @access public
     * @return User
     */
    public function findByEmail($email)
    {
        return self::model()->findByAttributes(array('email' => $email));
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Username',
			'password' => 'Password',
			'fb_id' => 'fb_id',

			'form_name' => 'form_name',

            'geschlecht' => 'Geschlecht*',
            'vorname' => 'Vorname*',
            'nachname' => 'Nachname',
            'email' => 'E-Mail*',
            'form_stadt' => 'Stadt',
            'form_handy' => 'Handy*',
            'form_automarke' =>"Automarke und<br>Model",
            'geburtsdatum' => 'Geburtsdatum*',
            'form_uber_mich' => 'Über mich',
            'raucher' => 'Raucher:',
            'haustiere' => 'Haustiere:',
            'musik' => 'Musik:',
            'farbe' => 'Farbe',

		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}
}
