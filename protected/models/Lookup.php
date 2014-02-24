<?php

/**
 * This is the model class for table "lookup".
 *
 * The followings are the available columns in table 'lookup':
 * @property integer $id
 * @property string $name
 * @property integer $code
 * @property string $type
 * @property integer $position
 */
class Lookup extends CActiveRecord
{
    private static $_items = array();

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __class__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, position', 'required'),
            array(
                'code, position',
                'numerical',
                'integerOnly' => true),
            array(
                'name, type',
                'length',
                'max' => 128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, name, code, type, position',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'lookup';
    }

    /**
     * Returns the items for the specified type.
     * @param string item type (e.g. 'PostStatus').
     * @return array item names indexed by item code. The items are order by their position values.
     * An empty array is returned if the item type does not exist.
     */
    public static function items($type)
    {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return self::$_items[$type];
    }

    /**
     * Returns the item name for the specified type and code.
     * @param string the item type (e.g. 'PostStatus').
     * @param integer the item code (corresponding to the 'code' column value)
     * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
     */
    public static function item($type, $code)
    {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }

    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    private static function loadItems($type)
    {
        self::$_items[$type] = array();
        $models = self::model()->findAll(array(
            'condition' => 'type=:type',
            'params' => array(':type' => $type),
            'order' => 'position',
            ));
        foreach ($models as $model)
            self::$_items[$type][$model->code] = Yii::t('global', $model->name);
    }
    private static function loadItems_notTrans($type)
    {
        self::$_items[$type] = array();
        $models = self::model()->findAll(array(
            'condition' => 'type=:type',
            'params' => array(':type' => $type),
            'order' => 'position',
            ));
        foreach ($models as $model)
            self::$_items[$type][$model->code] = $model->name;
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('global', 'ID'),
            'name' => Yii::t('global', 'Name'),
            'code' => Yii::t('global', 'Code'),
            'type' => Yii::t('global', 'Type'),
            'position' => Yii::t('global', 'Position'),
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
        $criteria->addCondition('type ="HelpTopic"');
        $criteria->compare('id', $this->id);

        if (Yii::app()->language == 'de') {
            if (trim($this->name) != '') {
                $items = self::items('HelpTopic');
                $ids = array();
                foreach ($items as $key => $value) {
                    if (strpos($value, trim($this->name)) !== false) {
                        $ids[] = $key;
                    }
                }
                if (count($ids)) {
                    $criteria->addCondition('code IN (' . implode(',', $ids) . ')');
                } else {
                    $criteria->addCondition('code IN (0)');
                }
            }

        } else
            $criteria->compare('name', $this->name, true);

        $criteria->compare('code', $this->code);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('position', $this->position);

        //$criteria->order = 'position ASC';
        return new CActiveDataProvider(get_class($this), array('criteria' => $criteria, ));
    }
}
