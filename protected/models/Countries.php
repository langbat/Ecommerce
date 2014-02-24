<?php

/**
 * This is the model class for table "countries".
 *
 * The followings are the available columns in table 'countries':
 * @property integer $id
 * @property string $iso2
 * @property string $short_name
 * @property string $long_name
 * @property string $iso3
 * @property string $numcode
 * @property string $un_member
 * @property string $calling_code
 * @property string $cctld
 * @property integer $is_active
 */
class Countries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Countries the static model class
	 */
    const YES = 1;
    const NO = 0;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'countries';
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
            array('is_active', 'numerical', 'integerOnly'=>true),
			array('iso2', 'length', 'max'=>2),
			array('short_name, long_name', 'length', 'max'=>80),
			array('iso3', 'length', 'max'=>3),
			array('numcode', 'length', 'max'=>6),
			array('un_member', 'length', 'max'=>12),
			array('calling_code', 'length', 'max'=>8),
			array('cctld', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, iso2, short_name, long_name, iso3, numcode, un_member, calling_code, cctld, is_active', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'iso2' => Yii::t('global', 'Iso2'),
			'short_name' => Yii::t('global', 'Short Name'),
			'long_name' => Yii::t('global', 'Long Name'),
			'iso3' => Yii::t('global', 'Iso3'),
			'numcode' => Yii::t('global', 'Numcode'),
			'un_member' => Yii::t('global', 'Un Member'),
			'calling_code' => Yii::t('global', 'Calling Code'),
			'cctld' => Yii::t('global', 'Cctld'),
            'is_active' => Yii::t('global', 'Active'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

        //$active = ($this->is_active == 'Yes' || $this->is_active == 'yes' || $this->is_active == 'ja' || $this->is_active == 'Ja'  )? self::YES:self::NO;
		$criteria->compare('id',$this->id);
		$criteria->compare('iso2',$this->iso2,true);
		$criteria->compare('short_name',$this->short_name,true);
		$criteria->compare('long_name',$this->long_name,true);
		$criteria->compare('iso3',$this->iso3,true);
		$criteria->compare('numcode',$this->numcode,true);
		$criteria->compare('un_member',$this->un_member,true);
		$criteria->compare('calling_code',$this->calling_code,true);
		$criteria->compare('cctld',$this->cctld,true);
        if($this->is_active){
            $criteria->compare('is_active',$this->is_active);
        }
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    function getActiveCountry($active){
        if($active == self::YES)
            return Yii::t('global','Yes');
        return Yii::t('global','No');
    }
    function getTranSlate($name,$is_active=null){
        if($is_active==1){
            return Yii::t('global',$name);
        } else {
            return $name;
        }

    }
}