<?php
/**
 * Index controller Home page
 */
class ComingsoonController extends SiteBaseController {
	
	public function actionindex() {
        $this->layout = 'comingsoon';
		$this->render('index');
    }
}