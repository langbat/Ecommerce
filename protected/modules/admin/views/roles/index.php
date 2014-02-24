
<div class="page-header">
	<h1><?php echo Yii::t('global', 'Manage'); ?> <small><?php echo Yii::t('adminroles', 'Roles'); ?></small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

 <div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-grid"></div>
			<h1><?php echo Yii::t('adminroles', 'Roles'); ?></h1>
            <ul class="buttons">
                <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('roles/addauthitem') ?>" data-original-title="<?php echo Yii::t('adminroles', 'Add Auth Item'); ?> "></a></li>
            </ul>
		</div>
		<div class="block-fluid">
			<table cellpadding="0" cellspacing="0" width="100%" class="table">
				<thead>
					<tr>
                                        
				           <th style='width: 20%'><?php echo $sort->link('name', Yii::t('adminroles', 'Name'), array( 'class' => 'tooltipsy', 'title' => Yii::t('adminroles', 'Sort list by name') ) ); ?></th>
        				   <th style='width: 50%'><?php echo $sort->link('description', Yii::t('adminroles', 'Description'), array( 'class' => 'tooltipsy', 'title' => Yii::t('adminroles', 'Sort list by description') ) ); ?></th>
        				   <th style='width: 10%'><?php echo $sort->link('type', Yii::t('adminroles', 'Type'), array( 'class' => 'tooltipsy', 'title' => Yii::t('adminroles', 'Sort list by type') ) ); ?></th>
        				   <th style='width: 5%'><?php echo Yii::t('adminroles', 'Children'); ?></th>
        				   <th style='width: 15%'><?php echo Yii::t('adminroles', 'Options'); ?></th>						
					</tr>
				</thead>
				<tfoot>
				<tr>
					<td colspan="6">													
						<?php $this->widget('widgets.admin.pager', array( 'pages' => $pages )); ?>
						<div class="clear"></div>
					</td>
				</tr>
    			</tfoot>
    			<tbody>
    			<?php if ( count($rows) ): ?>
    				
    				<?php foreach ($rows as $row): ?>
    					<tr>
    						<td><a href="<?php echo $this->createUrl('roles/viewauthitem', array( 'parent' => $row->name )); ?>" title="<?php echo Yii::t('adminroles', 'View Auth Item'); ?>" class='tooltipsy'><?php echo CHtml::encode($row->name); ?></a></td>
    						<td><?php echo CHtml::encode($row->description); ?></td>
    						<td><?php echo Yii::t('adminroles', AuthItem::model()->types[ $row->type ]); ?></td>
    						<td title='<?php echo Yii::t('adminroles', 'Item Children'); ?>'><?php echo count(Yii::app()->authManager->getItemChildren($row->name)); ?></td>
    						<td>
    							<!-- Icons -->
    							<a href="<?php echo $this->createUrl('roles/addauthitemchild', array( 'parent' => $row->name )); ?>" title="<?php echo Yii::t('adminroles', 'Add auth child item'); ?>" class='tooltipsy'><i class="icon-plus"></i></a>
    							 <a href="<?php echo $this->createUrl('roles/editauthitem', array( 'id' => $row->name )); ?>" title="<?php echo Yii::t('adminroles', 'Edit this auth item'); ?>" class='tooltipsy'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/update.png" alt="Edit" /></a>
    							 <a href="<?php echo $this->createUrl('roles/deleteauthitem', array( 'id' => $row->name )); ?>" title="<?php echo Yii::t('adminroles', 'Delete this auth item!'); ?> "class='tooltipsy deletelink'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/delete.png" alt="Delete" /></a>
    						</td>
    					</tr>
    				<?php endforeach ?>
    
    			<?php else: ?>	
    				<tr>
    					<td colspan='5' style='text-align:center;'><?php echo Yii::t('adminroles', 'No items found.'); ?></td>
    				</tr>
    			<?php endif; ?>
    			</tbody>
			</table>
		</div>
	</div>                                
</div>