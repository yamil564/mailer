function validateLogin(form){let validateForm=!0
let inputsForm=$("#"+form.attr('id')+" :input")
inputsForm.each(function(){let messageError=".msg_"+$(this).attr("id")
switch(!0){case $(this).attr("type")=="text"&&$(this).val()==='':$(this).addClass("invalid")
$(messageError).html("The username is required")
validateForm=!1
break
case $(this).attr("type")=="password"&&$(this).val()==='':$(this).addClass("invalid")
$(messageError).html("The password is required")
validateForm=!1
break}
$(this).keyup(function(){$(this).removeClass("invalid")
$(messageError).empty()})})
return validateForm}
$("#signIn").bind("submit",function(){if(validateLogin($(this))){$.ajax({type:$(this).attr("method"),url:$(this).attr("action"),data:$(this).serialize(),dataType:"json",success:function(data){if(data.message!='Signed in successfully'){message("error",data.message,"#CC1E1E")}else{message("success",data.message,"#4CC522");setTimeout(()=>{window.location.href=data.route},1500)}},})}
return!1})