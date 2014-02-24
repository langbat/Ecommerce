<script>
$(document).ready(function(){
     $("input[name=checkall]").click(function(){
        if(!$(this).is(':checked'))
            $("table input:checkbox").attr('checked', false);
        else
            $("table input:checkbox").attr('checked', true);
    })
    });
</script>
<style>
	#span3_newletter {
		padding-left: 20px;
	}
</style>

<div class="content-block">
	<div class="wrapper_profile">
		<div class="slider-box purple-grid">   
                
        <!-- -->
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
                        		<div class="head clearfix" style="background-color: #009EE0; border-radius: 9px 9px 0px 0px;padding-left: 10px;color: white;">
                        			<div class="isw-mail"></div>
                        		      <h5><?php echo Yii::t('global', 'Newsletters Email'); ?> <?php // echo Yii::app()->format->number($count); ?></h5>
                        		</div>
                                <?php if((isset($deleted) && ($deleted > 0))){ ?>
                                     <div class="alert">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <?php  echo $deleted. ' '. Yii::t('global', 'Email deleted'); ?>
                                    </div>
                                <?php } ?>
                                
                                
                        		<div class="block-fluid">
                        			<?php echo CHtml::form(); ?>
                        			<table cellpadding="0" cellspacing="0" width="100%" class="table">
                        				<thead>
                        					<tr>
                        						<th style='width: 5%;'><input name="checkall" type="checkbox" /></th>
                                                <th style='width: 25%;'><?php echo $sort->link('name', Yii::t('global', 'Name'), array( 'class' => 'tipb', 'title' => Yii::t('adminnewsletters', 'Sort list by name') ) ); ?></th>		
                        					   <th style='width: 30%;'><?php echo $sort->link('email', Yii::t('global', 'Email'), array( 'class' => 'tipb', 'title' => Yii::t('adminnewsletters', 'Sort list by email') ) ); ?></th>
                        					   <th style='width: 25%;'><?php echo $sort->link('joined', Yii::t('global', 'Joined'), array( 'class' => 'tipb', 'title' => Yii::t('adminnewsletters', 'Sort list by joined date') ) ); ?></th>
                        					   <th style='width: 15%;'><?php echo Yii::t('newsletter', 'Options'); ?></th>						
                        					</tr>
                        				</thead>
                        				<tbody>
                        					<?php if ($items): ?>
                        						<?php foreach ($items as $row): ?>
                        							<tr>
                        								<td><?php echo CHtml::checkbox( 'record[' . $row->id.']' ); ?></td>
                                                        <td><?php echo CHtml::encode($row->name); ?></td>
                        								<td><?php echo CHtml::encode($row->email); ?></td>
                        								<td class="tipb"><span><?php echo Yii::app()->dateFormatter->formatDateTime($row->joined, 'long', 'short'); ?></span></td>
                        								<td>
                        									<a href="<?php echo $this->createUrl('shopNewsletter/delete', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Delete this newsletter!'); ?>"><img src="/assets/images/delete.png" alt="<?php echo Yii::t('adminglobal','Delete') ?>" /></a>
                        								</td>
                        							</tr>
                        						<?php endforeach ?>
                        					<?php else: ?>	
                        						<tr>
                        							<td colspan='5' style='text-align:center;'><?php echo Yii::t('newsletter', 'No newsletters found.'); ?></td>
                        						</tr>
                        					<?php endif; ?>                               
                        				</tbody>
                        			</table>
                        			<div class="footer tar">
            								<select name="bulkoperations" style="margin-top: 10px;">
            									<option value=""><?php echo Yii::t('global', '-- Choose Action --'); ?></option>
            									<option value="bulkdelete"><?php echo Yii::t('global', 'Delete Selected'); ?></option>
            								</select>
            								<?php echo CHtml::submitButton( Yii::t('global', 'Apply'), array( 'confirm' => Yii::t('newsletter', 'Are you sure you would like to perform a bulk operation?'), 'class'=>'btn')); ?>
            						</div>
                        			
                        			</div>
                        			<?php echo CHtml::endForm(); ?>
			                         <?php $this->widget('widgets.MyADPager', array('pages'=>$pages, 'htmlOptions'=>array('class'=>'paging') )); ?>
                        		</div>
                                </div>
                                </div>
                                        
			     <!-- Inert newletter -->
                <div class="content-block">
                    <div class="wrapper_profile">
                        <div class="slider-box purple-grid">
                            <div class="message_profile fix-message"></div>
                            <div class="title">
                				<h5><?php echo Yii::t('global','Add Subscriber');?></h5>
                			</div>
                                <form action="" method="post" >
                                    <?php if(isset($this->sms)){ ?>
                                    <div class="alert">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <?php  echo Yii::t('global', 'Add email success'); ?>
                                    </div>
                                    <?php } ?>
                                    
                                	<div class="row-form clearfix">
                                		<div class="span3"><?php echo Yii::t('global','Name'); ?></div>
                                		<div class="span5">
                                            <input type="text" name="name" value="<?php if(isset($this->newname)){ echo $this->newname; } ?>"/>
                                        </div>
                                        <div class="span4">
                                            <span style="color: red; font-size: 15px;"><?php 
                                            if(isset($this->ername)){
                                                if($this->ername == 1){
                                                    echo Yii::t('global','Name cannot be blank');
                                                    } 
                                                } ?> </span>
                                        </div>
                                	</div>
                                
                                	<div class="row-form clearfix">
                                		<div class="span3"><?php echo Yii::t('global','Email'); ?></div>
                                		<div class="span5">
                                            <input type="text" name="email" value="<?php if(isset($this->newemail)){ echo $this->newemail; } ?>"/>
                                        </div>
                                        <div class="span4">
                                            <span style="color: red; font-size: 15px;" ><?php 
                                            if(isset($this->eremail)){
                                                if($this->eremail == 1){
                                                    echo Yii::t('global','Email cannot be blank');
                                                    }
                                                if($this->eremail == 2){
                                                    echo Yii::t('global', 'That email address is already subscribed.');
                                                } 
                                                } ?>
                                            </span>
                                        </div>
                                	</div>
                                     <input type="hidden" name="joined" value="<?php echo time() ?>"/>
                                     <input type="hidden" name="shop_id" value="<?php echo $this->userId ?>"/>
                                	<div class="footer tar">
                                		<input type="submit" class="btn" value="Save" name="save"/>
                                	</div>
                                </form>
                        </div>                   
                    </div>
                </div>
                
                <!--Send newlletter -->
                <div class="content-block">
                	<div class="wrapper_profile">
                		<div class="slider-box purple-grid">
                			<div class="message_profile fix-message"></div>
                			<div class="title">
                				<h5><?php echo Yii::t('global','Send Newsletters');?></h5>
                			</div>
                			<div class="info_profile1 fix-info-profile">
                				<div class="head clearfix">
                                    <?php if((isset($this->err_sent)) && ($this->err_sent == 0) ){ ?>
                                    <div class="alert">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <?php  echo $this->sent.' '. Yii::t('global', 'Newsletter emails sent'); ?>
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if((isset($this->err_sent)) && ($this->err_sent == 1) ){ ?>
                                    <div class="alert">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <?php  echo Yii::t('global', 'There are no subscribers to send the newsletter to.'); ?>
                                    </div>
                                    <?php } ?>
                                    <?php if((isset($this->err_sent)) && ($this->err_sent == 2) ){ ?>
                                    <div class="alert">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <?php  echo Yii::t('global', 'You must provide a valid content to email.'); ?>
                                    </div>
                                    <?php } ?>
                				     <div class="isw-text_document"></div>
                				     <h3></h3>
                				</div>
                				<?php echo CHtml::form(); ?>
                				<div class="block-fluid" id="wysiwyg_container">
                					<div class="row-form clearfix" >
                						<div class="span3" id="span3_newletter">
                							<?php echo CHtml::label(Yii::t('newsletter', 'Subject'), ''); ?>
                						</div>
                						<div class="span9">
                							<?php echo CHtml::textField('subject', 'Newsletter', array( 'class' => 'text-input medium-input', 'style'=>'width:715px' )); ?>
                						</div>
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
                	</div>
                </div>
			<?php } ?>
		</div>
	</div>
</div>

