<?php

/**
 * This is the model class for table "blogshop".
 *
 * The followings are the available columns in table 'blogshop':
 * @property integer $id
 * @property string $category_name
 * @property integer $shop_id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $alias
 * @property string $language
 * @property string $metadesc
 * @property string $metakeys
 * @property integer $views
 * @property integer $rating
 * @property integer $totalvotes
 * @property integer $status
 * @property integer $authorid
 * @property integer $postdate
 * @property integer $last_updated_date
 * @property integer $last_updated_author
 * @property string $image
 */
class Blogshop extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Blogshop the static model class
	 */
    public $shopname; 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'blogshop';
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
			array('title, title, description, content', 'required'),
			array('shop_id, views, rating, totalvotes, status, authorid, last_updated_date, last_updated_author', 'numerical', 'integerOnly'=>true),
			array('category_name, title, description, metadesc, metakeys', 'length', 'max'=>255),
            array('created_blog', 'safe'),
			array('alias', 'length', 'max'=>125),
			array('language', 'length', 'max'=>3),
			array('image', 'length', 'max'=>150),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_name, shop_id, created_blog, title, description, content, alias, language, metadesc, metakeys, views, rating, totalvotes, status, authorid, postdate, last_updated_date, last_updated_author, image', 'safe', 'on'=>'search'),
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
            	'shop' => array(self::BELONGS_TO, 'MemberShop', 'shop_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'category_name' => Yii::t('global', 'Category Name'),
			'shop_id' => Yii::t('global', 'Shop'),
			'title' => Yii::t('global', 'Title'),
			'description' => Yii::t('global', 'Description'),
			'content' => Yii::t('global', 'Content'),
			'alias' => Yii::t('global', 'Alias'),
			'language' => Yii::t('global', 'Language'),
			'metadesc' => Yii::t('global', 'Metadesc'),
			'metakeys' => Yii::t('global', 'Metakeys'),
			'views' => Yii::t('global', 'Views'),
			'rating' => Yii::t('global', 'Rating'),
			'totalvotes' => Yii::t('global', 'Totalvotes'),
			'status' => Yii::t('global', 'Status'),
			'authorid' => Yii::t('global', 'Authorid'),
			'postdate' => Yii::t('global', 'Postdate'),
			'last_updated_date' => Yii::t('global', 'Last Updated Date'),
			'last_updated_author' => Yii::t('global', 'Last Updated Author'),
			'image' => Yii::t('global', 'Image'),
            'created_blog' => Yii::t('global', 'Created'),
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
        $criteria->together = true;
        $criteria->with = array('shop');
        
		$criteria->compare('t.id',$this->id);
		$criteria->compare('category_name',$this->category_name,true);
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('metadesc',$this->metadesc,true);
		$criteria->compare('metakeys',$this->metakeys,true);
		$criteria->compare('views',$this->views);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('totalvotes',$this->totalvotes);
		$criteria->compare('status',$this->status);
		$criteria->compare('authorid',$this->authorid);
        if ($this->created_blog)
            $criteria->compare('DATE(created_blog)',date('Y-m-d', strtotime($this->created_blog)),true);
		$criteria->compare('last_updated_date',$this->last_updated_date);
		$criteria->compare('last_updated_author',$this->last_updated_author);
		$criteria->compare('image',$this->image,true);
        $criteria->compare('shop.name',$this->shopname);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
             'sort'=>array(
                'defaultOrder'=>'t.id DESC',
                 'attributes'=>array(
                    'shopname'=>array(
                        'asc'=>'shop.name',
                        'desc'=>'shop.name DESC',
                    ),
                    '*',
                ),
            ),
		));
	}
     public function getBlogShop($id_shop){
         $blogshop = new CActiveDataProvider('Blogshop', array(
                'criteria' => array(
                    'condition' => 'shop_id='.$id_shop,
                    'order'=>'id DESC',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
            )
            ));
         return $blogshop;
    }
    public function getBlogShopDetail($blog_id){
        $result = Blogshop::model()->find(array(
            'select'=>'*',
            'condition'=>'id=:id',
            'params'=>array(':id'=>$blog_id),
        ));
        return $result;
    }
    function showAdminImage(){
        return '<a class="fancybox" href="/uploads/blogshop/'.$this->image.'" rel="group">
                    <img class="img-polaroid fix_image_products" src="/uploads/blogshop/'.$this->image.'" style="height: 40px;"/>
                </a>';
    }
    public function getAllBlogShop($shop_id){
        $sql = "SELECT * FROM blogshop WHERE shop_id = ".$shop_id."";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    public function checkBlogShop($id_member, $id_blogshop){
        $sql =  "SELECT * FROM blogshop WHERE id = ".$id_blogshop." AND shop_id = ".$id_member."";
        $blogshop = Yii::app()->db->createCommand($sql)->queryAll();
        if($blogshop == null){
            return false;
        }else{
            return true;
        }
    }
}