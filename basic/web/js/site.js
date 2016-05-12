$(".fancybox-button").fancybox({
    prevEffect		: 'none',
    nextEffect		: 'none',

    helpers : {
        title : {
            type : 'inside'
        }
    }
});

$('.show-desc').click(function() {
    $elem = $(this).parent().next('.public-item_desc');
    if ($elem.css('display') == 'none') {
        $elem.show(300);
        $(this).addClass('open');
    } else {
        $elem.hide(300);
        $(this).removeClass('open');
    }
});
