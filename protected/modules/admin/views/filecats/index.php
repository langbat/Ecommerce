<div class="page-header">
	<h1>Manage <small>File Categories</small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

<div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-list"></div>
			<h1><?php echo Yii::t('adminfilecats', 'File Categories'); ?> (<?php echo Yii::app()->format->number($count); ?>)</h1>
			<ul class="buttons">
				
				<li>
					<a href="<?php echo $this->createUrl('filecats/addfilecat', array()); ?>" class="isw-text_document tipb" data-original-title="<?php echo Yii::t('adminfilecats', 'Add New File Category'); ?>"></a>
				</li>
			</ul>                        
		</div>
		<div class="block-fluid">
			<?php echo CHtml::form(); ?>
			<table cellpadding="0" cellspacing="0" width="100%" class="table">
				<thead>
					<tr>			
					   <th style='width: 30%;'><?php echo $sort->link('name', Yii::t('adminfilecats', 'Name'), array( 'class' => 'tooltip', 'title' => Yii::t('adminfilecats', 'Sort user list by username') ) ); ?>Name Category</th>
					   <th style='width: 60%;'><?php echo $sort->link('desc', Yii::t('adminfilecats', ''), array( 'class' => 'tooltip', 'title' => Yii::t('adminfilecats', 'Sort user list by email') ) ); ?>Description</th>
					   <th style='width: 10%;'><?php echo Yii::t('adminfilecats', 'Options'); ?></th>						
					</tr>
				</thead>
				<tbody>
					<?php if ( count($rows) ): ?>
						<?php foreach ($rows as $row): ?>
							<tr>						
								<td><?php echo CHtml::encode($row->name); ?></td>
								<td><?php echo CHtml::encode($row->desc); ?></td>
								<td>
									<a href="<?php echo $this->createUrl('filecats/editfilecat', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Edit this category'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/pencil.png" alt="Edit" /></a>
									<a href="<?php echo $this->createUrl('filecats/deletefilecat', array( 'id' => $row->id )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminglobal', 'Delete this category!'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/cross.png" alt="Delete" /></a>
								</td>
							</tr>
						<?php endforeach ?>
					<?php else: ?>	
						<tr>
							<td colspan='7' style='text-align:center;'><?php echo Yii::t('adminfilecats', 'No categories found.'); ?></td>
						</tr>
					<?php endif; ?>                               
				</tbody>
			</table>
			
			<?php echo CHtml::endForm(); ?>
		</div>
	</div>                                
</div>
<?php $this->widget('widgets.MyPager', array('pages'=>$pages, 'htmlOptions'=>array('class'=>'paging') )); ?>