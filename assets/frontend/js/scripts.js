$(document).ready(function() {

    /* full height window*/
    var slideHeight = $(window).height();
    $('#owl-banner .item').css('height', slideHeight);
    $(window).resize(function () {
        $('#owl-banner .item').css('height', slideHeight);
    });
    
    $('.section-auto').css('min-height', slideHeight);
    $(window).resize(function () {
        $('.section-auto').css('min-height', slideHeight);
    });

    /* scrollIt function*/
    $.scrollIt({
        activeClass: 'active',
        scrollTime: 1000
    });

    /* scroll to top function*/
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

    /* animation */
    wow = new WOW({
        boxClass:     'wow',      // default
        animateClass: 'animated', // default
        offset:       0,          // default
        mobile:       true,       // default
        live:         true        // default
    })
    wow.init();

    wow_static = new WOW({
        boxClass:     'wow_static',      // default
        animateClass: 'animated', // default
        offset:       0,          // default
        mobile:       true,       // default
        live:         true        // default
    })
    wow_static.init();

    WOW.prototype.addBox = function(element){
        this.boxes.push(element);
    };

    $('.wow').on('scrollSpy:exit',function(){
        var element = $(this);
        element.css({
            'visibility' : 'hidden',
            'animation-name' : 'none'
        }).removeClass('animated');
        wow.addBox(this);
    });
    $('.wow').scrollSpy();

});   
