<?php $categoryshop = ProductCategoriesShop::getCategoryShopByShopId($_GET['shop_id']); ?>
<div id="sidebar">
	<ul>
		<!-- Begin Widget -->
		<li class="widget">
			<h2><?php echo Yii::t('global','Categories')  ?></h2>
			<ul>
			<?php
                if( isset( $categoryshop ) ){ 
                foreach ($categoryshop as $item){
                   if((isset($_GET['category_id'])) && ($_GET['category_id'] == $item['id'])) { ?>
                        <li class="active-menu-left"><a href="../../../shop/category/<?php echo $this->membershop->id.'/'. $item['id'] ?>" title="<?php echo $item['name'] ?>"><?php echo $item['name'] ?></a></li>
               <?php }else{ ?>
                        <li ><a href="../../../shop/category/<?php echo $this->membershop->id.'/'. $item['id'] ?>" title="<?php echo $item['name'] ?>"><?php echo $item['name'] ?></a></li>
               <?php } }
               }
             ?>
			</ul>
		</li>
		<!-- End Widget -->
		<!-- Begin Widget -->
		<li class="widget">
			<h2><?php echo Yii::t('global','Search')  ?></h2>
			<div id="search">
					<label><?php echo Yii::t('global','Price')  ?></label>
					<select size="1" name="category"  onchange="goToPage('select1')" id="select1">
                            <option value="">-- <?php echo Yii::t('global','Select Price')  ?> --</option>
                            <?php
                            if(isset($_GET['price'])){ 
                                if(is_numeric($_GET['price'])){
                                    for($i = 100; $i <=1000; $i = $i +100){
                                        if($_GET['price']== $i){ ?>
                                            <option selected value="/shop/findproduct/<?php echo $this->membershop->id ?>/<?php echo $i ?>"><?php echo $i ?> €</option>
                                        <?php }else{ ?>
                                             <option value="/shop/findproduct/<?php echo $this->membershop->id ?>/<?php echo $i ?>"><?php echo $i ?> €</option>
                                        <?php } ?>
                                    <?php } ?>
                                    <option value="/shop/findproduct/<?php echo $this->membershop->id ?>/more1000"> >1000 €</option>
                                <?php }else{ 
                                    for($i = 100; $i <=1000; $i = $i +100){ ?>
                                        <option value="/shop/findproduct/<?php echo $this->membershop->id ?>/<?php echo $i ?>"><?php echo $i ?> €</option>
                                <?php } ?>
                                        <option selected value="/shop/findproduct/<?php echo $this->membershop->id ?>/more1000"> >1000 €</option>
                            <?php } ?>
                             <?php }else{ 
                                   for($i = 100; $i <=1000; $i = $i +100){ ?>
                                        <option value="/shop/findproduct/<?php echo $this->membershop->id ?>/<?php echo $i ?>"><?php echo $i ?> €</option>
                                   <?php } ?>
                                         <option value="/shop/findproduct/<?php echo $this->membershop->id ?>/more1000"> >1000 €</option>
                             
                             <?php } ?>
                                
                            
					</select>
					<label><?php echo Yii::t('global','Reviews')  ?></label>
					<select size="1" name="star" onchange="goToPage('select2')" id="select2">
						<option value="default">-- <?php echo Yii::t('global','Select Star')  ?> --</option>
                         <?php
                            if(isset($_GET['star'])){ 
                                if(is_numeric($_GET['star'])){
                                    for($i = 0; $i <=5; $i++){
                                        if($_GET['star']== $i){ ?>
                                            <option selected value="/shop/star/<?php echo $this->membershop->id ?>/<?php echo $i ?>"><?php echo $i ?> <?php echo Yii::t('global','Star')  ?></option>
                                        <?php }else{ ?>
                                             <option value="/shop/star/<?php echo $this->membershop->id ?>/<?php echo $i ?>"><?php echo $i ?> <?php echo Yii::t('global','Star')  ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                    <option value="/shop/star/<?php echo $this->membershop->id ?>/all"><?php echo Yii::t('global','All Star')  ?> </option>
                                <?php }else{ 
                                    for($i = 1; $i <=5; $i++){ ?>
                                        <option value="/shop/star/<?php echo $this->membershop->id ?>/<?php echo $i ?>"><?php echo $i ?> <?php echo Yii::t('global','Star')  ?></option>
                                <?php } ?>
                                        <option selected value="/shop/star/<?php echo $this->membershop->id ?>/all"> <?php echo Yii::t('global','All Star')  ?></option>
                            <?php } ?>
                             <?php }else{ 
                                   for($i = 0; $i <=5; $i++){ ?>
                                        <option value="/shop/star/<?php echo $this->membershop->id ?>/<?php echo $i ?>"><?php echo $i ?> <?php echo Yii::t('global','Star')  ?></option>
                                   <?php } ?>
                                         <option value="/shop/star/<?php echo $this->membershop->id ?>/all"> <?php echo Yii::t('global','All Star')  ?></option>
                             
                             <?php } ?>
					</select>
					<div class="cl">&nbsp;</div>
			
			</div>
		</li>
		<!-- End Widget -->
	</ul>
</div>