<?php $steps = array(
    '/' => Yii::t('global', 'Shopping Cart'),
    '/address' => Yii::t('global', 'Address Information'),
    '/methodpayment' => Yii::t('global', 'Method Payment'),
    '/review' => Yii::t('global', 'Order Review'),
    '/finished' => Yii::t('global', 'Finished'),
);
?>
<!--<div class="cart-grid purple-grid register">
    <div class="title">
		<ul class="inline menu fix-menu-cart">
        <?php /*$i = 1;
        foreach ($steps as $uri=>$name){
            echo '<li '.($i==$step?' class="active"':'').'>
                   <span class="a-left fix-menu-active-left"></span>';
            if ($i>$step || $step == 5)
                echo "<label class='fix-menu-label'>".$name."</label>";
            else echo '<a href="/cart'.$uri.'" style="color:#ffffff !important; font-weight:bold;">'.$name.'</a>';
            $fixmenu  = ( $i == 2 )?'fix-menu-active-two':'fix-menu-active-right';
            echo '<span class="a-right '.$fixmenu.'"></span></li>';

            $i ++;
        }
        */?>
		</ul>
	</div>
</div>-->

 <div class="cart-grid purple-grid fix_margin_bottom ">
     <div class="title fix-menu-cart">
         <?php  $i = 1; $css = "style='margin-left:5px'";
         foreach ($steps as $uri=>$name){ ?>
            <div class="menu-item">
                <span class="menu-text <?php echo ($i<=$step? 'active':''); echo ($i ==1)? ' fix-first-menu':' menu_normal';echo ($i == $step && $step ==5)? ' fix-last-menu menu_last':''; ?>">
                    <?php
                    if ($i > $step )
                            echo "<span style='color: white;'>".$name."</span>";
                        else if($i==1){
                            echo '<a style="margin-left:5px;" href="/cart'.$uri.'">'.$name.'</a>';
                        }else if($i==5) {
                            echo '<a style="width: 147px;" href="/cart'.$uri.'">'.$name.'</a>';
                        }else echo '<a  href="/cart'.$uri.'">'.$name.'</a>';
                    ?>
                </span>
                <?php if($i != 5) {  echo ($i<=$step? "<span class='arrow'></span>": '<span class="arrow2"></span>'); } ?>

            </div>
         <?php $i++; } ?>
     </div>
 </div>