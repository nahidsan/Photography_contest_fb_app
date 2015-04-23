(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#register-form").validate({
                rules: {
                    name: "required", 
		    txtMessage: "required",	                   
                    email: {
                        required: true,
                        email: true
                    },
                    mobile_no: {
                        required: true
                        
                    },
		    
		    image:{
			required: true
		    }
                },
                messages: {
                    name: "Please enter your name",
                    email: "Please enter a valid email address",
		    mobile_no: "Please enter your mobile number",
                    txtMessage: "Please enter message",
                    image: {
			required: 'Please select the image!'
			},
                    
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);