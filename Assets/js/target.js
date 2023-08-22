$(document).ready(function(){$('#file_direction').change(function(){let btn=$(this).prop('files')
let reader=new FileReader()
reader.readAsDataURL(btn[0])
reader.onload=function(){message("success","List uploaded","#4CC522")}})
function message(icon,title,background){const Toast=Swal.mixin({toast:!0,position:"bottom",showConfirmButton:!1,timer:4000,})
Toast.fire({icon:icon,iconColor:"#fff",title:title,background:background,})}
$('#CrNumber_target').on('input',function(){$('#txtNumber_target').val($(this).val())
$('#txtNumber_target').on("input",function(){if($('#txtNumber_target').val()>2000){$('#txtNumber_target').val("2000")}else if($('#txtNumber_target').val()===0&&$('#txtNumber_target').val()===""){$('#txtNumber_target').val("1")}
$(this).val($('#txtNumber_target').val())})
let price=$('#txtPrice').val()
let subtotal=Number.parseFloat($(this).val()*price).toFixed(2)
$('#Subtotal').text(subtotal)})
$('#txtNumber_target').on('input',function(){$('#CrNumber_target').val($(this).val())
if($(this).val()>2000){$(this).val("2000")}else if($(this).val()===0&&$(this).val()===""){$(this).val("1")}
let price=$('#txtPrice').val()
let subtotal=Number.parseFloat($(this).val()*price).toFixed(2)
$('#Subtotal').text(subtotal)})
$('#CrBedrooms_min').on("input",function(){let minVal=parseInt($(this).val())
let maxVal=parseInt($('#CrBedrooms_max').val())
$('#Bedrooms_min').text(minVal)
if(maxVal<minVal+2){$(this).val(maxVal-2)
$('#Bedrooms_min').text(maxVal-2)
if(minVal==$(this).attr('min')){$('#CrBedrooms_max').val(2)}}})
$('#CrBedrooms_max').on("input",function(){let minVal=parseInt($('#CrBedrooms_min').val())
let maxVal=parseInt($(this).val())
$('#Bedrooms_max').text(maxVal)
if(minVal>maxVal-2){$(this).val(minVal+2)
$('#Bedrooms_max').text(minVal+2)
if(maxVal==$(this).attr('max')){$('#CrBedrooms_min').val(parseInt($(this).attr('max'))-2)}}})
$('#CrSquare_footage_min').on("input",function(){let minVal=parseInt($(this).val())
let maxVal=parseInt($('#CrSquare_footage_max').val())
$('#Square_footage_min').text(minVal)
if(maxVal<minVal+322){$(this).val(maxVal-322)
$('#Square_footage_min').text(maxVal-322)
if(minVal==$(this).attr('min')){$('#CrSquare_footage_max').val(322)}}})
$('#CrSquare_footage_max').on("input",function(){let minVal=parseInt($('#CrSquare_footage_min').val())
let maxVal=parseInt($(this).val())
$('#Square_footage_max').text(maxVal)
if(minVal>maxVal-322){$(this).val(minVal+322)
$('#Square_footage_max').text(minVal+322)
if(maxVal==$(this).attr('max')){$('#CrSquare_footage_min').val(parseInt($(this).attr('max'))-322)}}})
$('#CrYear_built_min').on("input",function(){let minVal=parseInt($(this).val())
let maxVal=parseInt($('#CrYear_built_max').val())
$('#Year_built_min').text(minVal)
if(maxVal<minVal+14){$(this).val(maxVal-14)
$('#Year_built_min').text(maxVal-14)
if(minVal==$(this).attr('min')){$('#CrYear_built_max').val(14)}}})
$('#CrYear_built_max').on("input",function(){let minVal=parseInt($('#CrYear_built_min').val())
let maxVal=parseInt($(this).val())
$('#Year_built_max').text(maxVal)
if(minVal>maxVal-14){$(this).val(minVal+14)
$('#Year_built_max').text(minVal+14)
if(maxVal==$(this).attr('max')){$('#CrYear_built_min').val(parseInt($(this).attr('max'))-14)}}})
$('#CrYear_last_min').on("input",function(){let minVal=parseInt($(this).val())
let maxVal=parseInt($('#CrYear_last_max').val())
$('#Year_last_min').text(minVal)
if(maxVal<minVal+14){$(this).val(maxVal-14)
$('#Year_last_min').text(maxVal-14)
if(minVal==$(this).attr('min')){$('#CrYear_last_max').val(14)}}})
$('#CrYear_last_max').on("input",function(){let minVal=parseInt($('#CrYear_last_min').val())
let maxVal=parseInt($(this).val())
$('#Year_last_max').text(maxVal)
if(minVal>maxVal-14){$(this).val(minVal+14)
$('#Year_last_max').text(minVal+14)
if(maxVal==$(this).attr('max')){$('#CrYear_last_min').val(parseInt($(this).attr('max'))-14)}}})
$('#CrLast_sold_min').on("input",function(){let minVal=parseFloat($(this).val())
let maxVal=parseFloat($('#CrLast_sold_max').val())
if(minVal>1){$('#Last_sold_min').text(minVal+"M")}else{$('#Last_sold_min').text(minVal+"K")}
if(maxVal<minVal+1.22){if(maxVal>1){$(this).val(maxVal-1.22)
$('#Last_sold_min').text(maxVal-1.22+"M")}else{$(this).val(maxVal-1.22)
$('#Last_sold_min').text(maxVal-1.22+"K")}
if(minVal==$(this).attr('min')){$('#CrLast_sold_max').val(1.22)}}})
$('#CrLast_sold_max').on("input",function(){let minVal=parseFloat($('#CrLast_sold_min').val())
let maxVal=parseFloat($(this).val())
if(maxVal>1){$('#Last_sold_max').text(maxVal+"M")}else{$('#Last_sold_max').text(maxVal+"K")}
if(minVal>maxVal-1.22){$(this).val(minVal+1.22)
$('#Last_sold_max').text(minVal+1.22+"M")
if(maxVal==$(this).attr('max')){$('#CrLast_sold_min').val(parseInt($(this).attr('max'))-1.22)}}})
$("#enviar").submit(function(){let data
switch(type){case "circle":data=[type,polygon.getCenter(),polygon.getRadius()]
break
case "rectangle":data=[type,polygon.getBounds()]
break
case "polygon":data=[type,polygon.getPath().getArray()]
break}
$("#polygon").text(data)})
let map=new google.maps.Map(document.getElementById("map"),{zoom:16,maxZoom:18,center:{lat:39.02007335494998,lng:-76.97469811827334},disableDefaultUI:!0,gestureHandling:"none",zoomControl:!0,zoomControlOptions:{position:google.maps.ControlPosition.LEFT_BOTTOM,},mapTypeControl:!1,rotateControl:!1,scaleControl:!1,streetViewControl:!1,})
let marker=new google.maps.Marker({position:{lat:39.02007335494998,lng:-76.97469811827334},map:map,})
let circle=new google.maps.Circle({strokeColor:"#048FE4",strokeOpacity:0.8,strokeWeight:2,fillColor:"#048FE4",fillOpacity:0.35,map,center:{lat:39.02007335494998,lng:-76.97469811827334},radius:200,editable:!1,})
const drawingManager=new google.maps.drawing.DrawingManager({drawingControl:!0,drawingControlOptions:{position:google.maps.ControlPosition.TOP_LEFT,drawingModes:[google.maps.drawing.OverlayType.CIRCLE,google.maps.drawing.OverlayType.POLYGON,google.maps.drawing.OverlayType.RECTANGLE,],},circleOptions:{fillColor:"#048FE4",fillOpacity:0.35,strokeColor:"#048FE4",strokeOpacity:0.8,strokeWeight:2,clickable:!1,editable:!1,},polygonOptions:{fillColor:"#048FE4",fillOpacity:0.35,strokeColor:"#048FE4",strokeOpacity:0.8,strokeWeight:2,clickable:!1,editable:!1,},rectangleOptions:{fillColor:"#048FE4",fillOpacity:0.35,strokeColor:"#048FE4",strokeOpacity:0.8,strokeWeight:2,clickable:!1,editable:!1,},map,})
let geocoder=new google.maps.Geocoder()
let content=document.createElement("div")
content.classList.add("search")
const inputText=document.createElement("input")
inputText.addEventListener("keydown",(evento)=>{if(evento.key=="Enter"){evento.preventDefault()
geocode({address:inputText.value,})
return!1}})
inputText.id="location"
inputText.name="txtLocation"
inputText.type="text"
inputText.placeholder="Enter the address"
inputText.value="1700 Elton Rd, Silver Spring, MD 20903, EE. UU."
const submitButton=document.createElement("div")
submitButton.id="search"
const iconsearch=document.createElement("i")
iconsearch.classList.add("fas","fa-search")
const clearButton=document.createElement("div")
clearButton.id="clear"
const iconclose=document.createElement("i")
iconclose.classList.add("fas","fa-times")
submitButton.append(iconsearch)
content.append(inputText,submitButton)
clearButton.append(iconclose)
map.controls[google.maps.ControlPosition.TOP_CENTER].push(content)
map.controls[google.maps.ControlPosition.LEFT_TOP].push(clearButton)
let type="circle"
let polygon=circle
function clear(){if(polygon){polygon.setMap(null)
polygon=null}}
google.maps.event.addListener(drawingManager,"overlaycomplete",function(e){clear()
type=e.type
polygon=e.overlay})
submitButton.addEventListener("click",()=>geocode({address:inputText.value,}))
clearButton.addEventListener("click",()=>{clear()
polygon=circle
polygon.setMap(map)})
function geocode(request){clear()
geocoder.geocode(request).then((result)=>{const{results}=result
map.setCenter(results[0].geometry.location)
marker.setPosition(results[0].geometry.location)
marker.setMap(map)
circle.setCenter(results[0].geometry.location)
circle.setMap(map)
polygon=circle
inputText.value=results[0].formatted_address}).catch((e)=>{alert("Geocode was not successful for the following reason: "+e)})}})