
<div class="page-header">
	<h1>Manage <small><?php echo Yii::t('global', 'Languages')?></small></h1>
</div>

<!-- Start .notifications -->
<?php $this->widget('widgets.admin.notifications'); ?>
<!-- End .notifications -->

 <div class="row-fluid">
	<div class="span12">                    
		<div class="head clearfix">
			<div class="isw-grid"></div>
			<h1><?php echo Yii::t('adminlang', 'Languages'); ?></h1>
		</div>
		<div class="block-fluid">
			<table cellpadding="0" cellspacing="0" width="100%" class="table">
				<thead>
					<tr>
						<th style='width: 20%;'><?php echo Yii::t('adminlang', 'Language Key'); ?></th>
						<th style='width: 20%;'><?php echo Yii::t('adminlang', 'Language Title'); ?></th>
						<th style='width: 20%;'><?php echo Yii::t('adminlang', 'Source Language'); ?></th>
						<th style='width: 20%;'><?php echo Yii::t('adminlang', '# Strings'); ?></th>
						<th style='width: 20%;'><?php echo Yii::t('adminlang', 'Options'); ?></th>						
					</tr>
				</thead>
				<tbody>
					<?php foreach( Yii::app()->params['languages'] as $key => $value ): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $value; ?></td>
							<td>
								<?php if( $key == Yii::app()->sourceLanguage ): ?>
									<img class="tipb" data-original-title='<?php echo Yii::t('adminlang', 'Source Language'); ?>' src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/tick_circle.png" alt="Source Language" />
								<?php else: ?>
									<img class="tipb" data-original-title='<?php echo Yii::t('adminlang', 'Not Source Language'); ?>' src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/cross_circle.png" alt="Not Source Language" />
								<?php endif; ?>		
							</td>
						    <td>
								<?php if( $key == Yii::app()->sourceLanguage ): ?>
									<?php echo Yii::app()->format->formatNumber( $totalStringsInSource ); ?>
								<?php else: ?>
									<?php echo $this->getStringTranslationDifference( $key ) . ' / ' . Yii::app()->format->formatNumber( Message::model()->count('language=:key', array(':key'=>$key)) ); ?>
								<?php endif; ?>		
							</td>
							<td>
								<?php if($key == Yii::app()->sourceLanguage): ?>
									<img class="tipb" data-original-title='<?php echo Yii::t('adminlang', 'Source cannot be translated'); ?>' src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/information.png" alt="Translate" />
								<?php else: ?>
									<a href="<?php echo $this->createUrl('languages/translate', array( 'id' => $key )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminlang', 'Translate this language'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/pencil.png" alt="Translate" /></a>
									<a href="<?php echo $this->createUrl('languages/translateneeded', array( 'id' => $key )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminlang', 'Translate only the strings that were not translated yet.'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/pencil.png" alt="Translate" /></a>
									<a href="<?php echo $this->createUrl('languages/copystrings', array( 'id' => $key )); ?>" class="tipb" data-original-title="<?php echo Yii::t('adminlang', 'Copy missing language strings from source into this language'); ?>"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/icons/copy.png" alt="copy" /></a>
								<?php endif; ?>
							</td>
						</tr>	
					<?php endforeach; ?>                             
				</tbody>
			</table>
		</div>
	</div>                                
</div>