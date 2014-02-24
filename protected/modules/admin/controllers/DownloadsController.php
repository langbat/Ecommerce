<?php
/**
 * Downloads controller Home page
 */
class DownloadsController extends AdminBaseController {
	
	/**
	 * Page size constants
	 */
	const DOWNLOAD_PAGE_SIZE = 5;
	
	/**
	 * Controller constructor
	 */
    public function init()
    {
        parent::init();
		
		// Add page breadcrumb and title
		$this->pageTitle[] = Yii::t('downloads', 'Manage Files');
		$this->breadcrumbs[ Yii::t('downloads', 'Manage Files') ] = array('downloads/index');
    }

	/**
	 * Index action
	 */
    public function actionIndex() {
	
		if(!Yii::app()->user->isGuest && $my = Members::model()->findByPk(Yii::app()->user->id))
		{
			$cat = null;
			$plan = null;
			
			if(isset($_GET['cat']) && !$cat = FileCats::model()->findByPk(intval($_GET['cat'])))
			{
				throw new CHttpException(404, Yii::t('downloads', 'Sorry, We could not find that category.'));
			}
			elseif(isset($_GET['type']) && !$plan = Plans::model()->findByPk(intval($_GET['type'])))
			{
				throw new CHttpException(404, Yii::t('downloads', 'Sorry, We could not find that type.'));
			}
            
            
            
            if( isset($_POST['bulkoperations']) && $_POST['bulkoperations'] != '' )
		{
			// Perms
			if( !Yii::app()->user->checkAccess('op_custompages_managepages') )
			{
				throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
			}
			
			// Did we choose any values?
			if( isset($_POST['record']) && count($_POST['record']) )
			{
				// What operation we would like to do?
				switch( $_POST['bulkoperations'] )
				{
					case 'bulkdelete':
					
					// Perms
					
					
					// Load records and delete them
					$records = Files::model()->deleteByPk(array_keys($_POST['record']));
					// Done
					Yii::app()->user->setFlash('success', Yii::t('admindownloads', '{count} pages deleted.', array('{count}'=>$records)));
					break;
					
					case 'bulkapprove':
					// Load records
					$records = Files::model()->updateByPk(array_keys($_POST['record']), array('status'=>1));
					// Done
					Yii::app()->user->setFlash('success', Yii::t('admindownloads', '{count} pages approved.', array('{count}'=>$records)));
					break;
					
					case 'bulkunapprove':
					// Load records
					$records = Files::model()->updateByPk(array_keys($_POST['record']), array('status'=>0));
					// Done
					Yii::app()->user->setFlash('success', Yii::t('admindownloads', '{count} pages Un-Approved.', array('{count}'=>$records)));
					break;
					
					default:
					// Nothing
					break;
				}
			}
		}
			// Grab files
			$criteria = new CDbCriteria;
			$myplan = $my->getPlan();
			$condition = '1=1';
			if($cat) $condition .= ' AND cat_id='.$cat->id;
			elseif($plan) $condition .= ' AND plan_id='.$plan->id;
			
			$tagsearch = '';
			if(isset($_POST['tagsearch']))
			{
				$tagsearch = addslashes(trim($_POST['tagsearch']));
				$condition .= " AND (t.name LIKE '%". $tagsearch . "%' OR category.name LIKE '%". $tagsearch . "%')";
			}
			
			$criteria->condition = $condition;
			$criteria->with = array('category', 'plan');
			
			$count = Files::model()->count($criteria);
			$pages = new CPagination($count);
			$pages->pageSize = self::DOWNLOAD_PAGE_SIZE;
			$pages->route = 'downloads/index';
			
			if($cat) $pages->params = array('cat'=>$cat->id);
			elseif($plan) $pages->params = array('plan'=>$plan->id);
			
			$pages->applyLimit($criteria);
			
            $sort = new CSort('Files');
    		$sort->defaultOrder = 'created DESC';
    		$sort->applyOrder($criteria);
			
    		$sort->attributes = array(
    		        'id'=>'ID',
    		        'name'=>'name',
    		        'cat_id'=>'cat_id',
    		        'plan_id'=>'plan_id',
    				'created'=>'created',
                    'totaldownloads'=>'totaldownloads',
    		);
            $rows = Files::model()->findAll($criteria);
			$this->render('index', array('rows' => $rows, 'cat'=>$cat, 'plan'=>$plan, 'myplan'=>$myplan, 'tagsearch'=>$tagsearch, 'pages' => $pages, 'count' => $count, 'sort' => $sort ));
		}
		else
		{
			Yii::app()->user->setFlash('error', Yii::t('downloads', 'Please sign in.'));
			$this->redirect(Yii::app()->homeUrl.'login');
		}
        
        
    }
	
	/**
	 * View File Action
	 */
	public function actionviewfile()
	{
		if(!Yii::app()->user->isGuest && $my = Members::model()->findByPk(Yii::app()->user->id))
		{
			if( isset($_GET['id']) && ( $file = Files::model()->findByPk($_GET['id']) ) )
			{
				$myplan = $my->getPlan();
				if(!in_array($file->plan_id, $myplan->ids))
				{
					Yii::app()->user->setFlash('error', Yii::t('downloads', 'Sorry, You can not see that file.'));
					$this->redirect(Yii::app()->homeUrl);
				}
				
				// Increase the views count
				$file->views++;
				$file->update();
				
				// Show titles and nav
				$this->pageTitle[] = Yii::t('downloads', 'Viewing File: {title}', array('{title}'=>CHtml::encode($file->name)));
				$this->breadcrumbs[ Yii::t('downloads', 'Viewing File: {title}', array('{title}'=>$file->name)) ] = '';
				
				// Render
				$this->render('viewfile', array( 'file' => $file ));
			}
			else
			{
				$this->redirect(Yii::app()->homeUrl.'downloads');
			}
		}
		else
		{
			Yii::app()->user->setFlash('error', Yii::t('downloads', 'Please sign in.'));
			$this->redirect(Yii::app()->homeUrl.'login');
		}
	}
	
	/**
	 * Download Fie Action
	 */
	public function actiondownload()
	{
		if(!Yii::app()->user->isGuest && $my = Members::model()->findByPk(Yii::app()->user->id))
		{
			if(isset($_POST['dodowwnload']) && isset($_SESSION['download_key']) && $_POST['dodowwnload']==md5($_SESSION['download_key']))
			{
				$this->do_download($my, intval($_SESSION['download_key']));
				exit(0);
			}
			
			if( isset($_GET['id']) && ( $file = Files::model()->findByPk($_GET['id']) ) )
			{
				$myplan = $my->getPlan();
				if(!in_array($file->plan_id, $myplan->ids))
				{
					Yii::app()->user->setFlash('error', Yii::t('downloads', 'Sorry, You can not download that file.'));
					$this->redirect(Yii::app()->homeUrl.'downloads');
				}
				
				if(!$filedownload = UserDownloads::model()->find("user_id=" . $my->id . " AND file_id=". $file->id ." AND last_date >= '" . $myplan->start_date . "'"))
				{
					$userdownload = UserDownloads::model()->count("user_id=" . $my->id . " AND last_date >= '" . $myplan->start_date . "'");
					if($userdownload >= $myplan->permonth)
					{
						Yii::app()->user->setFlash('error', Yii::t('downloads', 'Sorry, You have reached the download limit per month.'));
						$this->redirect(Yii::app()->homeUrl.'downloads');
					}
					
					$filedownload = new UserDownloads;
					$filedownload->user_id = $my->id;
					$filedownload->file_id = $file->id;
					$filedownload->save();
				}
				elseif($myplan->permonth <= 0)
				{
					Yii::app()->user->setFlash('error', Yii::t('downloads', 'Sorry, You have reached the download limit per month.'));
					$this->redirect(Yii::app()->homeUrl.'downloads');
				}
				
				$target_path = ROOT_PATH.'uploads/_downloads/';
				
				if(file_exists($target_path.$file->file))
				{
					$_SESSION['download_key'] = $file->id;
					$this->render('download', array( 'file' => $file ));
				}
				else
				{
					Yii::app()->user->setFlash('error', Yii::t('downloads', 'Sorry, We could not find that file.'));
					$this->redirect(Yii::app()->homeUrl.'downloads');
				}
			}
			else
			{
				$this->redirect(Yii::app()->homeUrl.'downloads');
			}
		}
		else
		{
			Yii::app()->user->setFlash('error', Yii::t('downloads', 'Please sign in.'));
			$this->redirect(Yii::app()->homeUrl.'login');
		}
	}
    
    public function actioneditdownload()
	{	
		// Perms
		
		
		if( isset($_GET['id']) && ( $model = Files::model()->findByPk($_GET['id']) ) )
		{
			if( isset( $_POST['Files'] ) )
			{
				if( isset( $_POST['submit'] ) )
				{
					$model->attributes = $_POST['Files'];
					if( $model->save() )
					{
                        if(isset($_FILES['file']) && basename($_FILES['file']['name']) != '' && $_FILES['file']['error'] != 1)
        				{
        					$target_path = ROOT_PATH.'uploads/_downloads/';
        					
        					$file_ext = strtolower(substr($_FILES['file']["name"], -4));
        					
        					if(in_array($file_ext, array('.txt', '.jpg', '.png', '.gif', '.bmp', 'jpeg')))
        					{
        						if($file_ext == 'jpeg') $file_ext = '.jpg';
        						
        						$upload_filename = $model->id . '_' . date('YmdHis') . $file_ext;
        						
                                //move to downloads folder
                                if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path.$upload_filename))
                                {
                                    $files = glob($target_path.$model->id.'_*');
            						foreach($files as $file)
            						{
            							if($file != $target_path.$upload_filename)
            								unlink($file);
            						}
            						
            						$model->file = $upload_filename;
            						$model->update(array('file'));
                                }
        					}
        				}
                       
						Yii::app()->user->setFlash('success', Yii::t('admindownloads', 'File Edited.'));
						$this->redirect(array('downloads/index'));
					}
				}
				else if( isset( $_POST['preview'] ) ) 
				{
					$model->attributes = $_POST['Files'];
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
            
			$this->breadcrumbs[ Yii::t('admindownloads', 'Editing File') ] = '';
			$this->pageTitle[] = Yii::t('admindownloads', 'Editing File');
		
			// Display form
			$this->render('page_form', array( 'roles' => $_roles, 'model' => $model, 'uploaded_file'=>'', 'uploaded_filename'=>'', 'label' => Yii::t('admindownloads', 'Editing File') ));
		}
		else
		{
			Yii::app()->user->setFlash('error', Yii::t('adminerror', 'Could not find that ID.'));
			$this->redirect(array('downloads/index'));
		}
	}
    
    
    
    public function actionadddownload()
	{	
		// Perms
        $model = new FileForm;
        $uploaded_file = '';
		$uploaded_filename = '';
		
		if( isset( $_POST['FileForm'] ) )
		{
			$uploaded_file = '';
			$target_path = ROOT_PATH.'uploads/_downloads/';
			
            if(isset($_FILES['file']) && basename($_FILES['file']['name']) != '' && $_FILES['file']['error'] != 1)
			{
				$file_ext = strtolower(substr($_FILES['file']["name"], -4));
				
				if(in_array($file_ext, array('.txt', '.jpg', '.png', '.gif', '.bmp', 'jpeg')))
				{
					if($file_ext == 'jpeg') $file_ext = '.jpg';
					
					$upload_filename = date('YmdHis') . $file_ext;
					
                    //move to downloads folder
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path.$upload_filename))
                    {
                        $uploaded_file = $upload_filename;
						$uploaded_filename = $_FILES['file']["name"];
						if(isset($_POST['uploaded_file']) && file_exists($target_path.$_POST['uploaded_file']))
						{
							if(strtolower($uploaded_file) != strtolower($_POST['uploaded_file']))
								unlink($target_path.$_POST['uploaded_file']);
						}
                    }
				}
			}
			
			if($uploaded_file == '' && isset($_POST['uploaded_file']) && isset($_POST['uploaded_filename']) && file_exists($target_path.$_POST['uploaded_file']) )
			{
				$upload_filename = $_POST['uploaded_file'];
				$uploaded_filename = $_POST['uploaded_filename'];
				
				$file_ext = strtolower(substr($upload_filename, -4));
				
				if(in_array($file_ext, array('.txt', '.jpg', '.png', '.gif', '.bmp')))
				{
					$uploaded_file = $upload_filename;
				}
			}
			
			if($uploaded_file != '')
			{
				$model->attributes = $_POST['FileForm'];
			
				if($model->validate())
				{
					$dfile = new Files;
					$dfile->attributes = $_POST['FileForm'];
					$dfile->file = $uploaded_file;

					if( $dfile->save() )
					{
						rename($target_path.$uploaded_file, $target_path . $dfile->id . '_' . $uploaded_file);
						$dfile->file = $dfile->id . '_' . $uploaded_file ;
						$dfile->update(array('file'));
					   
						Yii::app()->user->setFlash('success', Yii::t('admindownloads', 'Download Added.'));
						$this->redirect(array('downloads/index'));
					}
				}
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
		
		$this->breadcrumbs[ Yii::t('admindownloads', 'Adding Download') ] = '';
		$this->pageTitle[] = Yii::t('admindownloads', 'Adding Download');
	
		// Display form
		$this->render('page_form', array( 'roles' => $_roles, 'model' => $model, 'uploaded_file'=>$uploaded_file, 'uploaded_filename'=>$uploaded_filename, 'label' => Yii::t('admindownloads', 'Adding Download') ));
	}
	
    
	
	public function do_download($my, $file_id)
	{
		unset($_SESSION['download_key']);
		if( $file = Files::model()->findByPk($file_id) )
		{
			$myplan = $my->getPlan();
			if(!in_array($file->plan_id, $myplan->ids))
			{
				Yii::app()->user->setFlash('error', Yii::t('downloads', 'Sorry, You can not download that file.'));
				$this->redirect(Yii::app()->homeUrl.'downloads');
			}
			
			if(!$filedownload = UserDownloads::model()->find("user_id=" . $my->id . " AND file_id=". $file->id ." AND last_date >= '" . $myplan->start_date . "'"))
			{
				$userdownload = UserDownloads::model()->count("user_id=" . $my->id . " AND last_date >= '" . $myplan->start_date . "'");
				if($userdownload >= $myplan->permonth)
				{
					Yii::app()->user->setFlash('error', Yii::t('downloads', 'Sorry, You have reached the download limit per month.'));
					$this->redirect(Yii::app()->homeUrl.'downloads');
				}
				
				$filedownload = new UserDownloads;
				$filedownload->user_id = $my->id;
				$filedownload->file_id = $file->id;
				$filedownload->save();
			}
			elseif($myplan->permonth <= 0)
			{
				Yii::app()->user->setFlash('error', Yii::t('downloads', 'Sorry, You have reached the download limit per month.'));
				$this->redirect(Yii::app()->homeUrl.'downloads');
			}
			
			$target_path = ROOT_PATH.'uploads/_downloads/';
			
			if(file_exists($target_path.$file->file))
			{
				// Increase the downloads count
				$filedownload->downloads++;
				$filedownload->update();
				
				header('Content-disposition: attachment; filename=' . $file->download_name);
				header('Content-type: application/octet-stream');
				readfile($target_path.$file->file);
				
				exit(0);
			}
			else
			{
				Yii::app()->user->setFlash('error', Yii::t('downloads', 'Sorry, We could not find that file.'));
				$this->redirect(Yii::app()->homeUrl);
			}
		}
		else
		{
			$this->redirect(Yii::app()->homeUrl.'downloads');
		}
	}
    
    public function actiondeletedownload()
	{
		// Perms
		
		
		if( isset($_GET['id']) && ( $model = Files::model()->findByPk($_GET['id']) ) )
		{			
			$model->delete();
			
			Yii::app()->user->setFlash('success', Yii::t('admindownloads', 'Download Deleted.'));
			$this->redirect(array('downloads/index'));
		}
		else
		{
			$this->redirect(array('downloads/index'));
		}
	}
}