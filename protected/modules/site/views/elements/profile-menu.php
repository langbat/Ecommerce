<div class="purple-box">
    <div class="title"><h5><?php echo Yii::t('global', 'User account')?></h5></div>
    <ul>
    <?php 
   $isMemberShop = MemberShop::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
    /*$activitie         = Auctions::model()->countUserActivities(Yii::app()->user->id);
    foreach( $activitie as $activities ){
        $totalactivities    = $activities['totalActivities'];
    }*/
    $items = array(
       /* 'activities' => Yii::t('global', 'My activities').' ('.$totalactivities.')',
        'completed_auctions' => Yii::t('global', 'My completed auctions'),*/
        '/profile/orders' => Yii::t('global', 'My orders'),
        '/memberShop' => Yii::t('global', 'Manage Shop'),
       /* 'transactions' => Yii::t('global', 'Account transactions'),*/
       /* Manager product*/
       '/messagesShopManager' => Yii::t('global', 'Manager Messages'),
       
       '/shopManager/detail' => Yii::t('global', 'Dealer Manager'),
    
       
        '/profile/index' => Yii::t('global', 'My profile'),
    );
    foreach ($items as $url=>$name){
        if($url!=='/memberShop'){
            if($url=='/messagesShopManager'){
               // <li class="menu-user-profile "'.Yii::app()->controller->getRoute()=='site'.$url?'active-user-profile':''.'">
             echo !empty($isMemberShop)?'':'<li class="menu-user-profile" '.((Yii::app()->controller->getRoute()=='site'.$url.'/index')?'id="active-user-profile"':'').'><a href="'.$url.'">'.$name.'</a></li>';;
        }else{
            echo ($url=='/shopManager/detail' && empty($isMemberShop) )?'':'<li class="menu-user-profile"'.((Yii::app()->controller->getRoute()=='site'.$url)?'id="active-user-profile"':'').'><a href="'.$url.'">'.$name.'</a></li>';
        }
        }else{
            echo empty($isMemberShop)?'<li class="menu-user-profile" '.((Yii::app()->controller->getRoute()=='site/memberShop/create')?'id="active-user-profile"':'').'><a href="/memberShop/create">'.Yii::t('global', 'Create Shop').'</a></li>':'<li class="menu-user-profile" '.((Yii::app()->controller->getRoute()=='site'.$url.'/index')?'id="active-user-profile"':'').'><a href="'.$url.'">'.$name. '</a></li>';;
        }
        
    }
    ?>
        
        <li class="menu-user-profile "><a href="/logout"><?php echo Yii::t('global', 'Logout') ?></a></li>
    </ul>
</div>