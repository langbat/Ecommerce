<div class="pull-left col-left">
    <?php $this->renderPartial('help-box');?>		
</div><!--#end col-left-->

<div class="pull-left col-right">
    <?php if(!Yii::app()->user->isGuest){ ?>
    <div class="right-box">
        <?php $this->renderPartial('/elements/profile-menu')?>
    </div>
    <?php } else { ?>
    <?php $this->renderPartial('/elements/right-ads');
    //$this->renderPartial('/elements/auction-finished');
    $this->renderPartial('/elements/tested-safety');
    $this->renderPartial('/elements/news-box');
}?>
</div><!--#end col-right-->
 