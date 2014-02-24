<div id="myModal2" class="modal hide fade purple-grid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="title">
        <h5 ><?php echo Yii::t('global', 'Confirm message')?>
        </h5>
    </div>
    <div class="modal-body">
        <p class="fix_content_modal">
            <?php echo Yii::t('global','Product will be put in Shopping cart ')  ?>
            <div class="bnt_confirm">
                <button class="btn btn-warning agree_shop" type="button" id="btn-sgree"> <?php echo Yii::t('global','Yes')  ?></button>
                <button class="btn eject" type="button eject"> <?php echo Yii::t('global','No')  ?></button>
            </div>

        </p>

    </div>
    <div class="modal-footer fix-footer-popup">
        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

</div>

<div class="content" >
<div class="row-fluid">
  <div class="picture_detail">
        <div class="img_large">
        <?php if($productshopdetail != null){ ?>
            <img id="large_img" src="/uploads/product_shop/<?php echo $productshopdetail['image']; ?>" />
        <?php }else{ ?>
            <img id="large_img" src="/uploads/product_shop/no-images.jpg" />
        <?php } ?>
        </div>
        <?php
        if(count($productshopdetail) > 1 ){?>
            <div class="img_small">
                <a  class="active" data-id="/uploads/product_shop/<?php echo $productshopdetail[0]['image'] ?>"> <img src="/uploads/product_shop/<?php echo $productshopdetail[0]['image'] ?>" /></a>
                <?php foreach($productshopdetail as $images){
                echo '<a data-id="/uploads/product_gallery_shop/'.$images['filename'].'"> <img src="/uploads/product_gallery_shop/'.$images['filename'].'" /></a>';
                }
                ?>
            </div>
        <?php }?>
        

    </div>
<div class="span7" id="span7-product">
    <div class="attributeSection" id="info-product">
       
        <div class="row">
            <h4> <?php echo $productshopdetail[0]['name'] ?></h4>
            <div class="category-name"><?php echo Yii::t('global',"Category") ?>: 
            <span class="special-name">
            <?php
           
             for($i = 0; $i<count($namecategory); $i++){ ?> 
            <a href="/shop/category/<?php echo $this->membershop->id.'/'. $namecategory[$i]['id'] ?>"><?php if($i== (count($namecategory)- 1)){echo $namecategory[$i]['name'] ;}else{echo $namecategory[$i]['name'] . ", " ;} };?></a> 
            </span></div>
            <div class="category-name"><?php echo Yii::t('global',"Price") ?>: <span class="special-price"><?php echo Utils::number_format($productshopdetail[0]['price']); ?>€</span></div>
            <div class="category-name"><?php echo Yii::t('global',"statt") ?>: 
            <span class="pass-price"><?php echo Utils::number_format($productshopdetail[0]['direct_buy_price']); ?>€</span></div>
            </div>
        <div class="row">
           
        </div>
        <div class="row">
            <input class="input-mini" type="text" value="1" name="quantity"> 
            <button class="add_to_cart btn_buy_shop btn"  data-id="<?php echo $productshopdetail[0]['id']?>" type="button" id="btn-product"><?php echo Yii::t('global', 'ADD TO CART');?></button>
        </div>  
        <div class="pr-info" id="rating-shop-detail">
            <span><?php 
                $this->widget('ext.dzRaty.DzRaty', array(
                    'name' => 'my_rating_product_id_'.$productshopdetail[0]['id'],
                    'value' => Ratings::model()->getRating($productshopdetail[0]['id'], 1 ),
                    'options' => array(
                            'half' => TRUE,
                            	'click' => "js:function(score, evt){ ratings(score,".$productshopdetail[0]['id'].",1) }",

                    ),
                    'htmlOptions' => array(
                    'class' => 'new-half-class'
                    ),
                ));
                $this->renderPartial('../elements/rate_product',array('product_id'=>$productshopdetail[0]['id']));
              ?>
             </span>  <span class='rating-total-detail'>( <?php Ratings::model()->totalRating( $productshopdetail[0]['id'], 1 ); ?> )  </span>
        <div class="comment_product" >
            <?php echo Yii::t('global','Add comment') ?>
            <input type="hidden" value="<?php echo ProductComments::TYPE_PRODUCT_SHOP ?>" class="type_comment" />
            <input class="product_id_comment" type="hidden"  value="<?php echo $productshopdetail[0]['id'] ?>"/>
        </div>
        </div>
        
    </div>
    
</div>

</div>
<div class="row-fluid" id="info_detail">
<ul class="nav nav-tabs" id="tabs-detail">
    <li class="active"><a href="#beschreibung"><?php echo Yii::t('global','Description');?></a></li>
    <li><a href="#bewertungen"><?php echo Yii::t('global','Reviews');?></a></li>
    <li><a href="#verkauferinfo"><?php echo Yii::t('global','Seller Info');?></a></li> 
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="beschreibung">
    <div class="contact-name-tab">
        <?php echo $productshopdetail[0]['short_desciption'] ?>
    </div>
    </div>
    <div class="tab-pane" id="bewertungen">
    <div class="contact-name-tab">
    <div class="pr-info">
            <span class="rating-shop-detail"><?php 
                $this->widget('ext.dzRaty.DzRaty', array(
                    'name' => 'my_rating_product_id'.$productshopdetail[0]['name'],
                    'value' => Ratings::model()->getRating($productshopdetail[0]['id'], 1 ),
                    'options' => array(
                            'half' => TRUE,
                            	'click' => "js:function(score, evt){ ratings(score,".$productshopdetail[0]['id'].",1) }",

                    ),
                    'htmlOptions' => array(
                    'class' => 'new-half-class'
                    ),
                ));
                 $this->renderPartial('../elements/rate_product',array('product_id'=>$productshopdetail[0]['id']));
              ?>
             </span>  <span class='rating-total-detail'>( <?php Ratings::model()->totalRating( $productshopdetail[0]['id'], 1 ); ?> )  </span>
        </div></div>
        </div>
    <div class="tab-pane" id="verkauferinfo">
    <?php foreach ($infomembershop as $item){?>
                <div class="contact-name-tab"><h2><?php echo $item['name'] ?></h2>
                    <div>Email : <a href="mailto:<?php echo $item['email'] ?>"><?php echo $item['email'] ?></a></div>
                    <div>Phone: <?php echo $item['phone'] ?></div>
                    <div>Add : <?php echo $item['address'] ?></div>
                    <div>Slogan : <?php echo $item['slogan'] ?></div>
                    <div>Description : <?php echo $item['description'] ?></div>
                </div>
              
        <?php }  ?>
    </div> 
</div> 
</div>
</div>
