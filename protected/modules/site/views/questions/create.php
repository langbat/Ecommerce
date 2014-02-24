<div class="contain-qs">
    <div class="block-fluid table-sorting">
    <a href="/questions/create#takeqs" class="btn btnqs"><i class="fa fa-question-circle"></i>Take a question</a>
    <?php   
      $this->widget('zii.widgets.CListView',array(      
      'dataProvider'=> $dataProvider,               
      'itemView'=>'../elements/question_box',
      'id'=>'clearfix',
                                                                                                       
          ) ); ?>
          <div class="blockquote" id="">
                <div id="takeqs"><?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
          </div>
    
    </div>
</div>