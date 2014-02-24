<?php

/**
 * This is the model class for table "coupons".
 *
 * The followings are the available columns in table 'coupons':
 * @property integer $id
 * @property string $title
 * @property integer $type
 * @property integer $status
 * @property double $value
 * @property integer $total
 * @property integer $used
 * @property string $created
 * @property string $from_date
 * @property string $to_date
 *
 * The followings are the available model relations:
 * @property CouponCodes[] $couponCodes
 */
class Coupons extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Coupons the static model class
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
        return 'coupons';
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
            array('type, status, total, used', 'numerical', 'integerOnly'=>true),
            array('value', 'numerical'),
            array('title', 'length', 'max'=>512),
            array('created, from_date, to_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, type, status, value, total, used, created, from_date, to_date', 'safe', 'on'=>'search'),
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
            'couponCodes' => array(self::HAS_MANY, 'CouponCodes', 'coupon_id'),
            //'OrderItems' => array(self::HAS_MANY, 'OrderItems', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('global', 'ID'),
            'title' => Yii::t('global', 'Title'),
            'type' => Yii::t('global', 'Type'),
            'status' => Yii::t('global', 'Status'),
            'value' => Yii::t('global', 'Value'),
            'total' => Yii::t('global', 'Total'),
            'used' => Yii::t('global', 'Used'),
            'created' => Yii::t('global', 'Created'),
            'from_date' => Yii::t('global', 'From Date'),
            'to_date' => Yii::t('global', 'To Date'),
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

        $criteria->compare('id',$this->id);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('type',$this->type);
        $criteria->compare('status',$this->status);
        $criteria->compare('value',$this->value);
        $criteria->compare('total',$this->total);
        $criteria->compare('used',$this->used);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('from_date',$this->from_date,true);
        $criteria->compare('to_date',$this->to_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    ////////////////////////////////////////////////////////////////////
    const TYPE_FIXED_AMOUNT = 1;
    const TYPE_PERCENT_CART = 2;
    
    function getDiscount($amount){
        if ($this->type == self::TYPE_FIXED_AMOUNT)
            return $this->value;
            
        return $this->value * $amount / 100;
    }
    
    
    public function getMyCoupons($member_id)
    {
        $criteria=new CDbCriteria;
        $criteria->with = array('couponCodes');
        $criteria->together = true;
        $criteria->compare('couponCodes.user_id',$member_id);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
}