$(document).ready(function()
{
    /* Fancybox 3 */
    $("a.fancy-cart").fancybox({
        touch : false
    });

    /* Fancybox 2 */
    // $(".gmap").fancybox({
    //     maxWidth  : 1000,
    //     maxHeight : 800,
    //     fitToView : true,
    //     width   : '100%',
    //     height    : '100%',
    //     autoSize  : true,
    //     closeClick  : false,
    //     openEffect  : 'none',
    //     closeEffect : 'none'
    // });

});

/* Begin Script WOW */
$(document).ready(function() {
    new WOW().init();
})
/* End Script WOW */

/* Begin Menu */
ddsmoothmenu.init({mainmenuid: "smoothmenu1",orientation: 'h',classname: 'ddsmoothmenu',contentsource: "markup"})
/* End Menu */

/* Begin Tìm kiếm */
function doEnter(evt)
{
    var key;
    if(evt.keyCode == 13 || evt.which == 13)
    {
        onSearch(evt);
    }
}

function onSearch(evt) 
{           
    var keyword = document.getElementById("keyword").value;
    // var dm = document.getElementById("dm_id_search").value;
    // if(keyword=='' && dm=='')
    if(keyword=='')
        alert('Bạn chưa nhập từ khóa tìm kiếm !');
    else
    {
        // location.href = "tim-kiem.html/dm="+dm+"&keyword="+keyword;
        location.href = "tim-kiem.html/keyword="+keyword;
        loadPage(document.location);            
    }
}

function doEnter_2(evt)
{
    var key;
    if(evt.keyCode == 13 || evt.which == 13)
    {
        onSearch_2(evt);
    }
}

function onSearch_2(evt) 
{           
    var keyword_2 = document.getElementById("keyword_2").value;
    if(keyword_2=='')
        alert('Bạn chưa nhập từ khóa tìm kiếm !');
    else
    {
        location.href = "tim-kiem.html/keyword="+keyword_2;
        loadPage(document.location);            
    }
} 
/* End Tìm kiếm */     

/* Scroll-Top */
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) { $('.scrollToTop').fadeIn(); } 
        else { $('.scrollToTop').fadeOut(); }
    });
    $('.scrollToTop').click(function() {
        $('html, body').animate({scrollTop : 0},800);
        return false; 
    });
})

/* Script Fixed Menu */
// $(window).scroll(function() {
//    // if($(window).scrollTop() >= $(".header").height()) {
//     if($(window).scrollTop() >= 70) {
//         //$("div.menu").css({position:"fixed",left:'0px',right:'0px',top:'0px',zIndex:'999'});
//         $("div#mobilemenu").css({position:"fixed",left:'0px',right:'0px',top:'0px',zIndex:'999'});
//         $("div.menu").addClass('wow animated fadeInDown');
//     }
//     else { 
//        // $("div.menu").css({position:"static"});
//         $("div#mobilemenu").css({position:"static"});
//         $("div.menu").removeClass('wow animated fadeInDown');
//      }
// });

