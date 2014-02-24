(function(e,t,n){var r=e();e.fn.dropdownHover=function(n){r=r.add(this.parent());return this.each(function(){var n=e(this).parent(),i={delay:500,instantlyCloseOthers:!0},s={delay:e(this).data("delay"),instantlyCloseOthers:e(this).data("close-others")},o=e.extend(!0,{},i,o,s),u;n.hover(function(){o.instantlyCloseOthers===!0&&r.removeClass("open");t.clearTimeout(u);e(this).addClass("open")},function(){u=t.setTimeout(function(){n.removeClass("open")},o.delay)})})};e(document).ready(function(){e('[data-hover="dropdown"]').dropdownHover()})})(jQuery,this);
var is_set_timeout = false;
jQuery(document).ready(function(){
       jQuery(".defaultText").focus(function(srcc){
        if(jQuery(this).val()==jQuery(this)[0].title)
        {
            jQuery(this).removeClass("defaultTextActive");
            jQuery(this).val("");
        }
        
        if(jQuery(this).attr('id')=='LoginForm_username'||jQuery(this).attr('id')=='LoginForm_password')
        {
            jQuery(this).removeClass("defaultTextActive");
            jQuery(this).val("");
        }
        if(jQuery(this).attr('id')=='LoginUser_email')
        {
            jQuery('#lostpassword_label').hide();
        }
    });
    
    jQuery(".defaultText").blur(function() {
        if (jQuery(this).val() == "") {
            jQuery(this).addClass("defaultTextActive");
            jQuery(this).val(jQuery(this)[0].title);
        }
        
    });
    
    jQuery(".defaultText").blur();   
    
    
   
    ///timer
    setInterval(function(){
        $('.time p').each(function(){
            var tmp = this.innerHTML.split(':');
            var h = parseInt(tmp[0],10);
            var m = parseInt(tmp[1],10);
            var s = parseInt(tmp[2],10);
            var seconds= h*3600 + m*60 + s - 1;
            if (seconds < 0){
                if (is_set_timeout == false){
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000); 
                    is_set_timeout = true;
                }
                
                return;    
            }
            
            h = Math.floor(seconds/3600); 
            m = Math.floor((seconds-h*3600)/60); 
            s = seconds%60; 
            
            if (h.toString().length == 1) h = '0' + h.toString();
            if (m.toString().length == 1)  m = '0' + m.toString();
            if (s.toString().length == 1)  s = '0' + s.toString();
                            
            $(this).text(h + ' : ' + m + ' : ' + s);
            
            var bidquote    = parseInt($('.bid-quote-number').text());
            var auction_id  = parseInt($('.auction-id').text());
            if ( seconds == 0 && bidquote == 0 ){
                $.get('/auctions/EndBid?id='+auction_id, function() {
                    //window.location.href = '/';
                }); 
            }
        })
    },1000);

    setInterval(function(){
        $('.time_detail').each(function(){

            var d =  parseInt($('.day').html());
            var h =  parseInt($('.hours').html());
            var m =  parseInt($('.minutes').html());
            var s =  parseInt($('.second').html());
            var seconds= (d *86400) + (h*3600) + (m*60) + s - 1;
            if (seconds < 0){
                $.get('/auctions/checkBasicAuction', function(html) {
                    $('.basic_show').html(html);
                });
                return;
            }
            d = Math.floor(seconds/86400);
            h = Math.floor((seconds-(d*86400))/3600);
            m = Math.floor((seconds/60)%60);
            s = seconds%60;
            if (d.toString().length == 1) d = '0' + d.toString();
            if (h.toString().length == 1) h = '0' + h.toString();
            if (m.toString().length == 1)  m = '0' + m.toString();
            if (s.toString().length == 1)  s = '0' + s.toString();
            $('.second').text(s);
            $('.minutes').text(m);
            $('.hours').text(h);
            $('.day').text(d);
            //$(this).text(h + ' : ' + m + ' : ' + s);
        })
    },1000);

    //
    setInterval(function(){
        $('.time_detail_countdown').each(function(){
            var secondsFirst= parseInt($('.second_total').html());
            if (secondsFirst == 0){
                return;
            }
            var seconds= (secondsFirst - 1);
            $('.second_total').html(seconds);
            var d = Math.floor(seconds/86400);
            var h = Math.floor((seconds-(d*86400))/3600);
            var m = Math.floor((seconds/60)%60);
            var s = seconds%60;
            if (d.toString().length == 1) d = '0' + d.toString();
            if (h.toString().length == 1) h = '0' + h.toString();
            if (m.toString().length == 1)  m = '0' + m.toString();
            if (s.toString().length == 1)  s = '0' + s.toString();
            $('.second').text(s);
            $('.minutes').text(m);
            $('.hours').text(h);
            $('.day').text(d);

        })
    },1000);

    $('.btn_buy').click(function(){
        $('#myModal2').modal('show');
        $('#myModal2').html();
    });
    $('.btn_buy_shop').click(function(){
        $('#myModal2').modal('show');
        $('#myModal2').html();
    });


    $('.agree').live('click',function(){
        var product_id = $('.btn_buy').attr('data-id');
        $.get('/cart/add?id='+product_id, function() {
            window.location.href = '/cart';
        });
    });

    $('.agree_shop').live('click',function(){
        var shop_id = $('.btn_buy_shop').attr('data-content');
        var product_id = $('.btn_buy_shop').attr('data-id');
        var qty = $('.qty-pshop').attr('value');
        $.get('/shop/add?id='+product_id+'&shop_id='+shop_id,'&qty-pshop='+qty, function() {
            window.location.href = '/cart';
        });
    });

    $('.eject').live('click',function(){
        $('#myModal2').modal('hide');
    });

    $("#btn-viewAuction").live("click", function(){
        var auction_id = $(this).attr('data-id');
        $.get('/auctions/auctionUpcomming?id='+auction_id, function() {
            $('.ajax-'+auction_id).css('display','none');
            $('.textviewAuction-'+auction_id).append(' You viewed this auction');
        });

    });
    
    $('.cont_bg .btn-kaufen').click(function(){
        var name_product = $(this).attr('data');
        var eur          = parseInt($(".eur").text());
        var euro         = parseInt( Math.floor($(".euro").val()) );
        var jokerbid     = $(".joker-bid-suggest").text();
        var strcent      = $(".cent").val();
        var cents        = strcent.substr(0,2);
        var cent         = ( cents.toString().length > 1 )? cents : '0' + cents.toString() ;
        var price        = ( cent == 0 )?euro:euro+'.'+cent;
        var typebid      = ( jokerbid == price )?1:0;
        var numberRegex  = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if( numberRegex.test(cent) || cent == 0 ) {
            if( euro == 0 && cent == 0 || isNaN(euro) || !numberRegex.test(euro) ){
                //alert( " Fehler! Ihr Gebot ist 0 Euro 0 Cent!" );
                $('#myModal4').modal('show');
                $('#myModal4').html();
            }
            else{
                if( price > eur ){
                   // alert( " Fehler! Ihr Gebot muss kleiner als Max. Preis. " );
                    $('#myModal3').modal('show');
                    $('#myModal3').html();
                }
                else {
                    var check_session = $.session.get('checkConfirmPopup');
                    if(check_session != 'checked'){                      
                        $('#myModal').html('<div class="ajax-loader"></div>');
                        $('#myModal').modal('show');
                        $.get('/auctions/ConfirmBid?name='+name_product+'&euro='+euro+'&cent='+cent+'&option=0&type='+typebid, function(html) {
                            $('#myModal').html(html);
                        });
                    }
                    else{
                        var option  =  1;
                        $('#myModal').html('<div class="ajax-loader"></div>');
                        $('#myModal').modal('show');
                        $.get('/auctions/ConfirmBid?name='+name_product+'&euro='+euro+'&cent='+cent+'&option='+option+'&type='+typebid, function(html) {
                            $('#myModal').html(html);
                        });
                    }
                }
            }
        }
        else{
            alert( "Fehler! Ihr Gebot ist 0 Euro 0 Cent!" );
        }
        return false;
    });
    
    $('.format-confirm').live('click',function(){
            var name_product = $(this).attr('data');
            var euro         = parseInt( Math.floor($(".euro").val()) );
            var strcent      = $(".cent").val();
            var cents        = strcent.substr(0,2);
            var cent         = ( cents.toString().length > 1 )? cents : '0' + cents.toString() ;
            var jokerbid     = $(".joker-bid-suggest").text();
            var price        = ( cent == 0 )?euro:euro+'.'+cent;
            var typebid      = ( jokerbid == price )?1:0;
            var numberRegex  = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
            if( numberRegex.test(cent) || cent == 0 ) {
                var modal2       = $('#myModal1').html('<div class="ajax-loader"></div>');
                var option       = 1;
                    $('#myModal').modal('hide');
                    modal2.modal('show');
                    $.get('/auctions/ConfirmBid?name='+name_product+'&euro='+euro+'&cent='+cent+'&option='+option+'&type='+typebid, function(html) {
                        modal2.html(html);
                    });
            }
    });
    $('.open-for-didding').live('click',function(){
          location.reload(true); 
    });
    $('#myModal1').bind('hide', function() {
        location.reload(true);
    });
    $('#myModalRate').bind('hide', function() {
        location.reload(true);
    });
    $('#messLogout').bind('hide', function() {
        window.location.href='/logout/index';
    });

    $('.close_mess').click(function(){
        window.location.href='/logout/index';
    });

    $("#btn-guestViewAuction").live("click", function(){
        var message = $('.text-view').attr('title');
        alert(message);
    });
    $('.comment_product').click(function(){
       var id = $(this).find('.product_id_comment').val();
       $('#myModalComment_'+id).modal('show');
    });
    $('.my_balance').html(my_balance + ' &euro;');
    $('.numberic_only').ForceNumericOnly();

    $('.go-last-liveShow').click(function(){
        $.get('/products/getLastLiveshow',function(html){
            window.location.href= '/products/detail/'+html;
        });
    });

    $('.description_shipping').click(function(){
        $('#descritpionShipping').modal('show');
        $('#descritpionShipping').html();
    })
        
    $('.shipping_info').click(function(){
        $('#shipping_info').modal('show');
        $('#shipping_info').html();
    })
});

function voteAuctions(id,message)
{
    var voted = $('input:radio[name=vote_'+id+']:checked').val();
    var check_session = $.session.get('checkHidePopup');
    if(voted == null){
        alert(message);
    } else {
        $('#myModal').html('<div class="ajax-loader"></div>');
        if(check_session != 'checked'){
            $('#myModal').modal('show');
        }
        $.get('/votes/add?id='+id+'&voted='+voted, function(html) {
            $('#myModal').html(html);
            $('.not-voted-'+id).css('display','none');
            if(voted == 0){
                $('.no-ajaxNotice-'+id).show();
            } else {
                $('.yes-ajaxNotice-'+id).show();
            }
        });
    }
}
function vote(auction_id){
    alert(auction_id);
    //$.get('/vote/do?id='+auction_id, function() {
    //});   
}
function intoShopping(auction_id,id){

        $('.into_shopping_cart').append('<span class="ajax-loader"></span>');
        $.get('/cart/addProduct?auction_id='+auction_id+'&id='+id, function() {

            window.location.href = '/cart';
        });
}

jQuery.fn.ForceNumericOnly =function(){
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 || 
                key == 9 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};



function showAllBid(id){
    $('#myModal').html('<div class="ajax-loader"></div>');
    $('#myModal').modal('show');
    $.get('/auctions/showAllBids?id='+id, function(html) {
        $('#myModal').html(html);
    });
}

function changeButtonVotes(id)
{
    $('#votes-'+id).removeClass('btn-vote').addClass('btn-vote-green ');

}

function setOneBid(id, msg)
{
    var id = 'tt'+aid;
    $(id).update(msg);
        $(id).appear({duration: 0.5});
        $(id).observe('click', function() {$(id).fade({duration: 0.5});});
	setTimeout(function() {$(id).fade({duration: 0.5});}, 10000);
    
}
function showMessageTip(id) {
    //$('#mes'+id).show(0).delay(10000).hide(100);
    $('#mes'+id).stop(true,true).show().delay(10000).fadeOut(1000);
}
function closeMessageTip(id) {
    $('#mes'+id).delay(0).hide();
}

function ratings( score, id, type ){    
         if ( type == '' ){type = 0;}
         $.get('/products/saveRating?score='+score+'&id='+id+'&type='+type, function(html) {
            if(html=="false"){
               $('#myModalRated').modal('show');
            } else {
                $('#myModalRate').modal('show');
            }
        });
        }
    
function shop_ratings( score, id){
     $.get('/shop/ratingShop?score='+score+'&id='+id, function(data) {
        if(data!=""){
            $(".sms").html(data);
           $('#myModalRate_shop').modal('show');
        } else {
            $('#myModalRated_shop').modal('show');
        }
    });
}

function validate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}


function inputLimiter(e, allow, value) {
    var AllowableCharacters = '';
    if (allow == 'Letters') { AllowableCharacters = ' ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; }
    if (allow == 'Numbers') { AllowableCharacters = '1234567890'; }
    if (allow == 'NameCharacters') { AllowableCharacters = ' ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-.\''; }
    if (allow == 'NameCharactersAndNumbers') { AllowableCharacters = '1234567890 ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-\''; }
    var k;
    k = document.all ? parseInt(e.keyCode) : parseInt(e.which);
    if (k != 13 && k != 8 && k != 0) {
    if ((e.ctrlKey == false) && (e.altKey == false)) {
    return ((AllowableCharacters.indexOf(String.fromCharCode(k)) != -1) && (value.length < 5));
    } else {
    return true;
    }
    } else {
    return true;
    }
}



