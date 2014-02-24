<?php
    $topics= Lookup::items('HelpTopic');    
?>
<div class="slider-wrapper">
    <div class="slider-box purple-grid">
        <div class="quection">
                <div class="title"><h5><?php echo Yii::t('global', 'Do You Have Question?'); ?></h5></div>               
                <div class="top_text"><p>Hier haben wir für Sie die häufigsten Fragen und Antworten zusammengestellt:</p></div>
                <div class="clearfix"></div>
        </div>
        <div class="help-topic">
                <div class="head-left"><h5><?php echo Yii::t('global', 'Help Topic'); ?></h5></div>
                <div class="info pull-left">                    
                    <div class="accordion" id="accordion2">
                    <?php $i=1;
					foreach($topics as $topic_id => $topic_name) { ?>
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $topic_id?>">
                                <?php echo $topic_name ?>
                                </a>
                            </div>
                            <div id="collapse<?php echo $topic_id?>" class="accordion-body collapse"> 
                            <?php $helps = Helps::model()->findAllByAttributes(array('topic' => $topic_id), array('order' => 'question'));
                            foreach ($helps as $help){
                                echo '<div class="accordion-inner">
                                    <a class="question" href="/helps/view?id='.$help->id.'">&raquo; '.$help->question.'</a>
                                </div>';
                            }
                            ?>   
                            </div>
                        </div>
                    <?php
						$i++;
					} ?>
                        
                    </div>
                     <div class="head-left chil"><h5><?php echo Yii::t('global', 'Quicklinks'); ?></h5></div>
                         <ul class="password">
                              <li><a href="<?php echo $this->createUrl('profile/changepass') ?>">&raquo; Change password </a></li>
                              <li><a href="<?php echo $this->createUrl('users/lostpassword') ?>">&raquo; Forgot password </a></li>
                              <li><a href="<?php echo $this->createUrl('/auctions/allEnded') ?>">&raquo; Confirm winning </a></li>
                              <li><a href="<?php echo $this->createUrl('profile/changeaddress') ?>">&raquo; Change address </a></li>
                         </ul>
                </div><!--#end info-->
                <div class="head-right">
                    <h5><?php echo Yii::t('global', 'Subitem'); ?></h5>
                    <div id="answer_content"></div>
                    
                </div>
                
                <div class="clearfix"></div>                
        </div>
        
    </div>   
    
</div><!--#end slider-wrapper-->
<script type="text/javascript">
$(document).ready(function(){
    $('.question').click(function(){
        $('#answer_content').html('<label class="ajax-loader"></label>');
        $('#answer_content').load(this.href);
        return false;
    })
})
</script>