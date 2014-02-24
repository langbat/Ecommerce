<?php
    $topics= Lookup::items('HelpTopic');    
?>
<div class="slider-wrapper">
    <div class="slider-box purple-grid">
        <div class="quection">
                <div class="title"><h5 class="fix-title-help"><?php echo Yii::t('global', 'Do You Have Question?'); ?></h5></div>
                <div class="search">
                    <input type="text" name="question" value="" class="question text-question"/>
                    <input  type="submit" name="search" value="<?php echo Yii::t('global', 'Search'); ?>" class="search-help  btn-search"/>
                </div>
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
                            <div id="collapse<?php echo $topic_id?>" class="accordion-body collapse panel-collapse">
                            <div class="accordion-inner">
                            <?php $helps = Helps::model()->findAllByAttributes(array('topic' => $topic_id, 'language' => Yii::app()->language), array('order' => 'rank'));
                            foreach ($helps as $help){
                                echo '<div class="accordion-inner"> <a class="question" href="/helps/view?id='.$help->id.'">&raquo; '.$help->question.'</a> </div>';
                             }  ?>
                            </div>
                            </div>

                        </div>
                    <?php
						$i++;
					} ?>
                        
                    </div>
                     <div class="head-left chil"><h5><?php echo Yii::t('global', 'Quicklinks'); ?></h5></div>
                         <ul class="password">
                              <li><a href="/profile/changepass">&raquo; <?php echo Yii::t('global','Change Password') ?> </a></li>
                              <li><a href="users/lostpassword">&raquo; <?php echo Yii::t('global','Forgot Password') ?></a></li>
                              <li><a href="/cart">&raquo; <?php echo Yii::t('global','Confirm winning') ?> </a></li>
                              <li><a href="/profile/changeaddress">&raquo; <?php echo Yii::t('global','Change address') ?></a></li>
                         </ul>
                </div><!--#end info-->
                <div class="head-right">
                    <h5 id="item-title"></h5>
                    <div id="answer_content">
                    </div>

                </div>
                
                <div class="clearfix"></div>                
        </div>


    </div>

</div><!--#end slider-wrapper-->
<script type="text/javascript">
$(document).ready(function(){

    //$('.accordion-toggle:first').click();
    $('a.question').live('click',function(){
        $('.question').css('text-decoration','none');
        $(this).css('text-decoration','underline');
        $('#item-title').html($(this).html());
        $('#answer_content').html('<label class="ajax-loader"></label>');
        $('#answer_content').load(this.href);
        return false;
    });
    //$('a.question:first').click();
    $('.search-help').click(function(){
        var question = $('.text-question').val();
        if(question !=""){
            $.get('/helps/search_help?question='+question, function(html) {
                $('#item-title').html('<?php echo Yii::t('global','&raquo; Result Search') ?>');
                $('#answer_content').html(html);
            });
        } else {
            alert('<?php echo  Yii::t('global','Kindly enter your question before searching !') ?>')
        }
    });

})
</script>