<?php

/**
 * This is the model class for table "members".
 *
 * The followings are the available columns in table 'members':
 * @property integer $id
 * @property integer $parent_id
 * @property string $username
 * @property integer $gender
 * @property string $email
 * @property string $password
 * @property string $password2
 * @property string $sourcefrom
 * @property integer $coupon
 * @property integer $joined
 * @property string $data
 * @property string $passwordreset
 * @property string $role
 * @property string $ipaddress
 * @property string $seoname
 * @property integer $fbuid
 * @property string $fbtoken
 * @property string $fname
 * @property string $lname
 * @property string $birthday
 * @property string $photo
 * @property string $address
 * @property string $phone
 * @property string $vericode
 * @property integer $current_plan
 * @property string $street
 * @property string $nr
 * @property string $ext_information
 * @property integer $postcode
 * @property string $city
 * @property integer $country_id
 * @property string $shipping_street
 * @property string $shipping_nr
 * @property string $shipping_ext_information
 * @property integer $shipping_postcode
 * @property string $shipping_city
 * @property integer $shipping_country_id
 * @property string $shipping_fname
 * @property string $shipping_lname
 * @property string $shipping_phone
 * @property string $subcriber
 * @property string $accepted
 * @property integer $status
 * @property string $last_logged
 *
 * The followings are the available model relations:
 * @property AuctionViews[] $auctionViews
 * @property AuctionVotes[] $auctionVotes
 * @property Bids[] $bids
 * @property CouponCodes[] $couponCodes
 * @property Countries $shippingCountry
 * @property Countries $country
 * @property Transactions[] $transactions
 */
class Members extends CActiveRecord
{	
    public $password2;
    //public $password2;
    public $bday;
    public $bmonth;
    public $byear;
    public $shipping_country_id;
    public $accepted;
    public $subcriber;
    public $npassword2;
	/**
	 * Default member groups
	 */
	const ROLE_ADMIN = 'admin';
    const ROLE_MOD = 'moderator';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';
	const ROLE_GUEST = 'guest';
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Members the static model class
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
        return 'members';
    }
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email', 'email','checkMX'=>true),
            array('email, username', 'unique', 'on' => 'create' ),
            array('email, username', 'unique', 'on' => 'createadmin' ),
            array('email, username, country_id, password, role', 'required', 'on'=>'createadmin' ),
			array('gender, nr, city, country_id, lname, fname, street, username, birthday, accepted,email, password, postcode, password2', 'required', 'on' => 'create'),
			array('parent_id, gender, coupon, fbuid, postcode, country_id, shipping_country_id, current_plan, status', 'numerical', 'integerOnly'=>true),
			array('username, email, seoname, photo, address, city', 'length', 'max'=>155),
			array('password, passwordreset, fname, lname, phone, vericode', 'length', 'max'=>40),
			array('role, ipaddress', 'length', 'max'=>30),
			array('fbtoken, street, nr, ext_information, city', 'length', 'max'=>255),
			array('sourcefrom, data, birthday, last_logged', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, username, gender, email, password, sourcefrom, coupon, joined, data, passwordreset, role, ipaddress, seoname, fbuid, fbtoken, fname, lname, birthday, street, nr, ext_information, postcode, country_id, photo, address, city, phone, vericode, current_plan, status, last_logged', 'safe', 'on'=>'search'),
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
            'auctionJoins' => array(self::HAS_MANY, 'AuctionJoins', 'user_id'),
            'auctionViews' => array(self::HAS_MANY, 'AuctionViews', 'user_id'),
			'auctionVotes' => array(self::HAS_MANY, 'AuctionVotes', 'user_id'),
			'bids' => array(self::HAS_MANY, 'Bids', 'bidder_id'),
			'couponCodes' => array(self::HAS_MANY, 'CouponCodes', 'user_id'),
			'transactions' => array(self::HAS_MANY, 'Transactions', 'user_id'),
            'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
            'shipping_country' => array(self::BELONGS_TO, 'Countries', 'shipping_country_id'),
            'products' => array(self::HAS_MANY, 'Products', 'user_id'),
        
		);
        
        	
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
			'id' => Yii::t('global', 'ID'),
			'parent_id' => Yii::t('global', 'Parent'),
			'username' => Yii::t('global', 'Username'),
			'gender' => Yii::t('global', 'Gender'),
			'email' => Yii::t('global', 'Email'),
			'nemail' => Yii::t('global', 'New Email'),
            'nemail2' => Yii::t('global', 'Confirm New Email'),
			'password' => Yii::t('global', 'Password'),
            'npassword' => Yii::t('global', 'New Password'),
            'password2' => Yii::t('global', 'Confirm Password'),
            'npassword2' => Yii::t('global', 'New Confirm Password'),
			'sourcefrom' => Yii::t('global', 'How do you know about our website?'),
			'coupon' => Yii::t('global', 'Coupon'),
			'joined' => Yii::t('global', 'Joined'),
			'data' => Yii::t('global', 'Data'),
			'passwordreset' => Yii::t('global', 'Passwordreset'),
			'role' => Yii::t('global', 'Role'),
			'ipaddress' => Yii::t('global', 'Ipaddress'),
			'seoname' => Yii::t('global', 'Seoname'),
			'fbuid' => Yii::t('global', 'Fbuid'),
			'fbtoken' => Yii::t('global', 'Fbtoken'),
			'fname' => Yii::t('global', 'First Name'),
			'lname' => Yii::t('global', 'Last Name'),
			'birthday' => Yii::t('global', 'Birthday'),
			'street' => Yii::t('global', 'Street'),
			'nr' => Yii::t('global', 'Nr'),
			'ext_information' => Yii::t('global', 'Ext Information'),
			'postcode' => Yii::t('global', 'Postcode'),
			'country_id' => Yii::t('global', 'Country'),
            'shipping_country_id' => Yii::t('global', 'Country'),
			'photo' => Yii::t('global', 'Photo'),
			'address' => Yii::t('global', 'Address'),
			'city' => Yii::t('global', 'City'),
			'phone' => Yii::t('global', 'Phone'),
			'vericode' => Yii::t('global', 'Vericode'),
			'current_plan' => Yii::t('global', 'Current Plan'),
            'status' => Yii::t('global', 'Status'),
            'shipping_street' => Yii::t('global', 'Shipping Street'),
            'shipping_nr' => Yii::t('global', 'Shipping Nr'),
            'shipping_postcode' => Yii::t('global', 'Shipping Postcode'),
            'shipping_city' => Yii::t('global', 'Shipping City'),
            'last_logged' => Yii::t('global', 'Last Logged'),
		);
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function hashPassword( $password, $salt )
	{
		return sha1( md5('salt') . $password );
	}
	
    public function generatePassword($minLength=5, $maxLength=10)
	{
		$length=rand($minLength,$maxLength);

		$letters='bcdfghjklmnpqrstvwxyz';
		$vowels='aeiou';
		$code='';
		for($i=0;$i<$length;++$i)
		{
			if($i%2 && rand(0,10)>2 || !($i%2) && rand(0,10)>9)
				$code.=$vowels[rand(0,4)];
			else
				$code.=$letters[rand(0,20)];
		}

		return $code;
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
     
    public function beforeSave()
	{

		if( $this->isNewRecord ) {
			$this->joined = time();
			$this->ipaddress = Yii::app()->request->getUserHostAddress();
			//$this->vericode = $this->hashPassword( time(), $this->email );

            //copy address
            $this->shipping_street = $this->street;
            $this->shipping_nr = $this->nr;
            $this->shipping_ext_information = $this->ext_information;
            $this->shipping_postcode = $this->postcode;
            $this->shipping_city = $this->city;
            $this->shipping_country_id = $this->country_id;
            $this->shipping_fname = $this->fname;
            $this->shipping_lname = $this->lname;
            $this->shipping_phone = $this->phone;
		}
        else{
            if (strpos($this->joined, '.') !== false){
                $this->joined = strtotime($this->joined);
            }
        }


		if( $this->scenario == 'create' || $this->scenario == 'change' )
		{
			$this->password = $this->hashPassword( $this->password, $this->email );
		}

		if( ( $this->scenario == 'update' && $this->password ) )
		{
			//$this->password = $this->hashPassword( $this->password, $this->email );
		}

		// Make an seo name based on the username
		$this->seoname = Yii::app()->func->makeAlias( $this->username );

		// Save data array as serialized string
		if( is_array( $this->data ) && count( $this->data ) )
		{
			$this->data = serialize( $this->data );
		}

		return parent::beforeSave();
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('sourcefrom',$this->sourcefrom,true);
		$criteria->compare('coupon',$this->coupon);
        if($this->joined){
            $criteria->compare('DATE(FROM_UNIXTIME(joined))', date('Y-m-d', strtotime($this->joined)),true);
        }
		$criteria->compare('data',$this->data,true);
		$criteria->compare('passwordreset',$this->passwordreset,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('ipaddress',$this->ipaddress,true);
		$criteria->compare('seoname',$this->seoname,true);
		$criteria->compare('fbuid',$this->fbuid);
		$criteria->compare('fbtoken',$this->fbtoken,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('nr',$this->nr,true);
		$criteria->compare('ext_information',$this->ext_information,true);
		$criteria->compare('postcode',$this->postcode);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('vericode',$this->vericode,true);
		$criteria->compare('current_plan',$this->current_plan);
        $criteria->compare('status',0);
        if ($this->last_logged)
            $criteria->compare('DATE(last_logged)',date('Y-m-d', strtotime($this->last_logged)),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=> 't.id DESC'
            ),
		));
	}

    /**
	 * Check to make sure the role is valid
	 */
	public function checkRole()
	{
		$roles = Yii::app()->authManager->getRoles();
		$_temp = array();
		if( count($roles) )
		{
			foreach( $roles as $role )
			{
				$_temp[ $role->name ] = $role->name;
			}
		}

		if( !in_array($this->role, $_temp) )
		{
			$this->addError('role', Yii::t('adminmembers', 'Please select a valid role.'));
		}
	}

	/**
	 * Check that the email is unique
	 */
	public function checkUniqueEmailUpdate()
	{
		if( $this->scenario == 'update' )
		{
			$user = Members::model()->exists('email=:email AND id!=:id', array(':email'=>$this->email, ':id'=>$this->id));
			if( $user )
			{
				$this->addError('email', Yii::t('adminmembers', 'Sorry, That email is already in use by another member.'));
			}
		}
	}
	/**
	 * Check that the username is unique
	 */
	public function checkUniqueUserUpdate()
	{
		if( $this->scenario == 'update' )
		{
			$user = Members::model()->exists('username=:username AND id!=:id', array(':username'=>$this->username, ':id'=>$this->id));
			if( $user )
			{
				$this->addError('username', Yii::t('adminmembers', 'Sorry, That username is already in use by another member.'));
			}
		}
	}

	/**
	 * Simple yet efficient way for password hashing
	 */


	/**
	 * Generate a random readable password
	 */


	/**
	 * Save date and password before saving
	 */


	/**
	 * Get link to user
	 */
	public function getLink( $name, $id, $alias, $htmlOptions=array() )
	{
		return CHtml::link( CHtml::encode($name), array('/profile/' . $id . '-' . $alias, 'lang'=>false), $htmlOptions );
	}

	/**
	 * Get link to user - faster
	 */
	public function getModelLink( $htmlOptions=array() )
	{
		return $this->getLink( $this->username, $this->id, $this->seoname, $htmlOptions );
	}

    /**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @return either string or hash
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @return string
	 */
	public function getJoined()
	{
		return Yii::app()->dateFormatter->formatDateTime( $this->joined, 'short', '' );
	}

	/**
	 * @return array
	 */
	public function getMemberData()
	{
		return unserialize( $this->data );
	}

	/**
	 * Get member profile link
	 */
	public function getProfileLink()
	{
		return CHtml::link( $this->getDisplayName(), array($this->id . '-' . $this->seoname, 'lang'=>false ) );
	}

	public function getDisplayName()
	{
		return $this->fname . ' ' . $this->lname;
	}

	public function getVeriCode()
	{
		return $this->vericode;
	}



	public function resizeImage($url, $newurl, $maxW, $maxH)
	{
		list($width, $height, $type) = getimagesize($url);
		if($width == 0 || $height == 0) return false;

		if($type == 1 && $width <= $maxW && $height <= $maxH && Members::is_ani($url))
		{
			if(move_uploaded_file($url, $newurl)) return true;
			else return false;
		}

		list($newW, $newH) = Members::getNewSize($width, $height, $maxW, $maxH);

		$pg_tempt = imagecreatetruecolor($newW, $newH);
		$res = false;

		if($type == 1)
		{
			$pg_image = imagecreatefromgif($url);

			$transparent_index = imagecolortransparent($pg_image);
			imagepalettecopy($pg_image, $pg_tempt);
			imagefill($pg_tempt, 0, 0, $transparent_index);
			imagecolortransparent($pg_tempt, $transparent_index);
			imagetruecolortopalette($pg_tempt, true, 256);

			imagecopyresampled($pg_tempt, $pg_image, 0, 0, 0, 0, $newW, $newH, $width, $height);
			if(imagegif($pg_tempt, $newurl)) $res = true;
			imagedestroy($pg_image);
		}
		elseif($type == 2)
		{
			$pg_image = imagecreatefromjpeg($url);
			imagecopyresampled($pg_tempt, $pg_image, 0, 0, 0, 0, $newW, $newH, $width, $height);
			if(imagejpeg($pg_tempt, $newurl, 85)) $res = true;
			imagedestroy($pg_image);
		}
		elseif($type == 3)
		{
			imagealphablending($pg_tempt, false);
			imagesavealpha($pg_tempt, true);
			$transparent_index = imagecolorallocatealpha($pg_tempt, 255, 255, 255, 127);
			imagefilledrectangle($pg_tempt, 0, 0, $newW, $newH, $transparent_index);

			$pg_image = imagecreatefrompng($url);
			imagecopyresampled($pg_tempt, $pg_image, 0, 0, 0, 0, $newW, $newH, $width, $height);
			if(imagepng($pg_tempt, $newurl)) $res = true;
			imagedestroy($pg_image);
		}
		else $res = false;

		imagedestroy($pg_tempt);
		return $res;
	}

	public function getNewSize($width, $height, $maxW, $maxH)
	{
		$newW = $width;
		$newH = $height;

		if($newW >= $maxW)
		{
			$newW = $maxW;
			$newH = $newW*$height/$width;
		}
		if($newH >= $maxH)
		{
			$newH = $maxH;
			$newW = $newH*$width/$height;
		}

		return array($newW, $newH);
	}

	public function is_ani($filename)
	{
		if(!($fh = @fopen($filename, 'rb'))) return false;
		$count = 0;

		while(!feof($fh) && $count < 2)
			$chunk = fread($fh, 1024 * 100);
			$count += preg_match_all('#\x00\x21\xF9\x04.{4}\x00\x2C#s', $chunk, $matches);
		fclose($fh);
		return $count > 1;
	}

	public function getStarted()
	{
		$myplan = $this->getPlan();

		if($this->vericode != '')
		{
			Yii::app()->user->setFlash('error', Yii::t('index', 'You must verify your email address first.'));
			Yii::app()->getController()->redirect(Yii::app()->homeUrl.'verify');
		}
		elseif($myplan->id == 0)
		{
			Yii::app()->user->setFlash('error', Yii::t('index', 'You must buy a plan!.'));
			Yii::app()->getController()->redirect(Yii::app()->homeUrl.'buy-a-plan');
		}

	}


	public function countMsg()
	{
		if(!Yii::app()->user->isGuest && $user = Members::model()->findByPk(Yii::app()->user->id))
		{
			if($count = UserMessages::model()->countByAttributes(array('to_user'=>$user->id, 'read'=>0))) return $count;
		}
		return 0;
	}


    //function
    function getBalance($user_id = 0){
        if ($user_id == 0) $user_id = Yii::app()->user->id;
        if (!$user_id) return 0;

        return Yii::app()->db->createCommand()
                ->select('SUM(amount) as balance')
                ->from('transactions')
                ->where('paymentstatus = '.Transactions::STATUS_APPROVED.' AND user_id = ' . $user_id)
                ->queryScalar();
    }


    function getShippingAddress($glue = ', '){
        $address = array();
        if ($this->shipping_street != '') $address[] = $this->shipping_street;
        if ($this->shipping_nr != '') $address[] = $this->shipping_nr;
        if ($this->shipping_ext_information != '') $address[] = $this->shipping_ext_information;
        if ($this->shipping_postcode != '') $address[] = $this->shipping_postcode;
        if ($this->shipping_city != '') $address[] = $this->shipping_city;
        if ($this->shipping_country_id != '' || $this->shipping_country_id != 0 ) $address[] = $this->shipping_country->short_name;
        $address = implode($glue, $address);
        if ($this->shipping_phone != '')
            $address .= '. '. Yii::t('global', 'Phone'). ': '. $this->shipping_phone;
        return $address;
    }

    function getBillingAddress($glue = ', '){
        $address = array();
        if ($this->street != '') $address[] = $this->street;
        if ($this->nr != '') $address[] = $this->nr;
        if ($this->ext_information != '') $address[] = $this->ext_information;
        if ($this->postcode != '') $address[] = $this->postcode;
        if ($this->city != '') $address[] = $this->city;
        if ($this->country != '' || $this->country != 0 ) $address[] = $this->country->short_name;
        $address = implode($glue, $address);

        if ($this->phone != '')
            $address .= '. '. Yii::t('global', 'Phone'). ': '. $this->phone;
        return $address;
    }

    function getFullname(){
        return $this->fname .' '.$this->lname;
    }

    function getShippingFullname(){
        return $this->shipping_fname .' '.$this->shipping_lname;
    }

    function afterFind(){
        $this->joined = date('d.m.Y', $this->joined);
        return parent::afterFind();
    }
    function checkExistUser($username){
             return Members::model()->find(array(
                    'select'=>'username',
                    'condition'=>'username=:username',
                    'params'=>array(':username'=>$username))
            );
    }
    function getFormatDate($date){
        if($date<10)
            return "0".$date;
        return $date;
    }

    function checkRoleLogin($username){
        $role = Members::model()->findByAttributes(array('username'=>$username));
        if($role===null){
            $role = Members::model()->findByAttributes(array('email'=>$username));
        }
        if($role->role == 'guest')
            return false;
        return true;
    }

     function getUser( $id ){
        $result = Members::model()->find(array(
                    'select'=>'username',
                    'condition'=>'id=:id',
                    'params'=>array( ':id'=>$id ) )
            );

          return  $result['username'];
    }
    function updateStatusOnline(){
        $table_members = $this->tableName();
        Yii::app()->db->createCommand()
                ->update($table_members,
                            array( 'last_logged'=> new CDbExpression('NOW()') ),
                            'id=:id', array( ':id'=>Yii::app()->user->id )
                         );
    }

    function checkStatusUserOnline( $user_id ){
        $sql = " SELECT username FROM members WHERE last_logged > NOW()-60 AND id ='$user_id' ";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ( $res as $result ){
            $username = $result['username'];
        }
        error_reporting(0);
        if( $username != '' )
            $viewStatus = Yii::t('global', 'Yes');
        else
            $viewStatus = Yii::t('global', 'No');
        return $viewStatus;
    }
    function evaluationMember( ){
        $sqlcount = "SELECT COUNT(id) FROM(";
        $sql = "SELECT mem.username, mem.joined, mem.fname,mem.lname, YEAR(mem.birthday) AS yearbirth, mem.address, mem.short_name,mem.last_logged,bidstransactions.* FROM (
	SELECT SUM(tr.amount) balance,c.*
	FROM(
		SELECT v.*,k.payment
		FROM
		(
			SELECT a.id,a.totalbid,b.freebid,@half:=0 AS haftfreebid,@special:=0 AS specialbid,(a.totalbid - IFNULL(b.freebid,0) ) AS Revenue,a.win
			FROM
				(SELECT me.id, COUNT(tr.id) AS Totalbid,SUM(tr.is_win) AS win
					FROM members me
					LEFT JOIN bids tr ON me.id= tr.bidder_id
					GROUP BY me.id ) AS a
				LEFT JOIN
				(
					SELECT COUNT(TYPE) AS freebid,bidder_id
					FROM bids
					WHERE TYPE = 2 GROUP BY bidder_id,TYPE ) AS b
				ON a.id = b.bidder_id) AS v
				LEFT JOIN
				(
				SELECT SUM(amount)*-1 AS payment,user_id
				FROM transactions
				WHERE transactiontype =3
				GROUP BY user_id) AS k
				ON v.id = k.user_id
	      ) AS c
	LEFT JOIN transactions tr
	ON c.id = tr.user_id
	GROUP BY c.id
	) AS bidstransactions
INNER JOIN
(SELECT member.id,member.username,member.joined, member.fname,member.lname, member.birthday, member.address, member.country_id, member.last_logged, country.short_name FROM
members member
INNER JOIN countries country
ON member.country_id = country.id) AS mem
ON bidstransactions.id = mem.id";

        //filter here
        $where = ' WHERE 1';
        if (isset($_GET['username'])){
            $where .= " AND username LIKE '%{$_GET['username']}%'";
        }
        if (isset($_GET['name'])){
            $where .= " AND CONCAT(fname, ' ', lname) LIKE '%{$_GET['name']}%'";
        }


        $sql .= $where;

        $sqlcount       .= $sql." ) AS a";
        $count          =   Yii::app()->db->createCommand($sqlcount)->queryScalar();
        $dataProvider   =   new CSqlDataProvider( $sql, array(
            'totalItemCount'=>$count,
            'sort'=>array(
            'attributes'=>array(
                    'username', 'balance', 'totalbid', 'freebid', 'win', 'payment', 'joined', 'fname', 'lname', 'yearbirth', 'address','short_name','Revenue','last_logged'
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        return  $dataProvider;
    }

    function getUserFrontEnd( $id, $rank ){
        $result = Members::model()->find(array(
                    'select'=>'username',
                    'condition'=>'id=:id',
                    'params'=>array( ':id'=>$id ) )
            );

          if($rank == 1)
            return '<span class="fix-rangBid">'.$result['username'].'</span>';
          else if( $id == Yii::app()->user->id )
            return '<span class="fix-rangNewBid">'.$result['username'].'</span>';
          else
            return $result['username'];
    }

    public function searchEvaluation()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;
        $criteria->compare('username',$this->username);
        $criteria->compare('balance',$this->balance);
        $criteria->compare('totalbid',$this->totalbid);
        $criteria->compare('freebid',$this->freebid);
        $criteria->compare('Revenue',$this->Revenue);
        $criteria->compare('win',$this->win,true);
        $criteria->compare('payment',$this->payment);
        $criteria->compare('joined',$this->joined);
        $criteria->compare('fname',$this->fname);
        $criteria->compare('lname',$this->lname);
        $criteria->compare('yearbirth',$this->yearbirth,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('short_name',$this->short_name);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    function getActivityAuctionsbyMem( $user_id = 0, $is_end = 0 ){
        $sql = "SELECT * FROM(
                    SELECT lista.*,products.name FROM(
                    SELECT auction_id,bidder_id,price,created,SUM(sumofbid) AS total,is_win,product_id FROM(
                    SELECT auction_id,bidder_id,price,bids.created,IF(bidder_id = '$user_id', 1, 0) AS sumofbid,is_win,product_id
                    FROM bids
                    INNER JOIN auctions
                    ON bids.auction_id = auctions.id
                    ORDER BY bids.id DESC
                    ) AS b
                    GROUP BY b.auction_id
                    HAVING b.bidder_id = '$user_id' ) AS lista
                    LEFT JOIN products
                    ON lista.product_id = products.id
                    WHERE lista.is_win = '$is_end'
                    ORDER BY created DESC ) AS activityAuction
                ";

        $dataProvider   =   new CSqlDataProvider( $sql, array(
            'sort'=>array(
            'attributes'=>array(
                    'price', 'total','name','created'
                ),
            ),
        ));
        return  $dataProvider;
    }

    function getAge(){
        if ($this->birthday == '0000-00-00' || $this->birthday== '1970-01-01')
            return '';

        $dob = date("Y-m-d",strtotime($this->birthday));

        $dobObject = new DateTime($dob);
        $nowObject = new DateTime();

        $diff = $dobObject->diff($nowObject);
        return $diff->y;
    }

    function getUsernameShop(){
        $tablemember = $this->tableName();
        return Yii::app()->db->createCommand()
                                        ->select('id,username')
                                        ->from($tablemember)
                                        ->queryAll();
    }

    function saveGuestMember($data){
        $guestMember = new Members();
        $guestMember->role = 'guest';
        $guestMember->email = $data['email'];
        $guestMember->fname =  $data['fname'];
        $guestMember->lname = $data['lname'];
        $guestMember->street = $data['street'];
        $guestMember->nr = $data['nr'];
        $guestMember->ext_information = $data['ext_information'];
        $guestMember->postcode = $data['postcode'];
        $guestMember->city = $data['city'];
        $guestMember->country_id = $data['country_id'];
        $guestMember->phone = $data['phone'];
        if($guestMember->save()){
            $guestMember->username = 'Guest'.$guestMember->id;
            $guestMember->save();
            Yii::app()->session['guest_acount'] =$guestMember->id;
        }
    }

    function saveGuestMemberWithShipping($data){
        $guestMember = new Members();
        $guestMember->role = 'guest';
        $guestMember->country_id = $data['country_id'];
        $guestMember->email = $data['email'];
        $guestMember->fname = $data['fname'];
        $guestMember->lname =  $data['lname'];
        $guestMember->street = $data['street'];
        $guestMember->nr = $data['nr'];
        $guestMember->ext_information =$data['ext_information'];
        $guestMember->postcode = $data['postcode'];
        $guestMember->city = $data['city'];
        $guestMember->phone = $data['phone'];
        if($guestMember->save()){
            $guestMember->username = 'Guest'.$guestMember->id;
            $guestMember->shipping_fname = $data['shipping_fname'];
            $guestMember->shipping_lname = $data['shipping_lname'];
            $guestMember->shipping_street = $data['shipping_street'];
            $guestMember->shipping_nr =$data['shipping_nr'];
            $guestMember->shipping_ext_information =$data['shipping_ext_information'];
            $guestMember->shipping_postcode =$data['shipping_postcode'];
            $guestMember->shipping_city =$data['shipping_city'];
            $guestMember->shipping_country_id =$data['shipping_country_id'];
            $guestMember->shipping_phone =$data['shipping_phone'];
            $guestMember->save();
            Yii::app()->session['guest_acount'] =$guestMember->id;

        }
    }

    function updateAddress($data){
        $id = isset(Yii::app()->user->id)?Yii::app()->user->id:Yii::app()->session['guest_acount'];
        $updateUser = Members::model()->findByPk($id);
        $updateUser->attributes = $data;
        $updateUser->shipping_street = $data['shipping_street'];
        $updateUser->shipping_nr = $data['shipping_nr'];
        $updateUser->shipping_ext_information = $data['shipping_ext_information'];
        $updateUser->shipping_postcode = $data['shipping_postcode'];
        $updateUser->shipping_city = $data['shipping_city'];
        $updateUser->shipping_country_id =  $data['shipping_country_id'];
        $updateUser->shipping_fname = $data['shipping_fname'];
        $updateUser->shipping_lname = $data['shipping_lname'];
        $updateUser->shipping_phone =  $data['shipping_phone'];
        $updateUser->save();
    }
    public function getEmails($id){
       $result = Members::model()->find(array(
                    'select'=>'email',
                    'condition'=>'id=:id',
                    'params'=>array( ':id'=>$id ) )
            );

          return  $result['email'];
    }
    public function getUsers($id){
       $result = Members::model()->find(array(
                    'select'=>'username',
                    'condition'=>'id=:id',
                    'params'=>array( ':id'=>$id ) )
            );

          return  $result['username'];
    }
}