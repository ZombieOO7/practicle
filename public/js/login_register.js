/* Login form validation */
$('#loginform').validate({
    rules:{
        email:{
            required:true,
            email:true,
            maxlength:50,
        },
        password:{
            required:true,
            minlength:6,
            maxlength:12,
        }
    },
    ignore: [],
    errorPlacement: function (error, element) {
        if(element.attr('name')=='email'){
            error.insertAfter('.emailError');
        }else if(element.attr('name')=='password'){
            error.insertAfter('.pswError');
        }else{
            error.insertAfter(element);
        }
    },
    submitHandler: function (form) {
        if (!this.beenSubmitted) {
            this.beenSubmitted = true;
            form.submit();
        }
    },
});

$('#signupform').validate({
    rules:{
        full_name:{
            required:true,
            maxlength:50,
        },
        email:{
            required:true,
            email:true,
            maxlength:50,
        },
        password:{
            required:true,
            minlength:6,
            maxlength:12,
        }
    },
    ignore: [],
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    submitHandler: function (form) {
        if (!this.beenSubmitted) {
            this.beenSubmitted = true;
            form.submit();
        }
    },
});