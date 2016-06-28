/*! Fabrik */
define(["jquery","fab/list-plugin","fab/fabrik"],function(a,b,c){var d=function(a){var b=a.retrieve("uberC"),d=a.retrieve("mapid"),f=a.retrieve("fld").value,g=new google.maps.Geocoder;c.radiusSearchResults||(c.radiusSearchResults={}),c.radiusSearchResults[f]&&e(b,d,c.radiusSearchResults[f]),g.geocode({address:f},function(a,g){g===google.maps.GeocoderStatus.OK?(e(b,d,a[0].geometry.location),c.radiusSearchResults[f]=a[0].geometry.location):window.alert(Joomla.JText._("PLG_LIST_RADIUS_SEARCH_GEOCODE_ERROR").replace("%s",g))})},e=function(a,b,d){a.getElement("input[name^=radius_search_geocode_lat]").value=d.lat(),a.getElement("input[name^=radius_search_geocode_lon]").value=d.lng(),c.radiusSearch[b].map.setCenter(d),c.radiusSearch[b].marker.setPosition(d)};window.geoCode=function(){c.googleMap=!0,window.addEvent("domready",function(){var a=(new google.maps.LatLng(c.radiusSearch.geocode_default_lat,c.radiusSearch.geocode_default_long),{zoom:4,mapTypeId:google.maps.MapTypeId.ROADMAP});c.radiusSearch="null"===typeOf(c.radiusSearch)?{}:c.radiusSearch;var b=document.getElements(".radius_search_geocode_map");b.each(function(b){var e=b.getParent(".radius_search_geocode"),f=e.getElement("button"),g=f?f:e.getElement(".radius_search_geocode_field");if(1!==g.retrieve("events-added",0).toInt()){c.radiusSearch[b.id]="null"===typeOf(c.radiusSearch[b.id])?{}:c.radiusSearch[b.id],c.radiusSearch[b.id].map=new google.maps.Map(b,a);var h=e.getParent(".radius_search");g.store("events-added",1),g.store("uberC",h),g.store("mapid",b.id);var i=e.getElement(".radius_search_geocode_field");if(g.store("fld",i),"null"!==typeOf(f))f.addEvent("click",function(a){a.stop(),d(g)}),i.addEvent("keyup",function(a){"enter"===a.key&&d(g)});else{var j;i.addEvent("keyup",function(a){j&&clearTimeout(j),"enter"===a.key&&d(g),j=window.setTimeout(function(){d(g)},1e3)})}var k=h.getElement("input[name=geo_code_def_zoom]").get("value").toInt(),l=h.getElement("input[name=geo_code_def_lat]").get("value").toFloat(),m=h.getElement("input[name=geo_code_def_lon]").get("value").toFloat();c.fireEvent("google.radiusmap.loaded",[b.id,k,l,m])}})})};var f=new Class({Extends:b,options:{geocode_default_lat:"0",geocode_default_long:"0",geocode_default_zoom:4,prefilter:!0,prefilterDistance:1e3,prefilterDone:!1,offset_y:0,key:!1},geocoder:null,map:null,initialize:function(a){this.parent(a),c.radiusSearch=c.radiusSearch?c.radiusSearch:{};var b="radius_search_geocode_map"+this.options.renderOrder;if("null"===typeOf(c.radiusSearch[b])){if(c.radiusSearch[b]={},c.radiusSearch[b].geocode_default_lat=this.options.geocode_default_lat,c.radiusSearch[b].geocode_default_long=this.options.geocode_default_long,c.radiusSearch[b].geocode_default_zoom=this.options.geocode_default_zoom,c.addEvent("google.radiusmap.loaded",function(a,b,d,e){var f=new google.maps.LatLng(d,e);c.radiusSearch[a].loaded||(c.radiusSearch[a].loaded=!0,c.radiusSearch[a].map.setCenter(f),c.radiusSearch[a].map.setZoom(b),c.radiusSearch[a].marker=new google.maps.Marker({map:c.radiusSearch[a].map,draggable:!0,position:f}),google.maps.event.addListener(c.radiusSearch[a].marker,"dragend",function(){var b=c.radiusSearch[a].marker.getPosition(),d=document.id(a).getParent(".radius_search"),e=d.getElement("input[name^=radius_search_geocode_lat]");"null"!==typeOf(e)&&(e.value=b.lat(),d.getElement("input[name^=radius_search_geocode_lon]").value=b.lng())}))}.bind(this)),c.loadGoogleMap(this.options.key,"geoCode"),"null"===typeOf(this.options.value)&&(this.options.value=0),"null"!==typeOf(this.listform)){if(this.listform=this.listform.getElement("#radius_search"+this.options.renderOrder),"null"===typeOf(this.listform))return void fconsole("didnt find element #radius_search"+this.options.renderOrder);var d=this.listform.getElements("select[name^=radius_search_type]");d.addEvent("change",function(a){this.toggleFields(a)}.bind(this)),this.listform.getElements("input.cancel").addEvent("click",function(){this.win.close()}.bind(this)),this.active=!1,this.listform.getElement(".fabrik_filter_submit").addEvent("mousedown",function(){this.active=!0,this.listform.getElement("input[name^=radius_search_active]").value=1}.bind(this))}if(this.options.value=this.options.value.toInt(),"null"===typeOf(this.listform))return;var e=this.listform.getElement(".radius_search_distance"),f=this.listform.getElement(".slider_output");this.mySlide=new Slider(this.listform.getElement(".fabrikslider-line"),this.listform.getElement(".knob"),{onChange:function(a){e.value=a,f.set("text",a+this.options.unit)}.bind(this),steps:this.options.steps}).set(0),this.mySlide.set(this.options.value),e.value=this.options.value,f.set("text",this.options.value),this.options.myloc&&!this.options.prefilterDone&&geo_position_js.init()&&geo_position_js.getCurrentPosition(function(a){this.setGeoCenter(a)}.bind(this),function(a){this.geoCenterErr(a)}.bind(this),{enableHighAccuracy:!0})}c.addEvent("listfilter.clear",function(a){a.contains(this.options.ref)&&this.clearFilter()}.bind(this)),this.makeWin(b)},makeWin:function(a){var b=document.id(a).getParent(".radius_search"),d=new Element("button.btn.button").set("html",'<i class="icon-location"></i> '+Joomla.JText._("PLG_LIST_RADIUS_SEARCH_BUTTON"));b.getParent().adopt(d);var e=this.options.offset_y>0?this.options.offset_y:null,f={id:"win_"+a,title:Joomla.JText._("PLG_LIST_RADIUS_SEARCH"),loadMethod:"html",content:b,width:500,height:540,offset_y:e,visible:!1,destroy:!1,onClose:function(){var a;a=!this.active&&window.confirm(Joomla.JText._("PLG_LIST_RADIUS_SEARCH_CLEAR_CONFIRM"))?0:1,this.win.window.getElement("input[name^=radius_search_active]").value=a}.bind(this)},g=c.getWindow(f);d.addEvent("click",function(a){a.stop(),b.setStyles({position:"relative",left:0});var c=d.retrieve("win");c.center(),c.open()}.bind(this)),d.store("win",g),this.button=d,this.win=g,c.addEvent("list.filter",function(){return this.injectIntoListForm()}.bind(this))},injectIntoListForm:function(){var a=this.button.retrieve("win"),b=a.contentEl.clone();return b.hide(),this.button.getParent().adopt(b),!0},setGeoCenter:function(a){this.geocenterpoint=a,this.geoCenter(a),this.prefilter()},prefilter:function(){this.options.prefilter&&(this.mySlide.set(this.options.prefilterDistance),this.listform.getElement("input[name^=radius_search_active]").value=1,this.listform.getElements("input[value=mylocation]").checked=!0,this.list?this.getList().submit("filter"):this.listform.getParent("form").submit())},geoCenter:function(a){"null"===typeOf(a)?window.alert(Joomla.JText._("PLG_VIEW_RADIUS_NO_GEOLOCATION_AVAILABLE")):(this.listform.getElement("input[name*=radius_search_lat]").value=a.coords.latitude.toFixed(2),this.listform.getElement("input[name*=radius_search_lon]").value=a.coords.longitude.toFixed(2))},geoCenterErr:function(a){fconsole("geo location error="+a.message)},toggleActive:function(){},toggleFields:function(a){var b=a.target.getParent(".radius_search");switch(a.target.get("value")){case"latlon":b.getElement(".radius_search_place_container").hide(),b.getElement(".radius_search_coords_container").show(),b.getElement(".radius_search_geocode").setStyles({position:"absolute",left:"-100000px"});break;case"mylocation":b.getElement(".radius_search_place_container").hide(),b.getElement(".radius_search_coords_container").hide(),b.getElement(".radius_search_geocode").setStyles({position:"absolute",left:"-100000px"}),this.setGeoCenter(this.geocenterpoint);break;case"place":b.getElement(".radius_search_place_container").show(),b.getElement(".radius_search_coords_container").hide(),b.getElement(".radius_search_geocode").setStyles({position:"absolute",left:"-100000px"});break;case"geocode":b.getElement(".radius_search_place_container").hide(),b.getElement(".radius_search_coords_container").hide(),b.getElement(".radius_search_geocode").setStyles({position:"relative",left:0})}this.win.fitToContent(!1)},clearFilter:function(){return this.listform.getElement("input[name^=radius_search_active]").value=0,!0}});return f});