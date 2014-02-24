<?php
if(Yii::app()->controller->id == 'videos' && Yii::app()->controller->action->id == 'search')
{
	$search['m'] = isset($_GET['m']) && $_GET['m'] == '1' ? 1 : 0;
	$search['s'] = isset($_GET['s']) && $_GET['s'] == '1' ? 1 : 0;
	$search['d'] = isset($_GET['d']) && $_GET['d'] == '1' ? 1 : 0;
	$search['t'] = isset($_GET['t']) ? $_GET['t'] : '';
	if($search['m']==0 && $search['s']==0 && $search['d']==0) $search['m']=$search['s']=$search['d']=1;
}
?>

<div class="row-fluid">
	<div class="search_box">
		<?php echo CHtml::form(Yii::app()->createUrl('/search'), 'get'); ?>
			<input type="text" name="t" value="<?php if(isset($search)) echo CHtml::encode($search['t']); ?>" class="txt_search"/>
			
			<input type="button" id="m" class="btn_checkbox m<?php if(!isset($search) || $search['m'] == 1) echo ' active'; ?>" value=""/>
			<input type="button" id="s" class="btn_checkbox s<?php if(!isset($search) || $search['s'] == 1) echo ' active'; ?>" value=""/>
			<input type="button" id="d" class="btn_checkbox d<?php if(!isset($search) || $search['d'] == 1) echo ' active'; ?>" value=""/>
			
			<input type="checkbox" name="m" value="1" class="checkbox"<?php if(!isset($search) || $search['m'] == 1) echo ' checked="checked"'; ?>/>
			<input type="checkbox" name="s" value="1" class="checkbox"<?php if(!isset($search) || $search['s'] == 1) echo ' checked="checked"'; ?>/>
			<input type="checkbox" name="d" value="1" class="checkbox"<?php if(!isset($search) || $search['d'] == 1) echo ' checked="checked"'; ?>/>
			<input type="submit" class="btn_search" value=""/>
		<?php echo CHtml::endForm(); ?>
	</div>
</div>
