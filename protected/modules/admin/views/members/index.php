<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?>
        <?php if(isset($type) && $type == 'admin'){ ?>
    <small><?php echo Yii::t('global', 'Admin'); ?></small></h1>
        <?php } else { ?>
    <small><?php echo Yii::t('global', 'Member'); ?></small></h1>
        <?php } ?>
</div>

<div class="row-fluid"><div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <?php if(isset($type) && $type == 'admin'){ ?>
            <h1><?php echo Yii::t('global', 'Admin'); ?></h1>
        <ul class="buttons">
            <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('members/createadmin') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Admin'); ?>"></a></li>
        </ul>
        <?php }  else { ?>
        <h1><?php echo Yii::t('global', 'Members'); ?></h1>
        <?php } ?>
    </div>
 <?php if(isset($type) && $type == 'admin'){ ?>
    <div class="block-fluid table-sorting hideUser-ajax">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'members-grid',
    	'dataProvider'=>$model->search(),
    	'filter'=>$model,
        'afterAjaxUpdate' => 'reinstallDatePicker',
    	'columns'=>array(
            array(
                'name'  => 'id',
                'header'=>Yii::t('global', 'UserId'),
                'value' =>'$data->id',
                'headerHtmlOptions'=> array('style' => 'width:70px;'),
            ),
    		'username',
            'fname',
            'lname',
    		'email',
            array(
                'name' => 'joined',
                'header'=>Yii::t('global', 'Registered date'),
                'htmlOptions'=> array('style' => 'text-align: center'),
                'filter' => $this->widget('CJuiDateTimePicker', array(
                        'model'=>$model,
                        'attribute'=>'joined',
                        'mode'=>'date',
                        'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                        'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                        'htmlOptions' => array(
                            'id' => 'datepicker_for_due_date',
                            'size' => '10',
                            'style' => 'text-align: center'
                        ),
                    ),
                    true)
            ),
    
            'city',
            array(
    			'class'=>'CButtonColumn',
                'template'=>'{view}{update}{hideMember}{changePassword}',
                'buttons'=>array
                (
                    'hideMember' => array
                    (
                        'label'=> Yii::t('global', 'Delete'),
                        'imageUrl'=>'/assets/images/delete.png',
                        'url'=>'$data->id',
                        'click'=>'function(){
                              hideMember($(this).attr("href"));
                              return false;
                        }',
                    ),
                    'changePassword' => array
                    (
                        'label'=> Yii::t('global', 'Change password'),
                        'imageUrl'=>'/assets/images/password.png',
                        'url'=>'Yii::app()->createUrl("admin/members/changepass", array("id" => $data->id, "action" => Yii::app()->controller->action->id))',
                    ),
                ),
    		),
    	),
    )); ?>
    </div>
<?php } else { ?>
<div class="block-fluid table-sorting hideUser-ajax">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'members-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
        array(
            'name'  => 'id',
            'header'=>Yii::t('global', 'UserId'),
            'value' =>'$data->id',
            'headerHtmlOptions'=> array('style' => 'width:70px;'),
        ),
        'username',
		'email',
        array(
                'name' => 'joined',
                'header'=>Yii::t('global', 'Registered date'),
                'htmlOptions'=> array('style' => 'text-align: center'),
                'filter' => $this->widget('CJuiDateTimePicker', array(
                        'model'=>$model,
                        'attribute'=>'joined',
                        'mode'=>'date',
                        'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                        'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                        'htmlOptions' => array(
                            'id' => 'datepicker_for_due_date',
                            'size' => '10',
                            'style' => 'text-align: center'
                        ),
                    ),
                    true)
            ),
        array(
            'name' => 'last_logged',
            'header'=>Yii::t('global', 'Last Logged'),
            'htmlOptions'=> array('style' => 'text-align: center'),
            'filter' => $this->widget('CJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'last_logged',
                    'mode'=>'date',
                    'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                    'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_due_date_last',
                        'size' => '10',
                        'style' => 'text-align: center'
                    ),
                ),
                true)
        ),
        array(
			'class'=>'CButtonColumn',
            'template'=>'{view}{update}{hideMember}{changePassword}',
            'buttons'=>array
            (
                'hideMember' => array
                (
                    'label'=> Yii::t('global', 'Delete'),
                    'imageUrl'=>'/assets/images/delete.png',
                    'url'=>'$data->id',
                    'click'=>'function(){
                          hideMember($(this).attr("href"));
                          return false;
                    }',
                ),
                'changePassword' => array
                (
                    'label'=> Yii::t('global', 'Change password'),
                    'imageUrl'=>'/assets/images/password.png',
                    'url'=>'Yii::app()->createUrl("admin/members/changepass", array("id" => $data->id, "action" => Yii::app()->controller->action->id))',
                ),
            ),
		),
	),
)); ?>
</div>
<?php } ?>
</div></div>
<script type="text/javascript">
    function hideMember(id){

        if(id == <?php echo Yii::app()->user->id ?>){
            alert('<?php echo Yii::t('global','You cant delete yourself!') ?>');
        } else {
            var hideConfirm = confirm('<?php echo Yii::t('global','Are you sure hidden in this user ?') ?>');
            if(hideConfirm == true){
                <?php if(isset($type) && $type == 'admin'){ ?>
                    $.post('/admin/members/hideAdmin?id='+id+'&ajax=members-grid', function(html) {
                        $('.hideUser-ajax').html(html);
                    });
                <?php } else { ?>
                    $.post('/admin/members/hideMember?id='+id+'&ajax=members-grid', function(html) {
                        $('.hideUser-ajax').html(html);
                    });
                <?php } ?>
            }
        }


    }
</script>
