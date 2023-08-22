lazyload();$("#sidebar").mCustomScrollbar({theme:"minimal",})
$("#dismiss, .overlay").on("click",function(){$("#sidebar").removeClass("active")
$(".overlay").removeClass("active")})
$("#sidebarCollapse").on("click",function(){$("#sidebar").addClass("active")
$(".overlay").addClass("active")
$(".collapse.in").toggleClass("in")
$("a[aria-expanded=true]").attr("aria-expanded","false")})
function message(icon,title,background){const Toast=Swal.mixin({toast:!0,position:"bottom",showConfirmButton:!1,timer:4000,});Toast.fire({icon:icon,iconColor:"#fff",title:title,background:background,})}