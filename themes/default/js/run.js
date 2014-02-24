jQuery(document).ready(function ()
{
    jQuery('.dropdown-toggle').dropdownHover();
    jQuery('.datepicker').datepicker();
    //jQuery('#share_modal').modal('show');
    
    if (jQuery('.slider').length > 0)
        jQuery('.slider').bjqs({
            animtype      : 'slide',
            height        : 194,
            width         : 438,
            responsive    : false,
            randomstart   : true
          });

})
