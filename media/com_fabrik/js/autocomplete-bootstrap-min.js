var FbAutocomplete=new Class({Implements:[Options,Events],options:{menuclass:"auto-complete-container dropdown",classes:{ul:"dropdown-menu",li:"result"},url:"index.php",max:10,onSelection:Class.empty,autoLoadSingleResult:true,storeMatchedResultsOnly:false},initialize:function(b,a){window.addEvent("domready",function(){this.matchedResult=false;this.setOptions(a);b=b.replace("-auto-complete","");this.options.labelelement=typeOf(document.id(b+"-auto-complete"))==="null"?document.getElement(b+"-auto-complete"):document.id(b+"-auto-complete");this.cache={};this.selected=-1;this.mouseinsde=false;document.addEvent("keydown",function(c){this.doWatchKeys(c)}.bind(this));this.element=typeOf(document.id(b))==="null"?document.getElement(b):document.id(b);this.buildMenu();if(!this.getInputElement()){fconsole("autocomplete didnt find input element");return}this.getInputElement().setProperty("autocomplete","off");this.getInputElement().addEvent("keyup",function(c){this.search(c)}.bind(this));this.getInputElement().addEvent("blur",function(c){if(this.options.storeMatchedResultsOnly){if(!this.matchedResult){if(typeof(this.data)==="undefined"||!(this.data.length===1&&this.options.autoLoadSingleResult)){this.element.value=""}}}}.bind(this))}.bind(this))},search:function(b){if(b.key==="tab"||b.key==="enter"){b.stop();this.closeMenu();return}this.matchedResult=false;var a=this.getInputElement().get("value");if(a===""){this.element.value=""}if(a!==this.searchText&&a!==""){this.element.value=a;this.positionMenu();if(this.cache[a]){this.populateMenu(this.cache[a]);this.openMenu()}else{Fabrik.loader.start(this.getInputElement());if(this.ajax){this.closeMenu();this.ajax.cancel()}this.ajax=new Request({url:this.options.url,data:{value:a},onComplete:function(c){Fabrik.loader.stop(this.getInputElement());this.completeAjax(c,a)}.bind(this)}).send()}}this.searchText=a},completeAjax:function(b,a){b=JSON.decode(b);this.cache[a]=b;Fabrik.loader.stop(this.getInputElement());this.populateMenu(b);this.openMenu()},buildMenu:function(){this.menu=new Element("ul.dropdown-menu",{role:"menu",styles:{"z-index":1056}});this.menu.inject(document.body);this.menu.addEvent("mouseenter",function(){this.mouseinsde=true}.bind(this));this.menu.addEvent("mouseleave",function(){this.mouseinsde=false}.bind(this));this.menu.addEvent("click:relay(a)",function(b,a){this.makeSelection(b,a)}.bind(this))},getInputElement:function(){return this.options.labelelement?this.options.labelelement:this.element},positionMenu:function(){var a=this.getInputElement().getCoordinates();var b=this.getInputElement().getPosition();this.menu.setStyles({left:a.left,top:(a.top+a.height)-1,width:a.width})},populateMenu:function(g){var c,d;g.map(function(i,a){i.text=Encoder.htmlDecode(i.text);return i});this.data=g;var b=this.getListMax();var f=this.menu;f.empty();if(g.length===1&&this.options.autoLoadSingleResult){this.element.value=g[0].value;this.fireEvent("selection",[this,this.element.value])}if(g.length===0){c=new Element("li").adopt(new Element("div.alert.alert-info").adopt(new Element("i").set("text",Joomla.JText._("COM_FABRIK_NO_RECORDS"))));c.inject(f)}for(var e=0;e<b;e++){var h=g[e];d=new Element("a",{href:"#","data-value":h.value,tabindex:"-1"}).set("text",h.text);c=new Element("li").adopt(d);c.inject(f)}if(g.length>this.options.max){new Element("li").set("text","....").inject(f)}},makeSelection:function(b,a){b.preventDefault();if(typeOf(a)!=="null"){this.getInputElement().value=a.get("text");this.element.value=a.getProperty("data-value");this.closeMenu();this.fireEvent("selection",[this,this.element.value]);this.element.fireEvent("change",new Event.Mock(this.element,"change"),700);Fabrik.fireEvent("fabrik.autocomplete.selected",[this,this.element.value])}else{Fabrik.fireEvent("fabrik.autocomplete.notselected",[this,this.element.value])}},closeMenu:function(){if(this.shown){this.shown=false;this.menu.hide();this.selected=-1;document.removeEvent("click",function(a){this.doTestMenuClose(a)}.bind(this))}},openMenu:function(){if(!this.shown){this.menu.show();this.shown=true;document.addEvent("click",function(a){this.doTestMenuClose(a)}.bind(this));this.selected=0;this.highlight()}},doTestMenuClose:function(){if(!this.mouseinsde){this.closeMenu()}},getListMax:function(){if(typeOf(this.data)==="null"){return 0}return this.data.length>this.options.max?this.options.max:this.data.length},doWatchKeys:function(c){var a=this.getListMax();if(!this.shown){if(c.code.toInt()===40&&document.activeElement===this.getInputElement()){this.openMenu()}}else{if(c.key==="enter"||c.key==="tab"){window.fireEvent("blur")}switch(c.code){case 40:if(!this.shown){this.openMenu()}if(this.selected+1<=a){this.selected++}this.highlight();c.stop();break;case 38:if(this.selected-1>=-1){this.selected--;this.highlight()}c.stop();break;case 13:case 9:c.stop();var b=new Event.Mock(this.getSelected(),"click");this.makeSelection(b,this.getSelected());this.closeMenu();break;case 27:c.stop();this.closeMenu();break}}},getSelected:function(){var a=this.menu.getElements("li").filter(function(b,c){return c===this.selected}.bind(this));return a[0].getElement("a")},highlight:function(){this.matchedResult=true;this.menu.getElements("li").each(function(a,b){if(b===this.selected){a.addClass("selected").addClass("active")}else{a.removeClass("selected").removeClass("active")}}.bind(this))}});var FabCddAutocomplete=new Class({Extends:FbAutocomplete,search:function(d){var c;var b=this.getInputElement().get("value");if(b===""){this.element.value=""}if(b!==this.searchText&&b!==""){var a=document.id(this.options.observerid);if(typeOf(a)!=="null"){if(this.options.formRef){a=Fabrik.blocks[this.options.formRef].formElements[this.options.observerid]}c=a.get("value")+"."+b}else{this.parent(d);return}this.positionMenu();if(this.cache[c]){this.populateMenu(this.cache[c]);this.openMenu()}else{Fabrik.loader.start(this.getInputElement());if(this.ajax){this.closeMenu();this.ajax.cancel()}this.ajax=new Request({url:this.options.url,data:{value:b,fabrik_cascade_ajax_update:1,v:a.get("value")},onSuccess:function(f){this.completeAjax(f)}.bind(this),onError:function(f,e){console.log(f,e)},onFailure:function(e){console.log(e)}}).send()}}this.searchText=b}});