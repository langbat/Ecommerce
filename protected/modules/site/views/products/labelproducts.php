<div class="pull-left col-left">
    <h5 class="left-10"><?php echo $label->name?></h5>
    <div class="product-wrapper show-grid">
        <?php $this->widget('zii.widgets.CListView', array(
        	'dataProvider'=>$products,
        	'itemView'=>'../elements/product-box-item',
        ));
        ?>
        
        <div class="clearfix"></div>
    </div><!--#end product-wrapper-->	
</div><!--#end col-left-->

<div class="pull-left col-right">
    <?php if(Yii::app()->user->isGuest){ ?>   
        <?php $this->renderPartial('/elements/tested-safety');?>
        <?php $this->renderPartial('/elements/news-box');?>
    <?php }else{ ?>
    <div class="right-box">
        <?php $this->renderPartial('/elements/profile-menu')?>
    </div>
        <?php $this->renderPartial('/elements/tested-safety');?>
        <?php $this->renderPartial('/elements/news-box');?>
    <?php } ?>
</div><!--#end col-right-->