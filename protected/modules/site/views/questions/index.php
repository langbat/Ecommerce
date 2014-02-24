<div class="contain-qs">
    <div class="block-fluid table-sorting">
    <a href="/questions/create#takeqs" class="btn btnqs"><i class="fa fa-question-circle"></i><?php echo Yii::t('globle','Make a question');?> </a>
    <?php   
      $this->widget('zii.widgets.CListView',array(      
      'dataProvider'=> $dataProvider,               
      'itemView'=>'../elements/question_box',
      'id'=>'clearfix',
                                                                                                       
          ) ); ?>
          
    
    </div>
</div>