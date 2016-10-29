$(document).ready(function() {

    $("select.chosen-select-contact").change(function() {
        var select = $(this).val();
        if (select == "1") {
            $(".img-col-example").not(".contact-1").hide();
            $(".contact-1").show();
            $(".form-contact-content").hide();
            $(".form-group-example").show();
        } else if (select == "2") {
            $(".img-col-example").not(".contact-2").hide();
            $(".contact-2").show();
            $(".form-contact-content").show();
            $(".form-group-example").show();
        } else {
            $(".select").hide();
            $(".form-group-example").hide();
        }
    });

    $( window ).on( 'mousemove mouseup', function() {
        var $modal     = $('.modal-dialog')
          , $backdrop  = $('.modal-backdrop')
          , el_height  = $modal.innerHeight();
        $backdrop.css({
            height: el_height + 20,
            minHeight: '100%',
            margin: 'auto'
        });
        $modal.css({
            maxWidth: '900px',
            margin: '10px auto'
        });
    });
    
    /* Populating option value because there is so much of them  and hurt my eyes to see them inside form */
    var group1 = ['bounce', 'flash', 'pulse', 'rubberband', 'shake', 'swing', 'tada', 'wobble', 'jello'];
    var group2 = ['bounceIn', 'bounceInDown', 'bounceInLeft', 'bounceInRight', 'bounceInUp'];
    var group3 = ['bounceOut', 'bounceOutDown', 'bounceOutLeft', 'bounceOutRight', 'bounceOutUp'];
    var group4 = ['fadeIn', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig', 'fadeInRight', 'fadeInRightBig', 'fadeInUp', 'fadeInUpBig'];
    var group5 = ['fadeOut', 'fadeOutDown', 'fadeOutDownBig', 'fadeOutLeft', 'fadeOutLeftBig', 'fadeOutRight', 'fadeOutRightBig', 'fadeOutUp', 'fadeOutUpBig'];
    var group6 = ['flip', 'flipInX', 'flipInY', 'flipOutX', 'flipOutY'];
    var group7 = ['lightSpeedIn', 'lightSpeedOut'];
    var group8 = ['rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight'];
    var group9 = ['rotateOut', 'rotateOutDownLeft', 'rotateOutDownRight', 'rotateOutUpLeft', 'rotateOutUpRight'];
    var group10 = ['slideInUp', 'slideInDown', 'slideInLeft', 'slideInRight'];
    var group11 = ['slideOutUp', 'slideOutDown', 'slideOutLeft', 'slideOutRight'];
    var group12 = ['zoomIn', 'zoomInDown', 'zoomInLeft', 'zoomInRight', 'zoomInUp'];
    var group13 = ['zoomOut', 'zoomOutDown', 'zoomOutLeft', 'zoomOutRight', 'zoomOutUp'];
    var group14 = ['hinge', 'rollIn', 'rollOut'];

    var option1 = '';
    for (var i=0;i<group1.length;i++){
        option1 += '<option value="'+ group1[i] + '">' + group1[i] + '</option>';
    }

    var option2 = '';
    for (var i=0;i<group2.length;i++){
        option2 += '<option value="'+ group2[i] + '">' + group2[i] + '</option>';
    }

    var option3 = '';
    for (var i=0;i<group3.length;i++){
        option3 += '<option value="'+ group3[i] + '">' + group3[i] + '</option>';
    }

    var option4 = '';
    for (var i=0;i<group4.length;i++){
        option4 += '<option value="'+ group4[i] + '">' + group4[i] + '</option>';
    }

    var option5 = '';
    for (var i=0;i<group5.length;i++){
        option5 += '<option value="'+ group5[i] + '">' + group5[i] + '</option>';
    }

    var option6 = '';
    for (var i=0;i<group6.length;i++){
        option6 += '<option value="'+ group6[i] + '">' + group6[i] + '</option>';
    }

    var option7 = '';
    for (var i=0;i<group7.length;i++){
        option7 += '<option value="'+ group7[i] + '">' + group7[i] + '</option>';
    }

    var option8 = '';
    for (var i=0;i<group8.length;i++){
        option8 += '<option value="'+ group8[i] + '">' + group8[i] + '</option>';
    }

    var option9 = '';
    for (var i=0;i<group9.length;i++){
        option9 += '<option value="'+ group9[i] + '">' + group9[i] + '</option>';
    }

    var option10 = '';
    for (var i=0;i<group10.length;i++){
        option10 += '<option value="'+ group10[i] + '">' + group10[i] + '</option>';
    }

    var option11 = '';
    for (var i=0;i<group11.length;i++){
        option11 += '<option value="'+ group11[i] + '">' + group11[i] + '</option>';
    }

    var option12 = '';
    for (var i=0;i<group12.length;i++){
        option12 += '<option value="'+ group12[i] + '">' + group12[i] + '</option>';
    }

    var option13 = '';
    for (var i=0;i<group13.length;i++){
        option13 += '<option value="'+ group13[i] + '">' + group13[i] + '</option>';
    }

    var option14 = '';
    for (var i=0;i<group14.length;i++){
        option14 += '<option value="'+ group14[i] + '">' + group14[i] + '</option>';
    }

    $('#opt-group-1').append(option1);
    $('#opt-group-2').append(option2);
    $('#opt-group-3').append(option3);
    $('#opt-group-4').append(option4);
    $('#opt-group-5').append(option5);
    $('#opt-group-6').append(option6);
    $('#opt-group-7').append(option7);
    $('#opt-group-8').append(option8);
    $('#opt-group-9').append(option9);
    $('#opt-group-10').append(option10);
    $('#opt-group-11').append(option11);
    $('#opt-group-12').append(option12);
    $('#opt-group-13').append(option13);
    $('#opt-group-14').append(option14);

});