<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $alias
 *
 * The followings are the available model relations:
 * @property AuctionCategories[] $auctionCategories
 * @property Categories $parent
 * @property Categories[] $categories
 */
class Categories extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categories the static model class
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
		return 'categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('name, alias', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, parent_id, alias', 'safe', 'on'=>'search'),
            array('alias', 'CheckUniqueAlias'),
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
			'auctionCategories' => array(self::HAS_MANY, 'AuctionCategories', 'category_id'),
			'parent' => array(self::BELONGS_TO, 'Categories', 'parent_id'),
			'categories' => array(self::HAS_MANY, 'Categories', 'parent_id'),
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
			'parent_id' => Yii::t('global', 'Parent'),
			'alias' => Yii::t('global', 'Alias'),
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('alias',$this->alias,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,

		));
	}
    
    /**
	 * Check alias and language combination
	 */
	public function CheckUniqueAlias()
	{
		if( $this->isNewRecord )
		{
			// Check if we already have an alias with those parameters
			if( self::model()->exists('alias=:alias', array(':alias' => $this->alias) ) ){
				$this->alias .= '-1';
                $this->CheckUniqueAlias();
			}
		}
		else
		{
			// Check if we already have an alias with those parameters
			if( self::model()->exists('alias=:alias AND id!=:id', array( ':id' => $this->id, ':alias' => $this->alias ) ) )			{
                $this->alias .= '-1';
				$this->CheckUniqueAlias();
			}
		}
	}
    
    /**
	 * Before save operations
	 */
	public function beforeSave()
	{
		$this->alias = strtolower(str_replace(' ', '-', $this->name));
        $this->alias = strtolower(str_replace(array('+', '&'), '', $this->alias));
        	
		return parent::beforeSave();
	}
	
	/**
	 * after save method
	 */
	public function afterSave()
	{
		Yii::app()->urlManager->clearCache();
		
		return parent::afterSave();
	}
    
    function getTree(&$arr, $parent_id = 0){
        $models=self::model()->findAll(array(
			'condition'=>'parent_id=:parent_id',
			'params'=>array(':parent_id'=>$parent_id),
			'order'=>'name',
		));
		foreach($models as $model){
        	$arr[$model->id]['name']=$model->name;
            $arr[$model->id]['alias']=$model->alias;
            self::getTree($arr[$model->id]['childs'], $model->id);  
		}
    }
    
    function printTree($tree, $level = 1){
        $result = '';
        foreach ($tree as $id=>$arr){
            
            if ($level == 1){
                $class = count($arr['childs'])?'dropactive':'';
            }
            else{
                $class = count($arr['childs'])?'sub':'';
            }
            
            if (Yii::app()->controller->id == 'products' && Yii::app()->controller->action->id == 'category' && $_GET['alias'] == $arr['alias']){
                $class .= ' active';
            }
            
            if ($level == 1)
                $result .= '<li class="'.$class.'"><a href="/products/category/'.$arr['alias'].'"><span>'.Yii::t( 'global', $arr['name'] ).'</span></a>';
            else
                $result .= '<li class="'.$class.'"><a href="/products/category/'.$arr['alias'].'">'.Yii::t( 'global', $arr['name'] ).'</a>';
                
            if (isset($arr['childs']) && count($arr['childs'])){
                $class = '';
                if ($level == 1)  $class = 'dropdown droplevel0';
                else if ($level == 2) $class = 'droplevel droplevel1';
                
                $result .= '<ul class="'.$class.'">'.self::printTree($arr['childs'], $level+1).'</ul>';
            }
            $result .= '</li>';
        }
        
        return $result;
    }

    public function getAllCategory(){
        $allCategory = self::model()->findAll();
        $category = array();
        foreach($allCategory as $item) {
            $category[$item['id']]=$item['name'];
        }
        return $category;
    }
    
    public function getAllCategoryByProduct(){
        $sql = "SELECT categories.id, categories.name, COUNT(categories.id) AS totalproduct
                FROM categories
                LEFT JOIN product_categories
                ON categories.id = product_categories.category_id
                INNER JOIN products
                ON product_categories.product_id = products.id
                WHERE products.is_active  = 1
                GROUP BY categories.id, categories.name
                ORDER BY totalproduct desc";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    public function getArrayCategoryByProduct($product_ids){
        $sql = "SELECT categories.id, categories.name, COUNT(categories.id) AS totalproduct
                FROM categories
                LEFT JOIN product_categories
                ON categories.id = product_categories.category_id
                INNER JOIN products
                ON product_categories.product_id = products.id
                WHERE products.is_active  = 1 AND products.id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")
                GROUP BY categories.id, categories.name
                ORDER BY totalproduct desc";
        $allCategory = Yii::app()->db->createCommand($sql)->queryAll();
         $category = array();
        foreach($allCategory as $item) {
            $category[$item['id']]=$item['name'].' ('.ProductCategories::model()->getProductOfCategory($product_ids,$item['id']).')';
        }
        return $category;
    }
}