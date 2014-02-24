<?php

/**
 * This is the model class for table "tokbox_archive".
 *
 * The followings are the available columns in table 'tokbox_archive':
 * @property integer $id
 * @property integer $user_id
 * @property string $created
 * @property string $archive_id
 * @property string $session_id
 * @property integer $stopped
 *
 * The followings are the available model relations:
 * @property Members $user
 */
class TokboxArchive extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TokboxArchive the static model class
     */
    public $username;
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tokbox_archive';
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
            array('user_id, stopped', 'numerical', 'integerOnly'=>true),
            array('archive_id', 'length', 'max'=>64),
            array('session_id', 'length', 'max'=>128),
            array('created', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, created, archive_id, session_id, stopped, username', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'Members', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('global', 'ID'),
            'user_id' => Yii::t('global', 'User'),
            'created' => Yii::t('global', 'Created'),
            'archive_id' => Yii::t('global', 'Archive'),
            'session_id' => Yii::t('global', 'Session'),
            'stopped' => Yii::t('global', 'Stopped'),
            'username' => Yii::t('global', 'Username'),
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
        $criteria->with = "user";
        $criteria->compare('t.id',$this->id);
        $criteria->compare('user.username',$this->username,true);
        $criteria->compare('user_id',$this->user_id);
        if($this->created){
            $criteria->compare('t.created',date('Y-m-d', strtotime($this->created)),true);
        }
        $criteria->compare('archive_id',$this->archive_id,true);
        $criteria->compare('session_id',$this->session_id,true);
        $criteria->compare('stopped',1);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' =>array(
                'defaultOrder'=>'created DESC',
                'attributes'=>array(
                    'username'=>array(
                        'asc'=>'user.username',
                        'desc'=>'user.username DESC'
                    ),
                    '*'
                )
            )
        ));
    }
    
    function viewVideo(){
        return '<a href="javascript:void(0)" onclick="viewVideo(\''.$this->archive_id.'\', \''.$this->session_id.'\')"><img src="/assets/images/view.png" /></a>';
    }
    
}