<?php
/**
 * Langauges controller Home page
 */
class LanguagesController extends AdminBaseController {
	const PAGE_SIZE = 10;
	const PAGE_SIZE_LARGE = 20;
	/**
	 * init
	 */
	public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('adminlang', 'Languages') ] = array('languages/index');
		$this->pageTitle[] = Yii::t('adminlang', 'Languages');
	}
	/**
	 * Index action
	 */
    public function actionIndex() {
	
		// Perms
		if( !Yii::app()->user->checkAccess('op_lang_translate') )
		{
			throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
		}
	
		$totalStringsInSource = SourceMessage::model()->count();
	
        $this->render('index', array( 'totalStringsInSource' => $totalStringsInSource ));
    }
    
    /**
	 * 
	 */
	public function actiontranslateneeded()
	{
		// Perms
		if( !Yii::app()->user->checkAccess('op_lang_translate') )
		{
			throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
		}
		
		$id = Yii::app()->request->getParam('id', 0);
		
		// Check if it exists
		if( !in_array($id, array_keys(Yii::app()->params['languages'])) )
		{
			Yii::app()->user->setFlash('error', Yii::t('adminlang', 'That language is not supported.'));
			$this->redirect(array('index'));
		}
		
		// Did we submit?
		if( isset($_POST['submit']) && $_POST['submit'] )
		{
			// Update the strings
			if( isset($_POST['strings']) && count($_POST['strings']) )
			{
				foreach( $_POST['strings'] as $stringid => $stringvalue )
				{
					// Update each one
					Message::model()->updateAll(array('translation'=>$stringvalue), 'language=:lang AND id=:id', array(':id' => $stringid, ':lang'=>$id));
				}
				
				Yii::app()->user->setFlash('success', Yii::t('adminlang', 'Strings Updated.'));
				
			}
		}
		
		$ids = $this->getStringNotTranslated( $id );
		
		// Grab the language data
		$criteria = new CDbCriteria;
		$criteria->condition = "language='$id' AND id IN (".implode(',', $ids).")";
        if (isset($_GET['translation'])){
            $criteria->addCondition("translation LIKE '%".$_GET['translation']."%'");
            $count = Message::model()->count("language='$id' AND id IN (".implode(',', $ids).") AND translation LIKE '%".$_GET['translation']."%'");
        }
        else{
            $count = Message::model()->count("language='$id' AND id IN (".implode(',', $ids).")");
        }
		$criteria->params = array(":lang"=>$id, ':ids' => implode(',', $ids));
		
		
        $pages = new CPagination($count);
		$pages->pageSize = self::PAGE_SIZE_LARGE;
		
		$pages->applyLimit($criteria);
		
		$sort = new CSort('Message');
		$sort->defaultOrder = 'id ASC';
		$sort->applyOrder($criteria);

		$sort->attributes = array(
		        'id'=>'id',
		        'translation'=>'translation',
		);
		
		$strings = Message::model()->findAll($criteria);
		
		$this->breadcrumbs[ Yii::t('adminlang', 'Translate') ] = array('languages/translate');
		$this->pageTitle[] = Yii::t('adminlang', 'Translate');
		
		$this->render('strings', array( 'strings'=>$strings, 'count'=>$count, 'pages'=>$pages, 'sort'=>$sort ));
	}

	/**
	 * 
	 */
	public function actiontranslate()
	{
		// Perms
		if( !Yii::app()->user->checkAccess('op_lang_translate') )
		{
			throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
		}
		
		$id = Yii::app()->request->getParam('id', 0);
		
		// Check if it exists
		if( !in_array($id, array_keys(Yii::app()->params['languages'])) )
		{
			Yii::app()->user->setFlash('error', Yii::t('adminlang', 'That language is not supported.'));
			$this->redirect(array('index'));
		}
		
		// Did we submit?
		if( isset($_POST['submit']) && $_POST['submit'] )
		{
			// Update the strings
			if( isset($_POST['strings']) && count($_POST['strings']) )
			{
				foreach( $_POST['strings'] as $stringid => $stringvalue )
				{
					// Update each one
					Message::model()->updateAll(array('translation'=>$stringvalue), 'language=:lang AND id=:id', array(':id' => $stringid, ':lang'=>$id));
				}
				
				Yii::app()->user->setFlash('success', Yii::t('adminlang', 'Strings Updated.'));
				
			}
		}
		
		// Grab the language data
		$criteria = new CDbCriteria;
		$criteria->condition = 'language=:lang';
		$criteria->params = array(":lang"=>$id);
        
        if (isset($_GET['translation'])){
            if (isset($_GET['source'])){
                $ids = $this->getSourceIdsFilter();
                $criteria->addCondition("translation LIKE '%".$_GET['translation']."%' AND id IN (".implode(',', $ids).")");
                $count = Message::model()->count("language='$id' AND id IN (".implode(',', $ids).") AND translation LIKE '%".$_GET['translation']."%'");    
            }
            else{
                $criteria->addCondition("translation LIKE '%".$_GET['translation']."%'");
                $count = Message::model()->count("language='$id' AND translation LIKE '%".$_GET['translation']."%'");
            }
            
        }
        else{
            if (isset($_GET['source'])){
                $ids = $this->getSourceIdsFilter();
                $criteria->addCondition("id IN (".implode(',', $ids).")");
                $count = Message::model()->count("language='$id' AND id IN (".implode(',', $ids).")");    
            }
            else{
                $count = Message::model()->count('language=:lang', array( ':lang' => $id ));
            }
            
            
        }
		
		
		$pages = new CPagination($count);
		$pages->pageSize = self::PAGE_SIZE;
		
		$pages->applyLimit($criteria);
		
		$sort = new CSort('Message');
		$sort->defaultOrder = 'id ASC';
		$sort->applyOrder($criteria);

		$sort->attributes = array(
		        'id'=>'id',
		        'translation'=>'translation',
		);
		
		$strings = Message::model()->findAll($criteria);
		
		$this->breadcrumbs[ Yii::t('adminlang', 'Translate') ] = array('languages/translate');
		$this->pageTitle[] = Yii::t('adminlang', 'Translate');
		
		$this->render('strings', array( 'strings'=>$strings, 'count'=>$count, 'pages'=>$pages, 'sort'=>$sort ));
	}
	
	/**
	 * Revert a string to it's original form
	 */
	public function actionrevert()
	{
		// Perms
		if( !Yii::app()->user->checkAccess('op_lang_translate') )
		{
			throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
		}
		
		$id = Yii::app()->request->getParam('id', 0);
		$string = Yii::app()->request->getParam('string', 0);
		
		// Check if it exists
		if( !in_array($id, array_keys(Yii::app()->params['languages'])) )
		{
			Yii::app()->user->setFlash('error', Yii::t('adminlang', 'That language is not supported.'));
			$this->redirect(array('index'));
		}
		
		// Grab the string and source
		$source = SourceMessage::model()->findByPk($string);
		$stringdata = Message::model()->find('language=:lang AND id=:id', array( ':id' => $string,  ':lang'=>$id));
		
		if( ( !$source || !$stringdata ) )
		{
			Yii::app()->user->setFlash('error', Yii::t('adminlang', 'That language string was not found.'));
			$this->redirect(array('index'));
		}
		
		// Update the stringdata based on the soruce
		Message::model()->updateAll(array('translation'=>$source->message), 'language=:lang AND id=:id', array( ':id' => $string,  ':lang'=>$id));
		
		Yii::app()->user->setFlash('success', Yii::t('adminlang', 'String Reverted.'));
		$this->redirect(array('languages/translate', 'id'=>$id));
	}

	/**
	 * Copy missing language strings from source into this language
	 */
	public function actioncopystrings()
	{
		// Perms
		if( !Yii::app()->user->checkAccess('op_lang_copy_strings') )
		{
			throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
		}
		
		$id = Yii::app()->request->getParam('id', 0);
		
		// Check if it exists
		if( !in_array($id, array_keys(Yii::app()->params['languages'])) )
		{
			Yii::app()->user->setFlash('error', Yii::t('adminlang', 'That language is not supported.'));
			$this->redirect(array('index'));
		}
		
		// Grab all soruce language strings
		$sourcestrings = SourceMessage::model()->findAll();
		
		$totaladded = 0;
		
		if( $sourcestrings )
		{
			foreach( $sourcestrings as $string )
			{
				// Do we have it already?
				if( !Message::model()->exists('language=:lang AND id=:id', array( ':lang' => $id, ':id' => $string->id )) )
				{
					// Doesn't then add it
					$newstring = new Message;
					$newstring->id = $string->id;
					$newstring->language = $id;
					$newstring->translation = $string->message;
					$newstring->save();
					$totaladded++;
				}
			}
		}
		
		// Done
		Yii::app()->user->setFlash('success', Yii::t('adminlang', 'Copy completed! Total of {number} missing strings copied.', array('{number}'=>$totaladded)));
		$this->redirect(array('index'));
	}
	
	/**
	 * Get ids of translation that were not translated
	 */
	public function getStringNotTranslated( $language )
	{
        if (isset($_GET['source'])){
            $origs = SourceMessage::model()->findAll("message LIKE '%".$_GET['source']."%'");
        }
        else{
            $origs = SourceMessage::model()->findAll();
        }
        
		
		$translated = array(0);
		if( count( $origs ) )
		{
			foreach( $origs as $orig )
			{
				// Grab the translation from the messages table
				$message = Message::model()->find('language=:lang AND id=:id', array( ':lang' => $language, ':id' => $orig->id ));
				if( $message )
				{
					if( $message->translation == '' || $message->translation == $orig->message )
					{
						$translated[] = $message->id;
					}
				}
			}
		}
        return $translated;
	}
	
	/**
	 * Get number of strings that were already translated
	 */
	public function getStringTranslationDifference( $language )
	{
		$origs = SourceMessage::model()->findAll();
		$translated = 0;
		if( count( $origs ) )
		{
			foreach( $origs as $orig )
			{
				// Grab the translation from the messages table
				$message = Message::model()->find('language=:lang AND id=:id', array( ':lang' => $language, ':id' => $orig->id ));
				if( $message )
				{
					if( $message->translation != $orig->message )
					{
						$translated++;
					}
				}
			}
		}
		return $translated;
	}
    
    function getSourceIdsFilter(){
        if (isset($_GET['source'])){
            $origs = SourceMessage::model()->findAll("message LIKE '%".$_GET['source']."%'");
        }
        else{
            $origs = SourceMessage::model()->findAll();
        }
        $ids = array(0);
		foreach( $origs as $orig ){
		  $ids[] = $orig->id;
		}
        return $ids;
    }
    
    function actionDelete(){
        $message = Message::model()->deleteAll('id = '.$_GET['id']);
        
        $message = SourceMessage::model()->findByPk($_GET['id']);
        if ($message) $message->delete();
    }
}