<?php
/**
 * custom pages controller Home page
 */
class UserMessagesController extends AdminBaseController {
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
		
		$this->breadcrumbs[ Yii::t('adminusermessages', 'User Messages') ] = array('usermessages/index');
		$this->pageTitle[] = Yii::t('adminusermessages', 'User Messages'); 
	}
	/**
	 * Index action
	 */
    public function actionIndex() {
        
		// Did we submit the form and selected items?
		if( isset($_POST['bulkoperations']) && $_POST['bulkoperations'] != '' )
		{
			// Perms
			if( !Yii::app()->user->checkAccess('op_usermessages_managepages') )
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
					if( !Yii::app()->user->checkAccess('op_usermessages_deletepages') )
					{
						throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
					}
					
					// Load records and delete them
					$records = UserMessages::model()->deleteByPk(array_keys($_POST['record']));
					// Done
					Yii::app()->user->setFlash('success', Yii::t('adminusermessages', '{count} pages deleted.', array('{count}'=>$records)));
					break;
					
					case 'bulkapprove':
					// Load records
					$records = UserMessages::model()->updateByPk(array_keys($_POST['record']), array('status'=>1));
					// Done
					Yii::app()->user->setFlash('success', Yii::t('adminusermessages', '{count} pages approved.', array('{count}'=>$records)));
					break;
					
					case 'bulkunapprove':
					// Load records
					$records = UserMessages::model()->updateByPk(array_keys($_POST['record']), array('status'=>0));
					// Done
					Yii::app()->user->setFlash('success', Yii::t('adminusermessages', '{count} pages Un-Approved.', array('{count}'=>$records)));
					break;
					
					default:
					// Nothing
					break;
				}
			}
		}

		// Load members and display
		$criteria = new CDbCriteria;

		$count = UserMessages::model()->count();
		$pages = new CPagination($count);
		$pages->pageSize = self::PAGE_SIZE;
		
		$pages->applyLimit($criteria);
		
		$sort = new CSort('UserMessages');
		$sort->defaultOrder = 'created DESC';
		$sort->applyOrder($criteria);

		$sort->attributes = array(
		        'subject'=>'subject',
		        'from_user'=>'from_user',
				'to_user'=>'to_user',
		        'created'=>'created',
		);
		
		$rows = UserMessages::model()->findAll($criteria);
	
        $this->render('index', array( 'count' => $count, 'rows' => $rows, 'pages' => $pages, 'sort' => $sort ) );
    }

	/**
	 * Add a new page action
	 */
     
     public function actionviewmessage()
	{
		if(!Yii::app()->user->isGuest && $my = Members::model()->findByPk(Yii::app()->user->id))
		{
			if( isset($_GET['id']) && ( $usermessage = UserMessages::model()->findByPk($_GET['id']) ) )
			{
				
				
				// Show titles and nav
				$this->pageTitle[] = Yii::t('usermessages', 'Viewing Message: {subject}', array('{title}'=>CHtml::encode($usermessage->subject)));
				$this->breadcrumbs[ Yii::t('usermessages', 'Viewing Message: {subject}', array('{title}'=>$usermessage->subject)) ] = '';
				
				// Render
				$this->render('viewmessage', array( 'usermessage' => $usermessage ));
			}
			else
			{
				$this->redirect(Yii::app()->homeUrl.'usermessages');
			}
		}
		else
		{
			Yii::app()->user->setFlash('error', Yii::t('usermessages', 'Please sign in.'));
			$this->redirect(Yii::app()->homeUrl.'login');
		}
	}
}