<?php
/**
 * custom pages controller Home page
 */
class FilecatsController extends AdminBaseController {
	/**
	 * Number of pages per page
	 */
	const PAGE_SIZE = 5;
	
	/**
	 * init
	 */
	public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('adminfilecats', 'File Categories') ] = array('filecats/index');
		$this->pageTitle[] = Yii::t('adminfilecats', 'File Categories'); 
	}
	/**
	 * Index action
	 */
    public function actionIndex() {
        
		// Did we submit the form and selected items?
		if( isset($_POST['bulkoperations']) && $_POST['bulkoperations'] != '' )
		{
			// Perms
			
			// Did we choose any values?
			if( isset($_POST['record']) && count($_POST['record']) )
			{
				// What operation we would like to do?
				switch( $_POST['bulkoperations'] )
				{
					case 'bulkdelete':
					
					// Perms
					
					
					// Load records and delete them
					$records = FileCats::model()->deleteByPk(array_keys($_POST['record']));
					// Done
					Yii::app()->user->setFlash('success', Yii::t('adminfilecats', '{count} categories deleted.', array('{count}'=>$records)));
					break;
					
					case 'bulkapprove':
					// Load records
					$records = FileCats::model()->updateByPk(array_keys($_POST['record']), array('status'=>1));
					// Done
					Yii::app()->user->setFlash('success', Yii::t('adminfilecats', '{count} categories approved.', array('{count}'=>$records)));
					break;
					
					case 'bulkunapprove':
					// Load records
					$records = FileCats::model()->updateByPk(array_keys($_POST['record']), array('status'=>0));
					// Done
					Yii::app()->user->setFlash('success', Yii::t('adminfilecats', '{count} categories Un-Approved.', array('{count}'=>$records)));
					break;
					
					default:
					// Nothing
					break;
				}
			}
		}

		// Load members and display
		$criteria = new CDbCriteria;

		$count = FileCats::model()->count();
		$pages = new CPagination($count);
		$pages->pageSize = self::PAGE_SIZE;
		
		$pages->applyLimit($criteria);
		
		$sort = new CSort('FileCats');
		$sort->defaultOrder = 'name DESC';
		$sort->applyOrder($criteria);

		$sort->attributes = array(
		        'name'=>'name',   
		);
		
		$rows = FileCats::model()->findAll($criteria);
	
        $this->render('index', array( 'count' => $count, 'rows' => $rows, 'pages' => $pages, 'sort' => $sort ) );
    }

	/**
	 * Add a new page action
	 */
	public function actionaddfilecat()
	{
		
		// Perms
		
		$model = new FileCats;
		
		if( isset( $_POST['FileCats'] ) )
		{
			if( isset( $_POST['submit'] ) )
			{
				$model->attributes = $_POST['FileCats'];
				if( $model->save() )
				{
					Yii::app()->user->setFlash('success', Yii::t('adminfilecats', 'Page Added.'));
					$this->redirect(array('filecats/index'));
				}
			}
			else if( isset( $_POST['preview'] ) ) 
			{
				$model->attributes = $_POST['FileCats'];
			}
		}
		
		$roles = AuthItem::model()->findAll(array('order'=>'type DESC, name ASC'));
		$_roles = array();
		if( count($roles) )
		{
			foreach($roles as $role)
			{
				$_roles[ AuthItem::model()->types[ $role->type ] ][ $role->name ] = $role->name;
			}
		}
		
		$this->breadcrumbs[ Yii::t('adminfilecats', 'Adding File Category') ] = '';
		$this->pageTitle[] = Yii::t('adminfilecats', 'Adding File Category');
		
		// Display form
		$this->render('page_form', array( 'roles' => $_roles, 'model' => $model, 'label' => Yii::t('adminfilecats', 'Adding File Category') ));
	}
	
	/**
	 * Edit page action
	 */
	public function actioneditfilecat()
	{	
		// Perms
		
		
		if( isset($_GET['id']) && ( $model = FileCats::model()->findByPk($_GET['id']) ) )
		{		
			if( isset( $_POST['FileCats'] ) )
			{
				if( isset( $_POST['submit'] ) )
				{
					$model->attributes = $_POST['FileCats'];
					if( $model->save() )
					{
						Yii::app()->user->setFlash('success', Yii::t('adminfilecats', 'Page Edited.'));
						$this->redirect(array('filecats/index'));
					}
				}
				else if( isset( $_POST['preview'] ) ) 
				{
					$model->attributes = $_POST['FileCats'];
				}
			}
			
			$roles = AuthItem::model()->findAll(array('order'=>'type DESC, name ASC'));
			$_roles = array();
			if( count($roles) )
			{
				foreach($roles as $role)
				{
					$_roles[ AuthItem::model()->types[ $role->type ] ][ $role->name ] = $role->name;
				}
			}
			$this->breadcrumbs[ Yii::t('adminfilecats', 'Editing File Category') ] = '';
			$this->pageTitle[] = Yii::t('adminfilecats', 'Editing File Category');
		
			// Display form
			$this->render('page_form', array( 'roles' => $_roles, 'model' => $model, 'label' => Yii::t('adminfilecats', 'Editing File Category') ));
		}
		else
		{
			Yii::app()->user->setFlash('error', Yii::t('adminerror', 'Could not find that ID.'));
			$this->redirect(array('filecats/index'));
		}
	}
	
	/**
	 * Change page visibility status
	 */
	
	public function actiondeletefilecat()
	{
		// Perms
		
		if( isset($_GET['id']) && ( $model = FileCats::model()->with(array('files'))->findByPk($_GET['id']) ) )
		{			
            if( count($model->files) )
			{
				Yii::app()->user->setFlash('error', Yii::t('adminerror', "Can't delete this category because it contains active files."));
				$this->redirect(array('filecats/index'));
			}
            
			$model->delete();
			
			Yii::app()->user->setFlash('success', Yii::t('adminfilecats', 'File Category Deleted.'));
			$this->redirect(array('filecats/index'));
		}
		else
		{
			$this->redirect(array('filecats/index'));
		}
	}
}