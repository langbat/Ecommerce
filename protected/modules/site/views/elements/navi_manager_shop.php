<?php $memShop = MemberShop::model()->getMemberShopByIdMember(Yii::app()->user->id);?>
<div class="content-block">
            <div class="dropdown">
                <ul class="nav nav-pills">
                    <li><div class="btn-group"><a href="/shopManager/detail" class="btn <?php echo Yii::app()->controller->getId()=='shopManager'?'active-menu-seller':''?>"><i class="fa fa-home"></i></a></div></li>
                    <li><div class="btn-group"><a href="/messagesShopManager" class="btn <?php echo Yii::app()->controller->getId()=='messagesShopManager'?'active-menu-seller':''?>"><i class="fa fa-envelope-o"></i></a></div></li>
                    <li class="dropdown"> 
                        <div class="btn-group dropdown">
                            <a class="btn <?php echo isset($_GET['fl'])?($_GET['fl']==1||$_GET['fl']==0)?'active-menu-seller':'':''?>"href="#"><?php echo Yii::t('global','setup');?> </a>
                           
                            <a href="#" class="btn dropdown-toggle"  id="drop1" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                           
                            <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="/memberShop/update?id=<?php echo $memShop->id; ?>&fl=0"><?php echo Yii::t('global','Welcome');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="/memberShop/update?id=<?php echo $memShop->id; ?>&fl=1"><?php echo Yii::t('global','Service ');?></a></li>
                                <!--
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Inhalte');?></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Vorlagen');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Zahlungsarten');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Versender');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Versandzonen');?></a></li>
                                -->
                            </ul>
                           
                        </div>

                    </li>
                    <li class="dropdown">
                        <div class="btn-group dropdown">
                            <a class="btn <?php echo (Yii::app()->controller->getId()=='memberShop')?!isset($_GET['fl'])?'active-menu-seller':$_GET['fl']==2?'active-menu-seller':'':(Yii::app()->controller->getId()=='productShopManager')?'active-menu-seller':''?>"href="#"><?php echo Yii::t('global','Article');?> </a>
                            <a href="#" class="btn dropdown-toggle"  id="drop2" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                           
                            <ul id="menu2" class="dropdown-menu" role="menu" aria-labelledby="drop2">
                           
                             <li role="presentation"><a role="menuitem" tabindex="-1" href="/memberShop/view_shop_manager?id=<?php echo $memShop->id; ?>"><?php echo Yii::t('global','My Shop');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="/productShopManager/index"><?php echo Yii::t('global','Product');?></a></li>
                             
                              <!--
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Another action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Something else here');?></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Separated link');?></a></li>
                                -->
                            </ul>
                             
                        </div>

                    </li>
                    <li class="dropdown">
                        <div class="btn-group dropdown">
                            <a class="btn <?php echo Yii::app()->controller->getId()=='liveSale'?'active-menu-seller':''?>" href="/liveSale"><?php echo Yii::t('global','live sale');?>  </a>
                           
                            <a href="#" class="btn dropdown-toggle"  id="drop3" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                            <!--
                            <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop3">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php // echo Yii::t('global','Action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php // echo Yii::t('global','Another action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Something else here');?></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php // echo Yii::t('global','Separated link');?></a></li>
                            </ul>
                            -->
                        </div>

                    </li>
                    <li class="dropdown">
                        <div class="btn-group dropdown">
                            <a class="btn <?php echo (Yii::app()->request->requestUri=='/orders/orderShop')||(preg_match("/orders\/view/i", Yii::app()->request->requestUri))||(preg_match("/orders\/update/i", Yii::app()->request->requestUri))?'active-menu-seller':''?>"href="/orders/orderShop"><?php echo Yii::t('global','Orders')?></a>
                            
                            <a href="#" class="btn dropdown-toggle"  id="drop4" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                            <!--
                            <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Another action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Something else here');?></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Separated link');?></a></li>
                            </ul>
                            -->
                        </div>

                    </li>
                    <li class="dropdown">
                        <div class="btn-group dropdown">
                            <a class="btn <?php echo (Yii::app()->request->requestUri=='/orders/customer/'.$memShop->id)||(preg_match("/orders\/vi_customer/i", Yii::app()->request->requestUri))||(preg_match("/orders\/up_customer/i", Yii::app()->request->requestUri))?'active-menu-seller':''?>"href="/orders/customer/<?php echo $memShop->id; ?>"><?php echo Yii::t('global','Customer');?></a>
                            <!--
                            <a href="#" class="btn dropdown-toggle"  id="drop5" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                            <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Another action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Something else here');?></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Separated link');?></a></li>
                            </ul>
                            -->
                        </div>

                    </li>
                    <li class="dropdown">
                        <div class="btn-group dropdown">
                            <a class="btn <?php echo Yii::app()->controller->getId()=='blogshop'?'active-menu-seller':''?>" href="/blogshop/index"><?php echo Yii::t('global','Blog');?></a>
                           <!--
                            <a href="#" class="btn dropdown-toggle"  id="drop5" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                            <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Another action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Something else here');?></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Separated link');?></a></li>
                            </ul>
                            -->
                        </div>

                    </li>
                    <li class="dropdown">
                        <div class="btn-group dropdown">
                        
                            <a class="btn <?php echo Yii::app()->controller->getId()=='shopNewsletter'?'active-menu-seller':''?>" href="/shopNewsletter/index"><?php echo Yii::t('global','Newsletter');?></a>
                    
                            <!--
                            <a href="#" class="btn dropdown-toggle"  id="drop5" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                            <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Another action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Something else here');?></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo Yii::t('global','Separated link');?></a></li>
                            </ul>
                            -->
                        </div>

                    </li>
                    <!--
                    <li class="dropdown">
                        <div class="btn-group dropdown">
                            <a class="btn"href="#">aktion</a>
                            <a href="#" class="btn dropdown-toggle"  id="drop6" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                            <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop6">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Another action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Something else here');?></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Separated link');?></a></li>
                            </ul>
                        </div>

                    </li>
                    <li class="dropdown">
                        <div class="btn-group dropdown">
                            <a class="btn"href="#">statistik</a>
                            <a href="#" class="btn dropdown-toggle"  id="drop6" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                            <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop6">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Another action');?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Something else here');?></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Separated link');?></a></li>
                            </ul>
                        </div>

                    </li>
                    -->
                </ul> 
            </div>
       
         </div>

<div class="row-fluid">
<div class="title-admin">
    <div class="title">
        <h3><?php echo Yii::t('global','Welcome to the Dashboard')?></h3> 
    </div>
</div>
</div>
