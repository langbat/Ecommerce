<div class="page-header">
	<h1>Manage <small>Files</small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

<div class="row-fluid">
    <div class="span12">
        <div class="head clearfix">
			<div class="isw-download"></div>
			<h1><?php echo Yii::t('admindownloads', 'Manage Files'); ?> (<?php echo Yii::app()->format->number($count); ?>)</h1>
			<ul class="buttons">
				<li>
					<a href="<?php echo $this->createUrl('downloads/adddownload', array()); ?>" class="isw-text_document tipb" data-original-title="<?php echo Yii::t('admindownloads', 'Add New File'); ?>"></a>
				</li>
			</ul>                        
		</div>
        
        <div class="block-fluid">
        <?php echo CHtml::form(); ?>
        <table cellspacing="7" cellpadding="0" style="width:100%" class="table adslist">
        	<tbody>
        		<tr>
        			<th style='width: 5%;'><input name="checkall" type="checkbox" /></th>
                    <th style='width: 40%;'><?php echo $sort->link('name', Yii::t('admindownloads', 'Name'), array( 'class' => 'tooltip', 'title' => Yii::t('admindownloads', 'Sort user list by name') ) ); ?>Name</th>
                    <th style='width: 15%;'><?php echo $sort->link('cat_id', Yii::t('admindownloads', 'Category'), array( 'class' => 'tooltip', 'title' => Yii::t('admindownloads', 'Sort user list by category') ) ); ?>Category</th>
                    <th style='width: 15%;'><?php echo $sort->link('plan_id', Yii::t('admindownloads', 'Type'), array( 'class' => 'tooltip', 'title' => Yii::t('admindownloads', 'Sort user list by type') ) ); ?>Type</th>
                    <th style='width: 15%;'><?php echo $sort->link('created', Yii::t('admindownloads', 'created'), array( 'class' => 'tooltip', 'title' => Yii::t('admindownloads', 'Sort user list by created') ) ); ?>Created</th>
                    <th style='width: 10%;'><?php echo Yii::t('admindownloads', 'Options'); ?></th>       		
                    
                </tr>
        		
        		<?php if( count($rows) ): ?>
        			
        			<?php foreach($rows as $row): ?>
        				<tr>
        					<td><?php echo CHtml::checkbox( 'record[' . $row->id.']' ); ?></td>
        					<td><a href="<?php echo $this->createUrl('downloads/editdownload', array('id'=>$row->id)); ?>" title="<?php echo Yii::t('downloads', 'View file'); ?>"><?php echo $row->name; ?></a></td>
        					<td><a href="<?php echo $this->createUrl('downloads/index', array('cat'=>$row->cat_id)); ?>"><?php echo $row->category->name; ?></a></td>
        					<td><a href="<?php echo $this->createUrl('downloads/index', array('type'=>$row->plan_id)); ?>"><?php echo $row->plan->name; ?></a></td>
        					<td><?php echo $row->created; ?></td>
                            <td>
									<a href="<?php echo $this->createUrl('downloads/editdownload', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Edit this file'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/pencil.png" alt="Edit" /></a>
									<a href="<?php echo $this->createUrl('downloads/deletedownload', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Delete this file!'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/cross.png" alt="Delete" /></a>
								</td>
        				</tr>
        			<?php endforeach ?>
        			
        		
        		
        		<?php else: ?>	
						<tr>
							<td colspan='6' style='text-align:center;'><?php echo Yii::t('admindownloads', 'No download files found.'); ?></td>
						</tr>
					<?php endif; ?> 
        	</tbody>
        </table>
        <div class="footer tar">
								<select name="bulkoperations">
									<option value=""><?php echo Yii::t('global', '-- Choose Action --'); ?></option>
									<option value="bulkdelete"><?php echo Yii::t('global', 'Delete Selected'); ?></option>
								</select>
								<?php echo CHtml::submitButton( Yii::t('global', 'Apply'), array( 'confirm' => Yii::t('admindownloads', 'Are you sure you would like to perform a bulk operation?'), 'class'=>'btn')); ?>
            </div>
			<?php echo CHtml::endForm(); ?>
        </div><!-- end block-fluid -->
        
    </div><!-- end span12 -->
</div><!-- end row-fluid -->
<?php $this->widget('widgets.MyPager', array('pages'=>$pages, 'htmlOptions'=>array('class'=>'paging') )); ?>