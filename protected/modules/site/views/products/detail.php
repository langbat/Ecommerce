<script type="text/javascript" src="/themes/default/js/jquery.elevatezoom.js"></script>
<div id="myModal" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'Notice')?></h5>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>
<div class="detail_product">
    <div class="head_detail">
        <div id="email-error" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="title">
                <h5 ><?php echo Yii::t('global', 'Notice')?></h5>
            </div>
            <div class="modal-body">
                <p class="fix_content_modal">
                    <?php echo Yii::t('global','Please enter your email valid!')  ?>
                </p>
            </div>
            <div class="modal-footer fix-footer-popup">
                <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
        
        </div>
            <form id="subscribe" action="" method="post">
                <input class="email_promotion defaultText " name="email_customer" type="text" title="<?php echo Yii::t('global','Enter your email to be the first one get  promotion from us...') ?>" />
                <span class="arrow_sub"></span>
                <input class="subscribe_now" type="submit" id="clickable"  name="action" value="<?php echo Yii::t('global','SUBSCRIBE NOW') ?>">
            </form>
          
    </div>
    <?php $this->renderPartial('/elements/detail_product', compact('product', 'sessionId', 'token','ordered','checkSchedule','last_product_tv'));?>
    <div class="content_detail">
        <div class="left_col_content">
           <?php $this->renderPartial('col_left_detail',compact('product','schedule','checkSchedule')) ?>
        </div>
        <div class="right_col_content">
            <div class="picture_detail">
                <div class="img_large">
                    <img id="img_01" src="/uploads/product/<?php echo $product->image ?>" data-zoom-image="/uploads/product/<?php echo $product->image ?>"/>
                </div>
                <div class="img_small" id="gallery_01">
                    <a  href="#" class="active" data-id="/uploads/product/<?php echo $product->image ?>" data-zoom-image="/uploads/product/<?php echo $product->image ?>"> <img src="/uploads/product/<?php echo $product->image ?>" id="img_01" /></a>
                    <?php foreach($gallery as $images){
                    echo '<a href="#" data-id="/uploads/product_gallery/'.$images['filename'].'" data-zoom-image="/uploads/product_gallery/'.$images['filename'].'"> <img id="img_01" src="/uploads/product_gallery/'.$images['filename'].'" /></a>';
                    }
                    ?>

                </div>
                 <script>
                        $("#img_01").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active'}); 
                        
                        //pass the images to Fancybox
                        $("#img_01").bind("click", function(e) {  
                          var ez =   $('#img_01').data('elevateZoom');	
                        	$.fancybox(ez.getGalleryList());
                          return false;
                        });
                </script>
            </div>
            <div class="info_detail">
                <div class="product_info">
                    <div class="title_info"><?php echo Yii::t('global','Product Information') ?></div>
                    <div class="content_info">
                        <?php echo $product->short_desciption ?>
                    </div>
                </div>
                <div class="review_rate">
                    <div class="title_rate"><?php echo Yii::t('global','Rating and Review') ?></div>
                    <div class="content_rate fix_content_comment">
                        <?php
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id'=>'comment-grid',
                            'dataProvider'=>$commentProduct,
                            'summaryText'=>'',
                            'columns'=>array(
                                array(
                                    'name'=>'content',
                                    'header'=>false,
                                )
                            )));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="icon_chat">
        <a class="view-chat-box" href="#"><img src="/themes/default/img/icon_chat.png"/></a>
    </div>

</div>

<div id="myModal2" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'Confirm message')?>
        </h5>
    </div>
    <div class="modal-body">
        <p class="fix_content_modal">
            <?php echo Yii::t('global','Product will be put in Shopping cart ')  ?>
        <div class="bnt_confirm">
            <button class="btn btn-warning agree" type="button"> <?php echo Yii::t('global','Yes')  ?></button>
            <button class="btn eject" type="button eject"> <?php echo Yii::t('global','No')  ?></button>
        </div>
        </p>

    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>

<div id="descritpionShipping" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'Description Shipping fee')?>
        </h5>
    </div>
    <div class="modal-body">
        <p class="fix_content_modal">
            <?php  $shipping_clause = ShippingClause::model()->findByAttributes(array('alias'=>'shipping_clause')) ;
                    echo $shipping_clause->shipping_fee_clause_inside." </br>".$shipping_clause->shipping_fee_clause_outside
            ?>

        </p>

    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>

    <div id="shipping_info" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="title">
            <h5 ><?php echo Yii::t('global', 'Delivery time of product')?>
            </h5>
        </div>
        <div class="modal-body">
            <p class="fix_content_modal">
                <?php echo Yii::app()->settings->delivery_time; ?>

            </p>

        </div>
        <div class="modal-footer fix-footer-popup">
            <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

    </div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.view-chat-box').click(function(){
            var moderator = '<?php echo $product->user->username; ?>';
            var mesage    = ' ';
            if (mesage != ''){
                chatWith(moderator, mesage);
            }
            return false;
        });
        $('.img_small a').click(function(){
           var url = $(this).attr('data-id');
            var old_url = $('#img_01').attr('src');
            if(url != old_url){
                $('.img_small a').removeClass('active');
                $('#img_01').fadeOut(300, function(){
                    $(this).attr('src',url).bind('onreadystatechange load', function(){
                        if (this.complete){
                            $(this).fadeIn(300);
                        }
                    });
                });
                $(this).addClass('active');
            }

        });
        $('.subscribe_now').click(function(){
            var email = $('.email_promotion').val();
            var checkEmail = validateEmail(email);
            if(checkEmail == true){
                $.get('/products/AddNewsletter?email='+email,function(data){
                    $(".modal-body").html(data);
                     $('#myModal').modal('show');
                     location.reload(true);
                });
            } else {
                $('#email-error').modal('show');
                $('#email-error').html();
            }
            return false;
        })
    });
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>
