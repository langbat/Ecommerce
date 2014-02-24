jQuery(document).ready(function() {
$fancyboxfunction = <<< EOS
	$(".video").click(function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'title'			: this.title,
			'width'			: 640,
			'height'		: 385,
			'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true'
			}
		});

		return false;
	});
    
      
EOS;
    $("a#fancyBoxLink").fancybox({
        'href'   : '#conten-fancybox',
        'titleShow'  : false,
        'width' :620,
        'transitionIn'  : 'elastic',
        'transitionOut' : 'elastic'
    });



});
