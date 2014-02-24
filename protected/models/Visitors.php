<?php

/**
 * This is the model class for table "visitors".
 *
 * The followings are the available columns in table 'visitors':
 * @property string $date
 * @property integer $page_views
 * @property integer $visitors
 */
class Visitors extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Visitors the static model class
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
		return 'visitors';
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
			array('date', 'required'),
			array('page_views, visitors', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('date, page_views, visitors', 'safe', 'on'=>'search'),
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
			'date' => Yii::t('global', 'Date'),
			'page_views' => Yii::t('global', 'Page Views'),
			'visitors' => Yii::t('global', 'Visitors'),
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

		$criteria->compare('date',$this->date,true);
		$criteria->compare('page_views',$this->page_views);
		$criteria->compare('visitors',$this->visitors);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    function run(){
        $model = self::model()->findByAttributes(array('date' => date('Y-m-d')));
        if (!$model){
            $model = new Visitors;
            $model->date = date('Y-m-d');
            $model->visitors = 0;
            $model->page_views = 0;
            $model->save();
            
        }
        if (!isset(Yii::app()->session['visited'])){
            Yii::app()->session['visited'] = true;
            $model->visitors += 1;
        }
        
        if (!Yii::app()->request->isAjaxRequest){
            $model->page_views += 1;
        }
        $model->save();
        
    }
}