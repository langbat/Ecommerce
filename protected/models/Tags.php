<?php

/**
 * This is the model class for table "tags".
 *
 * The followings are the available columns in table 'tags':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $weight
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property TagsRelationship[] $tagsRelationships
 */
class Tags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tags the static model class
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
		return 'tags';
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
			array('name, slug', 'required'),
			array('weight', 'numerical', 'integerOnly'=>true),
			array('name, slug', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, slug, weight, created, updated', 'safe', 'on'=>'search'),
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
            'productTags' => array(self::HAS_MANY, 'ProductTags', 'tags_id'),
            /*'relProduct'=>array(self::MANY_MANY, 'Products', 'product_tags(tags_id,product_id)'),*/
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'name' => Yii::t('global', 'Name'),
			'slug' => Yii::t('global', 'Slug'),
			'weight' => Yii::t('global', 'Weight'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('weight',$this->weight);
		if ($this->created)
            $criteria->compare('DATE(created)',date('Y-m-d', strtotime($this->created)),true);
        if ($this->updated)
            $criteria->compare('DATE(updated)',date('Y-m-d', strtotime($this->updated)),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
              'defaultOrder'=>'id DESC',
            )
		));
	}

    public function getAllTag(){
        $allTag = Tags::model()->findAll();
        $result = array();
        if($allTag){
            foreach($allTag as $tags){
                $result[]= $tags['name'];
            }
        }
        return $result;
    }

    public function saveTags($tags,$product_id){
        foreach($tags as $tag){
            $checkExist = self::exists('name=:name',array(':name'=>$tag));
            $productTag =  new ProductTags();
            if($checkExist){
                $infoTag = $this->findByAttributes(array('name'=>$tag));
                $productTag->product_id = $product_id;
                $productTag->tags_id = $infoTag->id;
                $productTag->save();
                // Save weight on Tags
                //$weightTag = new Tags;
//                $weightTag->weight =  10;
//                //$weightTag->id = $infoTag->id;
//                $weightTag->save();
                
            } else {
                $newTags =  new Tags();
                $newTags->name = $tag;
                $newTags->slug= $tag;
                $newTags->save();
                $productTag->product_id = $product_id;
                $productTag->tags_id = $newTags->id;
                $productTag->save();
            }
        }
    }

    public function updateTags($tags,$product_id){
        $allProductTag = ProductTags::model()->getTagById($product_id);
        $mergeTags =  array_unique(array_merge($allProductTag,$tags));
        $taggedRemoves = array_diff($mergeTags,$tags);
        $taggedAdds = array_diff($mergeTags,$allProductTag);
        $this->saveTags($taggedAdds,$product_id);
        foreach($taggedRemoves as $taggedRemove){
             ProductTags::model()->getTagRemoved($product_id,$taggedRemove);
        }
    }
    
    public function listTags( $limit ){
       $table_tags = self::tableName();
       return Yii::app()->db->createCommand()
                                            ->select('id, name, slug, weight')
                                            ->from($table_tags)
                                            ->order('id DESC')
                                            ->limit( $limit )
                                            ->queryAll();
    }
   
}