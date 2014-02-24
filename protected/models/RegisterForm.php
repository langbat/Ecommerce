<?php
/**
 * Register form model
 */
class RegisterForm extends CFormModel
{
	/**
	 * @var string - username
	 */
    public $username;
    
	/**
	 * @var string - password
	 */
	public $password;
	
	/**
	 * @var string - password2
	 */
	public $password2;
    
	/**
	 * @var string - email
	 */
	public $email;

	/**
	 * @var string - captcha
	 */
	public $verifyCode;
	
	
	public $id;
	public $parent_id;
    public $birthday;
	public $fname;
	public $lname;
	public $photo;
	public $address;
	public $city;
	public $phone;
    public $street;
    public $nr;
    public $ext_information;
    public $postcode;
    public $countries;
    public $telephone;
    public $gender;
    public $comment;
    public $coupon;
	
	/**
	 * table data rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('username', 'match', 'allowEmpty' => false, 'pattern' => '/[A-Za-z0-9\x80-\xFF]+$/' ),
			array('phone', 'match', 'allowEmpty' => false, 'pattern' => '/^([+]?[0-9 \-]+)$/' ),
			array('email', 'email'),
			array('email, username', 'unique', 'className' => 'Members' ),
			array('email, password, password2, fname, lname, gender, street, nr, postcode, city, phone, countries', 'required'),
			array('username, fname, lname, phone', 'length', 'min' => 3, 'max' => 32),
			array('address', 'length', 'min' => 3, 'max' => 100),
			array('password2', 'compare', 'compareAttribute'=>'password'),
			array('email', 'length', 'min' => 3, 'max' => 55),
            array('password, password2', 'length', 'min' => 6, 'max' => 55),
			//array('verifyCode', 'captcha'),
			array('parent_id', 'checkRef'),
		);
	}
    
    public function relations()
	{
		return array(
            'country' => array(self::BELONGS_TO, 'Countries', 'country_id')
        );
	}
	
	public function checkRef()
	{
		if($this->parent_id) $this->parent_id = intval($this->parent_id);
		else $this->parent_id = 0;
	}
	
	/**
	 * Attribute values
	 *
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
            'parent_id' => Yii::t('global', 'Parent'),
            'username' => Yii::t('global', 'Username'),
			'gender' => Yii::t('global', 'Gender'),
			'birthday' => Yii::t('global', 'Birthday'),
			'street' => Yii::t('global', 'Street and Nr'),
			'ext_information' => Yii::t('global', 'Extra Information'),
			'country_id' => Yii::t('global', 'Land'),
			'comment' => Yii::t('global', 'How do you know about our shop ?'),
			'coupon' => Yii::t('global', 'Coupon Code'),
			'postcode' => Yii::t('global', 'Postcode and Place'),
            'email' => Yii::t('global', 'Email'),
            'password' => Yii::t('global', 'Password'),
            'password2' => Yii::t('global', 'Confirm Password'),
            'joined' => Yii::t('global', 'Joined'),
            'data' => Yii::t('global', 'Data'),
            'passwordreset' => Yii::t('global', 'Passwordreset'),
            'role' => Yii::t('global', 'Role'),
            'ipaddress' => Yii::t('global', 'Ipaddress'),
            'seoname' => Yii::t('global', 'Seoname'),
            'fbuid' => Yii::t('global', 'Fbuid'),
            'fbtoken' => Yii::t('global', 'Fbtoken'),
            'fname' => Yii::t('members', 'First Name'),
			'lname' => Yii::t('members', 'Last Name'),
            'photo' => Yii::t('global', 'Photo'),
            'address' => Yii::t('global', 'Address'),
            'city' => Yii::t('global', 'City'),
            'phone' => Yii::t('global', 'Phone'),
            'vericode' => Yii::t('global', 'Vericode'),
            'current_plan' => Yii::t('global', 'Current Plan'),
		);
	}
    public $bday, $bmonth, $byear;
    protected function afterFind() { // public function beforeGetter() ? 
            list($this->byear, $this->bmonth, $this->bday) = explode('-', $this->birthday);
            $this->bday=intval($this->bday);
            $this->bmonth=intval($this->bmonth);
            return parent::afterFind();
    }
    protected function beforeValidate() {
            $this->birthday = date('Y-m-d',strtotime($this->bday.'-'.$this->bmonth.'-'.$this->byear));
            return parent::beforeValidate();
    }
	
}