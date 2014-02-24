<style>
#span3_newletter{
    padding-left: 20px;
}
</style>
<div class="content-block">
        <div class="wrapper_profile">
            <div class="slider-box purple-grid">
                <?php if(Yii::app()->user->isGuest){ ?>
                    <div class="message_profile fix-message">
                        <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                        <p>
                            <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="title">
                        <h5><?php echo Yii::t('global','Shop Newsletters');?></h5>
                        <div class="create_link"><a class="isw-plus tipb" href="/shopNewsletter/create" title="<?php echo Yii::t('global','Create Shop Newsletter') ?>"></a> </div>
                        
                    </div>
                    <div class="info_profile1 fix-info-profile">
                    <div class="head clearfix">
                        <div class="isw-text_document"></div>
                            <h3></h3>
                        </div>
                        <?php echo CHtml::form(); ?>
                        <div class="block-fluid" id="wysiwyg_container">
            			<div class="row-form clearfix">
            				<div class="span3" id="span3_newletter"><?php echo CHtml::label(Yii::t('g', 'Template'), ''); ?></div>
            				<div class="span9"><?php echo CHtml::dropDownList('template_id', null, CHtml::listData(EmailTemplates::model()->findAllByAttributes(array('language' => Yii::app()->language)),'id','name'), array('empty' => '', 'style'=>'width:740px')); ?></div>
            			</div>
                        <div class="row-form clearfix" >
            				<div class="span3" id="span3_newletter"><?php echo CHtml::label(Yii::t('newsletter', 'Subject'), ''); ?></div>
            				<div class="span9"><?php echo CHtml::textField('subject', 'Newsletter', array( 'class' => 'text-input medium-input', 'style'=>'width:725px' )); ?></div>
            			</div>
            
            			<?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'name' => 'content', 'value' => isset($_POST['content']) ? $_POST['content'] : '', 'editorTemplate' => 'full' )); ?>
            		
            			<div class="footer tar">
            				
            			<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Send!'), array('class'=>'btn', 'name'=>'sendnewsletter', 'style'=>'margin: 10px 10px 10px 0px')); ?>
            			<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Preview!'), array('class'=>'btn', 'name'=>'preview', 'style'=>'margin: 10px 10px 10px 0px')); ?>
            				</div>  
                        </div>
                        </div>
                   <?php echo CHtml::endForm(); ?>
                    </div><!--#end info-->
                  
                <?php } ?>
            </div>
        </div>
</div>







        <script type="text/javascript">
        $('#template_id').change(function(){
            $.get('/admin/emailTemplates/load?id=' + this.value, function(reponse){
                reponse = eval('(' + reponse + ')' );
                $('#subject').val(reponse.email_subject);
                CKEDITOR.instances.content.setData(reponse.email_content);
            })
        })
        </script>
