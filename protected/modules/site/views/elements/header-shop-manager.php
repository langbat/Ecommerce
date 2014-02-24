
<?php if(!isset(Yii::app()->user->id)){?>
<div class="content-block">
<div class="top-admin" style="height: 130px;">
<div class="logo-admin-top"><a href="#"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/logo.png" alt=""/></a></div>
</div>
</div>
<div class="row-fluid">
                <div class="title-admin" style="height: 50px;">
                    <div class="title">
                        
                    </div>
                </div>
            </div>
<?php }else{?>
<div class="content-block">
                    <div class="top-admin">
                        <h3 style="position: absolute;top: 33%;right: 120px;font-size: 20px;"> <?php echo Yii::t('global','DEALER AREA'). '&nbsp;&nbsp;<span style="color:#00B8FF">'.Yii::app()->user->name.'</span>';?></h3>  
                         <a href="<?php echo $this->createUrl('/logout/index'); ?>"><button class="btn logout" name="logout" type="submit" value="Logout"> <i class="icon-off"></i> LOGOUT</button>
                          </a> 
                        <div class="logo-admin-top"><a href="<?php echo Yii::app()->homeUrl;?>"><img style="width: 300px;" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/logo.png" alt=""/></a></div>
                        <div class="nav-admin">

                            <div class="dropdown">
                                <ul class="nav nav-pills">
                                    <li><div class="btn-group"><a href="/shopManager/detail" class="btn"><i class="fa fa-home"></i></a></div></li>
                                    <li><div class="btn-group"><a href="/messagesShopManager" class="btn"><i class="fa fa-envelope-o"></i></a></div></li>
                                    <li class="dropdown"> 
                                        <div class="btn-group dropdown">
                                            <a class="btn"href="#"><?php echo Yii::t('global','setup');?> </a>
                                           
                                            <a href="#" class="btn dropdown-toggle"  id="drop1" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                                             <!--
                                            <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop1">
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','setup');?></a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','themenbereiche');?></a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Inhalte');?></a></li>
                                                <li role="presentation" class="divider"></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Vorlagen');?></a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Zahlungsarten');?></a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Versender');?></a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php //echo Yii::t('global','Versandzonen');?></a></li>
                                            </ul>
                                            -->
                                        </div>

                                    </li>
                                    <li class="dropdown">
                                        <div class="btn-group dropdown">
                                            <a class="btn"href="#"><?php echo Yii::t('global','Article');?> </a>
                                            <a href="#" class="btn dropdown-toggle"  id="drop2" role="button" data-toggle="dropdown" ><b class="caret"></b></a>
                                            <ul id="menu2" class="dropdown-menu" role="menu" aria-labelledby="drop2">
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
                                            <a class="btn"href="#"><?php echo Yii::t('global','live sale');?>  </a>
                                           
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
                                            <a class="btn"href="#"><?php echo Yii::t('global','Orders')?></a>
                                            
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
                                            <a class="btn"href="#"><?php echo Yii::t('global','Customer');?></a>
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
                                
                    </div>
                    
                </div>
            </div>                
                </div>
                <div class="row-fluid">
                <div class="title-admin">
                    <div class="title">
                        <h3><?php echo Yii::t('global','Welcome to the Dashboard');?></h3> 
                    </div>
                </div>
            </div>
<?php } ?>