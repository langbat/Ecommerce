<?php
/**
 * custom pages controller Home page
 */
class UserMessagesController extends BaseController {
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
		
		$this->pageTitle[] = Yii::t('usermessages', 'Messages'); 
	}
	/**
	 * Index action
	 */
    public function actionIndex() {
        
        if(Yii::app()->user->isGuest)
        {
            Yii::app()->user->setFlash('error', Yii::t('downloads', 'Please sign in.'));
			$this->redirect(Yii::app()->homeUrl.'login');
        }
        
        $my = Members::model()->findByPk(Yii::app()->user->id);
        
		$criteria = new CDbCriteria;
        $criteria->condition = 'to_user=' . $my->id . ' OR from_user=' . $my->id;
		$count = UserMessages::model()->count();
		$pages = new CPagination($count);
		$pages->pageSize = self::PAGE_SIZE;
		
		$pages->applyLimit($criteria);
		
		$sort = new CSort('UserMessages');
		$sort->defaultOrder = 'created DESC';
		$sort->applyOrder($criteria);
		
		$sort->attributes = array(
		    'created'=>'created',
		);
		
		$rows = UserMessages::model()->findAll($criteria);
	
        $this->render('index', array( 'my'=>$my, 'count' => $count, 'rows' => $rows, 'pages' => $pages, 'sort' => $sort ) );
    }
	
    public function actionviewmessage()
	{
		if(!Yii::app()->user->isGuest && $my = Members::model()->findByPk(Yii::app()->user->id))
		{
			if( isset($_GET['id']) && ( $usermessage = UserMessages::model()->findByPk($_GET['id']) ) )
			{
				if($usermessage->to_user == $my->id)
				{
					$usermessage->read = 1;
					$usermessage->update();
				}
				elseif($usermessage->from_user != $my->id)
				{
					$this->redirect(Yii::app()->homeUrl.'messages');
				}
				
				if( isset($_POST['to_user']) && $to_user = Members::model()->findByPk(intval($_POST['to_user'])) )
				{
					if( isset( $_POST['subject'] ) && isset( $_POST['message'] ) )
					{
						$subject = trim($_POST['subject']);
						$message = trim($_POST['message']);
						
						if($subject != '' && $message != '')
						{
							$newmsg = new UserMessages;
							
							$newmsg->from_user = $my->id;
							$newmsg->to_user = $to_user->id;
							$newmsg->reply_of = $usermessage->id;
							$newmsg->subject = $subject;
							$newmsg->message = $message;
							
							if( $newmsg->insert() )
							{
								Yii::app()->user->setFlash('success', Yii::t('usermessages', 'Message Sent.'));
								$this->redirect(Yii::app()->homeUrl.'messages');
							}
						}
					}
				}
				
				// Show titles and nav
				$this->pageTitle[] = Yii::t('usermessages', 'Viewing Message: {subject}', array('{subject}'=>CHtml::encode($usermessage->subject)));
				//$this->breadcrumbs[ Yii::t('usermessages', 'Viewing Message: {subject}', array('{subject}'=>$usermessage->subject)) ] = '';
				
				// Render
				$this->render('viewmessage', array( 'my' => $my, 'usermessage' => $usermessage ));
			}
			else
			{
				$this->redirect(Yii::app()->homeUrl.'messages');
			}
		}
		else
		{
			Yii::app()->user->setFlash('error', Yii::t('usermessages', 'Please sign in.'));
			$this->redirect(Yii::app()->homeUrl.'login');
		}
	}
    
    public function actionsendmessage()
	{
		if(!Yii::app()->user->isGuest && $my = Members::model()->findByPk(Yii::app()->user->id))
		{
			if( isset($_GET['id']) && $to_user = Members::model()->findByPk(intval($_GET['id']) ) )
			{
				if( isset( $_POST['subject'] ) && isset( $_POST['message'] ) )
				{
					$subject = trim($_POST['subject']);
					$message = trim($_POST['message']);
					
					if($subject != '' && $message != '')
					{
						$newmsg = new UserMessages;
						
						$newmsg->from_user = $my->id;
						$newmsg->to_user = $to_user->id;
						$newmsg->subject = $subject;
						$newmsg->message = $message;
						
						if( $newmsg->insert() )
						{
							Yii::app()->user->setFlash('success', Yii::t('usermessages', 'Message Sent.'));
							$this->redirect(Yii::app()->homeUrl.'messages');
						}
					}
				}
				
				// Show titles and nav
				$this->pageTitle[] = Yii::t('usermessages', 'Send Message');
				
				// Render
				$this->render('sendmessage', array( 'my' => $my, 'to_user' => $to_user ));
			}
			else
			{
				$this->redirect(Yii::app()->homeUrl.'messages');
			}
		}
		else
		{
			Yii::app()->user->setFlash('error', Yii::t('usermessages', 'Please sign in.'));
			$this->redirect(Yii::app()->homeUrl.'login');
		}
	}
    
}