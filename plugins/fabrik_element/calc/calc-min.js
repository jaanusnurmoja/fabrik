/*! Fabrik */
define(["jquery","fab/element"],function(jQuery,FbElement){return window.FbCalc=new Class({Extends:FbElement,initialize:function(a,b){this.setPlugin("calc"),this.parent(a,b)},attachedToForm:function(){this.options.ajax&&(this.options.observe.each(function(a){this.addObserveEvent(a)}.bind(this)),this.options.calcOnLoad&&this.calc(),Fabrik.addEvent("fabrik.cdd.update",function(a){a.hasSubElements()&&-1!==jQuery.inArray(a.baseElementId,this.options.observe)&&this.addObserveEvent(a.baseElementId)}.bind(this))),this.parent()},addObserveEvent:function(a){var b,c;""!==a&&(this.form.formElements[a]?this.form.formElements[a].addNewEventAux(this.form.formElements[a].getChangeEvent(),function(a){this.calc(a)}.bind(this)):this.options.canRepeat?(b=a+"_"+this.options.repeatCounter,this.form.formElements[b]&&this.form.formElements[b].addNewEventAux(this.form.formElements[b].getChangeEvent(),function(a){this.calc(a)}.bind(this))):this.form.repeatGroupMarkers.each(function(d){for(b="",c=0;d>c;c++)b=a+"_"+c,this.form.formElements[b]&&this.form.formElements[b].addNewEvent(this.form.formElements[b].getChangeEvent(),function(a){this.calc(a)}.bind(this))}.bind(this)))},calc:function(){var formData=this.form.getFormElementData(),testData=$H(this.form.getFormData(!1));testData.each(function(a,b){(b.test(/\[\d+\]$/)||b.test(/^fabrik_vars/))&&(formData[b]=a)}.bind(this)),$H(formData).each(function(a,b){var c=this.form.formElements.get(b);c&&c.options.inRepeatGroup&&c.options.joinid===this.options.joinid&&c.options.repeatCounter===this.options.repeatCounter&&(formData[c.options.fullName]=a,formData[c.options.fullName+"_raw"]=formData[b+"_raw"])}.bind(this));var data={option:"com_fabrik",format:"raw",task:"plugin.pluginAjax",plugin:"calc",method:"ajax_calc",element_id:this.options.id,formid:this.form.id};data=Object.append(formData,data),Fabrik.loader.start(this.element.getParent(),Joomla.JText._("COM_FABRIK_LOADING")),new Request.HTML({url:"",method:"post",data:data,onSuccess:function(tree,elements,r,scripts){Fabrik.loader.stop(this.element.getParent()),this.update(r),eval(scripts),this.options.validations&&this.form.doElementValidation(this.options.element),this.element.fireEvent("change",new Event.Mock(this.element,"change")),Fabrik.fireEvent("fabrik.calc.update",[this,r])}.bind(this)}).send()},cloned:function(a){this.parent(a),this.attachedToForm()},update:function(a){this.getElement()&&(this.element.innerHTML=a,this.options.value=a)},getValue:function(){return this.element?this.options.value:!1}}),window.FbCalc});