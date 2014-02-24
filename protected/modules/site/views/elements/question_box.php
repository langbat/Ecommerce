<div class="post entry-content " id="">
	<!--cached-Sun, 22 Dec 2013 09:28:25 +0000-->
	<p class="citation">
		<?php echo $data->name . ', '.Yii::t('globle','on').' '.$data->datequestion.', '.Yii::t('global','ask').':'?>
        <br/>
       <span><?php echo Yii::t('globle','Email').': '.$data->emails?></span> 
	</p>
	<div class="blockquote">
		<div class="quote">
        <?php echo $data->questions?><br />
        <?php if(!empty($data->answers)){?>
        <i class="fa fa-share"></i>	<p class="citation" style="margin-left: 10px;">
	       	<?php echo 'Tosello.tv, '.Yii::t('globle','on').' '. $data->dateanswer .', '.Yii::t('global','answer').':'?>
        	</p>       
        <div class="prettyprint"><?php echo $data->answers?></div>
        <?php }?>
		</div>
	</div>
</div>