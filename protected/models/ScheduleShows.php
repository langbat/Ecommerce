<?php

/**
 * This is the model class for table "schedule_shows".
 *
 * The followings are the available columns in table 'schedule_shows':
 * @property integer $id
 * @property string $start_time
 * @property string $end_time
 * @property integer $product_id
 * @property string $content
 *
 * The followings are the available model relations:
 * @property Products $product
 */
class ScheduleShows extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ScheduleShows the static model class
     */
    public static function model($className = __class__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public $product_name;
    public function tableName()
    {
        return 'schedule_shows';
    }
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' =>
                    'ext.DateTimeI18NBehavior'));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('start_time, end_time, product_id, content', 'required'),
            array(
                'product_id',
                'numerical',
                'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, start_time, end_time, product_id, content,product_name',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('product' => array(
                self::BELONGS_TO,
                'Products',
                'product_id'), );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('global', 'ID'),
            'start_time' => Yii::t('global', 'Start Time'),
            'end_time' => Yii::t('global', 'End Time'),
            'product_id' => Yii::t('global', 'Product'),
            'content' => Yii::t('global', 'Content'),
            'product_name' => Yii::t('global', 'Product name'),
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

        $criteria = new CDbCriteria;
        $criteria->with = array('product');
        $criteria->compare('t.id', $this->id);
        if ($this->start_time)
            $criteria->compare('DATE(t.start_time)', date('Y-m-d', strtotime($this->
                start_time)));
        //$criteria->compare('',$this->start_time);
        if ($this->end_time)
            $criteria->compare('DATE(t.end_time)', date('Y-m-d', strtotime($this->end_time)));
        //	$criteria->compare('t.end_time',$this->end_time,true);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('product.name', $this->product_name);
        $criteria->compare('content', $this->content, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    public function getSchedule($product_id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'product_id=' . $product_id;
        return new CActiveDataProvider($this, array('criteria' => $criteria, 'sort' =>
                array('defaultOrder' => 'start_time ASC', )));
    }
    public function checkSchedule($id)
    {
        $getSchedule = self::model()->findAll(array('condition' => 'product_id=:id',
                'params' => array(':id' => $id)));
        $result = array(
            'check' => 0,
            'time' => 0,
            'counttime' => 0);
        if ($getSchedule) {
            foreach ($getSchedule as $item) {
                if (strtotime($item['start_time']) <= time() && strtotime($item['end_time']) >
                    time()) {
                    $time = (strtotime($item['end_time']) - time()) * 1000;
                    $result = array(
                        'check' => 1,
                        'time' => $time,
                        'counttime' => 1);
                    //break;
                } else {
                    if (time() < strtotime($item['start_time'])) {
                        if ($result['counttime'] == 1) {
                            $result['counttime'] = (strtotime($item['start_time']) - time());
                            break;
                        } else {
                            $time = (strtotime($item['start_time']) - time()) * 1000;
                            $counttime = (strtotime($item['start_time']) - time());
                            $result = array(
                                'check' => 0,
                                'time' => $time,
                                'counttime' => $counttime);
                            break;
                        }
                    }
                }
            }
            /*foreach($getSchedule as $item){
            if(time() < strtotime($item['start_time'])) {
            $result['counttime'] = (strtotime($item['start_time'])-time());
            break;
            }
            }*/
        }
        return $result;
    }
}
