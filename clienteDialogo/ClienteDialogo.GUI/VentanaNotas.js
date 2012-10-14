
$(function(){$("#btnGuardar").button();$("#btnEliminar").button();{idIntervencion=JSON.parse($("#intervencion").val());_sesionActual=opener.me.sesion;var _intervencion=null;var intervencionesDisponibles=opener.Navegador.nodosAgregados;for(var i=0;i<intervencionesDisponibles.length;i++){if(intervencionesDisponibles[i].intervencion.idIntervencion==idIntervencion){var _intervencion=intervencionesDisponibles[i].intervencion;}}
_ventana=new VentanaNotas(_sesionActual);if(_intervencion.Notas==null||_intervencion.Notas.length==0){var _controlador=new CNotas(_sesionActual);var _n=_controlador.crearNota();_n.Autor=_sesionActual.usuario;_intervencion.Notas=new Array();_intervencion.Notas[0]=_n;_n.intervencionPadre=_intervencion;}
_ventana.mostrarNota(_intervencion.Notas[0]);}});function VentanaNotas(sesion){me=this;this.SesionActual;this.notaActual;this.sesionActual=sesion;this.initializeComponents();}
VentanaNotas.prototype.initializeComponents=function(){$("#btnEliminar").click(function(){me.btnEliminarNota_Click(this);});$("#btnGuardar").click(function(){me.btnGuardarNota_Click(this);});}
VentanaNotas.prototype.btnEliminarNota_Click=function(sender){var _err="";var _exito=false;try{var _controlador=new CNotas(me.SesionActual);$("#txtNotas").val("");me.notaActual.Texto=$("#txtNotas").val();_exito=_controlador.eliminarNota(me.notaActual,_err);}catch(ex){}}
VentanaNotas.prototype.btnGuardarNota_Click=function(sender){var _err="";var _exito=false;try{var _controlador=new CNotas(me.SesionActual);me.notaActual.Texto=$("#txtNotas").val();if($.trim(me.notaActual.Texto)==""){return;}
_exito=_controlador.guardarNota(me.notaActual.intervencionPadre,me.notaActual,_err);}catch(ex){}
if(!_exito||(_err!=null&&_err.length>0)){notificar("No se pudo guardar la nota");}
else{notificar("Nota guardada con éxito");}}
VentanaNotas.prototype.mostrarNota=function(nota){try{this.notaActual=nota;if(nota.Texto.length>0){$("#txtNotas").val(nota.Texto);$("#btnEliminar").button("enabled");}
else{$("#txtNotas").val(nota.Texto);}}catch(ex){}}