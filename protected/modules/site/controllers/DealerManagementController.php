<?php

class DealerManagementController extends SiteBaseController {
    public function init()
	{
		parent::init();
		
	
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
     public function actionindex() {
        
		$this->render('index');
    }
     }
  ?>