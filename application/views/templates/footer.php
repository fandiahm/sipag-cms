<?php if($contact_display == '1'):?>

<?php 

	if(!empty($contact->contact_bgimage))
	{
		$contact_bgimage = 'background-image:url('.base_url().''.$contact->contact_bgimage.'); background-size:cover';
	}
	else
	{
		$contact_bgimage = '';
	}

	if(!empty($contact->contact_bgcolor))
	{
		$contact_bgcolor = 'background-color:'.$contact->contact_bgcolor.'';
	}
	else
	{
		$contact_bgcolor = '';
	}

?>
<div class="section section-auto section-footer" data-scroll-index="<?php echo $last_number; ?>" 
style="<?php echo $contact_bgcolor; ?>;<?php echo $contact_bgimage; ?>">
	<div class="container vertical-align">
		<div class="row content-center">
			<div class="col-lg-12">
                <h1 class="page-header center">
                	<?php echo $contact->contact_title; ?>
                </h1>
            </div>
            <?php if($contact->contact_layout == '1'): ?>
			<div class="col-lg-12 col-md-12">
				<form class="form-horizontal" action="#" id="form-msg">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="inputEmail">Email</label>
						<div class="col-xs-12 col-sm-7">
	    					<div class="clearfix">
	    						<input type="email" class="form-control input-md" name="inputEmail" id="inputEmail" maxlength="100" placeholder="Email">
	    					</div>
    					</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="inputName">Name</label>
						<div class="col-xs-12 col-sm-7">
	    					<div class="clearfix">
	    						<input type="text" class="form-control input-md" name="inputName" id="inputName" maxlength="100" placeholder="Name">
	    					</div>
    					</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="inputText">Message</label>
							<div class="col-xs-12 col-sm-7">
	    					<div class="clearfix">
	    						<textarea id="inputText" name="inputText" class="form-control input-md" placeholder="Say hello..."></textarea>
	    					</div>
    					</div>
					</div>
					<div class="form-group">
  						<label class="col-md-3 control-label">&nbsp;</label>
  						<div class="col-md-9">
  							<button type="button" id="btnSend" onclick="send()" class="btn btn-info">Send</button>	
    						<button type="button" id="btnReset" onclick="reset_form()" class="btn btn-default">Reset</button>
  						</div>
					</div>
				</form>
			</div>
			<?php elseif($contact->contact_layout == '2'): ?>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="clearfix">
					<?php echo $contact->contact_content; ?>
					<!--iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15862.623359088167!2d106.68218805!3d-6.3088652000000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e52bebe5a679%3A0xa1779384bbe55974!2sJl.+Tj.+Raya%2C+Serpong%2C+Kota+Tangerang+Selatan%2C+Banten+15310!5e0!3m2!1sid!2sid!4v1475293449958" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe-->
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<form class="form-horizontal" action="#" id="form-msg">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="inputEmail">Email</label>
						<div class="col-xs-12 col-sm-9">
	    					<div class="clearfix">
	    						<input type="email" class="form-control input-md" name="inputEmail" id="inputEmail" maxlength="100" placeholder="Email">
	    					</div>
    					</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="inputName">Name</label>
						<div class="col-xs-12 col-sm-9">
	    					<div class="clearfix">
	    						<input type="text" class="form-control input-md" name="inputName" id="inputName" maxlength="100" placeholder="Name">
	    					</div>
    					</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="inputText">Message</label>
							<div class="col-xs-12 col-sm-9">
	    					<div class="clearfix">
	    						<textarea id="inputText" name="inputText" class="form-control input-md" placeholder="Say hello..."></textarea>
	    					</div>
    					</div>
					</div>
					<div class="form-group">
  						<label class="col-md-3 control-label">&nbsp;</label>
  						<div class="col-md-9">
  							<button type="button" id="btnSend" onclick="send()" class="btn btn-info">Send</button>	
    						<button type="button" id="btnReset" onclick="reset_form()" class="btn btn-default">Reset</button>
  						</div>
					</div>
				</form>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php endif; ?>

<?php if($footer_display == '1'):?>

<div class="footer" style="background-color:<?php echo $footer_content->footer_color; ?>">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="footer-content">
					<?php echo $footer_content->footer_content; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php endif; ?>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_success" role="dialog">
    <div class="modal-dialog modal-content">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Success</h3>
            </div>
            <div class="modal-body form">
                <div class="alert alert-info"><p>Your message has been sent successfully. We will respond your message as soon as possible.</p></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnClose" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Bootstrap modal -->

<script>

	jQuery(function($) {
		/* main banner */
		var banner_nav = <?php echo $banner_nav; ?>;
		var autoplay = <?php echo $banner_autoplay; ?>;
		var transition = <?php echo $banner_transition; ?>;
	    $("#owl-banner").owlCarousel({

	        navigation: banner_nav, // Show next and prev buttons
	        slideSpeed: 5000,
	        singleItem: true,
	        transitionStyle: transition,
	        autoPlay: autoplay,
	        navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"]

	    });

	    var s_time = <?php echo $scrolltime; ?>;
	    var s_offset = <?php echo $scrolloffset; ?>;
	    /* scrollIt function*/
	    $.scrollIt({
	        scrollTime: s_time,
	        topOffset: s_offset
	    });


	    /* validation form msg*/
		$('#form-msg').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: true,
            ignore: "",
            rules: {
                inputEmail: {
                    required: true,
                    email: true
                },
                inputName: {
                    required: true
                },
                inputText: {
                    required: true
                },

            },
            messages: {
                inputEmail: {
                    required: "Please insert your email."
                },
                inputName: {
                    required: "Please tell us your name."
                },
                inputText: {
                    required: "Please describe your message."
                },
            },
            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                $('.footer').css('bottom', '-40px');
            },
            success: function (e) {
            	$('.footer').css('bottom', '0px');
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },
            errorPlacement: function (error, element) {
                if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                    var controls = element.closest('div[class*="col-"]');
                    if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else error.insertAfter(element.parent());
            },
            
            //submitHandler: function (form) {},
            invalidHandler: function (form) {
            }
        });
		
	})

	function reset_form()
	{
		$('#form-msg')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('.footer').css('bottom', '0px');
	}

	function send()
    {
    	//$('.footer').css('bottom', '-40px');
        if ($("#form-msg").valid()) 
        {
        	//$('.footer').css('bottom', '0px');
        	$('#btnSend').text('sending message...'); //change button text
        	$('#btnSave').attr('disabled',true); //set button disable 
        	
        	var url;

	        url = "<?php echo site_url('index/ajax_send'); ?>";
	        msg = "Thank you for sending message to us. We will respond your message as soon as possible.";
	     
	        var formData = new FormData($('#form-msg')[0]);
	        $.ajax({
	            url : url,
	            type: "POST",
	            data: formData,
	            contentType: false,
	            processData: false,
	            dataType: "JSON",
	            success: function(data)
	            {
	                if(data.status) 
	                {
	        			$('#modal_success').modal('show');
	        			$('#form-msg')[0].reset();
	        			$('.form-group').removeClass('has-error'); 
		    			$('.help-block').empty(); 
		    			$('#btnSend').text('Send'); //change button text
	                	$('#btnSend').attr('disabled',false); //set button enable 
	                }
	                else
	                {
	                    for (var i = 0; i < data.inputerror.length; i++) 
	                    {
	                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                    }
	                }

	            },
	            error: function (jqXHR, textStatus, errorThrown, ex)
	            {
	                alert('Error');
	                console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	                $('#btnSend').text('Send'); //change button text
	                $('#btnSend').attr('disabled',false); //set button enable 
	     
	            }
	        });
		}
 
    }

</script>