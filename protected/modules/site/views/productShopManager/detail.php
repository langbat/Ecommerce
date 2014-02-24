<div class="span9" id="content-product">
<div class="row-fluid">
<div class="span5">
    <div class="head_control"><a href="#" class="btn">Product</a></div>
    <div id="tooltip_image"><img src="/uploads/product_shop/<?php echo $productshopdetail['image']?>" alt=""/></div>
</div>
<div class="span7">
    <div class="attributeSection" id="info-product">

        <div class="row">
            <h4> <?php echo $productshopdetail['name'] ?></h4>
            Bestellnr.:129        
            <div class="special-price"><?php echo $productshopdetail['direct_buy_price']; ?></div>
            <div class="special-former-price">
                <span class="special-price-txt">statt&nbsp;</span>
                <span class="former-price"><?php echo $productshopdetail['price_purchase'] ?></span>
            </div>
        </div>
        <div class="row">
            inkl. gesetzlicher MwSt. zzgl. Versandkosten
            Verpackungsheit:
            Stück
            Lieferstatus:<span style="color: #ffd700;">Begrenzt</span> 
        </div>
        <div class="row">
            <input class="input-mini" type="text" value="1"> 
            <button class="btn" type="button">In den Warenkorb</button>
        </div>  
    </div>
</div>
</div>
<div class="row-fluid" id="info_detail">
<ul class="nav nav-tabs" id="tabs-detail">
    <li class="active"><a href="#beschreibung">Beschreibung</a></li>
    <li><a href="#bewertungen">Bewertungen</a></li>
    <li><a href="#verkauferinfo">Verkäuferinfo</a></li> 
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="beschreibung">
        <?php echo $productshopdetail['short_desciption'] ?>
    </div>
    <div class="tab-pane" id="bewertungen">Bewertungen</div>
    <div class="tab-pane" id="verkauferinfo">Verkäuferinfo</div> 
</div> 
</div>
</div>