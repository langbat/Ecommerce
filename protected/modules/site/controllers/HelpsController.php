<?php
class HelpsController extends SiteBaseController {
	
	/**
	 * Index action
	 */
    public function actionIndex() {
        $this->pageTitle[] = Yii::t('global', 'Help');
	   $this->render('index');
    }
    
    public function actionView() {
	   $model = Helps::model()->findByPk($_GET['id']);
       echo $model->answer;
    }

    public function actionSearch_help(){
        $question = $_GET['question'];
        $search_help = Helps::model()->findAllBySql('SELECT id,question FROM helps WHERE question like "%'.$question.'%"');
        $result = '';
        if($search_help){
            foreach($search_help as $item){
                $result.= '<div class="accordion-inner">
                                    <a class="question" href="/helps/view?id='.$item["id"].'">&raquo; '.$item["question"].'</a>
                           </div>';
            }
        } else {
            $result .= Yii::t('global','No result found');
        }
        echo $result;
    }
    
}