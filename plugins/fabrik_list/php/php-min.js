/*! Fabrik */
define(["jquery","fab/list-plugin"],function(jQuery,FbListPlugin){var FbListPHP=new Class({Extends:FbListPlugin,initialize:function(a){this.parent(a)},buttonAction:function(event){var additional_data=this.options.additional_data,hdata=$H({}),rowIndexes=[],ok;this.list.getForm().getElements("input[name^=ids]").each(function(a){if(a.checked){ok=!0;var b=a.name.match(/ids\[(\d+)\]/)[1];rowIndexes.push(b),additional_data&&(hdata.has(b)||hdata.set(b,$H({})),hdata[b].rowid=a.value,additional_data.split(",").each(function(c){var d=a.getParent(".fabrik_row").getElements("td.fabrik_row___"+c)[0].innerHTML;hdata[b][c]=d}))}});for(var rows=[],g=0;g<this.list.options.data.length;g++)for(var r=0;r<this.list.options.data[g].length;r++){var row=this.list.options.data[g][r].data;-1!==rowIndexes.indexOf(row.__pk_val)&&rows.push(row)}if(additional_data&&(this.list.getForm().getElement("input[name=fabrik_listplugin_options]").value=Json.encode(hdata)),""!==this.options.js_code){var result=eval("(function() {"+this.options.js_code+"}())");if(result===!1)return}this.list.submit("list.doPlugin")}});return FbListPHP});