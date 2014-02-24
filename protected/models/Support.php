

<?php

/**
 * This is the model class for table "support".
 *
 * The followings are the available columns in table 'support':
 * @property integer $id
 * @property integer $categories
 * @property string $title
 * @property string $content
 * @property string $description
 * @property string $linkyoutube
 * @property integer $is_highlight
 * @property string $date_create
 */
class Support extends CActiveRecord
{
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Support the static model class
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
		return 'support';
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
            array('categories, title, content, description', 'required'),
			array('categories, is_highlight', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('content, description, linkyoutube, date_create', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, categories, title, content, description, linkyoutube, is_highlight, date_create', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('global', 'ID'),
			'categories' => Yii::t('global', 'Categories'),
			'title' => Yii::t('global', 'Title'),
			'content' => Yii::t('global', 'Content'),
			'description' => Yii::t('global', 'Description'),
			'linkyoutube' => Yii::t('global', 'Video'),
			'is_highlight' => Yii::t('global', 'Is Highlight'),
			'date_create' => Yii::t('global', 'Date Create'),
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
		$criteria->compare('categories',$this->categories);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('linkyoutube',$this->linkyoutube,true);
		$criteria->compare('is_highlight',$this->is_highlight);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function getAllSupport(){
        return Support::findAllByAttributes(array('categories'=>'0'));
    }
    public function getisHighlight(){
      return  Support::findByAttributes(array('is_highlight'=>'1'),array('order'=>'id DESC'));
    }
    public function gettutorial(){
      return  Support::findByAttributes(array('categories'=>'2'),array('order'=>'id DESC'));
    }
    public function getImgFromVideo($video){
         if (preg_match('#(http://www.youtube.com)?/(v/([-|~_0-9A-Za-z]+)|watch\?v\=([-|~_0-9A-Za-z]+)&?.*?)#i',$video,$output) > 0)
          {
            // If it's in the video link format...
            return "<img src='http://img.youtube.com/vi/".$output[4]."/0.jpg' alt=' ' />";
          }
            else if (preg_match('(/embed/([a-z0-9A-Z]+))', $video, $output) > 0){
            // Otherwise, it's in the embed format
            return "<img src='http://img.youtube.com/vi/".$output[1]."/0.jpg' alt=' ' />";
            }else{
                $array = array(".","-"," ");
                $specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";
                for($i=0; $i<strlen($specialChars); $i++) 
                {
                    $array[]=$specialChars[$i];
                }
                 
                $name_replace = str_replace($array,'_',$video);
                return "
                   	<script type='text/javascript'>
                            $(document).ready(function() {
                            var video_$name_replace = document.getElementById('my_video_$name_replace');
                            var thecanvas_$name_replace = document.getElementById('thecanvas_$name_replace');
                            var image_video_$name_replace = document.getElementById('image_video_$name_replace');
                            video_$name_replace.addEventListener('pause', function(){
                                 draw( video_$name_replace, thecanvas_$name_replace,image_video_$name_replace); 
                            }, false);
                            setTimeout(function(){
                               video_$name_replace.pause();
                               },3000);
                            });
                    </script>
                       
                       
                    <video id='my_video_$name_replace' autoplay='true' controls muted style='display: none;'>
                        <source src='".Yii::app()->homeUrl."uploads/video/".$video."' type='video/mp4'/>
                    </video>
                    <canvas id='thecanvas_$name_replace' style='display: none;'>
                    </canvas>
                    <img id ='image_video_$name_replace' src=''/>";
                }
    
}
}
?>