
<div class="around-product-lastest-detail detail_product_last">
<div class="margin-product-lastest">
<div class="info_product">
    <div class="left_col_info">
        <div class="video_product">

            <?php error_reporting(0);

            if(isset($last_product_tv->id)) { ?>
                <div id="video-stream-box " class="fix_liveshow last-product-tv">
                    <div id="video-stream">
                        <img src="/themes/admin/default/img/loaders/loader_re.gif" />
                        <?php echo Yii::t('global', 'Loading stream ...')?>
                    </div>
                </div>

                <script type="text/javascript">
                    var session = TB.initSession('<?php echo $last_product_tv->session_id?>'); // Add a value for SESSION_ID.
                    var loadedArchive;
                    var ARCHIVE_ID = "<?php echo $last_product_tv->archive_id?>";
                    var TOKEN = "<?php echo Yii::app()->Tokbox->generate_token($last_product_tv->session_id, 'moderator');?>";
                    var API_KEY    = <?php echo Yii::app()->settings->tokbox_api_key?>;

                    session.addEventListener("sessionConnected", sessionConnectedHandler);
                    session.addEventListener("streamCreated", streamCreatedHandler);
                    session.addEventListener("archiveLoaded", archiveLoadedHandler);

                    session.connect(API_KEY, TOKEN); // Add values for API_KEY and TOKEN.

                    function sessionConnectedHandler(event) {
                        $('#video-stream').html('<img src="/themes/admin/default/img/loaders/loader_re.gif" />');
                        session.loadArchive(ARCHIVE_ID);
                    }

                    function archiveLoadedHandler(event) {
                        loadedArchive = event.archives[0];
                        loadedArchive.startPlayback();
                    }

                    function streamCreatedHandler(event) {
                        for (var i = 0; i < event.streams.length; i++) {
                            if (event.streams[i].type == "archive") {
                                subscribeToStream(event.streams[i]);
                            }
                        }
                    }

                    function subscribeToStream(stream) {
                        var replacementDiv = document.createElement('div');
                        document.getElementById('video-stream').appendChild(replacementDiv);
                        session.subscribe(stream, 'video-stream');
                    }
                </script>
            <?php } else if($checkSchedule['check']==1){    ?>
                    <div class="slide liveshow fix_liveshow" id="live-stream">
                        <h5><?php echo Yii::t('global', 'Preparing live stream ...')?></h5>
                    </div>
            <?php    } else {   ?>
                <div class="show_video fix_video_product">
                    <?php  echo $product->getVideo($product->video); ?>
                </div>
            <?php } ?>
        </div>
        <?php if (Yii::app()->user->id != $product->id):?>  
        <form action="" method="get" id="support-chat-box">
        <div class="chat_product">
            <input type="text" class="chat_input defaultText" title="<?php echo Yii::t('global','Type your message here and press Enter to send...') ?>" />
        </div>
        </form> 
        <?php endif; ?>
        <div class="social_product">
            <div class="facebook" ><a href="http://www.facebook.com/sharer/sharer.php?u=http://tosello.toasternet-online.de/products/detail/<?php echo $product->id ?>"> <?php echo Yii::t('global','Share on Facebook')?></a></div>
            <div class="tweeter" ><a href="http://twitter.com/share?url=http://tosello.toasternet-online.de/products/detail/<?php echo $product->id ?>"><?php echo Yii::t('global','Tweet it!')?></a></div>
        </div>
    </div>
    <div class="right_col_info fix_right_info">
        <div class="content_right_product">
            <div class="last_product"> <?php echo Yii::t('global','LASTEST PRODUCT') ?></div>
            <div class="product_name"><a href="/products/detail/<?php echo $product->id?>" style="text-decoration: none !important;"><span style="color: #706969;"><?php echo $product->name; //Yii::t('global','Sed egestas porta metus') ?></span></a></div>
            <div class="rate_product">
                <?php 
                      $this->widget('ext.dzRaty.DzRaty', array(
                            'name' => 'my_rating_field',
                          'value' => Ratings::model()->getRating($product->id),
                            'options' => array(
                                    'half' => TRUE,
                                    'click' => "js:function(score, evt){ ratings(score,".$product->id.") }",

                            ),
                            'htmlOptions' => array(
                            'class' => 'new-half-class'
                            ),
                        ));
                $this->renderPartial('../elements/rate_product',array('product_id'=>$product->id));
                ?>

            <div class="comment_product">
                <?php echo Yii::t('global','Add comment') ?>
                <input class="product_id_comment" type="hidden" value="<?php echo $product->id ?>"/>
            </div>
            </div>
            <div class="middle_info">
                <div class="picture_product">
                    <a href="/products/detail/<?php echo $product->id?>"><img src="/uploads/product/<?php echo $product->image; ?>" width="211px" height="214px" /></a>
                </div>
                <div class="price_product">
                    <div class="ordered" > <span class="number"><?php echo count($ordered); ?></span> <span class="text"> <?php echo Yii::t('global','ORDERED') ?></span></div>
                    <div class="for_now_only"><?php echo Yii::t('global','For now only') ?></div>
                    <div class="price_purchase">€<?php echo Utils::number_format($product->price-($product->price * $product->discount_percent)/100); ?></div>
                    <div class="save_money"><?php echo Yii::t('global','save') ?> €<?php echo  Utils::number_format(($product->price * $product->discount_percent)/100) ?></div>
                </div>
                <div class="btn_buy add_cart_button_large" data-id="<?php echo $product->id ?>"><span style="color: white;"><?php echo Yii::t('global','ADD TO CART')?></span></div>
                <div class="des_product">
                     <?php echo $product->short_desciption; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('#support-chat-box').submit(function(){
        var moderator = '<?php echo $product->user->username; ?>';
        if ($(this).find('input').val().trim() != ''){
            chatWith(moderator, $(this).find('input').val().trim());
            $(this).find('input').val('');
        }
        return false;
    });
    <?php if($checkSchedule['time'] !=0) {
        $time= $checkSchedule['time'];    ?>
    var time = <?php echo $time ?>;
        setInterval(function(){
            window.location.reload();
        }, time);
    <?php } ?>
})
</script>
<?php if (Yii::app()->user->isGuest || Yii::app()->user->role != 'mod'){
    $UserMod = UserCounter::getUserMod();
    $tokbox = Yii::app()->counter->getTokboxData( isset($UserMod['user_id'])?$UserMod['user_id']:0 );
    //$tokbox = Yii::app()->counter->getTokboxData($product->user_id);
    ?>    
     <script type="text/javascript">
      var apiKey    = <?php echo Yii::app()->settings->tokbox_api_key?>;
      var sessionId = "<?php echo $tokbox['tokbox_session']?>";
      var token = "<?php echo $tokbox['tokbox_token']?>";
      var is_showed = false;
      
      var publisher = TB.initPublisher(apiKey, 'tokbox-buyer-publish', {width: 200, height:200});

      var session   = TB.initSession(sessionId);         
      session.connect(apiKey, token);
      session.addEventListener("sessionConnected", sessionConnectedHandler);         
      session.addEventListener("streamCreated", streamCreatedHandler);
       
     
      function sessionConnectedHandler (event) {
         session.publish( publisher );
         subscribeToStreams(event.streams);
      }
      function subscribeToStreams(streams) {
        for (var i = 0; i < streams.length; i++) {
            var stream = streams[i];
            if (stream.connection.connectionId != session.connection.connectionId) {
                if (!is_showed)
                {
                    var div = document.createElement('div');
                    div.setAttribute('id', 'stream' + stream.streamId);
                    var streamsContainer = document.getElementById('live-stream');
                    
                    streamsContainer.innerHTML = '';
                    streamsContainer.appendChild(div);
                    var divProps = {width: 700, height:350};
                    subscriber = session.subscribe(stream, 'stream' + stream.streamId, divProps);
                    
                }                    
                else
                    is_showed = true;
            }
        }
      }
      
      function streamCreatedHandler(event) {
        subscribeToStreams(event.streams);
      }
     
      
    </script> 
    <div id="tokbox-mod-buyer"><div id="tokbox-buyer-publish"></div></div>
<?php } ?>