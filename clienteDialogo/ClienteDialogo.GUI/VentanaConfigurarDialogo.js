
$(function(){$("#btnGuardar").button();$("#btnAgregarReglaPredefinida").button();$("#btnAgregarTodasPredefinida").button();$("#btnCambiarFacilitador").button();$("#btnAgregarUsuario").button();$("#tabs").tabs({selected:0,show:function(event,ui){if(ui.index==1){$("#dgReglas").dataTable().fnAdjustColumnSizing(true);}
if(ui.index==2){$("#dgUsuarios").dataTable().fnAdjustColumnSizing(true);}}});{if(opener.VentanaNuevoDialogo!=null){_vtn=new VentanaConfigurarDialogo();_vtn.setControlador(opener.me.controladorDialogo);}
else{_vtn=new VentanaConfigurarDialogo();_vtn._modoEdicion=true;_vtn.setControlador(opener.Controlador);}}});function VentanaConfigurarDialogo(){me=this;this.controlador;this._modoEdicion=false;this.initializeComponents();document.title="Configuración de diálogo.";$("#cmbFacilitador").prop("disabled","disabled");$("#btnCambiarFacilitador").prop("disabled","disabled");$("#txtNombreUsuario").prop("disabled","disabled");$("#btnAgregarUsuario").prop("disabled","disabled");}
function obtieneDatos(){return $("#btnGuardar").val();}
VentanaConfigurarDialogo.prototype.initializeComponents=function(){$("#cmbPerfilIntervencion").change(function(){me.cmbPerfilIntervencion_SelectionChanged(this);});$("#btnGuardar").click(function(){});$("#btnAgregarReglaPredefinida").click(function(){me.btnAgregarReglaPredefinida_Click(this);});$("#btnAgregarTodasPredefinida").click(function(){me.btnAgregarTodasPredefinida_Click(this);});$("#btnAgregarUsuario").click(function(){me.btnAgregarUsuario_Click(this);});$("#btnCambiarFacilitador").click(function(){me.btnCambiarFacilitador_Click(this);});$("#btnGuardar").click(function(){me.btnGuardar_Click(this);});}
VentanaConfigurarDialogo.prototype.verificarRestricciones=function(){return true;}
VentanaConfigurarDialogo.prototype.verificarReglas=function(){return true;}
VentanaConfigurarDialogo.prototype.verificarBalances=function(){var _tablaBalance=$("#dgBalance").dataTable().fnGetNodes();var _total=0;for(var i=0;i<_tablaBalance.length;i++){_total+=new Number(_tablaBalance[i].children[2].innerHTML);var tolerancia=new Number(_tablaBalance[i].children[3].innerHTML);if(tolerancia<0||tolerancia>100){notificar("El valor de la tolerancia debe estar entre 0 y 100");return false;}}
if(_total!=100){notificar("La suma de los balances(Porcentajes) debe ser igual a 100%");return false;}
return true;}
VentanaConfigurarDialogo.prototype.btnGuardar_Click=function(sender){if(!me.verificarBalances()){return;}
if(!me.verificarReglas()){return;}
if(!me.verificarRestricciones()){return;}
var _dialog=me.controlador.dialogoActual;{var _movSeleccionada;for(var i=0;i<me.controlador.categoriasActuales.length;i++){if($("#cmbPerfilIntervencion option:selected").val()==me.controlador.categoriasActuales[i].nombre){_movSeleccionada=me.controlador.categoriasActuales[i];}}
_dialog.categoria=_movSeleccionada;me.controlador.categoriaSeleccionada=_movSeleccionada;me.controlador.tipodeMovidasActuales=_movSeleccionada.movidas;}
{var _bal=new Array();i=0;var _dv=$("#dgBalance").dataTable().fnGetNodes();for(var j=0;j<_movSeleccionada.movidas.length;j++){var _row=new Array();for(var k=0;k<_dv.length;k++){if(_movSeleccionada.movidas[j].Nombre==_dv[k].childNodes[0].innerHTML){_row.push($("#dgBalance").dataTable().fnGetNodes(k));}}
if(_row.length>0){var _nuevo=new Balance();_nuevo.movida=_movSeleccionada.movidas[j];_nuevo.valor=new Number(_row[0].children[2].innerHTML);_nuevo.valorTolerancia=new Number(_row[0].children[3].innerHTML);_bal[i++]=_nuevo;}}
me.controlador.balanceActual=_bal;}
{try{var _dvRegla=$("#dgReglas").dataTable().fnGetNodes();var _reglas=new Array();for(j=0;j<_dvRegla.length;j++){if(!me.existeRegla(_dvRegla[j].children[0].innerHTML)){var _nueva=new Regla();_nueva.textoRegla=_dvRegla[j].children[0].innerHTML;_reglas.push(_nueva);}}
if(_reglas.length==0){var _respaldoreglas=me.controlador.reglasActuales;me.controlador.reglasActuales=[];}else
for(j=0;j<_reglas.length;j++){me.controlador.reglasActuales.push(_reglas[j]);}}catch(ex){alert(ex);}
if(me.getModoEdicion()){var _exito=me.controlador.guardarConfiguracionDialogo();if(_exito.reglas&&_exito.balance)
notificar("Reglas y balance guardados exitosamente.");else{if(_exito.reglas)
notificar("Reglas guardadas.");if(_exito.balance)
notificar("Balance actualizado.");}
me.controlador.reglasActuales=_respaldoreglas;}else{if(opener.VentanaNuevoDialogo!=null){opener.vnd.actualizarConfiguracion();opener.focus();window.close();}}}}
VentanaConfigurarDialogo.prototype.existeRegla=function(regla){for(var k=0;k<me.controlador.reglasActuales.length;k++){if(me.controlador.reglasActuales[k].textoRegla==regla)
return true;}
return false;}
VentanaConfigurarDialogo.prototype.btnCambiarFacilitador_Click=function(sender){}
VentanaConfigurarDialogo.prototype.btnAgregarUsuario_Click=function(sender){}
VentanaConfigurarDialogo.prototype.btnAgregarTodasPredefinida_Click=function(sender){try{var _reglas=new Array();var _cmbReglas=$("#cmbReglasPredefinidas option");for(var i=0;i<me.controlador.reglasDisponibles.length;i++){if(me.controlador.reglasDisponibles[i]!=null){for(var j=0;j<_cmbReglas.length;j++){if(_cmbReglas[j].innerHTML==me.controlador.reglasDisponibles[i].textoRegla){_reglas[i]=me.controlador.reglasDisponibles[i];}}}}
for(var i=0;i<_reglas.length;i++){me.agregarRegla(_reglas[i]);}}catch(ex){alert(ex);}}
VentanaConfigurarDialogo.prototype.btnAgregarReglaPredefinida_Click=function(sender){try{var _regla;for(var i=0;i<me.controlador.reglasDisponibles.length;i++){if($("#cmbReglasPredefinidas option:selected").val()==me.controlador.reglasDisponibles[i].textoRegla){_regla=me.controlador.reglasDisponibles[i];}}
me.agregarRegla(_regla);}catch(ex){}}
VentanaConfigurarDialogo.prototype.agregarRegla=function(regla){try{var _agregarRegla=true;var _tabla;_tabla=$("#dgReglas").dataTable().fnGetNodes();for(var i=0;i<_tabla.length;i++){if(_tabla[i].textContent==regla.textoRegla){_agregarRegla=false;}}
if(_agregarRegla){var _nueva=new Array();_nueva[0]=_tabla.length+1;_nueva[1]=regla.textoRegla;$("#dgReglas").dataTable().fnAddData([_nueva]);}}catch(ex){}}
VentanaConfigurarDialogo.prototype.cmbPerfilIntervencion_SelectionChanged=function(sender){try{var _movSeleccionada=new CategoriaMovida();for(var i=0;i<me.controlador.categoriasActuales.length;i++){if(me.controlador.categoriasActuales[i].nombre==$("#cmbPerfilIntervencion option:selected").val()){_movSeleccionada=me.controlador.categoriasActuales[i];$("#lblDescripcion").html(_movSeleccionada.descripcion);}}
me.crearEstructuraTablaBalance();var _tabla=new Array();var _balance=me.controlador.balanceActual;if(_movSeleccionada.movidas!=undefined&&_movSeleccionada.movidas.length>0){for(var i=0;i<_movSeleccionada.movidas.length;i++){var _n=new Array();_n[0]=_movSeleccionada.movidas[i].IdMovida;_n[1]=_movSeleccionada.movidas[i].Nombre;_n[2]=_movSeleccionada.movidas[i].descripcion;if(_balance==null||_balance.length==0){_n[3]=0;_n[4]=0.0;}
else{if(me.getModoEdicion()){for(j=0;j<_balance.length;j++){if(_balance[j].movida.IdMovida==_n[0].toString()){_n[3]=_balance[j].valor;_n[4]=_balance[j].valorTolerancia;}}}else{for(j=0;j<_balance.length;j++){if(_balance[j].movida.Nombre==_n[1]){_n[3]=_balance[j].valor;_n[4]=_balance[j].valorTolerancia;}}}}
_tabla.push(_n);}
$("#dgBalance").dataTable().fnClearTable();$("#dgBalance").dataTable().fnAddData(_tabla);$(".edit").editable(function(value,settings){return value;},{type:"text",onblur:'submit',event:'dblclick',placeholder:''});}else{if(_movSeleccionada.movidas==undefined)
$("#lblDescripcion").html("");var _tabla=new Array();_tabla[0]=[null,null,null,null,null];$("#dgBalance").dataTable().fnClearTable();$("#dgBalance").dataTable().fnAddData(_tabla);}}catch(ex){}}
VentanaConfigurarDialogo.prototype.crearEstructuraTablaBalance=function(){var p=document.getElementById("dgBalance");if(!$.fn.DataTable.fnIsDataTable(p)){$("#dgBalance").dataTable({"bJQueryUI":true,"bPaginate":false,"bScrollInfinite":true,"bScrollCollapse":true,"sScrollY":"200px","bServerSide":false,"bAutoWidth":false,"bFilter":false,"oLanguage":{"sInfo":"","dgInfoEmpty":""},"aoColumns":[{"sTitle":"idMovida","bVisible":false},{"sTitle":"Nombre movida"},{"sTitle":"Descripción"},{"sTitle":"Porcentaje","sClass":"edit","bSortable":false},{"sTitle":"Tolerancia","sClass":"edit","bSortable":false}]});}}
VentanaConfigurarDialogo.prototype.setModoEdicion=function(valor){this._modoEdicion=valor;if(valor){$("#facilitador").show();}
else{$("#facilitador").hide();}}
VentanaConfigurarDialogo.prototype.getModoEdicion=function(){return this._modoEdicion;}
VentanaConfigurarDialogo.prototype.setControlador=function(controladorDialogo){try{this.controlador=controladorDialogo;var _categoriasPosibles=this.controlador.categoriasActuales;if(_categoriasPosibles==undefined){this.controlador.actualizarCategoriasPosibles();_categoriasPosibles=this.controlador.categoriasActuales;}
for(var i=0;i<_categoriasPosibles.length;i++){$("#cmbPerfilIntervencion").append("<option>"+_categoriasPosibles[i].nombre+"</option>");}
if(this.controlador.categoriaSeleccionada==null){this.controlador.determinarCategoriaSeleccionada();}
var op=$("#cmbPerfilIntervencion option");if(this.controlador.categoriaSeleccionada!=null){for(i=0;i<op.length;i++){if(op[i].label==this.controlador.categoriaSeleccionada.nombre){$("#cmbPerfilIntervencion")[0].options[i].defaultSelected=true;$("#cmbPerfilIntervencion").trigger('change');}}}
if(this.getModoEdicion()){$("#cmbPerfilIntervencion").attr("disabled","disabled");}}catch(ex){}
me.crearEstructuraTablaBalance();var _tabla=new Array();_tabla[0]=[null,null,null,null,null];$("#dgBalance").dataTable().fnAddData(_tabla);try{this.crearTablaReglas();i=0;for(var j=0;j<this.controlador.reglasActuales.length;j++){var data=new Array();data[0]=i;i++;data[1]=this.controlador.reglasActuales[j].textoRegla;$("#dgReglas").dataTable().fnAddData(data);}}catch(ex){}
try{var reglas=this.controlador.ReglasDisponibles();if(reglas!=null||reglas.length>0){for(i=0;i<reglas.length;i++){$("#cmbReglasPredefinidas").append("<option>"+reglas[i].textoRegla+"</option>");}}}catch(ex){}
try{var facilitador=null;if(this.getModoEdicion()){var listaUsuario=new Array();for(i=0;i<this.controlador.dialogoActual.intervenciones.length;i++){var usu=this.controlador.dialogoActual.intervenciones[i].usuarioCreador;var _estaUsuario=false;for(var j=0;j<listaUsuario.length;j++){if(listaUsuario[j].nombreUsuario==usu.nombreUsuario){_estaUsuario=true;break;}}
if(!_estaUsuario){listaUsuario.push(usu);}
if(usu.nombreUsuario==this.controlador.dialogoActual.usuarioFacilitador.nombreUsuario)
facilitador=usu;}
for(i=0;i<listaUsuario.length;i++){$("#cmbFacilitador").append("<option>"+listaUsuario[i].nombreUsuario+"</option>");}
op=$("#cmbFacilitador")[0].options;for(i=0;i<op.length;i++){if(op[i].label==facilitador.nombreUsuario){$("#cmbFacilitador")[0].options[i].defaultSelected=true;}}}}catch(ex){}
try{$("#dgUsuarios").dataTable({"bJQueryUI":true,"bPaginate":false,"bScrollInfinite":true,"bScrollCollapse":true,"sScrollY":"200px","bServerSide":false,"bFilter":false,"oLanguage":{"sInfo":"Mostrando _TOTAL_ usuarios restringidos","sInfoEmpty":"No hay usuarios restringidos"},"aoColumns":[{"sTitle":"Usuario"}]});var _upermitidos=this.controlador.usuariosPermitidosActuales;for(i=0;i<_upermitidos.length;i++){$("#dgUsuarios").dataTable().fnAddData([_upermitidos[i].nombreUsuario]);}}catch(ex){}}
VentanaConfigurarDialogo.prototype.crearTablaReglas=function(){$("#dgReglas").dataTable({"bJQueryUI":true,"bPaginate":false,"bScrollInfinite":true,"bScrollCollapse":true,"sScrollY":"200px","bServerSide":false,"bFilter":false,"oLanguage":{"sInfo":"Mostrando _TOTAL_ reglas asociadas","sInfoEmpty":"No hay reglas asociadas"},"aoColumns":[{"sTitle":"orden","bVisible":false},{"sWidth":"100%","sTitle":"Regla"}]});}