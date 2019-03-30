/*! Fabrik */

define(["jquery","fab/encoder","fab/fabrik","lib/debounce/jquery.ba-throttle-debounce"],function(G,r,S,t){var n=new Class({Implements:[Options,Events],options:{rowid:"",admin:!1,ajax:!1,primaryKey:null,error:"",submitOnEnter:!1,updatedMsg:"Form saved",pages:[],start_page:0,multipage_save:0,ajaxValidation:!1,showLoader:!1,customJsAction:"",plugins:{},ajaxmethod:"post",inlineMessage:!0,print:!1,toggleSubmit:!1,toggleSubmitTip:"must validate",mustValidate:!1,lang:!1,debounceDelay:500,images:{alert:"",action_check:"",ajax_loader:""}},initialize:function(t,e){"null"===typeOf(e.rowid)&&(e.rowid=""),this.id=t,this.result=!0,this.setOptions(e),this.options.pages=$H(this.options.pages),this.subGroups=$H({}),this.currentPage=this.options.start_page,this.formElements=$H({}),this.hasErrors=$H({}),this.mustValidateEls=$H({}),this.toggleSubmitTipAdded=!1,this.elements=this.formElements,this.duplicatedGroups=$H({}),this.addingOrDeletingGroup=!1,this.addedGroups=[],this.watchRepeatNumsDone=!1,this.fx={},this.fx.elements=[],this.fx.hidden=[],this.fx.validations={},this.setUpAll(),this._setMozBoxWidths(),this.options.editable&&function(){this.duplicateGroupsToMin()}.bind(this).delay(1e3),this.events={},this.submitBroker=new FbFormSubmit,this.scrollTips(),S.fireEvent("fabrik.form.loaded",[this])},_setMozBoxWidths:function(){Browser.firefox&&this.getForm()&&this.getForm().getElements(".fabrikElementContainer > .displayBox").each(function(t){var e=t.getParent().getComputedSize(),i=t.getParent().getSize().x-(e.computedLeft+e.computedRight),o=0===t.getParent().getSize().x?400:i;t.setStyle("width",o+"px");var n=t.getElement(".fabrikElement");"null"!==typeOf(n)&&(i=0,t.getChildren().each(function(t){t!==n&&(i+=t.getSize().x)}),n.setStyle("width",o-i-10+"px"))})},setUpAll:function(){if(this.setUp(),this.options.ajaxValidation&&this.options.toggleSubmit&&""!==this.options.toggleSubmitTip){var t=this._getButton("Submit");"null"!==typeOf(t)&&G(t).wrap('<div data-toggle="tooltip" title="'+Joomla.JText._("COM_FABRIK_MUST_VALIDATE")+'" class="fabrikSubmitWrapper" style="display: inline-block"></div>div>')}this.winScroller=new Fx.Scroll(window),this.form&&((this.options.ajax||!1===this.options.submitOnEnter)&&this.stopEnterSubmitting(),this.watchAddOptions()),$H(this.options.hiddenGroup).each(function(t,e){if(!0===t&&"null"!==typeOf(document.id("group"+e))){var i=document.id("group"+e).getElement(".fabrikSubGroup");this.subGroups.set(e,i.cloneWithIds()),this.hideLastGroup(e,i)}}.bind(this)),this.repeatGroupMarkers=$H({}),this.form&&(this.form.getElements(".fabrikGroup").each(function(t){var e=t.id.replace("group",""),i=t.getElements(".fabrikSubGroup").length;1===i&&"none"===t.getElement(".fabrikSubGroupElements").getStyle("display")&&(i=0),this.repeatGroupMarkers.set(e,i)}.bind(this)),this.watchGoBackButton()),this.watchPrintButton(),this.watchPdfButton(),this.watchTabs(),this.watchRepeatNums()},watchRepeatNums:function(){S.addEvent("fabrik.form.elements.added",function(t){t.id!==this.id||this.watchRepeatNumsDone||(Object.each(this.options.numRepeatEls,function(t,i){if(""!==t){var o=this.formElements.get(t);o&&o.addNewEventAux(o.getChangeEvent(),function(t){var e=o.getValue();this.options.minRepeat[i]=e.toInt(),this.options.maxRepeat[i]=e.toInt(),this.duplicateGroupsToMin()}.bind(this,o,i))}}.bind(t)),this.watchRepeatNumsDone=!0)}.bind(this))},watchPrintButton:function(){this.form.getElements("a[data-fabrik-print]").addEvent("click",function(t){if(t.stop(),this.options.print)window.print();else{var e=G(t.target).prop("href");e=e.replace(/&rowid=\d+/,"&rowid="+this.options.rowid),!1!==this.options.lang&&(e.test(/\?/)?e+="&lang="+this.options.lang:e+="?lang="+this.options.lang),window.open(e,"win2","status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=400,height=350,directories=no,location=no;")}}.bind(this))},watchPdfButton:function(){this.form.getElements('*[data-role="open-form-pdf"]').addEvent("click",function(t){t.stop();var e=t.event.currentTarget.href.replace(/(rowid=\d*)/,"rowid="+this.options.rowid);!1!==this.options.lang&&(e.test(/\?/)?e+="&lang="+this.options.lang:e+="?lang="+this.options.lang),window.location=e}.bind(this))},watchGoBackButton:function(){if(this.options.ajax){var t=this._getButton("Goback");if("null"===typeOf(t))return;t.addEvent("click",function(t){t.stop(),S.Windows[this.options.fabrik_window_id]?S.Windows[this.options.fabrik_window_id].close():window.history.back()}.bind(this))}},watchAddOptions:function(){this.fx.addOptions=[],this.getForm().getElements(".addoption").each(function(t){var e=t.getParent(".fabrikElementContainer").getElement(".toggle-addoption"),i=new Fx.Slide(t,{duration:500});i.hide(),e.addEvent("click",function(t){t.stop(),i.toggle()})})},setUp:function(){this.form=this.getForm(),this.watchGroupButtons(),this.watchSubmit(),this.createPages(),this.watchClearSession()},getForm:function(){return"null"===typeOf(this.form)&&(this.form=document.id(this.getBlock())),this.form},getBlock:function(){return"null"===typeOf(this.block)&&(this.block=!0===this.options.editable?"form_"+this.id:"details_"+this.id,""!==this.options.rowid&&(this.block+="_"+this.options.rowid)),this.block},addElementFX:function(t,e){var i,o,n;if("group_"===(t=t.replace("fabrik_trigger_","")).slice(0,6)){if(o=t=t.slice(6,t.length),!(i=document.id(t)))return fconsole('Fabrik form::addElementFX: Group "'+t+'" does not exist.'),!1}else{if("element_"!==t.slice(0,8))return fconsole("Fabrik form::addElementFX: Not an element or group: "+t),!1;if(o="element"+(t=t.slice(8,t.length)),!(i=document.id(t)))return fconsole('Fabrik form::addElementFX: Element "'+t+'" does not exist.'),!1;if(!(i=i.getParent(".fabrikElementContainer")))return fconsole('Fabrik form::addElementFX: Element "'+t+'.fabrikElementContainer" does not exist.'),!1}if(i){var r=i.get("tag");"li"===r||"td"===r?(n=new Element("div",{style:"width:100%"}).adopt(i.getChildren()),i.empty(),n.inject(i)):n=i;var s={duration:800,transition:Fx.Transitions.Sine.easeInOut};return"null"===typeOf(this.fx.elements[o])&&(this.fx.elements[o]={}),this.fx.elements[o].css=new Fx.Morph(n,s),"null"===typeOf(n)||"slide in"!==e&&"slide out"!==e&&"slide toggle"!==e||(this.fx.elements[o].slide=new Fx.Slide(n,s)),this.fx.elements[o]}return!1},doElementFX:function(t,e,i){var o,n,r,s,a=this.formElements.get(t.replace("fabrik_trigger_element_","")),l=!0;if(a&&(l=a.options.inRepeatGroup),n="fabrik_trigger_group_"===t.slice(0,21),i&&l&&!n&&i.options.inRepeatGroup){var u=t.split("_");u[u.length-1]=i.options.repeatCounter,t=u.join("_")}if(o="group_"===(t=t.replace("fabrik_trigger_","")).slice(0,6)?("group_"===(t=t.slice(6,t.length)).slice(0,6)&&(t=t.slice(6,t.length)),t):"element"+(t=t.slice(8,t.length)),(r=this.fx.elements[o])||(r=this.addElementFX("element_"+t,e))){switch("td"===(s=n||r.css.element.hasClass("fabrikElementContainer")?r.css.element:r.css.element.getParent(".fabrikElementContainer")).get("tag")&&(s=s.getChildren()[0]),e){case"show":s.fade("show").removeClass("fabrikHide"),n&&(document.id(t).getElements(".fabrikinput").setStyle("opacity","1"),this.showGroupTab(t),s.show());break;case"hide":s.fade("hide").addClass("fabrikHide"),n&&this.hideGroupTab(t);break;case"fadein":s.removeClass("fabrikHide"),"fadein"!==r.css.lastMethod&&(r.css.element.show(),r.css.start({opacity:[0,1]})),n&&(this.showGroupTab(t),s.show());break;case"fadeout":"fadeout"!==r.css.lastMethod&&r.css.start({opacity:[1,0]}).chain(function(){r.css.element.hide(),s.addClass("fabrikHide")}),n&&this.hideGroupTab(t);break;case"slide in":r.slide.slideIn();break;case"slide out":r.slide.slideOut(),s.removeClass("fabrikHide");break;case"slide toggle":r.slide.toggle();break;case"clear":this.formElements.get(t).clear();break;case"disable":n||G("#"+t).prop("disabled",!0);break;case"enable":n||G("#"+t).prop("disabled",!1);break;case"readonly":n||("SELECT"===G("#"+t).prop("tagName")?G("#"+t+" option:not(:selected)").attr("disabled",!0):G("#"+t).prop("readonly",!0));break;case"notreadonly":n||("SELECT"===G("#"+t).prop("tagName")?G("#"+t+" option").attr("disabled",!1):G("#"+t).prop("readonly",!1))}r.lastMethod=e,S.fireEvent("fabrik.form.doelementfx",[this,e,t,n])}},getGroupTab:function(t){if(t.test(/^group/)||(t="group"+t),document.id(t).getParent().hasClass("tab-pane")){var e=document.id(t).getParent().id;return this.form.getElement("a[href=#"+e+"]").getParent()}return!1},hideGroupTab:function(t){var e=this.getGroupTab(t);!1!==e&&(G(e).hide(),e.hasClass("active")&&(e.getPrevious()?G(e.getPrevious().getFirst()).tab("show"):e.getNext()&&G(e.getNext().getFirst()).tab("show")))},selectGroupTab:function(t){var e=this.getGroupTab(t);!1!==e&&(e.hasClass("active")||G(e.getFirst()).tab("show"))},showGroupTab:function(t){var e=this.getGroupTab(t);!1!==e&&G(e).show()},watchTabs:function(){var i=this;G(this.form).on("click","*[data-role=fabrik_tab]",function(t){var e=t.target.id.match(/group(\d+)_tab/);1<e.length&&(e=e[1]),S.fireEvent("fabrik.form.tab.click",[i,e,t],500)})},watchClearSession:function(){if(0!==this.options.multipage_save){var e=this,i=G(this.form);i.find(".clearSession").on("click",function(t){t.preventDefault(),i.find("input[name=task]").val("removeSession"),e.clearForm(),e.form.submit()})}},createPages:function(){var t,i,o;if(this.isMultiPage()){this.options.pages.each(function(t,e){(i=G(document.createElement("div"))).attr({class:"page",id:"page_"+e}),o=G("#group"+t[0]),o.closest("div").hasClass("tab-pane")||(i.insertBefore(o),t.each(function(t){i.append(G("#group"+t))}))}),(t=this._getButton("Submit"))&&""===this.options.rowid&&(t.disabled="disabled",t.setStyle("opacity",.5));var e=this;G(this.form).on("click",".fabrikPagePrevious",function(t){e._doPageNav(t,-1)}),G(this.form).on("click",".fabrikPageNext",function(t){e._doPageNav(t,1)}),this.setPageButtons(),this.hideOtherPages()}},isMultiPage:function(){return 1<this.options.pages.getKeys().length},_doPageNav:function(t,e){var i,o,n=this;this.options.editable?("null"!==typeOf(this.form.getElement(".fabrikMainError"))&&this.form.getElement(".fabrikMainError").addClass("fabrikHide"),G(".tool-tip").css("top",0),i="index.php?option=com_fabrik&format=raw&task=form.ajax_validate&form_id="+this.id,!1!==this.options.lang&&(i+="&lang="+this.options.lang),S.loader.start(this.getBlock(),Joomla.JText._("COM_FABRIK_VALIDATING")),this.clearErrors(),o=G.extend({},this.getFormData(),{task:"form.ajax_validate",fabrik_ajax:"1",format:"raw"}),o=this._prepareRepeatsForAjax(o),G.ajax({url:i,method:this.options.ajaxmethod,data:o}).done(function(t){S.loader.stop(n.getBlock()),t=JSON.parse(t),-1!==e&&!1!==n._showGroupError(t,o)||(n.changePage(e),n.saveGroupsToDb()),G("html, body").animate({scrollTop:G(n.form).offset().top},300)})):this.changePage(e),t.preventDefault()},saveGroupsToDb:function(){var e,i,t,o,n=this,r=this.form.querySelector("input[name=format]"),s=this.form.querySelector("input[name=task]"),a=this.getBlock();0!==this.options.multipage_save&&(S.fireEvent("fabrik.form.groups.save.start",[this]),!1!==this.result?(e=r.value,i=s.value,this.form.querySelector("input[name=format]").value="raw",this.form.querySelector("input[name=task]").value="form.savepage",t="index.php?option=com_fabrik&format=raw&page="+this.currentPage,!1!==this.options.lang&&(t+="&lang="+this.options.lang),S.loader.start(a,"saving page"),(o=this.getFormData()).fabrik_ajax=1,G.ajax({url:t,method:this.options.ajaxmethod,data:o}).done(function(t){S.fireEvent("fabrik.form.groups.save.completed",[n]),!1!==n.result?(r.value=e,s.value=i,n.options.ajax&&S.fireEvent("fabrik.form.groups.save.end",[n,t]),S.loader.stop(a)):n.result=!0})):this.result=!0)},changePage:function(t){this.changePageDir=t,S.fireEvent("fabrik.form.page.change",[this,t]),!1!==this.result?(this.currentPage=this.currentPage.toInt(),0<=this.currentPage+t&&this.currentPage+t<this.options.pages.getKeys().length&&(this.currentPage=this.currentPage+t,this.pageGroupsVisible()||this.changePage(t)),this.setPageButtons(),G("#page_"+this.currentPage).css("display",""),this._setMozBoxWidths(),this.hideOtherPages(),S.fireEvent("fabrik.form.page.chage.end",[this,t]),S.fireEvent("fabrik.form.page.change.end",[this,t]),!1!==this.result||(this.result=!0)):this.result=!0},pageGroupsVisible:function(){var i=!1;return this.options.pages.get(this.currentPage).each(function(t){var e=G("#group"+t);0<e.length&&"none"!==e.css("display")&&(i=!0)}),i},hideOtherPages:function(){var i=parseInt(this.currentPage,10);this.options.pages.each(function(t,e){parseInt(e,10)!==i&&G("#page_"+e).hide()})},setPageButtons:function(){var e=this._getButton("Submit"),t=this.form.getElements(".fabrikPagePrevious");this.form.getElements(".fabrikPageNext").each(function(t){this.currentPage===this.options.pages.getKeys().length-1?("null"!==typeOf(e)&&(e.disabled="",e.setStyle("opacity",1)),t.disabled="disabled",t.setStyle("opacity",.5)):("null"===typeOf(e)||""!==this.options.rowid&&"0"!==this.options.rowid.toString()||(e.disabled="disabled",e.setStyle("opacity",.5)),t.disabled="",t.setStyle("opacity",1))}.bind(this)),t.each(function(t){0===this.currentPage?(t.disabled="disabled",t.setStyle("opacity",.5)):(t.disabled="",t.setStyle("opacity",1))}.bind(this))},destroyElements:function(){this.formElements.each(function(t){t.destroy()})},addElements:function(t){var o=[],e=0;for((t=$H(t)).each(function(t,i){t.each(function(t){if("array"===typeOf(t)){if("null"===typeOf(document.id(t[1])))return void fconsole('Fabrik form::addElements: Cannot add element "'+t[1]+'" because it does not exist in HTML.');var e=new window[t[0]](t[1],t[2]);o.push(this.addElement(e,t[1],i))}else if("object"===typeOf(t)){if("null"===typeOf(document.id(t.options.element)))return void fconsole('Fabrik form::addElements: Cannot add element "'+t.options.element+'" because it does not exist in HTML.');o.push(this.addElement(t,t.options.element,i))}else"null"!==typeOf(t)?fconsole("Fabrik form::addElements: Cannot add unknown element: "+t):fconsole("Fabrik form::addElements: Cannot add null element.")}.bind(this))}.bind(this)),e=0;e<o.length;e++)if("null"!==typeOf(o[e]))try{o[e].attachedToForm()}catch(t){fconsole(o[e].options.element+" attach to form:"+t)}S.fireEvent("fabrik.form.elements.added",[this])},addElement:function(t,e,i){var o="_ro"===(e=(e=t.getFormElementsKey(e)).replace("[]","")).substring(e.length-3,e.length);return t.form=this,t.groupid=i,this.formElements.set(e,t),S.fireEvent("fabrik.form.element.added",[this,e,t]),o&&(e=e.substr(0,e.length-3),this.formElements.set(e,t)),this.submitBroker.addElement(e,t),t},dispatchEvent:function(t,e,i,o){"string"===typeOf(o)&&(o=r.htmlDecode(o));var n=this.formElements.get(e);if(!n)Object.each(this.formElements,function(t){e===t.baseElementId&&(n=t)});n?""!==o?n.addNewEvent(i,o):S.debug&&fconsole("Fabrik form::dispatchEvent: Javascript empty for "+i+" event on: "+e):fconsole("Fabrik form::dispatchEvent: Cannot find element to add "+i+" event to: "+e)},action:function(t,e){this.formElements.get(e);Browser.exec("oEl."+t+"()")},triggerEvents:function(t){this.formElements.get(t).fireEvents(arguments[1])},watchValidation:function(t,e){var i=G("#"+t);!1!==this.options.ajaxValidation&&(0!==i.length?(i=this.formElements.get(t)).addAjaxValidation():fconsole("Fabrik form::watchValidation: Could not add "+e+' event because element "'+t+'" does not exist.'))},doElementValidation:function(t,e,i){var o;if(!1!==this.options.ajaxValidation&&(i="null"===typeOf(i)?"_time":i,"event"===typeOf(t)||"object"===typeOf(t)||"domevent"===typeOf(t)?(o=t.target.id,!0===e&&(o=document.id(t.target).getParent(".fabrikSubElementContainer").id)):o=t,"null"!==typeOf(document.id(o)))){!0===document.id(o).getProperty("readonly")||document.id(o).getProperty("readonly");var n=this.formElements.get(o);if((n||(o=o.replace(i,""),n=this.formElements.get(o)))&&n.shouldAjaxValidate())if(S.fireEvent("fabrik.form.element.validation.start",[this,n,t]),!1!==this.result){n.setErrorMessage(Joomla.JText._("COM_FABRIK_VALIDATING"),"fabrikValidating");var r=$H(this.getFormData());r.set("task","form.ajax_validate"),r.set("fabrik_ajax","1"),r.set("format","raw"),!1!==this.options.lang&&r.set("lang",this.options.lang),r=this._prepareRepeatsForAjax(r);var s=o;n.origId&&(s=n.origId+"_0"),n.options.repeatCounter=n.options.repeatCounter?n.options.repeatCounter:0;new Request({url:"",method:this.options.ajaxmethod,data:r,onComplete:function(t){this._completeValidaton(t,o,s)}.bind(this)}).send()}else this.result=!0}},_completeValidaton:function(t,e,i){if(t=JSON.parse(t),"null"===typeOf(t))return this._showElementError(["Oups"],e),void(this.result=!0);if(this.formElements.each(function(t,e){t.afterAjaxValidation()}),S.fireEvent("fabrik.form.element.validation.complete",[this,t,e,i]),!1!==this.result){var o=this.formElements.get(e);"null"!==typeOf(t.modified[i])&&(o.options.inRepeatGroup?o.update(t.modified[i][o.options.repeatCounter]):o.update(t.modified[i])),"null"!==typeOf(t.errors[i])?this._showElementError(t.errors[i][o.options.repeatCounter],e):this._showElementError([],e),this.options.toggleSubmit&&(this.options.mustValidate?(this.hasErrors.has(e)&&this.hasErrors.get(e)||(this.mustValidateEls[e]=!1),this.mustValidateEls.hasValue(!0)||this.toggleSubmit(!0)):this.toggleSubmit(0===this.hasErrors.getKeys().length))}else this.result=!0},_prepareRepeatsForAjax:function(i){return this.getForm(),"hash"===typeOf(i)&&(i=i.getClean()),this.form.getElements("input[name^=fabrik_repeat_group]").each(function(t){if(t.id.test(/fabrik_repeat_group_\d+_counter/)){var e=t.name.match(/\[(.*)\]/)[1];i["fabrik_repeat_group["+e+"]"]=t.get("value")}}),i},_showGroupError:function(o,t){var s,n=Array.from(this.options.pages.get(this.currentPage.toInt())),a=!1;return $H(t).each(function(t,r){if(r=r.replace(/\[(.*)\]/,"").replace(/%5B(.*)%5D/,""),this.formElements.has(r)){var e=this.formElements.get(r);if(n.contains(e.groupid.toInt())){if(o.errors[r])if(e.options.inRepeatGroup)o.errors[r].each(function(t,e){var i=r.replace(/_(\d+)$/,"_"+e),o=this.formElements.get(i),n="";"null"!==typeOf(t)&&(n=t.flatten().join("<br />")),""!==n?(s=this._showElementError(t,i),!1===a&&(a=s)):o.setErrorMessage("","")}.bind(this));else{var i="";"null"!==typeOf(o.errors[r])&&(i=o.errors[r].flatten().join("<br />")),""!==i?(s=this._showElementError(o.errors[r],r),!1===a&&(a=s)):e.setErrorMessage("","")}o.modified[r]&&e&&e.update(o.modified[r])}}}.bind(this)),a},_showElementError:function(t,e){var i="";"null"!==typeOf(t)&&(i=t.flatten().join("<br />"));var o=""===i?"fabrikSuccess":"fabrikError";return""===i?(delete this.hasErrors[e],i=Joomla.JText._("COM_FABRIK_SUCCESS")):this.hasErrors.set(e,!0),i="<span> "+i+"</span>",this.formElements.get(e).setErrorMessage(i,o),"fabrikSuccess"!==o},updateMainError:function(){var t;"null"!==typeOf(this.form.getElement(".fabrikMainError"))&&this.form.getElement(".fabrikMainError").set("html",this.options.error),0<(t=this.form.getElements(".fabrikError").filter(function(t,e){return!t.hasClass("fabrikMainError")})).length&&this.form.getElement(".fabrikMainError").hasClass("fabrikHide")&&this.showMainError(this.options.error),0===t.length&&this.hideMainError()},hideMainError:function(){if("null"!==typeOf(this.form.getElement(".fabrikMainError"))){var t=this.form.getElement(".fabrikMainError");myfx=new Fx.Tween(t,{property:"opacity",duration:500,onComplete:function(){t.addClass("fabrikHide")}}).start(1,0)}},showMainError:function(t){if(!(S.bootstrapped&&this.options.ajaxValidation||"null"===typeOf(this.form.getElement(".fabrikMainError")))){var e=this.form.getElement(".fabrikMainError");e.set("html",t),e.removeClass("fabrikHide"),myfx=new Fx.Tween(e,{property:"opacity",duration:500}).start(0,1)}},_getButton:function(t){if(this.getForm()){var e=this.form.getElement("input[type=button][name="+t+"]");return e||(e=this.form.getElement("input[type=submit][name="+t+"]")),e||(e=this.form.getElement("button[type=button][name="+t+"]")),e||(e=this.form.getElement("button[type=submit][name="+t+"]")),e}},watchSubmit:function(){var t=this._getButton("Submit"),e=this._getButton("apply");if(!t&&!e){if(!this.form.getElement("button[type=submit]"))return;t=this.form.getElement("button[type=submit]")}var i=this._getButton("delete"),o=this._getButton("Copy");i&&i.addEvent("click",function(t){if(!window.confirm(Joomla.JText._("COM_FABRIK_CONFIRM_DELETE_1")))return!1;var e=S.fireEvent("fabrik.form.delete",[this,this.options.rowid]).eventResults;if("null"!==typeOf(e)&&0!==e.length&&e.contains(!1))return t.stop(),!1;this.form.getElement("input[name=task]").value="form.delete",this.doSubmit(t,i)}.bind(this)),this.form.getElements("button[type=submit]").combine([e,t,o]).each(function(e){"null"!==typeOf(e)&&e.addEvent("click",function(t){this.doSubmit(t,e)}.bind(this))}.bind(this)),this.form.addEvent("submit",function(t){this.doSubmit(t)}.bind(this))},mockSubmit:function(t){t=void 0!==t?t:"Submit";var e=this._getButton(t);e||(e=new Element("button",{name:t,type:"submit"})),this.doSubmit(new Event.Mock(e,"click"),e)},doSubmit:function(d,h){if(this.submitBroker.enabled())return d.stop(),!1;this.toggleSubmit(!1),this.submitBroker.submit(function(){if(this.options.showLoader&&S.loader.start(this.getBlock(),Joomla.JText._("COM_FABRIK_LOADING")),S.fireEvent("fabrik.form.submit.start",[this,d,h]),!1===this.result)return this.result=!0,d.stop(),S.loader.stop(this.getBlock()),this.updateMainError(),void this.toggleSubmit(!0);if(1<this.options.pages.getKeys().length&&this.form.adopt(new Element("input",{name:"currentPage",value:this.currentPage.toInt(),type:"hidden"})),hiddenElements=[],G.each(this.formElements,function(t,e){e.element&&0!==G(e.element).closest(".fabrikHide").length&&hiddenElements.push(t)}),this.form.adopt(new Element("input",{name:"hiddenElements",value:JSON.stringify(hiddenElements),type:"hidden"})),this.options.ajax&&this.form){this.options.showLoader||S.loader.start(this.getBlock(),Joomla.JText._("COM_FABRIK_LOADING"));var t=$H(this.getFormData());(t=this._prepareRepeatsForAjax(t))[h.name]=h.value,"Copy"===h.name&&(t.Copy=1,d.stop()),t.fabrik_ajax="1",t.format="raw";new Request.JSON({url:this.form.action,data:t,method:this.options.ajaxmethod,onError:function(t,e){fconsole(t+": "+e),this.showMainError(e),S.loader.stop(this.getBlock(),"Error in returned JSON"),this.toggleSubmit(!0)}.bind(this),onFailure:function(t){fconsole(t),S.loader.stop(this.getBlock(),"Ajax failure"),this.toggleSubmit(!0)}.bind(this),onComplete:function(t,e){if(this.toggleSubmit(!0),"null"===typeOf(t))return S.loader.stop(this.getBlock(),"Error in returned JSON"),void fconsole("error in returned json",t,e);G(this.form.getElements("[data-role=fabrik_tab]")).removeClass("fabrikErrorGroup");var o=!1;if(void 0!==t.errors&&$H(t.errors).each(function(t,e){if(0<t.flatten().length&&(o=!0,this.formElements.has(e)))if(this.formElements[e].options.inRepeatGroup){for(d=0;d<t.length;d++)if(0<t[d].flatten().length){var i=e.replace(/(_\d+)$/,"_"+d);this._showElementError(t[d],i)}}else this._showElementError(t,e)}.bind(this)),this.updateMainError(),!1===o){var i=!1;""===this.options.rowid&&"apply"!==h.name&&(i=!0),S.loader.stop(this.getBlock());var n="null"!==typeOf(t.msg)&&void 0!==t.msg&&""!==t.msg?t.msg:Joomla.JText._("COM_FABRIK_FORM_SAVED");if(!0!==t.baseRedirect)if(i=t.reset_form,void 0!==t.url)if("popup"===t.redirect_how){var r=t.width?t.width:400,s=t.height?t.height:400,a=t.x_offset?t.x_offset:0,l=t.y_offset?t.y_offset:0,u=t.title?t.title:"";S.getWindow({id:"redirect",type:"redirect",contentURL:t.url,caller:this.getBlock(),height:s,width:r,offset_x:a,offset_y:l,title:u})}else"samepage"===t.redirect_how?window.open(t.url,"_self"):"newpage"===t.redirect_how&&window.open(t.url,"_blank");else t.suppressMsg||alert(n);else i=void 0!==t.reset_form?t.reset_form:i,t.suppressMsg||alert(n);S.fireEvent("fabrik.form.submitted",[this,t]),"apply"!==h.name&&(i&&this.clearForm(),S.Windows[this.options.fabrik_window_id]&&S.Windows[this.options.fabrik_window_id].close()),S.fireEvent("fabrik.form.submitted.end",[this,t])}else S.fireEvent("fabrik.form.submit.failed",[this,t]),S.loader.stop(this.getBlock(),Joomla.JText._("COM_FABRIK_VALIDATION_ERROR"))}.bind(this)}).send()}S.fireEvent("fabrik.form.submit.end",[this]),!1===this.result?(this.result=!0,d.stop(),this.updateMainError()):this.options.ajax?(d.stop(),S.fireEvent("fabrik.form.ajax.submit.end",[this])):"null"!==typeOf(h)?(new Element("input",{type:"hidden",name:h.name,value:h.value}).inject(this.form),this.form.submit()):d.stop()}.bind(this)),d.stop()},getFormData:function(t){(t="null"===typeOf(t)||t)&&this.formElements.each(function(t,e){t.onsubmit()}),this.getForm();var e=this.form.toQueryString(),n={};e=e.split("&");var i=$H({});e.each(function(t){var e=(t=t.split("="))[0];"[]"===(e=decodeURI(e)).substring(e.length-2)&&(e=e.substring(0,e.length-2),i.has(e)?i.set(e,i.get(e)+1):i.set(e,0),e=e+"["+i.get(e)+"]"),n[e]=t[1]});this.formElements.getKeys();return this.formElements.each(function(t,i){if("fabrikfileupload"===t.plugin&&(n[i]=t.get("value")),"null"===typeOf(n[i])){var o=!1;$H(n).each(function(t,e){(e=(e=unescape(e)).replace(/\[(.*)\]/,""))===i&&(o=!0)}.bind(this)),o||(n[i]="")}}.bind(this)),n},getFormElementData:function(){var i={};return this.formElements.each(function(t,e){t.element&&(i[e]=t.getValue(),i[e+"_raw"]=i[e])}.bind(this)),i},watchGroupButtons:function(){var n=this;G(this.form).on("click",".deleteGroup",t(this.options.debounceDelay,!0,function(t,e){if(t.preventDefault(),!n.addingOrDeletingGroup){n.addingOrDeletingGroup=!0;var i=t.target.getParent(".fabrikGroup"),o=t.target.getParent(".fabrikSubGroup");n.deleteGroup(t,i,o),n.addingOrDeletingGroup=!1}})),G(this.form).on("click",".addGroup",t(this.options.debounceDelay,!0,function(t,e){t.preventDefault(),n.addingOrDeletingGroup||(n.addingOrDeletingGroup=!0,n.duplicateGroup(t,!0),n.addingOrDeletingGroup=!1)})),this.form.addEvent("click:relay(.fabrikSubGroup)",function(t,e){var i=e.getElement(".fabrikGroupRepeater");i&&(e.addEvent("mouseenter",function(t){i.fade(1)}),e.addEvent("mouseleave",function(t){i.fade(.2)}))}.bind(this))},mockDuplicateGroup:function(t){var e=this.form.getElement("#group"+t+" .addGroup");if("null"===typeOf(e))return!1;var i=new Event.Mock(e,"click");return this.duplicateGroup(i,!1),!0},duplicateGroupsToMin:function(){this.form&&(S.fireEvent("fabrik.form.group.duplicate.min",[this]),Object.each(this.options.group_repeats,function(t,e){if("null"!==typeOf(this.options.minRepeat[e])&&1===t.toInt()){var i,o,n,r,s,a,l,u=this.form.getElement("#fabrik_repeat_group_"+e+"_counter"),d=this.form.getElement("#fabrik_repeat_group_"+e+"_added").value;if("null"!==typeOf(u)){1===(i=o=u.value.toInt())&&(a=this.form.getElement("#"+this.options.group_pk_ids[e]+"_0"),"1"!==d&&"null"!==typeOf(a)&&""===a.value&&(o=0));var h,p=this.options.minRepeat[e].toInt(),f=this.options.maxRepeat[e].toInt(),m=this.form.getElement("#group"+e);if(0===p&&0===o)r=this.form.getElement("#group"+e+" .deleteGroup"),l="null"!==typeOf(r)&&new Event.Mock(r,"click"),h=m.getElement(".fabrikSubGroup"),this.deleteGroup(l,m,h);else if(i<p){if(n=this.form.getElement("#group"+e+" .addGroup"),"null"!==typeOf(n)){var c=new Event.Mock(n,"click");for(s=i;s<p;s++)this.duplicateGroup(c,!1)}}else if(0<f&&f<i)for(s=i;f<s;s--){var g=G(this.form.getElements("#group"+e+" .deleteGroup")).last()[0],b=G(g).find("[data-role=fabrik_delete_group]")[0];if(h=G(m.getElements(".fabrikSubGroup")).last()[0],"null"!==typeOf(b)){var E=new Event.Mock(b,"click");this.deleteGroup(E,m,h)}}this.setRepeatGroupIntro(m,e)}}}.bind(this)))},deleteGroup:function(t,e,i){if(S.fireEvent("fabrik.form.group.delete",[this,t,e]),!1!==this.result){t&&t.preventDefault();var o=0,n=G(t.target).find("[data-role=fabrik_delete_group]").addBack("[data-role=fabrik_delete_group]")[0];e.getElements(".deleteGroup").each(function(t,e){G(t).find("[data-role=fabrik_delete_group]")[0]===n&&(o=e)}.bind(this));var r=e.id.replace("group","");if(document.id("fabrik_repeat_group_"+r+"_counter").get("value").toInt()<=this.options.minRepeat[r]&&0!==this.options.minRepeat[r]){if(""!==this.options.minMaxErrMsg[r]){var s=this.options.minMaxErrMsg[r];s=(s=s.replace(/\{min\}/,this.options.minRepeat[r])).replace(/\{max\}/,this.options.maxRepeat[r]),alert(s)}}else if(delete this.duplicatedGroups.i,"0"!==document.id("fabrik_repeat_group_"+r+"_counter").value){var a=e.getElements(".fabrikSubGroup");if(this.subGroups.set(r,i.clone()),a.length<=1)this.hideLastGroup(r,i),this.formElements.each(function(t,e){t.groupid===r&&"null"!==typeOf(t.element)&&this.removeMustValidate(t)}.bind(this)),document.id("fabrik_repeat_group_"+r+"_added").value="0",S.fireEvent("fabrik.form.group.delete.end",[this,t,r,o]);else{var l=i.getPrevious();1<a.length&&i.dispose(),this.formElements.each(function(t,e){"null"!==typeOf(t.element)&&"null"===typeOf(document.id(t.element.id))&&(t.decloned(r),delete this.formElements[e])}.bind(this)),a=e.getElements(".fabrikSubGroup");var u={};if(this.formElements.each(function(t,e){t.groupid===r&&(u[e]=t.decreaseName(o))}.bind(this)),$H(u).each(function(t,e){e!==t&&(this.formElements[t]=this.formElements[e],delete this.formElements[e])}.bind(this)),S.fireEvent("fabrik.form.group.delete.end",[this,t,r,o]),l){var d=document.id(window).getScroll().y,h=l.getCoordinates();if(h.top<d){var p=h.top;this.winScroller.start(0,p)}}}document.id("fabrik_repeat_group_"+r+"_counter").value=document.id("fabrik_repeat_group_"+r+"_counter").get("value").toInt()-1,this.repeatGroupMarkers.set(r,this.repeatGroupMarkers.get(r)-1),this.setRepeatGroupIntro(e,r)}}else this.result=!0},hideLastGroup:function(t,e){var i=this.options.noDataMsg[t];""===i&&(i=Joomla.JText._("COM_FABRIK_NO_REPEAT_GROUP_DATA"));var o=e.getElement(".fabrikSubGroupElements"),n=new Element("div",{class:"fabrikNotice alert"}).appendText(i);if("null"===typeOf(o)){var r=(o=e).getElement(".addGroup");if("null"!==typeOf(r)){var s=o.getParent("table").getElements('*[data-role="fabrik-group-repeaters"]').getLast();s||(s=o.getParent("table").getElements("thead th").getLast()),r.inject(s)}}o.setStyle("display","none"),n.inject(o,"after")},isFirstRepeatSubGroup:function(t){return 1===t.getElements(".fabrikSubGroup").length&&t.getElement(".fabrikNotice")},getSubGroupToClone:function(t){var e=document.id("group"+t).getElement(".fabrikSubGroup");e||(e=this.subGroups.get(t));var i=null,o=!1;return this.duplicatedGroups.has(t)&&(o=!0),o?i=e?e.cloneNode(!0):this.duplicatedGroups.get(t):(i=e.cloneNode(!0),this.duplicatedGroups.set(t,i)),i},repeatGetChecked:function(t){var e=[];return t.getElements(".fabrikinput").each(function(t){"radio"===t.type&&t.getProperty("checked")&&e.push(t)}),e},duplicateGroup:function(t,e){var a,l;if(e=void 0===e||e,S.fireEvent("fabrik.form.group.duplicate",[this,t]),!1!==this.result){t&&t.preventDefault();var i=t.target.getParent(".fabrikGroup").id.replace("group",""),o=i.toInt(),n=document.id("group"+i),u=this.repeatGroupMarkers.get(i),r=document.id("fabrik_repeat_group_"+i+"_counter").get("value").toInt();if(r>=this.options.maxRepeat[i]&&0!==this.options.maxRepeat[i]){if(""!==this.options.minMaxErrMsg[i]){var s=this.options.minMaxErrMsg[i];s=(s=s.replace(/\{min\}/,this.options.minRepeat[i])).replace(/\{max\}/,this.options.maxRepeat[i]),window.alert(s)}}else{if(document.id("fabrik_repeat_group_"+i+"_counter").value=r+1,this.isFirstRepeatSubGroup(n)){var d=n.getElements(".fabrikSubGroup"),h=d[0].getElement(".fabrikSubGroupElements");if("null"===typeOf(h))n.getElement(".fabrikNotice").dispose(),h=d[0],n.getElement(".addGroup").inject(h.getElement("td.fabrikGroupRepeater")),h.setStyle("display","");else d[0].getElement(".fabrikNotice").dispose(),d[0].getElement(".fabrikSubGroupElements").show();return this.repeatGroupMarkers.set(i,this.repeatGroupMarkers.get(i)+1),document.id("fabrik_repeat_group_"+i+"_added").value="1",void this.formElements.each(function(t,e){t.groupid===i&&"null"!==typeOf(t.element)&&this.addMustValidate(t)}.bind(this))}var p=this.getSubGroupToClone(i),f=this.repeatGetChecked(n),m=n.getElement("table.repeatGroupTable");m?(m.getElement("tbody")&&(m=m.getElement("tbody")),m.appendChild(p)):n.appendChild(p),f.each(function(t){t.setProperty("checked",!0)}),this.subelementCounter=0;var c=[],g=!1,b=p.getElements(".fabrikinput"),E=null;this.formElements.each(function(r){var s=!1;a=null;if(b.each(function(t){g=r.hasSubElements(),l=t.getParent(".fabrikSubElementContainer");var e=g&&l?l.id:t.id,i=r.getCloneName();if(e===i||e===i+"-auto-complete"){if(E=t,s=!0,g)0,a=t.getParent(".fabrikSubElementContainer"),document.id(e).getElement("input")&&t.cloneEvents(document.id(e).getElement("input"));else{t.cloneEvents(r.element);var o=Array.from(r.element.id.split("_"));o.splice(o.length-1,1,u),t.id=o.join("_");var n=t.getParent(".fabrikElementContainer").getElement("label");n&&n.setProperty("for",t.id)}"null"!==typeOf(t.name)&&(t.name=t.name.replace("[0]","["+u+"]"))}}.bind(this)),s){if(g&&"null"!==typeOf(a)){var t=Array.from(r.options.element.split("_"));t.splice(t.length-1,1,u),a.id=t.join("_")}r.options.element;var e=r.unclonableProperties(),i=new CloneObject(r,!0,e);i.container=null,i.options.repeatCounter=u,g&&"null"!==typeOf(a)?(i.element=document.id(a),i.cloneUpdateIds(a.id),i.options.element=a.id,i._getSubElements()):i.cloneUpdateIds(E.id),c.push(i)}}.bind(this)),c.each(function(t){t.cloned(u);var e=new RegExp(this.options.group_pk_ids[o]);!this.options.group_copy_element_values[o]||this.options.group_copy_element_values[o]&&t.element.name&&t.element.name.test(e)?t.reset():t.resetEvents()}.bind(this));var v={};if(v[i]=c,this.addElements(v),e){var k=G(window).height(),_=document.id(window).getScroll().y,y=p.getCoordinates();if(y.bottom>_+k){var w=y.bottom-k;this.winScroller.start(0,w)}}new Fx.Tween(p,{property:"opacity",duration:500}).set(0);p.fade(1),S.fireEvent("fabrik.form.group.duplicate.end",[this,t,i,u]),this.setRepeatGroupIntro(n,i),this.repeatGroupMarkers.set(i,this.repeatGroupMarkers.get(i)+1),this.addedGroups.push("group"+i)}}else this.result=!0},setRepeatGroupIntro:function(t,e){var i=this.options.group_repeat_intro[e],o="";t.getElements('*[data-role="group-repeat-intro"]').each(function(t,e){o=i.replace("{i}",e+1),this.formElements.each(function(t){if(!t.options.inRepeatGroup){var e=new RegExp("{"+t.element.id+"}");o=o.replace(e,t.getValue())}}),t.set("html",o)}.bind(this))},update:function(i){if(S.fireEvent("fabrik.form.update",[this,i.data]),!1!==this.result){var o=arguments[1]||!1,n=i.data;if(this.getForm(),this.form){var t=this.form.getElement("input[name=rowid]");t&&n.rowid&&(t.value=n.rowid)}this.formElements.each(function(t,e){"null"===typeOf(n[e])&&"_ro"===e.substring(e.length-3,e.length)&&(e=e.substring(0,e.length-3)),"null"===typeOf(n[e])?i.id!==this.id||o||t.update(""):t.update(n[e])}.bind(this))}else this.result=!0},reset:function(){this.addedGroups.each(function(t){var e=document.id(t).findClassUp("fabrikGroup").id.replace("group","");document.id("fabrik_repeat_group_"+e+"_counter").value=document.id("fabrik_repeat_group_"+e+"_counter").get("value").toInt()-1,t.remove()}),this.addedGroups=[],S.fireEvent("fabrik.form.reset",[this]),!1!==this.result?this.formElements.each(function(t,e){t.reset()}.bind(this)):this.result=!0},showErrors:function(t){if(t.id===this.id){var e=new Hash(t.errors);0<e.getKeys().length&&("null"!==typeOf(this.form.getElement(".fabrikMainError"))&&(this.form.getElement(".fabrikMainError").set("html",this.options.error),this.form.getElement(".fabrikMainError").removeClass("fabrikHide")),e.each(function(t,e){if("null"!==typeOf(document.id(e+"_error")))for(var i=document.id(e+"_error"),o=(new Element("span"),0);o<t.length;o++)for(var n=0;n<t[o].length;n++)new Element("div").appendText(t[o][n]).inject(i);else fconsole(e+"_error not found (form show errors)")}))}},appendInfo:function(i){this.formElements.each(function(t,e){t.appendInfo&&t.appendInfo(i,e)}.bind(this))},clearForm:function(){this.getForm(),this.form&&(this.formElements.each(function(t,e){e===this.options.primaryKey&&(this.form.getElement("input[name=rowid]").value=""),t.update("")}.bind(this)),this.form.getElements(".fabrikError").empty(),this.form.getElements(".fabrikError").addClass("fabrikHide"))},clearErrors:function(){G(this.form).find(".fabrikError").removeClass("fabrikError").removeClass("error").removeClass("has-error"),this.hideTips()},hideTips:function(){this.elements.each(function(t){t.removeTipMsg()})},scrollTips:function(){var e,i,o,n=this,r=G(n.form).closest(".fabrikWindow"),s=r.find(".itemContent"),a=function(){var t=r.data("origPosition");void 0===t&&(t=r.position(),r.data("origPosition",t)),o=r.position(),e=t.top-o.top+s.scrollTop(),i=t.left-o.left+s.scrollLeft(),n.elements.each(function(t){t.moveTip(e,i)})};s.on("scroll",function(){a()}),S.on("fabrik.window.resized",function(t){0<r.length&&t===r[0]&&a()})},stopEnterSubmitting:function(){var i=this.form.getElements("input.fabrikinput");i.each(function(t,e){t.addEvent("keypress",function(t){"enter"===t.key&&(t.stop(),i[e+1]&&i[e+1].focus(),e===i.length-1&&this._getButton("Submit").focus())}.bind(this))}.bind(this))},getSubGroupCounter:function(t){},addMustValidate:function(t){this.options.ajaxValidation&&this.options.toggleSubmit&&(this.mustValidateEls.set(t.element.id,t.options.mustValidate),t.options.mustValidate&&(this.options.mustValidate=!0,this.toggleSubmit(!1)))},removeMustValidate:function(t){this.options.ajaxValidation&&this.options.toggleSubmit&&(delete this.mustValidateEls[t.element.id],t.options.mustValidate&&(this.mustValidateEls.hasValue(!0)||this.toggleSubmit(!0)))},toggleSubmit:function(t){var e=this._getButton("Submit");"null"!==typeOf(e)&&(!0===t?(e.disabled="",e.setStyle("opacity",1),""!==this.options.toggleSubmitTip&&(G(this.form).find(".fabrikSubmitWrapper").tooltip("destroy"),this.toggleSubmitTipAdded=!1)):(e.disabled="disabled",e.setStyle("opacity",.5),""!==this.options.toggleSubmitTip&&(this.toggleSubmitTipAdded||(G(this.form).find(".fabrikSubmitWrapper").tooltip(),this.toggleSubmitTipAdded=!0))),S.fireEvent("fabrik.form.togglesubmit",[this,t]))},addPlugins:function(t){var i=this;G.each(t,function(t,e){e.form=i}),this.plugins=t}});return S.form=function(t,e,i){var o=new n(e,i);return S.addBlock(t,o),o},n});