
<div class="span12">
    <div class="head clearfix ">
        <div class="isw-calendar"></div>
        <h1><?php echo Yii::t('global','Schedule shows') ?></h1>
        <ul class="buttons">
            <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('scheduleShows/create?id='.$model->id) ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'ScheduleShows'); ?>"></a></li>
        </ul>
    </div>
    <div class="block gallery clearfix">
        <?php
        $schedule=new ScheduleShows('search');
        $schedule->product_id = $model->id;

        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'schedule-shows-grid',
            'summaryText'=>'',
            'dataProvider'=>$schedule->search(),
            'columns'=>array(
                array(
                    'name'=>'id',
                    'type'=>'raw',
                    'value'=>'CHtml::link($data->id,array("/admin/scheduleShows/view","id"=>$data->id))'
                ),
                'start_time',
                'end_time',
                'content',

            ),
        )); ?>
    </div>