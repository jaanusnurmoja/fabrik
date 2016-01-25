/*! Fabrik */
var FbDatabasejoin=new Class({Extends:FbElement,options:{id:0,formid:0,key:"",label:"",windowwidth:360,displayType:"dropdown",popupform:0,listid:0,listRef:"",joinId:0,isJoin:!1,canRepeat:!1,fullName:"",show_please_select:!1,allowadd:!1,autoCompleteOpts:null,observe:null},initialize:function(a,b){this.activePopUp=!1,this.activeSelect=!1,this.setPlugin("databasejoin"),this.parent(a,b),this.init()},watchAdd:function(){if(c=this.getContainer()){var a=c.getElement(".toggle-addoption");a.removeEvent("click",this.watchAddEvent),this.watchAddEvent=this.start.bind(this),a.addEvent("click",this.watchAddEvent)}},start:function(a,b){if(this.options.editable){var c,d,e=this.getContainer();b=b?!0:!1;var f=function(){this.close()};if(c=!1,a&&(a.stop(),f=function(a){a.fitToContent()},c=!0,this.activePopUp=!0),d=!0,(b!==!1||0!==this.options.popupform&&this.options.allowadd!==!1)&&"null"!==typeOf(this.element)&&"null"!==typeOf(e)){var g=e.getElement(".toggle-addoption"),h="null"===typeOf(g)?a.target.get("href"):g.get("href"),i=this.element.id+"-popupwin";this.windowopts={id:i,title:Joomla.JText._("PLG_ELEMENT_DBJOIN_ADD"),contentType:"xhr",loadMethod:"xhr",contentURL:h,height:320,minimizable:!1,collapsible:!0,visible:c,onContentLoaded:f,destroy:d};var j=this.options.windowwidth;""!==j&&(this.windowopts.width=j,this.windowopts.onContentLoaded=f),this.win=Fabrik.getWindow(this.windowopts)}}},getBlurEvent:function(){return"auto-complete"===this.options.displayType?"change":this.parent()},removeOption:function(a,b){var c=document.id(this.element.id);switch(this.options.displayType){case"dropdown":case"multilist":var b="array"===typeOf(this.options.value)?this.options.value:Array.from(this.options.value);for(options=c.options,i=0;i<options.length;i++)if(options[i].value===a){c.remove(i),b&&(c.selectedIndex=0),this.options.advanced&&jQuery("#"+this.element.id).trigger("liszt:updated");break}}},addOption:function(a,b,c){b=Encoder.htmlDecode(b),c="undefined"!=typeof c?c:!0;var d,e,f;switch(this.options.displayType){case"dropdown":case"multilist":var g="array"===typeOf(this.options.value)?this.options.value:Array.from(this.options.value);e=g.contains(a)?"selected":"",d=new Element("option",{value:a,selected:e}).set("text",b),document.id(this.element.id).adopt(d),this.options.advanced&&jQuery("#"+this.element.id).trigger("liszt:updated");break;case"auto-complete":c&&(f=this.element.getParent(".fabrikElement").getElement("input[name*=-auto-complete]"),this.element.value=a,f.value=b);break;case"checkbox":d=this.getCheckboxTmplNode().clone();var h=jQuery(Fabrik.jLayouts["fabrik-element-"+this.getPlugin()+"-form-rowopts"])[0];this._addOption(d,b,a,h);break;case"radio":default:var d=jQuery(Fabrik.jLayouts["fabrik-element-"+this.getPlugin()+"-form-radio_"+this.strElement])[0],h=jQuery(Fabrik.jLayouts["fabrik-element-"+this.getPlugin()+"-form-rowopts"])[0];this._addOption(d,b,a,h,null)}},_addOption:function(a,b,c,d){var e="array"===typeOf(this.options.value)?this.options.value:Array.from(this.options.value),f=a.getElement("input"),g=this.getSubOptions(),h=this.getSubOptsRow(),i=e.contains(c)?!0:!1,j="radio"===this.options.displayType?"":g.length;f.name=this.options.canRepeat?this.options.fullName+"["+this.options.repeatCounter+"]["+j+"]":this.options.fullName+"["+j+"]",a.getElement("span").set("html",b),a.getElement("input").set("value",c),0===h.length&&d.inject(this.element,"bottom");var k=jQuery(this.element).children("div[data-role=fabrik-rowopts]").last()[0],l=jQuery(k).children("div[data-role=suboption]");l.length>=this.options.optsPerRow&&(d.inject(this.element,"bottom"),k=jQuery(this.element).children("div[data-role=fabrik-rowopts]").last()[0]),a.inject(k,"bottom"),a.getElement("input").checked=i},hasSubElements:function(){var a=this.options.displayType;return"checkbox"===a||"radio"===a?!0:this.parent()},getCheckboxTmplNode:function(){if(Fabrik.bootstrapped&&(this.chxTmplNode=jQuery(Fabrik.jLayouts["fabrik-element-"+this.getPlugin()+"-form-checkbox_"+this.strElement])[0],!this.chxTmplNode&&"checkbox"===this.options.displayType)){var a=this.element.getElements("> .fabrik_subelement");0===a.length?(this.chxTmplNode=this.element.getElement(".chxTmplNode").getChildren()[0].clone(),this.element.getElement(".chxTmplNode").destroy()):this.chxTmplNode=a.getLast().clone()}return this.chxTmplNode},getCheckboxRowOptsNode:function(){if(Fabrik.bootstrapped)this.chxTmplNode=jQuery(Fabrik.jLayouts["fabrik-element-"+this.getPlugin()+"-form-rowopts"])[0];else if(!this.chxTmplNode&&"checkbox"===this.options.displayType){var a=this.element.getElements("> .fabrik_subelement");0===a.length?(this.chxTmplNode=this.element.getElement(".chxTmplNode").getChildren()[0].clone(),this.element.getElement(".chxTmplNode").destroy()):this.chxTmplNode=a.getLast().clone()}return this.chxTmplNode},updateFromServer:function(a){var b=this.form.getFormElementData(),c={option:"com_fabrik",format:"raw",task:"plugin.pluginAjax",plugin:"databasejoin",method:"ajax_getOptions",element_id:this.options.id,formid:this.options.formid};return c=Object.append(b,c),"auto-complete"===this.options.displayType&&""===a?(this.addOption("","",!0),this.element.fireEvent("change",new Event.Mock(this.element,"change")),void this.element.fireEvent("blur",new Event.Mock(this.element,"blur"))):(a&&(c[this.strElement+"_raw"]=a,c[this.options.fullName+"_raw"]=a),Fabrik.loader.start(this.element.getParent(),Joomla.JText._("COM_FABRIK_LOADING")),void new Request.JSON({url:"",method:"post",data:c,onSuccess:function(b){Fabrik.loader.stop(this.element.getParent());var c,d=!1,e=this.getOptionValues();("auto-complete"!==this.options.displayType||""!==a||0!==e.length)&&(jsonValues=[],b.each(function(a){jsonValues.push(a.value),e.contains(a.value)||"null"===typeOf(a.value)||(c=this.options.value===a.value,this.addOption(a.value,a.text,c),d=!0)}.bind(this)),e.each(function(a){jsonValues.contains(a)||(c=this.options.value===a,this.removeOption(a,c),d=!0)}.bind(this)),d&&(this.element.fireEvent("change",new Event.Mock(this.element,"change")),this.element.fireEvent("blur",new Event.Mock(this.element,"blur"))),this.activePopUp=!1)}.bind(this)}).post())},getSubOptions:function(){var a;switch(this.options.displayType){case"dropdown":case"multilist":a=this.element.getElements("option");break;case"checkbox":a=this.element.getElements("[data-role=suboption] input[type=checkbox]");break;case"radio":default:a=this.element.getElements("[data-role=suboption] input[type=radio]")}return a},getSubOptsRow:function(){var a;switch(this.options.displayType){case"dropdown":case"multilist":default:break;case"checkbox":case"radio":a=this.element.getElements("[data-role=fabrik-rowopts]")}return a},getOptionValues:function(){var a=this.getSubOptions(),b=[];return a.each(function(a){b.push(a.get("value"))}),b.unique()},appendInfo:function(a){var b=a.rowid,c="index.php?option=com_fabrik&view=form&format=raw",d={formid:this.options.popupform,rowid:b};new Request.JSON({url:c,data:d,onSuccess:function(a){var b=a.data[this.options.key],c=a.data[this.options.label];switch(this.options.displayType){case"dropdown":case"multilist":var d=this.element.getElements("option").filter(function(a,c){return a.get("value")===b?("dropdown"===this.options.displayType?this.element.selectedIndex=c:a.selected=!0,!0):void 0}.bind(this));0===d.length&&this.addOption(b,c);break;case"auto-complete":this.addOption(b,c);break;case"checkbox":this.addOption(b,c);break;case"radio":default:d=this.element.getElements(".fabrik_subelement").filter(function(a){return a.get("value")===b?(a.checked=!0,!0):void 0}.bind(this)),0===d.length&&this.addOption(b,c)}"null"!==typeOf(this.element)&&(this.element.fireEvent("change",new Event.Mock(this.element,"change")),this.element.fireEvent("blur",new Event.Mock(this.element,"blur")))}.bind(this)}).send()},watchSelect:function(){var a,b;if(a=this.getContainer()){var c=a.getElement(".toggle-selectoption");"null"!==typeOf(c)&&(c.addEvent("click",function(a){this.selectRecord(a)}.bind(this)),Fabrik.addEvent("fabrik.list.row.selected",function(a){this.options.listid.toInt()===a.listid.toInt()&&this.activeSelect&&(this.update(a.rowid),b=this.element.id+"-popupwin-select",Fabrik.Windows[b]&&Fabrik.Windows[b].close())}.bind(this)),this.unactiveFn=function(){this.activeSelect=!1}.bind(this),window.addEvent("fabrik.dbjoin.unactivate",this.unactiveFn),this.selectThenAdd()),this.selectThenAdd()}},selectThenAdd:function(){Fabrik.addEvent("fabrik.block.added",function(a,b){b==="list_"+this.options.listid+this.options.listRef&&a.form.addEvent("click:relay(.addbutton)",function(a){a.preventDefault();var b=this.selectRecordWindowId();Fabrik.Windows[b].close(),this.start(a,!0)}.bind(this))}.bind(this))},destroy:function(){window.removeEvent("fabrik.dbjoin.unactivate",this.unactiveFn)},selectRecord:function(a){window.fireEvent("fabrik.dbjoin.unactivate"),this.activeSelect=!0,a.stop();var b=this.selectRecordWindowId(),c=this.getContainer().getElement("a.toggle-selectoption").href;c+="&triggerElement="+this.element.id,c+="&resetfilters=1",c+="&c="+this.options.listRef,this.windowopts={id:b,title:Joomla.JText._("PLG_ELEMENT_DBJOIN_SELECT"),contentType:"xhr",loadMethod:"xhr",evalScripts:!0,contentURL:c,width:this.options.windowwidth,height:320,minimizable:!1,collapsible:!0,onContentLoaded:function(a){a.fitToContent()}},Fabrik.getWindow(this.windowopts)},selectRecordWindowId:function(){return this.element.id+"-popupwin-select"},numChecked:function(){return"checkbox"!==this.options.displayType?null:this._getSubElements().filter(function(a){return"0"!==a.value?a.checked:!1}).length},update:function(a){if(this.getElement(),"null"!==typeOf(this.element)){if(!this.options.editable){if(this.element.set("html",""),""===a)return;"string"===typeOf(a)&&(a=JSON.decode(a));var b=this.form.getFormData();return"object"===typeOf(b)&&(b=$H(b)),void a.each(function(a){this.element.innerHTML+="null"!==typeOf(b.get(a))?b.get(a)+"<br />":a+"<br />"}.bind(this))}this.setValue(a)}},setValue:function(a){var b=!1;if("null"!==typeOf(this.element.options))for(var c=0;c<this.element.options.length;c++)if(this.element.options[c].value===a){this.element.options[c].selected=!0,b=!0;break}b||("auto-complete"===this.options.displayType?(this.element.value=a,this.updateFromServer(a)):"dropdown"===this.options.displayType?this.options.show_please_select&&(this.element.options[0].selected=!0):("string"===typeOf(a)&&(a=""===a?[]:JSON.decode(a)),"array"!==typeOf(a)&&(a=[a]),this._getSubElements(),this.subElements.each(function(b){var c=!1;a.each(function(a){a.toString()===b.value&&(c=!0)}.bind(this)),b.checked=c}.bind(this)))),this.options.value=a,this.options.advanced&&jQuery("#"+this.element.id).trigger("liszt:updated")},updateByLabel:function(a){if(this.getElement(),"null"!==typeOf(this.element)){this.options.editable&&"dropdown"===this.options.displayType||this.update(a);var b=this.element.getElements("option");b.some(function(b){return b.text===a?(this.update(b.value),!0):!1}.bind(this))}},showDesc:function(a){var b=a.target.selectedIndex,c=this.getContainer().getElement(".dbjoin-description"),d=c.getElement(".description-"+b);c.getElements(".notice").each(function(a){if(a===d){var b=new Fx.Tween(d,{property:"opacity",duration:400,transition:Fx.Transitions.linear});b.set(0),a.setStyle("display",""),b.start(0,1)}else a.setStyle("display","none")})},getValue:function(){var a=null;if(this.getElement(),!this.options.editable)return this.options.value;if("null"===typeOf(this.element))return"";switch(this.options.displayType){case"dropdown":default:return"null"===typeOf(this.element.get("value"))?"":this.element.get("value");case"multilist":var b=[];return this.element.getElements("option").each(function(a){a.selected&&b.push(a.value)}),b;case"auto-complete":return this.element.value;case"radio":return a="",this._getSubElements().each(function(b){return b.checked?a=b.get("value"):null}),a;case"checkbox":return a=[],this.getChxLabelSubElements().each(function(b){b.checked&&a.push(b.get("value"))}),a}},getChxLabelSubElements:function(){var a=this._getSubElements();return a.filter(function(a){return a.name.contains("___id")?void 0:!0})},getCloneName:function(){return this.options.element},getValues:function(){var a=[],b="dropdown"!==this.options.displayType?"input":"option";return document.id(this.element.id).getElements(b).each(function(b){a.push(b.value)}),a},cloned:function(a){this.activePopUp=!1,this.parent(a),this.init(),this.watchSelect(),"auto-complete"===this.options.displayType&&this.cloneAutoComplete()},cloneAutoComplete:function(){var a=this.getAutoCompleteLabelField();a.id=this.element.id+"-auto-complete",a.name=this.element.name.replace("[]","")+"-auto-complete",document.id(a.id).value="",new FbAutocomplete(this.element.id,this.options.autoCompleteOpts)},watchObserve:function(){this.options.observe.each(function(a){if(""!==a)if(this.form.formElements[a])this.form.formElements[a].addNewEventAux(this.form.formElements[a].getChangeEvent(),function(){this.updateFromServer()}.bind(this));else{var b;this.options.canRepeat?(b=a+"_"+this.options.repeatCounter,this.form.formElements[b]&&this.form.formElements[b].addNewEventAux(this.form.formElements[b].getChangeEvent(),function(){this.updateFromServer()}.bind(this))):this.form.repeatGroupMarkers.each(function(c,d){for(b="",v2=0;v2<c;v2++)b="join___"+this.form.options.group_join_ids[d]+"___"+a+"_"+v2,this.form.formElements[b]&&this.form.formElements[b].addNewEvent(this.form.formElements[b].getChangeEvent(),function(){this.updateFromServer()}.bind(this))}.bind(this))}}.bind(this))},attachedToForm:function(){this.options.editable&&this.watchObserve(),parent.attachedToForm()},init:function(){"null"!==typeOf(this.element)&&(this.options.editable&&this.getCheckboxTmplNode(),this.options.allowadd===!0&&this.options.editable!==!1&&(this.watchAddEvent=this.start.bind(this),this.watchAdd(),Fabrik.addEvent("fabrik.form.submitted",function(a,b){this.options.popupform===a.id&&(this.activePopUp&&(this.options.value=b.rowid),"auto-complete"===this.options.displayType?new Request.JSON({url:"index.php?option=com_fabrik&view=form&format=raw",data:{formid:this.options.popupform,rowid:b.rowid},onSuccess:function(a){this.update(a.data[this.options.key])}.bind(this)}).send():this.updateFromServer())}.bind(this))),this.options.editable&&(this.watchSelect(),this.options.showDesc===!0&&this.element.addEvent("change",function(a){this.showDesc(a)}.bind(this))))},getAutoCompleteLabelField:function(){var a=this.element.getParent(".fabrikElement"),b=a.getElement("input[name*=-auto-complete]");return"null"===typeOf(b)&&(b=a.getElement("input[id*=-auto-complete]")),b},addNewEventAux:function(action,js){switch(this.options.displayType){case"dropdown":default:this.element&&this.element.addEvent(action,function(e){e&&e.stop(),"function"===typeOf(js)?js.delay(0,this,this):eval(js)}.bind(this));break;case"checkbox":case"radio":this._getSubElements(),this.subElements.each(function(el){el.addEvent(action,function(){"function"===typeOf(js)?js.delay(0,this,this):eval(js)}.bind(this))}.bind(this));break;case"auto-complete":var f=this.getAutoCompleteLabelField();"null"!==typeOf(f)&&f.addEvent(action,function(e){e&&e.stop(),"function"===typeOf(js)?js.delay(700,this,this):eval(js)}.bind(this)),this.element&&this.element.addEvent(action,function(e){e&&e.stop(),"function"===typeOf(js)?js.delay(0,this,this):eval(js)}.bind(this))}},decreaseName:function(a){if("auto-complete"===this.options.displayType){var b=this.getAutoCompleteLabelField();"null"!==typeOf(b)&&(b.name=this._decreaseName(b.name,a,"-auto-complete"),b.id=this._decreaseId(b.id,a,"-auto-complete"))}return this.parent(a)},updateUsingRaw:function(){return!0}});