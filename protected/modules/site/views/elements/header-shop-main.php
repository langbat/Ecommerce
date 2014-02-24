<div id="wrapper-header">
    <div class="cnt_top_header">
	   <div class="row-fluid show-grid" id="logo-login-bar">
            <div class="span3"><a href="<?php echo Yii::app()->homeUrl;?>"><img alt="Logo" src="/themes/default/img/logo.png"></a></div>
            <div class="span4" style="width: 330px;">
                <ul style="list-style: none;">
                <li class="mbNavEntry" id="mbSearch" style="width: 320px; margin-top: 30px; margin-left: -20px;">
                <form method="get" action="">
                    <div class=" input-append shop-select-checker">
                        <select name="shop_id" class="shop-select">
                            <?php if(isset($this->membershop)){ ?>
                            <option value="<?php echo $this->membershop->id; ?>"><?php echo $this->membershop->name; ?></option>
                            <option value="0">All Shops</option>
                            <?php }else{ ?>
                                <option value="0">All Shops</option>
                            <?php } ?>
                        </select>
                        <input id="mbHeadSearchInput" name="condition" <?php if(isset($_GET['condition'])){ ?> value="<?php echo $_GET['condition'];?>" <?php }?>type="text" placeholder="<?php echo Yii::t('global','Search') ?>..." style="width: 134px;">
                        <button type="button" class="check" id="mbHeadSearchButton"><?php echo Yii::t('global','Search') ?></button>
                    </div>
                </form>
            </li>
            </ul>
            </div>
    		<div class="span5 login-span" style="width: 370px;">
                <?php $this->renderPartial('/elements/cart');?>
    			<?php $this->renderPartial('/elements/login');?>
    	   </div> 
	   </div>
    </div> 
     <!-- Begin Add 02/07/2014 -->
      <?php if( $this->membershop->banner != '' ){?> 
             <div id="main-banner-shop">   
                   <div id="around-banner">
                       <span class="title-banner-shop"><img src="/themes/default/img/star-gold.png"/> <?php echo $this->membershop->name; ?> <?php echo Yii::t('global','Online Shop'); ?>  </span>
                       <span class="menu-banner-shop"><p class="new-request-links"> <a href="<?php echo Yii::app()->homeUrl;?>"> <?php  echo Yii::t('global','Home'); ?> </a> <span style="padding-right: 10px !important;"></span> <a href="/shop/detail/<?php echo $this->membershop->id; ?>"> <?php echo Yii::t('global','Our stores'); ?>  </a> </p></span>
                       <div class="img-banner">
                        
                        <img src="/uploads/logoshop/<?php echo $this->membershop->banner; ?>" alt="<?php echo $this->membershop->name; ?>" /> 
                        
                       </div>
                   </div>
             </div>
         <?php } ?> 
          <!-- End Add -->       
</div>
<div id="checkConditon" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 style="text-align: left;"><?php echo Yii::t('global', 'Notice')?>
        </h5>
    </div>
    <div class="modal-body" >
        <p class="sms" style="text-align: center; font-size: 12px;">
        <?php echo Yii::t('global','You must input keyword')  ?>
        </p>
    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>

<script>
$('.check').click(function(){
       var id = $('.shop-select').val();
       var condition = $('#mbHeadSearchInput').val().trim();
       if(condition == ''){
            $('#checkConditon').modal('show');
       }else{
            if(id != 0){
                window.location.href = '/shop/search/'+id+'/'+condition;
            }else{
                window.location.href = '/search.html?q='+condition;
            }
       }
       
    });
</script>