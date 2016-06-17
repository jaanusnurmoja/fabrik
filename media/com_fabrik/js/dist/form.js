/*! Fabrik */
define(["jquery","fab/encoder","fab/fabrik","lib/debounce/jquery.ba-throttle-debounce"],function(a,b,c,d){var e=new Class({Implements:[Options,Events],options:{rowid:"",admin:!1,ajax:!1,primaryKey:null,error:"",submitOnEnter:!1,updatedMsg:"Form saved",pages:[],start_page:0,multipage_save:0,ajaxValidation:!1,showLoader:!1,customJsAction:"",plugins:[],ajaxmethod:"post",inlineMessage:!0,print:!1,toggleSubmit:!1,mustValidate:!1,lang:!1,debounceDelay:500,images:{alert:"",action_check:"",ajax_loader:""}},initialize:function(a,b){"null"===typeOf(b.rowid)&&(b.rowid=""),this.id=a,this.result=!0,this.setOptions(b),this.plugins=this.options.plugins,this.options.pages=$H(this.options.pages),this.subGroups=$H({}),this.currentPage=this.options.start_page,this.formElements=$H({}),this.hasErrors=$H({}),this.mustValidateEls=$H({}),this.elements=this.formElements,this.duplicatedGroups=$H({}),this.addingOrDeletingGroup=!1,this.fx={},this.fx.elements=[],this.fx.validations={},this.setUpAll(),this._setMozBoxWidths(),function(){this.duplicateGroupsToMin()}.bind(this).delay(1e3),this.events={},this.submitBroker=new FbFormSubmit,this.scrollTips(),c.fireEvent("fabrik.form.loaded",[this])},_setMozBoxWidths:function(){Browser.firefox&&this.getForm()&&this.getForm().getElements(".fabrikElementContainer > .displayBox").each(function(a){var b=a.getParent().getComputedSize(),c=a.getParent().getSize().x-(b.computedLeft+b.computedRight),d=0===a.getParent().getSize().x?400:c;a.setStyle("width",d+"px");var e=a.getElement(".fabrikElement");"null"!==typeOf(e)&&(c=0,a.getChildren().each(function(a){a!==e&&(c+=a.getSize().x)}),e.setStyle("width",d-c-10+"px"))})},setUpAll:function(){this.setUp(),this.winScroller=new Fx.Scroll(window),this.form&&((this.options.ajax||this.options.submitOnEnter===!1)&&this.stopEnterSubmitting(),this.watchAddOptions()),$H(this.options.hiddenGroup).each(function(a,b){if(a===!0&&"null"!==typeOf(document.id("group"+b))){var c=document.id("group"+b).getElement(".fabrikSubGroup");this.subGroups.set(b,c.cloneWithIds()),this.hideLastGroup(b,c)}}.bind(this)),this.repeatGroupMarkers=$H({}),this.form&&(this.form.getElements(".fabrikGroup").each(function(a){var b=a.id.replace("group",""),c=a.getElements(".fabrikSubGroup").length;1===c&&"none"===a.getElement(".fabrikSubGroupElements").getStyle("display")&&(c=0),this.repeatGroupMarkers.set(b,c)}.bind(this)),this.watchGoBackButton()),this.watchPrintButton(),this.watchPdfButton(),this.watchTabs()},watchPrintButton:function(){this.form.getElements("a[data-fabrik-print]").addEvent("click",function(b){if(b.stop(),this.options.print)window.print();else{var c=a(b.target).prop("href");c=c.replace(/&rowid=\d+/,"&rowid="+this.options.rowid),this.options.lang!==!1&&(c+="&lang="+this.options.lang),window.open(c,"win2","status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=400,height=350,directories=no,location=no;")}}.bind(this))},watchPdfButton:function(){this.form.getElements('*[data-role="open-form-pdf"]').addEvent("click",function(a){a.stop();var b=a.event.currentTarget.href.replace(/(rowid=\d*)/,"rowid="+this.options.rowid);this.options.lang!==!1&&(b+="&lang="+this.options.lang),window.location=b}.bind(this))},watchGoBackButton:function(){if(this.options.ajax){var a=this._getButton("Goback");if("null"===typeOf(a))return;a.addEvent("click",function(a){a.stop(),c.Windows[this.options.fabrik_window_id]?c.Windows[this.options.fabrik_window_id].close():window.history.back()}.bind(this))}},watchAddOptions:function(){this.fx.addOptions=[],this.getForm().getElements(".addoption").each(function(a){var b=a.getParent(".fabrikElementContainer").getElement(".toggle-addoption"),c=new Fx.Slide(a,{duration:500});c.hide(),b.addEvent("click",function(a){a.stop(),c.toggle()})})},setUp:function(){this.form=this.getForm(),this.watchGroupButtons(),this.watchSubmit(),this.createPages(),this.watchClearSession()},getForm:function(){return"null"===typeOf(this.form)&&(this.form=document.id(this.getBlock())),this.form},getBlock:function(){return"null"===typeOf(this.block)&&(this.block=this.options.editable===!0?"form_"+this.id:"details_"+this.id,""!==this.options.rowid&&(this.block+="_"+this.options.rowid)),this.block},addElementFX:function(a,b){var c,d,e;if(a=a.replace("fabrik_trigger_",""),"group_"===a.slice(0,6)){if(a=a.slice(6,a.length),d=a,c=document.id(a),!c)return fconsole('Fabrik form::addElementFX: Group "'+a+'" does not exist.'),!1}else{if("element_"!==a.slice(0,8))return fconsole("Fabrik form::addElementFX: Not an element or group: "+a),!1;if(a=a.slice(8,a.length),d="element"+a,c=document.id(a),!c)return fconsole('Fabrik form::addElementFX: Element "'+a+'" does not exist.'),!1;if(c=c.getParent(".fabrikElementContainer"),!c)return fconsole('Fabrik form::addElementFX: Element "'+a+'.fabrikElementContainer" does not exist.'),!1}if(c){var f=c.get("tag");"li"===f||"td"===f?(e=new Element("div",{style:"width:100%"}).adopt(c.getChildren()),c.empty(),e.inject(c)):e=c;var g={duration:800,transition:Fx.Transitions.Sine.easeInOut};return"null"===typeOf(this.fx.elements[d])&&(this.fx.elements[d]={}),this.fx.elements[d].css=new Fx.Morph(e,g),"null"===typeOf(e)||"slide in"!==b&&"slide out"!==b&&"slide toggle"!==b||(this.fx.elements[d].slide=new Fx.Slide(e,g)),this.fx.elements[d]}return!1},doElementFX:function(b,d,e){var f,g,h,i,j=this.formElements.get(b.replace("fabrik_trigger_element_","")),k=!0;if(j&&(k=j.options.inRepeatGroup),g="fabrik_trigger_group_"===b.slice(0,21)?!0:!1,e&&k&&!g&&e.options.inRepeatGroup){var l=b.split("_");l[l.length-1]=e.options.repeatCounter,b=l.join("_")}if(b=b.replace("fabrik_trigger_",""),"group_"===b.slice(0,6)?(b=b.slice(6,b.length),"group_"===b.slice(0,6)&&(b=b.slice(6,b.length)),f=b):(b=b.slice(8,b.length),f="element"+b),h=this.fx.elements[f],h||(h=this.addElementFX("element_"+b,d))){switch(i=g||h.css.element.hasClass("fabrikElementContainer")?h.css.element:h.css.element.getParent(".fabrikElementContainer"),"td"===i.get("tag")&&(i=i.getChildren()[0]),d){case"show":i.fade("show").removeClass("fabrikHide"),g&&document.id(b).getElements(".fabrikinput").setStyle("opacity","1");break;case"hide":i.fade("hide").addClass("fabrikHide");break;case"fadein":i.removeClass("fabrikHide"),"fadein"!==h.css.lastMethod&&(h.css.element.show(),h.css.start({opacity:[0,1]}));break;case"fadeout":"fadeout"!==h.css.lastMethod&&h.css.start({opacity:[1,0]}).chain(function(){h.css.element.hide(),i.addClass("fabrikHide")});break;case"slide in":h.slide.slideIn();break;case"slide out":h.slide.slideOut(),i.removeClass("fabrikHide");break;case"slide toggle":h.slide.toggle();break;case"clear":this.formElements.get(b).clear();break;case"disable":g||a("#"+b).prop("disabled",!0);break;case"enable":g||a("#"+b).prop("disabled",!1);break;case"readonly":g||("SELECT"===a("#"+b).prop("tagName")?a("#"+b+" option:not(:selected)").attr("disabled",!0):a("#"+b).prop("readonly",!0));break;case"notreadonly":g||("SELECT"===a("#"+b).prop("tagName")?a("#"+b+" option").attr("disabled",!1):a("#"+b).prop("readonly",!1))}h.lastMethod=d,c.fireEvent("fabrik.form.doelementfx",[this])}},getGroupTab:function(a){if(document.id("group"+a).getParent().hasClass("tab-pane")){var b=document.id("group"+a).getParent().id,c=this.form.getElement("a[href=#"+b+"]");return c.getParent()}return!1},hideGroupTab:function(b){var c=this.getGroupTab(b);c!==!1&&(c.hide(),c.hasClass("active")&&(c.getPrevious()?a(c.getPrevious().getFirst()).tab("show"):c.getNext()&&a(c.getNext().getFirst()).tab("show")))},selectGroupTab:function(b){var c=this.getGroupTab(b);c!==!1&&(c.hasClass("active")||a(c.getFirst()).tab("show"))},showGroupTab:function(a){var b=this.getGroupTab(a);b!==!1&&b.show()},watchTabs:function(){var b=this;a(this.form).on("click","*[data-role=fabrik_tab]",function(a){var d=a.target.id.match(/group(\d+)_tab/);d.length>1&&(d=d[1]),c.fireEvent("fabrik.form.tab.click",[b,d,a],500)})},watchClearSession:function(){var b=this,c=a(this.form);c.find(".clearSession").on("click",function(a){a.preventDefault(),c.find("input[name=task]").val("removeSession"),b.clearForm(),b.form.submit()})},createPages:function(){var b,c,d,e;if(this.isMultiPage()){this.options.pages.each(function(b,f){c=a(document.createElement("div")),c.attr({"class":"page",id:"page_"+f}),d=a("#group"+b[0]),e=d.closest("div"),e.hasClass("tab-pane")||(c.insertBefore(d),b.each(function(b){c.append(a("#group"+b))}))}),b=this._getButton("Submit"),b&&""===this.options.rowid&&(b.disabled="disabled",b.setStyle("opacity",.5));var f=this;a(this.form).on("click",".fabrikPagePrevious",function(a){f._doPageNav(a,-1)}),a(this.form).on("click",".fabrikPageNext",function(a){f._doPageNav(a,1)}),this.setPageButtons(),this.hideOtherPages()}},isMultiPage:function(){return this.options.pages.getKeys().length>1},_doPageNav:function(b,d){var e,f,g=this;this.options.editable?(this.form.getElement(".fabrikMainError").addClass("fabrikHide"),a(".tool-tip").css("top",0),e="index.php?option=com_fabrik&format=raw&task=form.ajax_validate&form_id="+this.id,this.options.lang!==!1&&(e+="&lang="+this.options.lang),c.loader.start(this.getBlock(),Joomla.JText._("COM_FABRIK_VALIDATING")),this.clearErrors(),f=a.extend({},this.getFormData(),{task:"form.ajax_validate",fabrik_ajax:"1",format:"raw"}),f=this._prepareRepeatsForAjax(f),a.ajax({url:e,method:this.options.ajaxmethod,data:f}).done(function(b){c.loader.stop(g.getBlock()),b=JSON.parse(b),(-1===d||g._showGroupError(b,f)===!1)&&(g.changePage(d),g.saveGroupsToDb()),a("html, body").animate({scrollTop:a(g.form).offset().top},300)})):this.changePage(d),b.preventDefault()},saveGroupsToDb:function(){var b,d,e,f,g=this,h=this.form.querySelector("input[name=format]"),i=this.form.querySelector("input[name=task]"),j=this.getBlock();if(0!==this.options.multipage_save){if(c.fireEvent("fabrik.form.groups.save.start",[this]),this.result===!1)return void(this.result=!0);b=h.value,d=i.value,this.form.querySelector("input[name=format]").value="raw",this.form.querySelector("input[name=task]").value="form.savepage",e="index.php?option=com_fabrik&format=raw&page="+this.currentPage,this.options.lang!==!1&&(e+="&lang="+this.options.lang),c.loader.start(j,"saving page"),f=this.getFormData(),f.fabrik_ajax=1,a.ajax({url:e,method:this.options.ajaxmethod,data:f}).done(function(a){return c.fireEvent("fabrik.form.groups.save.completed",[g]),g.result===!1?void(g.result=!0):(h.value=b,i.value=d,g.options.ajax&&c.fireEvent("fabrik.form.groups.save.end",[g,a]),void c.loader.stop(j))})}},changePage:function(b){return this.changePageDir=b,c.fireEvent("fabrik.form.page.change",[this,b]),this.result===!1?void(this.result=!0):(this.currentPage=this.currentPage.toInt(),this.currentPage+b>=0&&this.currentPage+b<this.options.pages.getKeys().length&&(this.currentPage=this.currentPage+b,this.pageGroupsVisible()||this.changePage(b)),this.setPageButtons(),a("#page_"+this.currentPage).css("display",""),this._setMozBoxWidths(),this.hideOtherPages(),c.fireEvent("fabrik.form.page.chage.end",[this,b]),c.fireEvent("fabrik.form.page.change.end",[this,b]),this.result===!1?void(this.result=!0):void 0)},pageGroupsVisible:function(){var b=!1;return this.options.pages.get(this.currentPage).each(function(c){var d=a("#group"+c);d.length>0&&"none"!==d.css("display")&&(b=!0)}),b},hideOtherPages:function(){var b,c=parseInt(this.currentPage,10);this.options.pages.each(function(d,e){parseInt(e,10)!==c&&(b=a("#page_"+e),b.hide())})},setPageButtons:function(){var a=this._getButton("Submit"),b=this.form.getElements(".fabrikPagePrevious"),c=this.form.getElements(".fabrikPageNext");c.each(function(b){this.currentPage===this.options.pages.getKeys().length-1?("null"!==typeOf(a)&&(a.disabled="",a.setStyle("opacity",1)),b.disabled="disabled",b.setStyle("opacity",.5)):("null"===typeOf(a)||""!==this.options.rowid&&"0"!==this.options.rowid.toString()||(a.disabled="disabled",a.setStyle("opacity",.5)),b.disabled="",b.setStyle("opacity",1))}.bind(this)),b.each(function(a){0===this.currentPage?(a.disabled="disabled",a.setStyle("opacity",.5)):(a.disabled="",a.setStyle("opacity",1))}.bind(this))},destroyElements:function(){this.formElements.each(function(a){a.destroy()})},addElements:function(a){var b=[],d=0;for(a=$H(a),a.each(function(a,c){a.each(function(a){if("array"===typeOf(a)){if("null"===typeOf(document.id(a[1])))return void fconsole('Fabrik form::addElements: Cannot add element "'+a[1]+'" because it does not exist in HTML.');var d=new window[a[0]](a[1],a[2]);b.push(this.addElement(d,a[1],c))}else if("object"===typeOf(a)){if("null"===typeOf(document.id(a.options.element)))return void fconsole('Fabrik form::addElements: Cannot add element "'+a.options.element+'" because it does not exist in HTML.');b.push(this.addElement(a,a.options.element,c))}else fconsole("null"!==typeOf(a)?"Fabrik form::addElements: Cannot add unknown element: "+a:"Fabrik form::addElements: Cannot add null element.")}.bind(this))}.bind(this)),d=0;d<b.length;d++)if("null"!==typeOf(b[d]))try{b[d].attachedToForm()}catch(e){fconsole(b[d].options.element+" attach to form:"+e)}c.fireEvent("fabrik.form.elements.added",[this])},addElement:function(a,b,d){b=a.getFormElementsKey(b),b=b.replace("[]","");var e="_ro"===b.substring(b.length-3,b.length);return a.form=this,a.groupid=d,this.formElements.set(b,a),c.fireEvent("fabrik.form.element.added",[this,b,a]),e&&(b=b.substr(0,b.length-3),this.formElements.set(b,a)),this.submitBroker.addElement(b,a),a},dispatchEvent:function(a,d,e,f){"string"===typeOf(f)&&(f=b.htmlDecode(f));var g=this.formElements.get(d);if(!g){Object.each(this.formElements,function(a){d===a.baseElementId&&(g=a)})}g?""!==f?g.addNewEvent(e,f):c.debug&&fconsole("Fabrik form::dispatchEvent: Javascript empty for "+e+" event on: "+d):fconsole("Fabrik form::dispatchEvent: Cannot find element to add "+e+" event to: "+d)},action:function(a,b){this.formElements.get(b);Browser.exec("oEl."+a+"()")},triggerEvents:function(a){this.formElements.get(a).fireEvents(arguments[1])},watchValidation:function(b,c){var d=this,e=a("#"+b);if(this.options.ajaxValidation!==!1)return 0===e.length?void fconsole("Fabrik form::watchValidation: Could not add "+c+' event because element "'+b+'" does not exist.'):e.hasClass("fabrikSubElementContainer")?void e.find(".fabrikinput").on(c,function(a){d.doElementValidation(a,!0)}):void e.on(c,function(a){d.doElementValidation(a,!1)})},doElementValidation:function(a,b,d){var e;if(this.options.ajaxValidation!==!1&&(d="null"===typeOf(d)?"_time":d,"event"===typeOf(a)||"object"===typeOf(a)||"domevent"===typeOf(a)?(e=a.target.id,b===!0&&(e=document.id(a.target).getParent(".fabrikSubElementContainer").id)):e=a,"null"!==typeOf(document.id(e)))){document.id(e).getProperty("readonly")===!0||"readonly"===document.id(e).getProperty("readonly");var f=this.formElements.get(e);if(f||(e=e.replace(d,""),f=this.formElements.get(e))){if(c.fireEvent("fabrik.form.element.validation.start",[this,f,a]),this.result===!1)return void(this.result=!0);f.setErrorMessage(Joomla.JText._("COM_FABRIK_VALIDATING"),"fabrikValidating");var g=$H(this.getFormData());g.set("task","form.ajax_validate"),g.set("fabrik_ajax","1"),g.set("format","raw"),g=this._prepareRepeatsForAjax(g);var h=e;f.origId&&(h=f.origId+"_0"),f.options.repeatCounter=f.options.repeatCounter?f.options.repeatCounter:0;var i="index.php?option=com_fabrik&form_id="+this.id;this.options.lang!==!1&&(i+="&lang="+this.options.lang);{new Request({url:i,method:this.options.ajaxmethod,data:g,onComplete:function(a){this._completeValidaton(a,e,h)}.bind(this)}).send()}}}},_completeValidaton:function(a,b,d){if(a=JSON.decode(a),"null"===typeOf(a))return this._showElementError(["Oups"],b),void(this.result=!0);if(this.formElements.each(function(a){a.afterAjaxValidation()}),c.fireEvent("fabrik.form.element.validation.complete",[this,a,b,d]),this.result===!1)return void(this.result=!0);var e=this.formElements.get(b);"null"!==typeOf(a.modified[d])&&e.update(a.modified[d]),"null"!==typeOf(a.errors[d])?this._showElementError(a.errors[d][e.options.repeatCounter],b):this._showElementError([],b),this.options.toggleSubmit&&(this.options.mustValidate?(this.hasErrors.has(b)&&this.hasErrors.get(b)||(this.mustValidateEls[b]=!1),this.mustValidateEls.hasValue(!0)||this.toggleSubmit(!0)):this.toggleSubmit(0===this.hasErrors.getKeys().length))},_prepareRepeatsForAjax:function(a){return this.getForm(),"hash"===typeOf(a)&&(a=a.getClean()),this.form.getElements("input[name^=fabrik_repeat_group]").each(function(b){if(b.id.test(/fabrik_repeat_group_\d+_counter/)){var c=b.name.match(/\[(.*)\]/)[1];a["fabrik_repeat_group["+c+"]"]=b.get("value")}}),a},_showGroupError:function(a,b){var c,d=Array.from(this.options.pages.get(this.currentPage.toInt())),e=!1;return $H(b).each(function(b,f){if(f=f.replace(/\[(.*)\]/,"").replace(/%5B(.*)%5D/,""),this.formElements.has(f)){var g=this.formElements.get(f);if(d.contains(g.groupid.toInt())){if(a.errors[f]){var h="";"null"!==typeOf(a.errors[f])&&(h=a.errors[f].flatten().join("<br />")),""!==h?(c=this._showElementError(a.errors[f],f),e===!1&&(e=c)):g.setErrorMessage("","")}a.modified[f]&&g&&g.update(a.modified[f])}}}.bind(this)),e},_showElementError:function(a,b){var c="";"null"!==typeOf(a)&&(c=a.flatten().join("<br />"));var d=""===c?"fabrikSuccess":"fabrikError";return""===c?(delete this.hasErrors[b],c=Joomla.JText._("COM_FABRIK_SUCCESS")):this.hasErrors.set(b,!0),c="<span> "+c+"</span>",this.formElements.get(b).setErrorMessage(c,d),"fabrikSuccess"===d?!1:!0},updateMainError:function(){var a,b=this.form.getElement(".fabrikMainError");b.set("html",this.options.error),a=this.form.getElements(".fabrikError").filter(function(a){return!a.hasClass("fabrikMainError")}),a.length>0&&b.hasClass("fabrikHide")&&this.showMainError(this.options.error),0===a.length&&this.hideMainError()},hideMainError:function(){var a=this.form.getElement(".fabrikMainError");myfx=new Fx.Tween(a,{property:"opacity",duration:500,onComplete:function(){a.addClass("fabrikHide")}}).start(1,0)},showMainError:function(a){if(!c.bootstrapped||!this.options.ajaxValidation){var b=this.form.getElement(".fabrikMainError");b.set("html",a),b.removeClass("fabrikHide"),myfx=new Fx.Tween(b,{property:"opacity",duration:500}).start(0,1)}},_getButton:function(a){if(this.getForm()){var b=this.form.getElement("input[type=button][name="+a+"]");return b||(b=this.form.getElement("input[type=submit][name="+a+"]")),b||(b=this.form.getElement("button[type=button][name="+a+"]")),b||(b=this.form.getElement("button[type=submit][name="+a+"]")),b}},watchSubmit:function(){var a=this._getButton("Submit"),b=this._getButton("apply");if(a||b){var d=this._getButton("delete"),e=this._getButton("Copy");d&&d.addEvent("click",function(a){if(!window.confirm(Joomla.JText._("COM_FABRIK_CONFIRM_DELETE_1")))return!1;var b=c.fireEvent("fabrik.form.delete",[this,this.options.rowid]).eventResults;return"null"!==typeOf(b)&&0!==b.length&&b.contains(!1)?(a.stop(),!1):(this.form.getElement("input[name=task]").value="form.delete",void this.doSubmit(a,d))}.bind(this));var f=this.form.getElements("button[type=submit]").combine([b,a,e]);f.each(function(a){"null"!==typeOf(a)&&a.addEvent("click",function(b){this.doSubmit(b,a)}.bind(this))}.bind(this)),this.form.addEvent("submit",function(a){this.doSubmit(a)}.bind(this))}},mockSubmit:function(a){a="undefined"!=typeof a?a:"Submit";var b=this._getButton(a);b||(b=new Element("button",{name:"Submit",type:"submit"})),this.doSubmit(new Event.Mock(b,"click"),b)},doSubmit:function(a,b){return this.submitBroker.enabled()?(a.stop(),!1):(this.submitBroker.submit(function(){if(this.options.showLoader&&c.loader.start(this.getBlock(),Joomla.JText._("COM_FABRIK_LOADING")),c.fireEvent("fabrik.form.submit.start",[this,a,b]),this.result===!1)return this.result=!0,a.stop(),c.loader.stop(this.getBlock()),void this.updateMainError();if(this.options.pages.getKeys().length>1&&this.form.adopt(new Element("input",{name:"currentPage",value:this.currentPage.toInt(),type:"hidden"})),this.options.ajax&&this.form){this.options.showLoader||c.loader.start(this.getBlock(),Joomla.JText._("COM_FABRIK_LOADING"));var d=$H(this.getFormData());d=this._prepareRepeatsForAjax(d),d[b.name]=b.value,"Copy"===b.name&&(d.Copy=1,a.stop()),d.fabrik_ajax="1",d.format="raw";{new Request.JSON({url:this.form.action,data:d,method:this.options.ajaxmethod,onError:function(a,b){fconsole(a+": "+b),this.showMainError(b),c.loader.stop(this.getBlock(),"Error in returned JSON")}.bind(this),onFailure:function(a){fconsole(a),c.loader.stop(this.getBlock(),"Ajax failure")}.bind(this),onComplete:function(d,e){if("null"===typeOf(d))return c.loader.stop(this.getBlock(),"Error in returned JSON"),void fconsole("error in returned json",d,e);var f=!1;if(void 0!==d.errors&&$H(d.errors).each(function(b,c){if(this.formElements.has(c)&&b.flatten().length>0)if(f=!0,this.formElements[c].options.inRepeatGroup){for(a=0;a<b.length;a++)if(b[a].flatten().length>0){var d=c.replace(/(_\d+)$/,"_"+a);this._showElementError(b[a],d)}}else this._showElementError(b,c)}.bind(this)),this.updateMainError(),f===!1){var g=!1;""===this.options.rowid&&"apply"!==b.name&&(g=!0),c.loader.stop(this.getBlock());var h="null"!==typeOf(d.msg)&&void 0!==d.msg&&""!==d.msg?d.msg:Joomla.JText._("COM_FABRIK_FORM_SAVED");if(d.baseRedirect!==!0)if(g=d.reset_form,void 0!==d.url)if("popup"===d.redirect_how){var i=d.width?d.width:400,j=d.height?d.height:400,k=d.x_offset?d.x_offset:0,l=d.y_offset?d.y_offset:0,m=d.title?d.title:"";c.getWindow({id:"redirect",type:"redirect",contentURL:d.url,caller:this.getBlock(),height:j,width:i,offset_x:k,offset_y:l,title:m})}else"samepage"===d.redirect_how?window.open(d.url,"_self"):"newpage"===d.redirect_how&&window.open(d.url,"_blank");else d.suppressMsg||alert(h);else g=void 0!==d.reset_form?d.reset_form:g,d.suppressMsg||alert(h);c.fireEvent("fabrik.form.submitted",[this,d]),"apply"!==b.name&&(g&&this.clearForm(),c.Windows[this.options.fabrik_window_id]&&c.Windows[this.options.fabrik_window_id].close())}else c.fireEvent("fabrik.form.submit.failed",[this,d]),c.loader.stop(this.getBlock(),Joomla.JText._("COM_FABRIK_VALIDATION_ERROR"))}.bind(this)}).send()}}c.fireEvent("fabrik.form.submit.end",[this]),this.result===!1?(this.result=!0,a.stop(),this.updateMainError()):this.options.ajax?(a.stop(),c.fireEvent("fabrik.form.ajax.submit.end",[this])):"null"!==typeOf(b)?(new Element("input",{type:"hidden",name:b.name,value:b.value}).inject(this.form),this.form.submit()):a.stop()}.bind(this)),void a.stop())},getFormData:function(a){a="null"!==typeOf(a)?a:!0,a&&this.formElements.each(function(a){a.onsubmit()}),this.getForm();var b=this.form.toQueryString(),c={};b=b.split("&");var d=$H({});b.each(function(a){a=a.split("=");var b=a[0];b=decodeURI(b),"[]"===b.substring(b.length-2)&&(b=b.substring(0,b.length-2),d.has(b)?d.set(b,d.get(b)+1):d.set(b,0),b=b+"["+d.get(b)+"]"),c[b]=a[1]});this.formElements.getKeys();return this.formElements.each(function(a,b){if("fabrikfileupload"===a.plugin&&(c[b]=a.get("value")),"null"===typeOf(c[b])){var d=!1;$H(c).each(function(a,c){c=unescape(c),c=c.replace(/\[(.*)\]/,""),c===b&&(d=!0)}.bind(this)),d||(c[b]="")}}.bind(this)),c},getFormElementData:function(){var a={};return this.formElements.each(function(b,c){b.element&&(a[c]=b.getValue(),a[c+"_raw"]=a[c])}.bind(this)),a},watchGroupButtons:function(){var b=this;a(this.form).on("click",".deleteGroup",d(this.options.debounceDelay,!0,function(a){if(a.preventDefault(),!b.addingOrDeletingGroup){b.addingOrDeletingGroup=!0;var c=a.target.getParent(".fabrikGroup"),d=a.target.getParent(".fabrikSubGroup");b.deleteGroup(a,c,d),b.addingOrDeletingGroup=!1}})),a(this.form).on("click",".addGroup",d(this.options.debounceDelay,!0,function(a){a.preventDefault(),b.addingOrDeletingGroup||(b.addingOrDeletingGroup=!0,b.duplicateGroup(a),b.addingOrDeletingGroup=!1)})),this.form.addEvent("click:relay(.fabrikSubGroup)",function(a,b){var c=b.getElement(".fabrikGroupRepeater");c&&(b.addEvent("mouseenter",function(){c.fade(1)}),b.addEvent("mouseleave",function(){c.fade(.2)}))}.bind(this))},duplicateGroupsToMin:function(){this.form&&(c.fireEvent("fabrik.form.group.duplicate.min",[this]),Object.each(this.options.group_repeats,function(a,b){if("null"!==typeOf(this.options.minRepeat[b])&&1===a.toInt()){var c,d,e,f,g,h,i,j=this.form.getElement("#fabrik_repeat_group_"+b+"_counter");if("null"!==typeOf(j)){c=d=j.value.toInt(),1===c&&(h=this.form.getElement("#"+this.options.group_pk_ids[b]+"_0"),"null"!==typeOf(h)&&""===h.value&&(d=0));var k=this.options.minRepeat[b].toInt();if(0===k&&0===d){f=this.form.getElement("#group"+b+" .deleteGroup"),i="null"!==typeOf(f)?new Event.Mock(f,"click"):!1;var l=this.form.getElement("#group"+b),m=l.getElement(".fabrikSubGroup");this.deleteGroup(i,l,m)}else if(k>c&&(e=this.form.getElement("#group"+b+" .addGroup"),"null"!==typeOf(e))){var n=new Event.Mock(e,"click");for(g=c;k>g;g++)this.duplicateGroup(n)}}}}.bind(this)))},deleteGroup:function(b,d,e){if(c.fireEvent("fabrik.form.group.delete",[this,b,d]),this.result===!1)return void(this.result=!0);b&&b.preventDefault();var f=0;d.getElements(".deleteGroup").each(function(c,d){a(c).find("[data-role=fabrik_delete_group]")[0]===b.target&&(f=d)}.bind(this));var g=d.id.replace("group",""),h=document.id("fabrik_repeat_group_"+g+"_counter").get("value").toInt();if(h<=this.options.minRepeat[g]&&0!==this.options.minRepeat[g]){if(""!==this.options.minMaxErrMsg[g]){var i=this.options.minMaxErrMsg[g];i=i.replace(/\{min\}/,this.options.minRepeat[g]),i=i.replace(/\{max\}/,this.options.maxRepeat[g]),alert(i)}}else if(delete this.duplicatedGroups.i,"0"!==document.id("fabrik_repeat_group_"+g+"_counter").value){var j=d.getElements(".fabrikSubGroup");if(this.subGroups.set(g,e.clone()),j.length<=1)this.hideLastGroup(g,e),c.fireEvent("fabrik.form.group.delete.end",[this,b,g,f]);else{{var k=e.getPrevious();new Fx.Tween(e,{property:"opacity",duration:300,onComplete:function(){j.length>1&&e.dispose(),this.formElements.each(function(a,b){"null"!==typeOf(a.element)&&"null"===typeOf(document.id(a.element.id))&&(a.decloned(g),delete this.formElements[b])}.bind(this)),j=d.getElements(".fabrikSubGroup");var a={};this.formElements.each(function(b,c){b.groupid===g&&(a[c]=b.decreaseName(f))}.bind(this)),$H(a).each(function(a,b){b!==a&&(this.formElements[a]=this.formElements[b],delete this.formElements[b])}.bind(this)),c.fireEvent("fabrik.form.group.delete.end",[this,b,g,f])}.bind(this)}).start(1,0)}if(k){var l=document.id(window).getScroll().y,m=k.getCoordinates();if(m.top<l){var n=m.top;this.winScroller.start(0,n)}}}document.id("fabrik_repeat_group_"+g+"_counter").value=document.id("fabrik_repeat_group_"+g+"_counter").get("value").toInt()-1,this.repeatGroupMarkers.set(g,this.repeatGroupMarkers.get(g)-1),this.setRepeatGroupIntro(d,g)}},hideLastGroup:function(a,b){var c=b.getElement(".fabrikSubGroupElements"),d=new Element("div",{"class":"fabrikNotice alert"}).appendText(Joomla.JText._("COM_FABRIK_NO_REPEAT_GROUP_DATA"));if("null"===typeOf(c)){c=b;var e=c.getElement(".addGroup");if("null"!==typeOf(e)){var f=c.getParent("table").getElements('*[data-role="fabrik-group-repeaters"]').getLast();f||(f=c.getParent("table").getElements("thead th").getLast()),e.inject(f)}}c.setStyle("display","none"),d.inject(c,"after")},isFirstRepeatSubGroup:function(a){var b=a.getElements(".fabrikSubGroup");return 1===b.length&&a.getElement(".fabrikNotice")},getSubGroupToClone:function(a){var b=document.id("group"+a),c=b.getElement(".fabrikSubGroup");c||(c=this.subGroups.get(a));var d=null,e=!1;return this.duplicatedGroups.has(a)&&(e=!0),e?d=c?c.cloneNode(!0):this.duplicatedGroups.get(a):(d=c.cloneNode(!0),this.duplicatedGroups.set(a,d)),d},repeatGetChecked:function(a){var b=[];return a.getElements(".fabrikinput").each(function(a){"radio"===a.type&&a.getProperty("checked")&&b.push(a)}),b},duplicateGroup:function(b){var d,e;if(c.fireEvent("fabrik.form.group.duplicate",[this,b]),this.result===!1)return void(this.result=!0);b&&b.preventDefault();var f=b.target.getParent(".fabrikGroup").id.replace("group",""),g=f.toInt(),h=document.id("group"+f),i=this.repeatGroupMarkers.get(f),j=document.id("fabrik_repeat_group_"+f+"_counter").get("value").toInt();if(j>=this.options.maxRepeat[f]&&0!==this.options.maxRepeat[f]){if(""!==this.options.minMaxErrMsg[f]){var k=this.options.minMaxErrMsg[f];k=k.replace(/\{min\}/,this.options.minRepeat[f]),k=k.replace(/\{max\}/,this.options.maxRepeat[f]),window.alert(k)}}else{if(document.id("fabrik_repeat_group_"+f+"_counter").value=j+1,this.isFirstRepeatSubGroup(h)){var l=h.getElements(".fabrikSubGroup"),m=l[0].getElement(".fabrikSubGroupElements");if("null"===typeOf(m)){h.getElement(".fabrikNotice").dispose(),m=l[0];var n=h.getElement(".addGroup");n.inject(m.getElement("td.fabrikGroupRepeater")),m.setStyle("display","")}else l[0].getElement(".fabrikNotice").dispose(),l[0].getElement(".fabrikSubGroupElements").show();return void this.repeatGroupMarkers.set(f,this.repeatGroupMarkers.get(f)+1)}var o=this.getSubGroupToClone(f),p=this.repeatGetChecked(h),q=h.getElement("table.repeatGroupTable");q?(q.getElement("tbody")&&(q=q.getElement("tbody")),q.appendChild(o)):h.appendChild(o),p.each(function(a){a.setProperty("checked",!0)}),this.subelementCounter=0;var r=[],s=!1,t=o.getElements(".fabrikinput"),u=null;this.formElements.each(function(a){var b=!1;d=null;var c=-1;if(t.each(function(f){s=a.hasSubElements(),e=f.getParent(".fabrikSubElementContainer");var g=s&&e?e.id:f.id,h=a.getCloneName();if(g===h||g===h+"-auto-complete"){if(u=f,b=!0,s)c++,d=f.getParent(".fabrikSubElementContainer"),document.id(g).getElement("input")&&f.cloneEvents(document.id(g).getElement("input"));else{f.cloneEvents(a.element);var j=Array.from(a.element.id.split("_"));j.splice(j.length-1,1,i),f.id=j.join("_");var k=f.getParent(".fabrikElementContainer").getElement("label");k&&k.setProperty("for",f.id)}"null"!==typeOf(f.name)&&(f.name=f.name.replace("[0]","["+i+"]"))}}.bind(this)),b){if(s&&"null"!==typeOf(d)){var f=Array.from(a.options.element.split("_"));f.splice(f.length-1,1,i),d.id=f.join("_")}var g=(a.options.element,a.unclonableProperties()),h=new CloneObject(a,!0,g);h.container=null,h.options.repeatCounter=i,s&&"null"!==typeOf(d)?(h.element=document.id(d),h.cloneUpdateIds(d.id),h.options.element=d.id,h._getSubElements()):h.cloneUpdateIds(u.id),r.push(h)}}.bind(this)),r.each(function(a){a.cloned(i);var b=new RegExp(this.options.group_pk_ids[g]);!this.options.group_copy_element_values[g]||this.options.group_copy_element_values[g]&&a.element.name&&a.element.name.test(b)?a.reset():a.resetEvents()}.bind(this));var v={};v[f]=r,this.addElements(v);var w=a(window).height(),x=document.id(window).getScroll().y,y=o.getCoordinates();if(y.bottom>x+w){var z=y.bottom-w;this.winScroller.start(0,z)}{new Fx.Tween(o,{property:"opacity",duration:500}).set(0)}o.fade(1),c.fireEvent("fabrik.form.group.duplicate.end",[this,b,f,i]),this.setRepeatGroupIntro(h,f),this.repeatGroupMarkers.set(f,this.repeatGroupMarkers.get(f)+1)}},setRepeatGroupIntro:function(a,b){var c=this.options.group_repeat_intro[b],d="",e=a.getElements('*[data-role="group-repeat-intro"]');e.each(function(a,b){d=c.replace("{i}",b+1),this.formElements.each(function(a){if(!a.options.inRepeatGroup){var b=new RegExp("{"+a.element.id+"}");d=d.replace(b,a.getValue())}}),a.set("html",d)}.bind(this))},update:function(a){if(c.fireEvent("fabrik.form.update",[this,a.data]),this.result===!1)return void(this.result=!0);var b=arguments[1]||!1,d=a.data;if(this.getForm(),this.form){var e=this.form.getElement("input[name=rowid]");e&&d.rowid&&(e.value=d.rowid)}this.formElements.each(function(c,e){"null"===typeOf(d[e])&&"_ro"===e.substring(e.length-3,e.length)&&(e=e.substring(0,e.length-3)),"null"===typeOf(d[e])?a.id!==this.id||b||c.update(""):c.update(d[e])}.bind(this))},reset:function(){return this.addedGroups.each(function(a){var b=document.id(a).findClassUp("fabrikGroup"),c=b.id.replace("group","");document.id("fabrik_repeat_group_"+c+"_counter").value=document.id("fabrik_repeat_group_"+c+"_counter").get("value").toInt()-1,
a.remove()}),this.addedGroups=[],c.fireEvent("fabrik.form.reset",[this]),this.result===!1?void(this.result=!0):void this.formElements.each(function(a){a.reset()}.bind(this))},showErrors:function(a){var b=null;if(a.id===this.id){var c=new Hash(a.errors);c.getKeys().length>0&&("null"!==typeOf(this.form.getElement(".fabrikMainError"))&&(this.form.getElement(".fabrikMainError").set("html",this.options.error),this.form.getElement(".fabrikMainError").removeClass("fabrikHide")),c.each(function(a,c){if("null"!==typeOf(document.id(c+"_error")))for(var d=document.id(c+"_error"),e=(new Element("span"),0);e<a.length;e++)for(var f=0;f<a[e].length;f++)b=new Element("div").appendText(a[e][f]).inject(d);else fconsole(c+"_error not found (form show errors)")}))}},appendInfo:function(a){this.formElements.each(function(b,c){b.appendInfo&&b.appendInfo(a,c)}.bind(this))},clearForm:function(){this.getForm(),this.form&&(this.formElements.each(function(a,b){b===this.options.primaryKey&&(this.form.getElement("input[name=rowid]").value=""),a.update("")}.bind(this)),this.form.getElements(".fabrikError").empty(),this.form.getElements(".fabrikError").addClass("fabrikHide"))},clearErrors:function(){a(this.form).find(".fabrikError").removeClass("fabrikError").removeClass("error").removeClass("has-error"),this.hideTips()},hideTips:function(){this.elements.each(function(a){a.removeTipMsg()})},scrollTips:function(){var b,d,e,f=this,g=a(f.form).closest(".fabrikWindow"),h=g.find(".itemContent"),i=function(){var a=g.data("origPosition");void 0===a&&(a=g.position(),g.data("origPosition",a)),e=g.position(),b=a.top-e.top+h.scrollTop(),d=a.left-e.left+h.scrollLeft(),f.elements.each(function(a){a.moveTip(b,d)})};h.on("scroll",function(){i()}),c.on("fabrik.window.resized",function(a){g.length>0&&a===g[0]&&i()})},stopEnterSubmitting:function(){var a=this.form.getElements("input.fabrikinput");a.each(function(b,c){b.addEvent("keypress",function(b){"enter"===b.key&&(b.stop(),a[c+1]&&a[c+1].focus(),c===a.length-1&&this._getButton("Submit").focus())}.bind(this))}.bind(this))},getSubGroupCounter:function(){},addMustValidate:function(a){this.options.ajaxValidation&&this.options.toggleSubmit&&(this.mustValidateEls.set(a.element.id,a.options.mustValidate),a.options.mustValidate&&(this.options.mustValidate=!0,this.toggleSubmit(!1)))},toggleSubmit:function(a){var b=this._getButton("Submit");"null"!==typeOf(b)&&(a===!0?(b.disabled="",b.setStyle("opacity",1)):(b.disabled="disabled",b.setStyle("opacity",.5)))}});return c.form=function(a,b,d){var f=new e(b,d);return c.addBlock(a,f),f},e});