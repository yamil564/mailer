function validateClient(form){let validateForm=!0
let inputsForm=$("#"+form.attr('id')+" :input")
inputsForm.each(function(){let messageError=".msg_"+$(this).attr("id")
switch(!0){case $(this).attr("type")=="text"&&$(this).val()==='':$(this).addClass("invalid")
$(messageError).html("The information is required")
validateForm=!1
break
case $(this).attr("type")=="email"&&$(this).val()==='':$(this).addClass("invalid")
$(messageError).html("The email is required")
validateForm=!1
break
case $(this).attr("type")=="date"&&$(this).val()==='':$(this).addClass("invalid")
$(messageError).html("The date is required")
validateForm=!1
$(this).change(function(){$(this).removeClass("invalid")
$(messageError).empty()})
break
case $(this).attr("type")=="password"&&$(this).val()==='':$(this).addClass("invalid")
$(messageError).html("The password is required")
validateForm=!1
break}
$(this).keyup(function(){$(this).removeClass("invalid")
$(messageError).empty()})})
return validateForm}
$("#newClient").bind("submit",function(){if(validateClient($(this))){$.ajax({type:$(this).attr("method"),url:$(this).attr("action"),data:new FormData(this),contentType:!1,processData:!1,dataType:"json",success:function(data){if(data.message!='Successfully saved'){message("error",data.message,"#CC1E1E")}else{message("success",data.message,"#4CC522")
$("#newClient")[0].reset()
setTimeout(()=>{window.location.href=data.route},1500)}}})}
return!1})
$("#updateClient").bind("submit",function(){if(validateClient($(this))){$.ajax({type:$(this).attr("method"),url:$(this).attr("action"),data:new FormData(this),contentType:!1,processData:!1,dataType:"json",success:function(data){if(data.message!="Successfully updated"){message("error",data.message,"#CC1E1E")}else{message("success",data.message,"#4CC522")
setTimeout(()=>{window.location.href=data.route},1500)}},})}
return!1})
$(".delete").on('click',function(){$("#clientAccount").val($(this).val())})
$("#deleteClient").bind("submit",function(e){e.preventDefault()
$.ajax({type:$(this).attr("method"),url:$(this).attr("action"),data:new FormData(this),contentType:!1,processData:!1,success:function(data){if(data!="Successfully removed"){message("error",data,"#CC1E1E")}else{$('#deleteModal').modal('hide')
message("success",data,"#4CC522")
setTimeout(()=>{location.reload()},1500)}},})})