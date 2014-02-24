<?php

/**
 * This is the model class for table "categories_shop".
 *
 * The followings are the available columns in table 'categories_shop':
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $alias
 * @property string $created
 * @property string $updated
 * 
 * The followings are the available model relations:
 * @property Categories $parent
 * @property Categories[] $categories
 */
class CategoriesShop extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CategoriesShop the static model class
	 */
     public $categoryshop;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'categories_shop';
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
			array('name', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('name, alias', 'length', 'max'=>255),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, parent_id, alias, created, updated', 'safe', 'on'=>'search'),
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
            'parent' => array(self::BELONGS_TO, 'CategoriesShop', 'parent_id'),
    		'categories' => array(self::HAS_MANY, 'CategoriesShop', 'parent_id'),
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('alias',$this->alias,true);
		if ($this->created)
		    $criteria->compare('created',date('Y-m-d ', strtotime($this->created)),true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'t.id DESC',
            ),
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
                $result .= '<li class="'.$class.'"><a href="/products/category/'.$arr['alias'].'"><span>'.Yii::t('global', $arr['name']).'</span></a>';
            else
                $result .= '<li class="'.$class.'"><a href="/products/category/'.$arr['alias'].'">'.Yii::t('global', $arr['name']).'</a>';
                
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

        public function getAllCategoryShop(){
            $allCategory = self::model()->findAll('parent_id != 0');
            $category = array();
            foreach($allCategory as $item) {
                $category[$item['id']]=$item['name'];
            }
            return $category;
        }
        public function getCategoryShopByShopId($shop_id){
            $productshop = ProductsShop::model()->checkProductsShop($shop_id);
            $result = array();
    		foreach ($productshop as $key => $item) {
    			$result[]=$item['id'];
    		}
            $sql = 'SELECT product_categories_shop.category_id
            FROM product_categories_shop INNER JOIN products_shop
            WHERE products_shop.id IN ('. implode(", ",$result). ') GROUP BY product_categories_shop.category_id';
            
            $idcategoryshop = ProductCategoriesShop::model()->findAllBySql($sql);
            $result1 = array();
    		foreach ($idcategoryshop as $key => $item) {
    			$result1[]=$item['category_id'];
    		}
            $sql2 = 'SELECT categories_shop.id, categories_shop.name FROM categories_shop INNER JOIN product_categories_shop where categories_shop.id IN ('. implode(", ",$result1). ') GROUP BY categories_shop.id';
            $categoryshop = CategoriesShop::model()->findAllBySql($sql2);
            return $categoryshop;
      }
      public function getid($arr){
            $arr1 = array();
            if(count($arr) > 1){
                foreach($arr as $key => $item){
                    $arr1[]= $item['id'];
                }
                return $arr1;
            }else{
                foreach($arr as $key => $item){
                    $id = $item['id'];
                }
                return $id;
            }
      }
      public function checkexit($array, $shop_id){
            $check = self::model()->getid($array);
            if(!is_array($check)){
                $tmp = $check;
            }else{
                $tmp = $check[0];
            }
            $sql = "SELECT categories_shop.id, categories_shop.name FROM product_categories_shop INNER JOIN products_shop
                ON product_categories_shop.product_id = products_shop.id
                INNER JOIN categories_shop ON categories_shop.id = product_categories_shop.category_id
                WHERE categories_shop.id !=". $tmp ." and products_shop.shop_id = ".$shop_id. " GROUP BY categories_shop.id";
            return Yii::app()->db->createCommand($sql)->queryAll();
      }
         public function getArrayCategoryByProduct($product_ids){
   
            $sql = "SELECT categories_shop.id, categories_shop.name, COUNT(categories_shop.id) AS totalproduct
                FROM categories_shop
                LEFT JOIN product_categories_shop
                ON categories_shop.id = product_categories_shop.category_id
                INNER JOIN products_shop
                ON product_categories_shop.product_id = products_shop.id
                WHERE products_shop.is_active  = 1 AND products_shop.id IN (".implode(',' , ($product_ids)? $product_ids: array(0)).")
                GROUP BY categories_shop.id, categories_shop.name
                ORDER BY totalproduct desc";
                 $allCategory = Yii::app()->db->createCommand($sql)->queryAll();
                 $category = array();
                foreach($allCategory as $item) {
                    $category['_'.$item['id']]=$item['name'].' ('.ProductCategoriesShop::model()->getProductOfCategory($product_ids,$item['id']).')';
                }
                        //var_dump($category);exit();
                return $category;
        }
}