<?php $tutorial =  Support::model()->gettutorial();if(count($tutorial)>0){?>

<div class="span3">
	<div class="purple-box-sup">
		<div class="title">
			<h5><?php echo $tutorial->title?></h5>
		</div>
		<div class="block" style="padding: 10px 5px 10px; background-color: #ffffff;">

			<p >
				<?php echo (strlen($tutorial->description)>100)?substr($tutorial->description, 0, 100). '.....':$tutorial->description?>
			</p>
			<a class="img_video_sup" href="/support/tutorialdetail?id=<?php echo $tutorial->id?>"><?php echo Support::model()->getImgFromVideo($tutorial->linkyoutube)?></a>
			<a href="/support/tutorials" style="margin-top: 20px;display: block;"><i class="fa fa-angle-double-right"></i>Details</a>
		</div>

	</div>
</div>
<?php }?>