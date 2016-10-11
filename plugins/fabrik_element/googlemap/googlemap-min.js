/*! Fabrik */
function googlemapload(){if("null"===typeOf(Fabrik.googleMapRadius)){var a=document.createElement("script"),b=document.location,c=b.pathname.split("/"),d=c.indexOf("index.php");-1!==d&&(c=c.slice(0,d)),c.shift(),c=c.join("/"),a.type="text/javascript",a.src=Fabrik.liveSite+"/components/com_fabrik/libs/googlemaps/distancewidget.js",document.body.appendChild(a),Fabrik.googleMapRadius=!0}document.body?window.fireEvent("google.map.loaded"):console.log("no body")}function googleradiusloaded(){document.body?window.fireEvent("google.radius.loaded"):console.log("no body")}define(["jquery","fab/element","lib/debounce/jquery.ba-throttle-debounce","fab/fabrik"],function(a,b,c,d){return window.FbGoogleMap=new Class({Extends:b,watchGeoCodeDone:!1,options:{lat:0,lat_dms:0,key:"",lon:0,lon_dms:0,zoomlevel:"13",control:"",maptypecontrol:!1,overviewcontrol:!1,scalecontrol:!1,drag:!1,maptype:"G_NORMAL_MAP",geocode:!1,latlng:!1,latlng_dms:!1,staticmap:!1,auto_center:!1,scrollwheel:!1,streetView:!1,sensor:!1,center:0,reverse_geocode:!1,use_radius:!1,geocode_on_load:!1,traffic:!1,debounceDelay:500,styles:[],directionsFrom:!1,directionsFromLat:0,directionsFromLon:0,reverse_geocode_fields:{},key:!1,mapShown:!0},loadScript:function(){d.loadGoogleMap(this.options.key,"googlemapload")},initialize:function(a,b){this.mapMade=!1,this.parent(a,b),this.options.mapShown&&(this.loadFn=function(){this.mapTypeIds=[];for(var a in google.maps.MapTypeId)this.mapTypeIds.push(google.maps.MapTypeId[a]);switch(this.mapTypeIds.push("OSM"),this.options.maptype){case"OSM":this.options.maptype="OSM";break;case"G_SATELLITE_MAP":this.options.maptype=google.maps.MapTypeId.SATELLITE;break;case"G_HYBRID_MAP":this.options.maptype=google.maps.MapTypeId.HYBRID;break;case"TERRAIN":this.options.maptype=google.maps.MapTypeId.TERRAIN;break;default:case"G_NORMAL_MAP":this.options.maptype=google.maps.MapTypeId.ROADMAP}this.makeMap(),1!==this.options.center||""!==this.options.rowid&&0!==this.options.rowid||(geo_position_js.init()?geo_position_js.getCurrentPosition(this.geoCenter.bind(this),this.geoCenterErr.bind(this),{enableHighAccuracy:!0}):fconsole("Geo location functionality not available"))}.bind(this),this.radFn=function(){this.makeRadius()}.bind(this),window.addEvent("google.map.loaded",this.loadFn),window.addEvent("google.radius.loaded",this.radFn),this.loadScript())},destroy:function(){window.removeEvent("google.map.loaded",this.loadFn),window.removeEvent("google.radius.loaded",this.radFn)},getValue:function(){return"null"!==typeOf(this.field)?this.field.get("value"):!1},makeMap:function(){if(this.mapMade!==!0){this.mapMade=!0;var a=this;if(("undefined"==typeof this.map||null===this.map)&&"null"!==typeOf(this.element)&&((this.options.geocode||this.options.reverse_geocode)&&(this.geocoder=new google.maps.Geocoder),this.element=document.id(this.options.element),"null"!==typeOf(this.element))){if(this.field=this.element.getElement("input.fabrikinput"),this.watchGeoCode(),d.addEvent("fabrik.form.elements.added",function(b){b===a.form&&a.watchGeoCode()}),this.options.staticmap){var b=this.element.getElement("img");b.getStyle("width").toInt(),b.getStyle("height").toInt()}if(!this.options.staticmap){var c="GSmallMapControl"===this.options.control?google.maps.ZoomControlStyle.SMALL:google.maps.ZoomControlStyle.LARGE,e={center:new google.maps.LatLng(this.options.lat,this.options.lon),zoom:this.options.zoomlevel.toInt(),mapTypeId:this.options.maptype,scaleControl:this.options.scalecontrol,mapTypeControl:this.options.maptypecontrol,overviewMapControl:this.options.overviewcontrol,scrollwheel:this.options.scrollwheel,streetViewControl:this.options.streetView,zoomControl:!0,zoomControlOptions:{style:c},mapTypeControlOptions:{mapTypeIds:this.mapTypeIds}};if(this.map=new google.maps.Map(document.id(this.element).getElement(".map"),e),this.map.setOptions({styles:this.options.styles}),"OSM"===this.options.maptype&&this.map.mapTypes.set("OSM",new google.maps.ImageMapType({getTileUrl:function(a,b){return"http://tile.openstreetmap.org/"+b+"/"+a.x+"/"+a.y+".png"},tileSize:new google.maps.Size(256,256),name:"OpenStreetMap",maxZoom:18})),this.options.traffic){var f=new google.maps.TrafficLayer;f.setMap(this.map)}var g=new google.maps.LatLng(this.options.lat,this.options.lon),h={map:this.map,position:g};h.draggable=this.options.drag,this.options.latlng===!0&&(this.element.getElement(".lat").addEvent("blur",function(a){this.updateFromLatLng(a)}.bind(this)),this.element.getElement(".lng").addEvent("blur",function(a){this.updateFromLatLng(a)}.bind(this))),this.options.latlng_dms===!0&&(this.element.getElement(".latdms").addEvent("blur",function(a){this.updateFromDMS(a)}.bind(this)),this.element.getElement(".lngdms").addEvent("blur",function(a){this.updateFromDMS(a)}.bind(this))),this.marker=new google.maps.Marker(h),this.options.latlng===!0&&(this.element.getElement(".lat").value=this.marker.getPosition().lat()+"° N",this.element.getElement(".lng").value=this.marker.getPosition().lng()+"° E"),this.options.latlng_dms===!0&&(this.element.getElement(".latdms").value=this.latDecToDMS(),this.element.getElement(".lngdms").value=this.lngDecToDMS()),this.options.directionsFrom&&(this.directionsService=new google.maps.DirectionsService,this.directionsDisplay=new google.maps.DirectionsRenderer,this.directionsDisplay.setMap(this.map),this.directionsFromPoint=new google.maps.LatLng(this.options.directionsFromLat,this.options.directionsFromLon),this.calcRoute()),google.maps.event.addListener(this.marker,"dragend",function(){this.field.value=this.marker.getPosition()+":"+this.map.getZoom(),this.options.latlng===!0&&(this.element.getElement(".lat").value=this.marker.getPosition().lat()+"° N",this.element.getElement(".lng").value=this.marker.getPosition().lng()+"° E"),this.options.latlng_dms===!0&&(this.element.getElement(".latdms").value=this.latDecToDMS(),this.element.getElement(".lngdms").value=this.lngDecToDMS()),this.options.latlng_osref===!0&&(this.element.getElement(".osref").value=this.latLonToOSRef()),this.options.reverse_geocode&&this.reverseGeocode(),this.options.directionsFrom&&this.calcRoute()}.bind(this)),google.maps.event.addListener(this.map,"zoom_changed",function(){this.field.value=this.marker.getPosition()+":"+this.map.getZoom()}.bind(this)),this.options.auto_center&&this.options.editable&&google.maps.event.addListener(this.map,"dragend",function(){this.marker.setPosition(this.map.getCenter()),this.field.value=this.marker.getPosition()+":"+this.map.getZoom(),this.options.latlng===!0&&(this.element.getElement(".lat").value=this.marker.getPosition().lat()+"° N",this.element.getElement(".lng").value=this.marker.getPosition().lng()+"° E"),this.options.latlng_dms===!0&&(this.element.getElement(".latdms").value=this.latDecToDMS(),this.element.getElement(".lngdms").value=this.lngDecToDMS())}.bind(this))}this.watchTab(),d.addEvent("fabrik.form.page.change.end",function(){this.redraw()}.bind(this))}}},calcRoute:function(){var a={origin:this.directionsFromPoint,destination:this.marker.getPosition(),travelMode:google.maps.TravelMode.DRIVING};this.directionsService.route(a,function(a,b){b==google.maps.DirectionsStatus.OK&&this.directionsDisplay.setDirections(a)}.bind(this))},radiusUpdatePosition:function(){},radiusUpdateDistance:function(){if(this.options.radius_write_element){var a=this.distanceWidget.get("distance");"m"===this.options.radius_unit&&(a/=1.609344),$(this.options.radius_write_element).value=parseFloat(a).toFixed(2)}},radiusActiveChanged:function(){this.options.radius_write_element&&(this.distanceWidget.get("active")||document.id(this.options.radius_write_element).fireEvent("change",new Event.Mock(document.id(this.options.radius_write_element),"change")))},radiusSetDistance:function(){if(this.options.radius_read_element){var a=document.id(this.options.radius_read_element).value;"m"===this.options.radius_unit&&(a=1.609344*a);{this.distanceWidget.get("sizer_position")}this.distanceWidget.set("distance",a);var b=this.distanceWidget.get("center");this.distanceWidget.set("center",b)}},makeRadius:function(){if(this.options.use_radius){this.options.radius_read_element&&this.options.repeatCounter>0&&(this.options.radius_read_element=this.options.radius_read_element.replace(/_\d+$/,"_"+this.options.repeatCounter)),this.options.radius_write_element&&this.options.repeatCounter>0&&(this.options.radius_write_element=this.options.radius_write_element.replace(/_\d+$/,"_"+this.options.repeatCounter));var a=this.options.radius_default;this.options.editable?this.options.radius_read_element?a=document.id(this.options.radius_read_element).value:this.options.radius_write_element&&(a=document.id(this.options.radius_write_element).value):a=this.options.radius_ro_value,"m"===this.options.radius_unit&&(a=1.609344*a),this.distanceWidget=new DistanceWidget({map:this.map,marker:this.marker,distance:a,maxDistance:2500,color:"#000000",activeColor:"#5599bb",sizerIcon:new google.maps.MarkerImage(this.options.radius_resize_off_icon),activeSizerIcon:new google.maps.MarkerImage(this.options.radius_resize_icon)}),google.maps.event.addListener(this.distanceWidget,"distance_changed",this.radiusUpdateDistance.bind(this)),google.maps.event.addListener(this.distanceWidget,"position_changed",this.radiusUpdatePosition.bind(this)),google.maps.event.addListener(this.distanceWidget,"active_changed",this.radiusActiveChanged.bind(this)),this.options.radius_fitmap&&(this.map.setZoom(20),this.map.fitBounds(this.distanceWidget.get("bounds"))),this.radiusUpdateDistance(),this.radiusUpdatePosition(),this.radiusAddActions()}},radiusAddActions:function(){this.options.radius_read_element&&document.id(this.options.radius_read_element).addEvent("change",this.radiusSetDistance.bind(this))},updateFromLatLng:function(){var a=this.element.getElement(".lat").get("value").replace("° N","");a=a.replace(",",".").toFloat();var b=this.element.getElement(".lng").get("value").replace("° E","");b=b.replace(",",".").toFloat();var c=new google.maps.LatLng(a,b);this.marker.setPosition(c),this.doSetCenter(c,this.map.getZoom(),!0)},updateFromDMS:function(){var a=this.element.getElement(".latdms"),b=a.get("value").replace("S","-");b=b.replace("N",""),a=this.element.getElement(".lngdms");var c=a.get("value").replace("W","-");c=c.replace("E","");var d=b.split("°"),e=d[0],f=d[1].split("'"),g=60*f[0].toFloat(),h=(g+f[1].replace('"',"").toFloat())/3600;e=Math.abs(e.toFloat())+h.toFloat(),-1!==d[0].toString().indexOf("-")&&(e=-e);var i=c.toString().split("°"),j=i[0],k=i[1].split("'"),l=60*Math.abs(k[0].toFloat()),m=(l+Math.abs(k[1].replace('"',"").toFloat()))/3600;j=Math.abs(j.toFloat())+m.toFloat(),-1!==i[0].toString().indexOf("-")&&(j=-j);var n=new google.maps.LatLng(e.toFloat(),j.toFloat());this.marker.setPosition(n),this.doSetCenter(n,this.map.getZoom(),!0)},latDecToDMS:function(){var a=this.marker.getPosition().lat(),b=parseInt(Math.abs(a),10),c=60*(Math.abs(a).toFloat()-b.toFloat()),d=parseInt(c,10),e=60*(c.toFloat()-d.toFloat()),f=e.toFloat();60===f&&(d=d.toFloat()+1,f=0),60===d&&(b=b.toFloat()+1,d=0);var g="N";return g=-1!==a.toString().indexOf("-")?"S":"N",g+b+"°"+d+"'"+f+'"'},lngDecToDMS:function(){var a=this.marker.getPosition().lng(),b=parseInt(Math.abs(a),10),c=60*(Math.abs(a).toFloat()-b.toFloat()),d=parseInt(c,10),e=60*(c.toFloat()-d.toFloat()),f=e.toFloat();60===f&&(d.value=d.toFloat()+1,f.value=0),60===d&&(b.value=b.toFloat()+1,d.value=0);var g="";return g=-1!==a.toString().indexOf("-")?"W":"E",g+b+"°"+d+"'"+f+'"'},latLonToOSRef:function(){var a=new LatLng(this.marker.getPosition().lng(),this.marker.getPosition().lng()),b=a.toOSRef();return b.toSixFigureString()},geoCode:function(){var a="";"2"===this.options.geocode?(this.options.geocode_fields.each(function(b){var c=this.form.formElements.get(b);c&&(a+=c.get("value")+",")}.bind(this)),a=a.slice(0,-1)):a=this.element.getElement(".geocode_input").value;var b=new Element("div").set("html",a);a=b.get("text"),this.geocoder.geocode({address:a},function(b,c){c!==google.maps.GeocoderStatus.OK||0===b.length?fconsole(a+" not found!"):(this.marker.setPosition(b[0].geometry.location),this.doSetCenter(b[0].geometry.location,this.map.getZoom(),!1))}.bind(this))},watchGeoCode:function(){if(this.options.geocode&&this.options.editable&&"undefined"!=typeof this.form&&!this.watchGeoCodeDone){if("2"===this.options.geocode&&("button"!==this.options.geocode_event?this.options.geocode_fields.each(function(b){var e=document.id(b);if("null"!==typeOf(e)){var f=this,g=this.form.formElements.get(b);g.options.geocomplete?d.addEvent("fabrik.element.field.geocode",function(){this.geoCode()}.bind(this)):(a(e).on("keyup",c(this.options.debounceDelay,function(a){f.geoCode(a)})),e.addEvent("change",function(){this.geoCode()}.bind(this)))}}.bind(this)):"button"===this.options.geocode_event&&this.element.getElement(".geocode").addEvent("click",function(a){this.geoCode(a)}.bind(this))),"1"===this.options.geocode&&document.id(this.element).getElement(".geocode_input"))if("button"===this.options.geocode_event)this.element.getElement(".geocode").addEvent("click",function(a){this.geoCode(a)}.bind(this)),this.element.getElement(".geocode_input").addEvent("keypress",function(a){"enter"===a.key&&a.stop()}.bind(this));else{var b=this;a(this.element.getElement(".geocode_input")).on("keyup",c(this.options.debounceDelay,function(a){b.geoCode(a)}))}this.watchGeoCodeDone=!0}},unclonableProperties:function(){return["form","marker","map","maptype"]},cloned:function(a){var b=[];this.options.geocode_fields.each(function(c){var d=c.split("_"),e=d.getLast();return"null"===typeOf(e.toInt())?d.join("_"):(d.splice(d.length-1,1,a),void b.push(d.join("_")))}),this.options.geocode_fields=b,this.mapMade=!1,this.map=null,this.makeMap(),this.parent(a)},update:function(a){if(a=a.split(":"),a.length<2&&(a[1]=this.options.zoomlevel),this.map){var b=a[1].toInt();this.map.setZoom(b),a[0]=a[0].replace("(",""),a[0]=a[0].replace(")","");var c=a[0].split(",");c.length<2&&(c[0]=this.options.lat,c[1]=this.options.lon);var d=new google.maps.LatLng(c[0],c[1]);this.marker.setPosition(d),this.doSetCenter(d,this.map.getZoom(),!0)}},geoCenter:function(a){var b=new google.maps.LatLng(a.coords.latitude,a.coords.longitude);this.marker.setPosition(b),this.doSetCenter(b,this.map.getZoom(),!0)},geoCenterErr:function(a){fconsole("geo location error="+a.message)},redraw:function(){google.maps.event.trigger(this.map,"resize");var a=new google.maps.LatLng(this.options.lat,this.options.lon);this.map.setCenter(a),this.map.setZoom(this.map.getZoom())},reverseGeocode:function(){this.geocoder.geocode({latLng:this.marker.getPosition()},function(a,b){b===google.maps.GeocoderStatus.OK?a[0]?(this.options.reverse_geocode_fields.formatted_address&&this.form.formElements.get(this.options.reverse_geocode_fields.formatted_address).update(a[0].formatted_address),a[0].address_components.each(function(a){a.types.each(function(b){"street_number"===b?this.options.reverse_geocode_fields.route&&this.form.formElements.get(this.options.reverse_geocode_fields.route).update(a.long_name+" "):"route"===b?this.options.reverse_geocode_fields.route&&this.form.formElements.get(this.options.reverse_geocode_fields.route).update(a.long_name):"street_address"===b?this.options.reverse_geocode_fields.route&&this.form.formElements.get(this.options.reverse_geocode_fields.route).update(a.long_name):"neighborhood"===b?this.options.reverse_geocode_fields.neighborhood&&this.form.formElements.get(this.options.reverse_geocode_fields.neighborhood).update(a.long_name):"locality"===b?this.options.reverse_geocode_fields.locality&&this.form.formElements.get(this.options.reverse_geocode_fields.locality).updateByLabel(a.long_name):"administrative_area_level_1"===b?this.options.reverse_geocode_fields.administrative_area_level_1&&this.form.formElements.get(this.options.reverse_geocode_fields.administrative_area_level_1).updateByLabel(a.long_name):"postal_code"===b?this.options.reverse_geocode_fields.postal_code&&this.form.formElements.get(this.options.reverse_geocode_fields.postal_code).updateByLabel(a.long_name):"country"===b&&this.options.reverse_geocode_fields.country&&this.form.formElements.get(this.options.reverse_geocode_fields.country).updateByLabel(a.long_name)}.bind(this))}.bind(this))):window.alert("No results found"):window.alert("Geocoder failed due to: "+b)}.bind(this))},doSetCenter:function(a,b,c){this.map.setCenter(a,b),this.field.value=this.marker.getPosition()+":"+this.map.getZoom(),this.options.latlng===!0&&(this.element.getElement(".lat").value=a.lat()+"° N",this.element.getElement(".lng").value=a.lng()+"° E"),this.options.latlng_dms===!0&&(this.element.getElement(".latdms").value=this.latDecToDMS(),this.element.getElement(".lngdms").value=this.lngDecToDMS()),c&&this.options.reverse_geocode&&this.reverseGeocode()},attachedToForm:function(){this.options.geocode&&this.options.geocode_on_load&&this.geoCode(),this.parent()}}),window.FbGoogleMap});