let currentSubtotal=parseFloat($("[name='subtotal']").val())
let currentTotal=parseFloat($("[name='total']").val())
let currentDuetoday=parseFloat($("[name='duetoday']").val())
let balanceLimited=parseFloat($("#limit").val())
let limitedAccount=parseFloat($("[name='limit']").val())
console.log(currentSubtotal,currentTotal,currentDuetoday,balanceLimited,limitedAccount);$("#btnPromotionalCode").click(function(){$(".promotionalCode").toggle()
$("#txtCode").val("")
$("#discount").text("")
$("[name='discount']").text("")
$("#subtotal").text(currentSubtotal.toFixed(2))
$("#total").text(currentTotal.toFixed(2))
$("#duetoday").text(currentDuetoday.toFixed(2))})
$("#txtCode").on("input",function(){$.ajax({type:'POST',url:$("#url").val(),data:{txtCode:$(this).val()},success:function(data){if(data!="Invalid promotional code"){$("#discount").css('color','green')
$("#discount").text(data+"%")
$("[name='discount']").val(data)
let newSubtotal=currentSubtotal-(currentSubtotal*(data/100))
$("#subtotal").text(newSubtotal.toFixed(2))
$("[name='subtotal']").val(newSubtotal.toFixed(2))
$("#total").text(newSubtotal.toFixed(2))
$("[name='total']").val(newSubtotal.toFixed(2))
if(newSubtotal<=limitedAccount||$("[name='current']").val()>=(newSubtotal-limitedAccount)+balanceLimited){$("#duetoday").text(0.00.toFixed(2))
$("[name='duetoday']").val(0.00.toFixed(2))}else{let newDuetoday=((newSubtotal-limitedAccount)+balanceLimited)-$("[name='current']").val()
$("#duetoday").text(newDuetoday.toFixed(2))
$("[name='duetoday']").val(newDuetoday.toFixed(2))}}else{$("#discount").css('color','red')
$("#discount").text(data)
$("[name='discount']").val(0.00.toFixed(2))
$("#subtotal").text(currentSubtotal.toFixed(2))
$("[name='subtotal']").val(currentSubtotal.toFixed(2))
$("#total").text(currentTotal.toFixed(2))
$("[name='total']").val(currentTotal.toFixed(2))
$("#duetoday").text(currentDuetoday.toFixed(2))
$("[name='duetoday']").val(currentDuetoday.toFixed(2))}}})})
$("#checkoutOrder").bind("submit",function(){if($("[name='duetoday']").val()==0){$.ajax({type:$(this).attr("method"),url:$(this).attr("action"),contentType:!1,processData:!1,dataType:"json",data:new FormData(this),success:function(data){if(data.message!='Successfully Order'){message("error",data.message,"#CC1E1E")}else{message("success",data.message,"#4CC522")
setTimeout(()=>{window.location.href=data.route},3000)}}})
return!1}
return!0})