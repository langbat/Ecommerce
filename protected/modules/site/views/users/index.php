<div id="profile" style="float: left; width:50%;">
    <h1 class="title"><?php echo Yii::t('global', 'Profile'); ?></h1>

    <?php if($model->hasErrors()): ?>
    	<p class="error">
    		<?php echo Yii::t('global', 'Please fix the following input errors'); //CHtml::errorSummary($model); ?>
    	</p>
    <?php endif; ?>
    
    <div class="row-fluid">
    	<div class="span3 bold"></div>
    	<div class="span4"><img src="<?php echo Yii::app()->homeUrl.'uploads/avatar/';
    		if($model->photo !='' && file_exists(ROOT_PATH.'uploads/avatar/t_'.$model->photo) ) echo 't_'.$model->photo;
    		else echo 'default.png';
    	?>" alt="<?php echo $model->fname . ' ' . $model->lname; ?>"/></div>
    </div>
   
    <div class="row-fluid">
        <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'fname'); ?></div>
    	<div class="span3 bold"><?php echo $model->fname; ?></div>
    </div>
    
    <div class="row-fluid">
        <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'lname'); ?></div>
    	<div class="span3 bold"><?php echo $model->lname; ?></div>
    </div>
    
    <div class="row-fluid">
        <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'address'); ?></div>
    	<div class="span3 bold"><?php echo $model->address; ?></div>
    </div>
    
    <div class="row-fluid">
        <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'city'); ?></div>
    	<div class="span3 bold"><?php echo $model->city; ?></div>
    </div>
    
    <div class="row-fluid">
        <div class="span3 bold"><?php echo CHtml::activeLabel($model, 'phone'); ?></div>
    	<div class="span3 bold"><?php echo $model->phone; ?></div>
    </div>
</div>   
    
   <!-- for OPTION --> 
<div id="profile" style="float: left; width:40%;">
    <h1 class="span7 offset1"><u><?php echo Yii::t('global', 'Setting'); ?></u></h1>
    
    <div class="span3" style="margin-top:20px">
        <div class="text w49 left">
            <h4><?php echo Yii::t('global', 'Change Password'); ?></h4>
        </div>
        <div class="set w49 right center">
            <div class="absolute save"></div>
            <a class="italic" href="<?php echo $this->createUrl('/users/changepass'); ?>"> <?php echo Yii::t('global', 'Change Password for this account'); ?> </a>
        </div>
    </div>
    
     <div class="span3" style="margin-top:20px">
        <div class="text w49 left">
            <h4><?php echo Yii::t('global', 'Edit This User'); ?></h4>
        </div>
        <div class="set w49 right center">
            <div class="absolute save"></div>
            <a class="italic" href="<?php echo $this->createUrl('/users/editprofile'); ?>"><?php echo Yii::t('global', 'Edit This User Information'); ?></a>
        </div>
    </div>
    
    <div class="span3" style="margin-top:20px">
        <div class="text w49 left">
            <h4><?php echo Yii::t('global', 'Newsleter:'); ?> </h4>
        </div>
        <?php if(empty($newsleter)){?>
            <div class="set w49 right center">
                <div class="absolute buy"><a style="margin-left:12px" href="/users/togglenewsletter"></a></div>
                <a class="italic" href="/users/togglenewsletter"><?php echo Yii::t('global', 'Deactivate'); ?></a>
            </div>
        <?php }else{ ?>
            <div class="set w49 right center">
                <div class="absolute save"><a href="/users/togglenewsletter"></a></div>
                <a class="italic" href="/users/togglenewsletter"><?php echo Yii::t('global', 'Activate'); ?></a>
            </div>
        <?php } ?>
    </div>
    
    <div class="span3" style="margin-top:20px">
        <div class="text w49 left">
            <h4><?php echo Yii::t('global', 'Delete User'); ?></h4>
        </div>  
        <div class="set w49 right center">
            <div class="absolute buy"><a style="margin-left:12px" href="/users/delete"  onclick="return confirm('Are you sure you want to delete?')"><?php echo Yii::t('global', 'Click to delete this user'); ?></a></div>
            <p class="italic" style="color:#fff" href="/users/delete"  onclick="return confirm('Are you sure you want to delete?')">Delete</p>
        </div>
    </div>
</div>    
    
    
   
