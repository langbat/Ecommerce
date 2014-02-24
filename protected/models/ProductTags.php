<?php

/**
 * This is the model class for table "product_tags".
 *
 * The followings are the available columns in table 'product_tags':
 * @property integer $id
 * @property integer $product_id
 * @property integer $tags_id
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Tags $tags
 */
class ProductTags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductTags the static model class
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
		return 'product_tags';
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
			array('product_id, tags_id', 'numerical', 'integerOnly'=>true),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, tags_id, created, updated', 'safe', 'on'=>'search'),
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
			'tags' => array(self::BELONGS_TO, 'Tags', 'tags_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'product_id' => Yii::t('global', 'Product'),
			'tags_id' => Yii::t('global', 'Tags'),
			'created' => Yii::t('global', 'Created'),
			'updated' => Yii::t('global', 'Updated'),
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('tags_id',$this->tags_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTagById($id){
        $tags = $this->findAllByAttributes(array('product_id'=>$id));
        $result=array();
        if($tags){
            $result = array();
            foreach($tags as $tag){
                $result[]=$tag->tags->name;
            }
        }
        return $result;
    }

    public function getTagRemoved($product_id,$name){
        $criteria=new CDbCriteria;
        $criteria->with='tags';
        $criteria->condition = 'product_id='.$product_id.' AND tags.name="'.$name.'"';
        $tagRemoved = ProductTags::model()->find($criteria);
        $tagRemoved->delete();
    }
    
     function getIdsOfTagProducts( $tag_id ){
        $results = array();
        $ids = ProductTags::model()->findAllByAttributes(array('tags_id' => $tag_id));
        foreach ($ids as $id){
            $results[]  = $id->product_id;
        }
        return $results;
    }
    
}