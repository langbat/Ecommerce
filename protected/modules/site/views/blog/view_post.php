<div class="pull-left col-left">
    <div class="purple-grid">
        <div class="title">
            <h5><?php echo $model->title; ?></h5>
        </div>        
        <div class="top_text">
            <?php echo $content; ?>	
        	<div class="clearfix"></div>
        </div><!--#end product-wrapper-->
    </div>
 </div>
 
 
 <div class="pull-left col-right">
    <?php if(Yii::app()->user->isGuest){ ?>
        <?php $this->renderPartial('/elements/right-ads');?> 
        <?php $this->renderPartial('/elements/tested-safety');?>
        <?php $this->renderPartial('/elements/news-box');?>
    <?php }else{ ?>
    <div class="right-box">
        <?php $this->renderPartial('/elements/profile-menu')?>
    </div>
        <?php $this->renderPartial('/elements/right-ads');?>
        <?php $this->renderPartial('/elements/tested-safety');?>
        <?php $this->renderPartial('/elements/news-box');?>
    <?php } ?>
</div><!--#end col-right-->