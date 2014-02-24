<div class="page-header">
	<h1><?php echo Yii::t('global','Manage') ?> <small><?php echo Yii::t('global','Newsletter Email') ?></small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->


<div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-mail"></div>
			<h1><?php echo Yii::t('global', 'Newsletters Email'); ?> (<?php echo Yii::app()->format->number($count); ?>)</h1>
			 
		</div>
		<div class="block-fluid">
			<?php echo CHtml::form(); ?>
			<table cellpadding="0" cellspacing="0" width="100%" class="table">
				<thead>
					<tr>
						<th style='width: 5%;'><input name="checkall" type="checkbox" /></th>			
					   <th style='width: 45%;'><?php echo $sort->link('email', Yii::t('global', 'Email'), array( 'class' => 'tipb', 'title' => Yii::t('adminnewsletters', 'Sort list by email') ) ); ?></th>
					   <th style='width: 45%;'><?php echo $sort->link('joined', Yii::t('global', 'Joined'), array( 'class' => 'tipb', 'title' => Yii::t('adminnewsletters', 'Sort list by joined date') ) ); ?></th>
					   <th style='width: 5%;'><?php echo Yii::t('newsletter', 'Options'); ?></th>						
					</tr>
				</thead>
				<tbody>
					<?php if ($items): ?>
						<?php foreach ($items as $row): ?>
							<tr>
								<td><?php echo CHtml::checkbox( 'record[' . $row->id.']' ); ?></td>
								<td><?php echo CHtml::encode($row->email); ?></td>
								<td class="tipb"><span><?php echo Yii::app()->dateFormatter->formatDateTime($row->joined, 'long', 'short'); ?></span></td>
								<td>
									<a href="<?php echo $this->createUrl('newsletter/delete', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Delete this newsletter!'); ?>"><img src="/assets/images/delete.png" alt="<?php echo Yii::t('adminglobal','Delete') ?>" /></a>
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
								<select name="bulkoperations" style="margin-top: 7px;">
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
<br/>
<div class="row-fluid">
	<div class="span6">
		<div class="head clearfix">
			<div class="isw-ok"></div>
			<h1><?php echo Yii::t('global','Add Subscriber') ?></h1>
		</div>
		<div class="block-fluid">                        
			
			<?php echo CHtml::form(); ?>

			<div class="row-form clearfix">
				<?php echo CHtml::activeLabel($model, 'email'); ?>
				<?php echo CHtml::activeTextField($model, 'email', array( 'class' => 'text-input medium-input' )); ?>
				<?php echo CHtml::error($model, 'email', array( 'class' => 'input-notification errorshow png_bg' )); ?>
			</div>                         
			
			<div class="footer tar">
				<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Submit'), array('class'=>'btn', 'name'=>'submit')); ?>
			</div>                 
			<?php echo CHtml::endForm(); ?> 	
			
		</div>

	</div>
</div>
<?php echo CHtml::form(); ?>
<div class="row-fluid">
	<div class="span12">
        <div class="head clearfix">
        <div class="isw-text_document"></div>
            <h1><?php echo Yii::t('global', 'Send Newsletter'); ?></h1>
        </div>
        <div class="block-fluid" id="wysiwyg_container">
			<div class="row-form clearfix">
				<div class="span3"><?php echo CHtml::label(Yii::t('g', 'Template'), ''); ?></div>
				<div class="span9"><?php echo CHtml::dropDownList('template_id', null, CHtml::listData(EmailTemplates::model()->findAllByAttributes(array('language' => Yii::app()->language)),'id','name'), array('empty' => '')); ?></div>
			</div>
            <div class="row-form clearfix">
				<div class="span3"><?php echo CHtml::label(Yii::t('newsletter', 'Subject'), ''); ?></div>
				<div class="span9"><?php echo CHtml::textField('subject', 'Newsletter', array( 'class' => 'text-input medium-input' )); ?></div>
			</div>

			<?php $this->widget('application.widgets.ckeditor.CKEditor', array( 'name' => 'content', 'value' => isset($_POST['content']) ? $_POST['content'] : '', 'editorTemplate' => 'full' )); ?>
		
			<div class="footer tar">
				
			<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Send!'), array('class'=>'btn', 'name'=>'sendnewsletter')); ?>
			<?php echo CHtml::submitButton(Yii::t('adminglobal', 'Preview!'), array('class'=>'btn', 'name'=>'preview')); ?>
				</div>  
        </div>
	</div>
</div>	
<?php echo CHtml::endForm(); ?>	

<script type="text/javascript">
$('#template_id').change(function(){
    $.get('/admin/emailTemplates/load?id=' + this.value, function(reponse){
        reponse = eval('(' + reponse + ')' );
        $('#subject').val(reponse.email_subject);
        CKEDITOR.instances.content.setData(reponse.email_content);
    })
})
</script>
