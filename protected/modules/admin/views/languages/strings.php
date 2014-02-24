<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('adminlang', 'Language Strings'); ?> (<?php echo $count; ?>)</h1>
    </div>
<div class="block-fluid">
			<?php $this->widget('widgets.admin.pager', array( 'pages' => $pages )); ?>
            <form method="GET" action="">
            <input type="hidden" name="id" value="<?php echo isset($_GET['id'])?$_GET['id']:''?>" />
            <table style="width: 100%;">
                <tr>
    			   <th><?php echo Yii::t('adminlang', 'Original String'); ?></th>
    			   <th><input type="text" name="source" value="<?php echo isset($_GET['source'])?$_GET['source']:''?>" /></th>
    			   <th><?php echo $sort->link('translation', Yii::t('adminlang', 'Translation')); ?></th>
                   <th><input type="text" name="translation" value="<?php echo isset($_GET['translation'])?$_GET['translation']:''?>" /></th>
    			   <th><input type="submit" class="btn" value="<?php echo Yii::t('global', 'Search')?>" /></th>
    			</tr>
            </table>
            </form>
            
			<?php echo CHtml::form(); ?>
			<table class="items table">
				<thead>
					<tr>
					   <th style='width: 5%;'><?php echo $sort->link('id', Yii::t('adminlang', 'ID'), array( 'class' => 'tooltip', 'title' => Yii::t('adminlang', 'Sort by string id') ) ); ?></th>
					   <th style='width: 40%;'><?php echo Yii::t('adminlang', 'Original String'); ?></th>
					   <th style='width: 40%;'><?php echo $sort->link('translation', Yii::t('adminlang', 'Translation'), array( 'class' => 'tooltip', 'title' => Yii::t('adminlang', 'Sort by translation') ) ); ?></th>
					   <th style='width: 10%;'><?php echo Yii::t('adminlang', 'Options'); ?></th>
					</tr>                    
				</thead>
				<tfoot>
					<tr>
						<td colspan="4">					
							<?php $this->widget('widgets.admin.pager', array( 'pages' => $pages )); ?>
							<div class="clear"></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
					
					<?php if( count($strings) ): ?>
						
						<?php foreach( $strings as $string ): ?>
							<?php $orig = SourceMessage::model()->findByPk($string->id); ?>
							<tr>
								<td><?php echo $string->id; ?></td>
								<td style='vertical-align:top;'><?php echo CHtml::encode($orig->message); ?> <br /><small>(<?php echo $orig->category; ?>)</small></td>
								<td><?php echo CHtml::textArea("strings[{$string->id}]", $string->translation, array( 'rows' => 3, 'style' => 'width: 96%' )); ?></td>
							    <td>&nbsp;
							    	<?php if( $string->translation != $orig->message ): ?>
										<a href="<?php echo $this->createUrl('languages/revert', array( 'id' => $string->language, 'string' => $string->id )); ?>" title="<?php echo Yii::t('adminlang', 'Revert translation to original'); ?>" class='tooltip'>
											<img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/revert.png" alt="revert" />
										 </a>
									<?php endif; ?>
                                    
                                    <a class="delete-row" href="<?php echo $this->createUrl('languages/delete', array( 'id' => $string->id )); ?>" title="<?php echo Yii::t('adminlang', 'Delete'); ?>" class='tooltip'>
										<img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/cross.png" alt="revert" />
									 </a>
							    </td>
							</tr>	
						<?php endforeach; ?>
					
					<tr>
						<td colspan='4' style='text-align:right;' class="footer tar"><?php echo CHtml::submitButton(Yii::t('adminlang', 'Submit'), array('name'=>'submit','class' => 'btn')); ?></td>
					</tr>
					
					<?php else: ?>	
					<tr>
						<td colspan='4' style='text-align:center;'><?php echo Yii::t('adminlang', 'No strings found.'); ?></td>
					</tr>
					<?php endif; ?>
					
				</tbody>
			</table>
			
			<?php echo CHtml::endForm(); ?>
	</div><!-- form --></div></div>
 <script type="text/javascript">
 $(document).ready(function(){
    $('.delete-row').click(function(){
        var obj = this;
        $.get(this.href, function(){
            $(obj).parent().parent().remove();
        })
        return false;
    })
 })
 </script>