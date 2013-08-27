var SliderField=new Class({initialize:function(b,a){this.field=document.id(b);this.slider=a;this.field.addEvent("change",function(c){this.update(c)}.bind(this))},destroy:function(){this.field.removeEvent("change",function(a){this.update(a)}.bind(this))},update:function(){if(!this.options.editable){this.element.set("html",val);return}this.slider.set(this.field.value.toInt())}});var ColourPicker=new Class({Extends:FbElement,options:{red:0,green:0,blue:0,value:[0,0,0,1]},initialize:function(b,a){this.plugin="colourpicker";if(typeOf(a.value)==="null"||a.value[0]==="undefined"){a.value=[0,0,0,1]}this.parent(b,a);a.outputs=this.outputs;this.element=document.id(b);this.ini()},ini:function(){this.options.callback=function(c,d){c=this.update(c);if(d!==this.grad){this.grad.update(c)}}.bind(this);this.widget=this.element.getParent(".fabrikSubElementContainer").getElement(".colourpicker-widget");this.setOutputs();var b=new Drag.Move(this.widget,{handle:this.widget.getElement(".draggable")});this.createSliders(this.strElement);this.swatch=new ColourPickerSwatch(this.options.element,this.options,this);this.widget.getElement("#"+this.options.element+"-swatch").empty().adopt(this.swatch);this.widget.hide();this.grad=new ColourPickerGradient(this.options.element,this.options,this);this.widget.getElement("#"+this.options.element+"-picker").empty().adopt(this.grad.square);this.update(this.options.value);var a=this.widget.getElement(".modal-header a");if(a){a.addEvent("click",function(c){c.stop();this.widget.hide()}.bind(this))}},cloned:function(e){this.parent(e);var d=this.element.getParent(".fabrikSubElementContainer").getElement(".colourpicker-widget"),b=d.getElements(".tab-pane"),a=d.getElements("a[data-toggle=tab]");a.each(function(g){var c=g.get("href").split("-");var f=c[0].split("_");f[f.length-1]=e;f=f.join("_");f+="-"+c[1];g.href=f});b.each(function(g){var c=g.get("id").split("-");var f=c[0].split("_");f[f.length-1]=e;f=f.join("_");f+="-"+c[1];g.id=f});a.each(function(c){c.addEvent("click",function(f){f.stop();jQuery(c).tab("show")})});this.ini()},setOutputs:function(a){this.outputs={};this.outputs.backgrounds=this.getContainer().getElements(".colourpicker_bgoutput");this.outputs.foregrounds=this.getContainer().getElements(".colourpicker_output");this.outputs.backgrounds.each(function(b){b.removeEvents("click");b.addEvent("click",function(c){this.toggleWidget(c)}.bind(this))}.bind(this));this.outputs.foregrounds.each(function(b){b.removeEvents("click");b.addEvent("click",function(c){this.toggleWidget(c)}.bind(this))}.bind(this))},createSliders:function(a){this.sliderRefs=[];this.table=new Element("table");this.tbody=new Element("tbody");this.createColourSlideHTML(a,"red","Red:",this.options.red);this.createColourSlideHTML(a,"green","Green:",this.options.green);this.createColourSlideHTML(a,"blue","Blue:",this.options.blue);this.table.appendChild(this.tbody);this.widget.getElement(".sliders").empty().appendChild(this.table);Fabrik.addEvent("fabrik.colourpicker.slider",function(c,b,d){if(this.sliderRefs.contains(c.element.id)){this.options.colour[b]=d;this.update(this.options.colour.red+","+this.options.colour.green+","+this.options.colour.blue)}}.bind(this));this.redField.addEvent("change",function(b){this.updateFromField(b,"red")}.bind(this));this.greenField.addEvent("change",function(b){this.updateFromField(b,"green")}.bind(this));this.blueField.addEvent("change",function(b){this.updateFromField(b,"blue")}.bind(this))},createColourSlideHTML:function(c,f,b,e){var g=new Element("input.input-mini input "+f+"SliderField",{type:"text",id:c+f+"redField",size:"3",value:e});var d=[new Element("td").set("text",b),new Element("td").adopt(g)];var a=new Element("tr").adopt(d);this.tbody.appendChild(a);this[f+"Field"]=g},updateAll:function(c,b,a){c=c?c.toInt():0;b=b?b.toInt():0;a=a?a.toInt():0;this.redField.value=c;this.options.colour.red=c;this.greenField.value=b;this.options.colour.green=b;this.blueField.value=a;this.options.colour.blue=a;this.updateOutputs()},updateOutputs:function(){var a=new Color([this.options.colour.red,this.options.colour.green,this.options.colour.blue,1]);this.outputs.backgrounds.each(function(b){b.setStyle("background-color",a)});this.outputs.foregrounds.each(function(b){b.setStyle("background-color",a)});this.element.value=a.red+","+a.green+","+a.blue},update:function(a){if(this.options.editable===false){this.element.set("html",a);return}if(typeOf(a)==="null"){a=[0,0,0]}else{if(typeOf(a)==="string"){a=a.split(",")}}this.updateAll(a[0],a[1],a[2]);return a},updateFromField:function(a,b){var c=Math.min(255,a.target.value.toInt());a.target.value=c;if(isNaN(c)){c=0}else{this.options.colour[b]=c;this.options.callback(this.options.colour.red+","+this.options.colour.green+","+this.options.colour.blue)}},toggleWidget:function(a){a.stop();this.widget.toggle()}});var ColourPickerSwatch=new Class({Extends:Options,options:{},initialize:function(b,a){this.element=document.id(b);this.setOptions(a);this.callback=this.options.callback;this.outputs=this.options.outputs;this.redField=null;this.widget=new Element("div");this.colourNameOutput=new Element("span").inject(this.widget);this.createColourSwatch(b);return this.widget},createColourSwatch:function(e){var b;var f=new Element("div",{styles:{"float":"left","margin-left":"5px","class":"swatchBackground"}});for(var d=0;d<this.options.swatch.length;d++){var c=new Element("div",{styles:{width:"160px"}});var a=this.options.swatch[d];b=0;$H(a).each(function(i,h){var g=e+"swatch-"+d+"-"+b;c.adopt(new Element("div",{id:g,styles:{"float":"left",width:"10px",cursor:"crosshair",height:"10px","background-color":"rgb("+h+")"},"class":i,events:{click:function(j){this.updateFromSwatch(j)}.bind(this),mouseenter:function(j){this.showColourName(j)}.bind(this),mouseleave:function(j){this.clearColourName(j)}.bind(this)}}));b++}.bind(this));f.adopt(c)}this.widget.adopt(f)},updateFromSwatch:function(a){a.stop();var b=new Color(a.target.getStyle("background-color"));this.options.colour.red=b[0];this.options.colour.green=b[1];this.options.colour.blue=b[2];this.showColourName(a);this.callback(b,this)},showColourName:function(a){this.colourName=a.target.className;this.colourNameOutput.set("text",this.colourName)},clearColourName:function(a){this.colourNameOutput.set("text","")}});var ColourPickerGradient=new Class({Extends:Options,options:{size:125},initialize:function(b,a){this.brightness=0;this.saturation=0;this.setOptions(a);this.callback=this.options.callback;this.container=document.id(b);if(typeOf(this.container)==="null"){return}this.offset=0;this.margin=10;this.borderColour="rgba(155, 155, 155, 0.6)";this.hueWidth=40;this.colour=new Color(this.options.value);this.square=new Element("canvas",{width:(this.options.size+65)+"px",height:this.options.size+"px"});this.square.inject(this.container);this.square.addEvent("click",function(c){this.doIt(c)}.bind(this));this.down=false;this.square.addEvent("mousedown",function(c){this.down=true}.bind(this));this.square.addEvent("mouseup",function(c){this.down=false}.bind(this));document.addEvent("mousemove",function(c){if(this.down){this.doIt(c)}}.bind(this));this.drawCircle();this.drawHue();this.arrow=this.drawArrow();this.positionCircle(this.options.size,0);this.update(this.options.value)},doIt:function(c){var f={x:0,y:0,w:this.options.size,h:this.options.size};var b=this.square.getPosition();var a=c.page.x-b.x;var d=c.page.y-b.y;if(a<f.w&&d<f.h){this.setColourFromSquareSelection(a,d)}else{if(a>this.options.size+this.margin&&a<=this.options.size+this.hueWidth){this.setHueFromSelection(a,d)}}},update:function(a){colour=new Color(a);this.brightness=colour.hsb[2];this.saturation=colour.hsb[1];this.colour=this.colour.setHue(colour.hsb[0]);this.colour=this.colour.setSaturation(100);this.colour=this.colour.setBrightness(100);this.render();this.positionCircleFromColour(colour)},positionCircleFromColour:function(d){this.saturarion=d.hsb[1];this.brightness=d.hsb[2];var a=Math.floor(this.options.size*(this.saturarion/100));var b=Math.floor(this.options.size-(this.options.size*(this.brightness/100)));this.positionCircle(a,b)},drawCircle:function(){this.circle=new Element("canvas",{width:"10px",height:"10px"});var b=this.circle.getContext("2d");b.lineWidth=1;b.beginPath();var a=this.circle.width/2;var c=this.circle.width/2;b.arc(a,c,4.5,0,Math.PI*2,true);b.strokeStyle="#000";b.stroke();b.beginPath();b.arc(a,c,3.5,0,Math.PI*2,true);b.strokeStyle="#FFF";b.stroke()},setHueFromSelection:function(a,e){e=Math.min(1,e/this.options.size);e=Math.max(0,e);var b=360-(e*360);this.colour=this.colour.setHue(b);this.render();this.positionCircle();var d=this.colour;d=d.setBrightness(this.brightness);d=d.setSaturation(this.saturation);this.callback(d,this)},setColourFromSquareSelection:function(a,f){var e=this.square.getContext("2d");this.positionCircle(a,f);var d=e.getImageData(a,f,1,1).data;var b=new Color([d[0],d[1],d[2]]);this.brightness=b.hsb[2];this.saturation=b.hsb[1];this.callback(b,this)},positionCircle:function(a,d){a=a?a:this.circleX;this.circleX=a;d=d?d:this.circleY;this.circleY=d;this.render();var b=this.square.getContext("2d");var c=this.offset-5;a=Math.max(-5,Math.round(a)+c);d=Math.max(-5,Math.round(d)+c);b.drawImage(this.circle,a,d)},drawHue:function(){var a=this.square.getContext("2d");var c=this.options.size+this.margin+this.offset;var b=a.createLinearGradient(0,0,0,this.options.size+this.offset);b.addColorStop(0,"rgba(255, 0, 0, 1)");b.addColorStop(5/6,"rgba(255, 255, 0, 1)");b.addColorStop(4/6,"rgba(0, 255, 0, 1)");b.addColorStop(3/6,"rgba(0, 255, 255, 1)");b.addColorStop(2/6,"rgba(0, 0, 255, 1)");b.addColorStop(1/6,"rgba(255, 0, 255, 1)");b.addColorStop(1,"rgba(255, 0, 0, 1)");a.fillStyle=b;a.fillRect(c,this.offset,this.hueWidth-10,this.options.size);a.strokeStyle=this.borderColour;a.strokeRect(c+0.5,this.offset+0.5,this.hueWidth-11,this.options.size-1)},render:function(){var a=this.square.getContext("2d");var f=this.offset;a.clearRect(0,0,this.square.width,this.square.height);var b=this.options.size;a.fillStyle=this.colour.hex;a.fillRect(f,f,b,b);var e=a.createLinearGradient(f,f,b+f,0);e.addColorStop(0,"rgba(255, 255, 255, 1)");e.addColorStop(1,"rgba(255, 255, 255, 0)");a.fillStyle=e;a.fillRect(f,f,b,b);e=a.createLinearGradient(0,f,0,b+f);e.addColorStop(0,"rgba(0, 0, 0, 0)");e.addColorStop(1,"rgba(0, 0, 0, 1)");a.fillStyle=e;a.fillRect(f,f,b,b);a.strokeStyle=this.borderColour;a.strokeRect(f+0.5,f+0.5,b-1,b-1);this.drawHue();var g=((360-this.colour.hsb[0])/362)*this.options.size-2;var d=b+this.hueWidth+f+2;var c=Math.max(0,Math.round(g)+f-1);a.drawImage(this.arrow,d,c)},drawArrow:function(){var d=new Element("canvas");var a=d.getContext("2d");var b=16;var c=b/3;d.width=b;d.height=b;var f=-b/4;var e=0;for(var g=0;g<20;g++){a.beginPath();a.fillStyle="#000";a.moveTo(e,b/2+f);a.lineTo(e+b/4,b/4+f);a.lineTo(e+b/4,b/4*3+f);a.fill()}a.translate(-c,-b);return d}});