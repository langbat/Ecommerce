<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Member Shops'); ?></small></h1>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="head clearfix">
            <div class="isw-grid"></div>
            <h1><?php echo Yii::t('global', 'Member Shops'); ?></h1>      
            <ul class="buttons">
                <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('memberShop/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'MemberShop'); ?>"></a></li>
            </ul>                        
        </div>
        <div class="block-fluid table-sorting">
    
            <?php $this->widget('zii.widgets.grid.CGridView', array(
            	'id'=>'member-shop-grid',
            	'dataProvider'=>$model->search(),
            	'filter'=>$model,
                'afterAjaxUpdate' => 'reinstallDatePicker',
            	'columns'=>array(
            		array(
                        'name'=>'id',
                        'htmlOptions'=>array('width'=>'50'),
                        'value'=>'$data->id'
                    ),
                    array(
                        'name' => 'username',
                        'header'=>Yii::t('global','User'),
                        'value' => 'CHtml::link($data->user->username,array("/admin/members/view/","id"=>$data->user_id))',
                        'type' => 'raw',
                        //'htmlOptions'=>array('style'=>'text-align:center'),
                    ),
            		//'user_id',
            		'name',
            		'slogan',
            		'email',
            	       array(
                        'header'=>Yii::t('global','Image'),
                        'type' => 'raw',
                        'value' => '$data->showAdminImage()',
                        'htmlOptions'=>array('style'=>'width:80px;')
                    ),
                     array(
                        'name' => 'created',
                        'header'=>Yii::t("global","Create Date"),
                        'headerHtmlOptions'=> array('style' => 'text-align: center; width:150px;'),
                        'filter' => $this->widget('CJuiDateTimePicker', array(
                                'model'=>$model,
                                'attribute'=>'created',
                                'mode'=>'date',
                                'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                                'language' => Yii::app()->language=='en'?'':Yii::app()->language,
                                'htmlOptions' => array(
                                    'id' => 'datepicker_for_due_date',
                                    'size' => '10',
                                    'style' => 'text-align: center; border-right: 1px solid #dddddd;'
                                ),
                            ),
                            true)
                    ),
            		/*
            		'description',
            		'created',
            		'updated',
            		*/
            		array(
            			'class'=>'CButtonColumn',
            		),
            	),
            )); ?>
        </div>
    </div>
</div>