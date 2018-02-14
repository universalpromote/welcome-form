
function scroll_to_class(element_class, removed_height) {
	var scroll_to = $(element_class).offset().top - removed_height;
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 0);
	}
}

function bar_progress(progress_line_object, direction) {
	var number_of_steps = progress_line_object.data('number-of-steps');
	var now_value = progress_line_object.data('now-value');
	var new_value = 0;
	if(direction == 'right') {
		new_value = now_value + ( 100 / number_of_steps );
	}
	else if(direction == 'left') {
		new_value = now_value - ( 100 / number_of_steps );
	}
	progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}

jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*
        Form
    */
    $('.f1 fieldset:first').fadeIn('slow');
    
    $('.f1 input[type="text"], .f1 input[type="email"]').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    // next step
    $('.f1 .btn-next').on('click', function() {
    	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;
    	// navigation steps / progress steps
    	var current_active_step = $(this).parents('.f1').find('.f1-step.active');
		var progress_line = $(this).parents('.f1').find('.f1-progress-line');
		var prev_icon = $(".f1-step.active .f1-step-icon");
		
    	// fields validation
    	parent_fieldset.find('input[type="text"], input[type="email"]').each(function() {
    		if( $(this).val() == "" ) {
    			$(this).addClass('input-error');
    			next_step = false;
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	// fields validation
    	
    	if( next_step ) {
    		parent_fieldset.fadeOut(400, function() {
    			// change icons
				current_active_step.removeClass('active').addClass('activated').next().addClass('active');
				//  replace previous icon with checkmark
				prev_icon.html("<i class='fa fa-check'></i>");
    			// progress bar
    			bar_progress(progress_line, 'right');
    			// show next step
	    		$(this).next().fadeIn();
	    		// scroll window to beginning of the form
    			scroll_to_class( $('.f1'), 20 );
	    	});
    	}
    	
    });
    
    // previous step
    $('.f1 .btn-previous').on('click', function() {
    	// navigation steps / progress steps
		var current_active_step = $(this).parents('.f1').find('.f1-step.active');
		var progress_line = $(this).parents('.f1').find('.f1-progress-line');
		var step_num = current_active_step.data("id");
		var current_step_num = current_active_step.prev().data("id");
		var prev_icon = $(".f1-step.active .f1-step-icon");
		console.log("previous step number was: " + step_num);
		console.log("current step number: " + current_step_num);
    	
    	$(this).parents('fieldset').fadeOut(400, function() {
			// change icons
			current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
			prev_icon.html(current_step_num + 1);
    		// progress bar
    		bar_progress(progress_line, 'left');
    		// show previous step
    		$(this).prev().fadeIn();
    		// scroll window to beginning of the form
			scroll_to_class( $('.f1'), 20 );
    	});
    });
    
    // submit
    $('.f1').on('submit', function(e) {
		e.preventDefault();
		var agentname = $("#agent_name").val();
		var agenttitle = $("#agent_title").val();
		var agentphone = $("#agent_phone").val();
		var agentemail = $("#agent_email").val();
		var listingprice = $("#listing_price").val();
		var listingstreet = $("#listing_street").val();
		var listingcity = $("#listing_city").val();
		var bedstotal = $("#beds_total").val();
		var bathstotal = $("#baths_total").val();
		var sqfttotal = $("#sqft_total").val();
		var lottotal = $("#lot_total").val();
		var listingtype = $("#listing_type").val();
		var yearbuilt = $("#year_built").val();
		var listingdescription = $("#listing_description").val();
		// var message = $("#message").val();
		// var contact = $("#contact").val();
		// var name = $("#name").val();
		// var email = $("#email").val();
		// var message = $("#message").val();

		$.post("contact.php", {
			username : agentname,
			usertitle : agenttitle,
			userphone : agentphone,
			useremail : agentemail,
			listprice : listingprice,
			liststreet : listingstreet,
			listcity : listingcity,
			listbeds : bedstotal,
			listbaths : bathstotal,
			listsqft : sqfttotal,
			listlot : lottotal,
			listtype : listingtype,
			listyrblt : yearbuilt,
			listdesc : listingdescription
			}, function(data) {
			$("#returnmessage").append(data); // Append returned message to message paragraph.
			if (data == "Your Query has been received, We will contact you soon.") {
			$(this)[0].reset(); // To reset form fields on success.
			}
		});
	});

	$(document).ready( function() {
	
	// Set input value on change and create fileselect event
	$('.btn-upload :file').on('change', function () {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
	});	

	// On fileselect look for closest input and set file name as value
	$('.btn-upload :file').on('fileselect', function (event, label) {

		var	inputClosest = $(this).closest('.row').find('input[type=text]'),
			title = label;

		if (inputClosest.length) {
			inputClosest.val(title);
		} else {
			if (title) alert(title);
		} 
	});

		
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#userimg').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		// Read URL and display user logo image
		function readURL2(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#logoimg').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}


		$("#propimg0").change(function(){
		    readURL(this);
		}); 	

		
		$("#propimg1").change(function () {
			readURL2(this);
		});
	});

	$('.btn-restart').click(function(e) {

		if(confirm('Do you want to reload this site? Changes you made may not be saved.')){
			window.location.reload(); 
		}
		else {
			e.stopPropagation();
			e.preventDefault(); 
			console.log("user refreshed cancelled!");
		}
	});

	 // Referneces
	var clearBn = $("#rmv-img1");
		clearBn2 = $("#rmv-img2");
		clearBn3 = $("#rmv-img3");

	// Setup the clear functionality
	clearBn.on("click", function(){
	var control = $("#propimg1-name");
	control.replaceWith( control.val('').clone( true ) );
	});

	clearBn2.on("click", function(){
	var control2 = $("#propimg2-name");
	control2.replaceWith( control2.val('').clone( true ) );
	});

	clearBn3.on("click", function(){
	var control3 = $("#propimg3-name");
	control3.replaceWith( control3.val('').clone( true ) );
	});

});
