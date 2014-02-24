<div class="info_product">
    <div class="left_col_info">
        <div class="video_product">

            <div class="slide" id="live-stream">
                <?php 
                $UserMod = UserCounter::getUserMod();
                if (Yii::app()->user->isGuest || Yii::app()->user->role != 'mod') { 
                         $tokbox1 = Yii::app()->counter->getTokboxData( isset($UserMod['user_id'])?$UserMod['user_id']:0 );
                            if( (!isset($tokbox1['tokbox_session']) && $tokbox1['tokbox_session'] == '') ){ ?>
                                 <script type="text/javascript" src="http://releases.flowplayer.org/js/flowplayer-3.2.12.min.js"></script>
                            <?php    echo Products::model()->getVideoFrontEnd($productdetail->video);                                
                               
                        } else{
                    ?>
                    <h5><?php echo Yii::t('global', 'Preparing live stream ...') ?></h5> 
                <?php }
                } ?> 
            </div> 
        </div>
        <?php if (Yii::app()->user->id != $productdetail->id): ?>  
            <form action="" method="get" id="support-chat-box">
                <div class="chat_product">
                    <input type="text" class="chat_input defaultText" title="<?php echo Yii::t('global', 'Type your message here and press Enter to send...') ?>" />
                </div>
            </form> 
        <?php endif; ?>
        <div class="social_product">
            <div class="facebook" ><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=<?php echo Yii::app()->request->serverName?>/products/detail/<?php echo $productdetail->id ?>','facewindow1','width=800,height=400');return false;" href=""> <?php echo Yii::t('global', 'Share on Facebook') ?></a></div>
            <div class="tweeter" ><a  onclick="window.open('http://twitter.com/share?url=http://<?php echo Yii::app()->request->serverName?>/products/detail/<?php echo $productdetail->id ?>','tweetwindow1','width=800,height=400');return false;" href=""><?php echo Yii::t('global', 'Tweet it!') ?></a></div>
        </div>
    </div>
    <div class="right_col_info">
        <div class="content_right_product">
            <div class="last_product"> <?php echo Yii::t('global', 'LASTEST PRODUCT') ?></div>
            <div class="product_name"><a href="/products/detail/<?php echo $productdetail->id ?>" style="text-decoration: none !important;"><span style="color: #706969;"><?php echo $productdetail->name; //Yii::t('global','Sed egestas porta metus')                                                      ?></span></a></div>
            <div class="rate_product">
                <?php
                $this->widget('ext.dzRaty.DzRaty', array(
                    'name' => 'my_rating_field23',
                    'value' => Ratings::model()->getRating($productdetail->id),
                    'options' => array(
                        'half' => TRUE,
                        'click' => "js:function(score, evt){ ratings(score," . $productdetail->id . ") }",
                    ),
                    'htmlOptions' => array(
                        'class' => 'new-half-class'
                    ),
                ));
                $this->renderPartial('../elements/rate_product');
                ?>

            </div>
            <div class="middle_info">
                <div class="picture_product">
                    <a href="/products/detail/<?php echo $productdetail->id ?>"><img src="/uploads/product/<?php echo $productdetail->image; ?>" width="211px" height="214px" /></a>
                </div>
                <div class="price_product">
                    <div class="ordered" > <span class="number"><?php echo count($count_ordered) ?></span> <span class="text"> <?php echo Yii::t('global', 'ORDERED') ?></span></div>
                    <div class="for_now_only"><?php echo Yii::t('global', 'For now only') ?></div>
                    <div class="price_purchase">€<?php echo Utils::number_format($productdetail->price - ($productdetail->price * $productdetail->discount_percent)/100);// $productdetail->direct_buy_price; ?></div>
                    <div class="save_money"><?php echo Yii::t('global', 'save') ?> €<?php echo Utils::number_format(($productdetail->price * $productdetail->discount_percent)/100); ?></div>
                </div>
                <div class="btn-kaufen add_cart_button_large"><a href="/products/detail/<?php echo $productdetail->id ?>"><span style="color: white;"><?php echo Yii::t('global', 'ADD TO CART') ?></span></a></div>
                <div class="des_product">
                    <?php echo $productdetail->short_desciption; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#support-chat-box').submit(function() {
           var moderator = '<?php echo $productdetail->user->username; ?>';
            if ($(this).find('input').val().trim() != '') {
                chatWith(moderator, $(this).find('input').val().trim());
                $(this).find('input').val('');
            }
            return false;
        })
    })
</script>
<?php
if (Yii::app()->user->isGuest || Yii::app()->user->role != 'mod') {
    $tokbox = Yii::app()->counter->getTokboxData( isset($UserMod['user_id'])?$UserMod['user_id']:0 );
    ?>    
    <script type="text/javascript">

    <?php if (isset($tokbox['tokbox_session']) && $tokbox['tokbox_session'] != ''): ?>
            var apiKey = <?php echo Yii::app()->settings->tokbox_api_key ?>;
            var sessionId = "<?php echo $tokbox['tokbox_session'] ?>";
            var token = "<?php echo $tokbox['tokbox_token'] ?>";
            var is_showed = false;

            var publisher = TB.initPublisher(apiKey, 'tokbox-buyer-publish', {width: 200, height: 200});

            var session = TB.initSession(sessionId);
            session.connect(apiKey, token);
            session.addEventListener("sessionConnected", sessionConnectedHandler);
            session.addEventListener("streamCreated", streamCreatedHandler);


            function sessionConnectedHandler(event) {
                session.publish(publisher);
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
                            var divProps = {width: 730, height: 480};
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
    <?php endif ?>
    </script> 
    <div id="tokbox-mod-buyer"><div id="tokbox-buyer-publish"></div></div>
<?php } ?>