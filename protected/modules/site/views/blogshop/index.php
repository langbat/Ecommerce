<div class="content-block">
    <div class="wrapper_profile">
        <div class="slider-box purple-grid">
            <?php if(Yii::app()->user->isGuest){ ?>
                <div class="message_profile fix-message">
                    <h1><span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','You must login to see this page.'); ?></h1>
                    <p>
                        <span class="frontend_account_index shopware_studio_snippet"><?php echo Yii::t('global','Please login to see this page.'); ?></span>
                    </p>
                </div>
            <?php } else { ?>
                <div class="title">
                    <h5><?php echo Yii::t('global','Blog Shop');?></h5>
                    <div class="create_link"><a class="isw-plus tipb" href="/blogshop/create" title="<?php echo Yii::t('global','Create Blog Shop') ?>"></a> </div>
                    
                </div>
                <div class="info_profile1 fix-info-profile">
                <?php $this->widget('zii.widgets.grid.CGridView', array(
                	'id'=>'blogshop-grid',
                	'dataProvider'=>$model->search(),
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                	'filter'=>$model,
                	'columns'=>array(
         	            array(
                                'name'=>'id',
                                'htmlOptions'=>array('style'=>'width:100px;')
                            ),
                		array(
                            'name'=>'category_name',
                            'header'=>Yii::t("global","Category name"),
                            'type'=>'raw',
                            'headerHtmlOptions'=> array('style' => 'width:170px;'),
                        ),
                		//array(
//                                'name'=>'shopname',
//                                'header'=>Yii::t('global','Name Shop'),
//                                'htmlOptions'=>array('style'=>'width:280px;'),
//                                'value'=>'$data->shop->name'
//                            ),
                        'title',
                        array(
                            'name' => 'created_blog',
                            'header'=>Yii::t("global","Create Date"),
                            'headerHtmlOptions'=> array('style' => 'text-align: center; width:150px;'),
                            'filter' => $this->widget('CJuiDateTimePicker', array(
                                    'model'=>$model,
                                    'attribute'=>'created_blog',
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
                		array(
                			'class'=>'CButtonColumn',
                            'headerHtmlOptions'=> array('style' => 'width:50px;'),
                		),
                	),
                ));      ?>              
                 </div><!--#end info-->
              
            <?php } ?>
        </div>
    </div>
</div>