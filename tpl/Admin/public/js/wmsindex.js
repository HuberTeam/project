 


 $(function () {

    var $isactive =0;
        $(".isActive").find("li").each(function () {
            a = $(this).find("a:first")[0];
            address = $(a).attr("href").split("=")[1];
            url = document.URL.toLowerCase();
            if(address===undefined){
                address='undefined';
            };
            if( url.search(address)!= -1 )
            {
                $(this).addClass("current");
                $isactive = 1;          
            }
        });
        if($isactive == 0){
            $('#ac').addClass("current");
        }
    });
$(function(){	
    var cubuk_seviye = $(document).scrollTop();
    var header_yuksekligi = $('.auto-hide-header').outerHeight();

    $(window).scroll(function() {
        var kaydirma_cubugu = $(document).scrollTop();

        if (kaydirma_cubugu > header_yuksekligi){$('.auto-hide-header').addClass('gizle');} 
        else {$('.auto-hide-header').removeClass('gizle');}

        if (kaydirma_cubugu > cubuk_seviye){$('.auto-hide-header').removeClass('sabit');} 
        else {$('.auto-hide-header').addClass('sabit');}				

        cubuk_seviye = $(document).scrollTop();	
     });
});
$(function() {

	var $t, leftX, newWidth;

	$('.menu ul').append('<div class="block"></div>');
	var $block = $('.block');

	$block.width($(".current").width()).css('left', $('.current a').position().left).data('rightLeft', $block.position().left).data('rightWidth', $block.width());

	$('.menu ul li').find('a').hover(function() {
		$t = $(this);
		leftX = $t.position().left;
		newWidth = $t.parent().width();

		$block.stop().animate({
			left: leftX,
			width: newWidth
		},300);
	}, function() {
		$block.stop().animate({
			left: $block.data('rightLeft'),
			width: $block.data('rightWidth')
		},300)
	})
	// $($('.menu ul li.current'))[0].setAttribute('id','firstLi');
	// var getClass = $($('.menu ul li.current'))[0].getAttribute('class','current');
	// console.log(getClass)
})