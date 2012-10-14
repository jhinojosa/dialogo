
$(function(){$("#tabs").tabs();{vdialogo=new VentanaEstadisticas(opener.Controlador);vdialogo.cargarEstadisticas();}});function VentanaEstadisticas(controller){this.Controlador=controller;this.InitializeComponents();}
VentanaEstadisticas.prototype.InitializeComponents=function(){$("#tabs").tabs({selected:0,show:function(event,ui){if(ui.index==0){$("#grillaPorcentajes").dataTable().fnAdjustColumnSizing(true);}
if(ui.index==1){$("#grillaUsuarios").dataTable().fnAdjustColumnSizing(true);}
if(ui.index==2){$("#grillaEje").dataTable().fnAdjustColumnSizing(true);}}});}
VentanaEstadisticas.prototype.cargarEstadisticas=function(){try{var _ds=this.Controlador.obtenerEstadisticas(this.Controlador.dialogoActual);_ds.pop();for(var i=0;i<_ds.length;i++){_ds[i].columnas.pop();_ds[i].datos.pop();}
document.title="Estadísticas para el diálogo "+this.Controlador.dialogoActual.Titulo;var gp=$("#grillaPorcentajes");if($.fn.DataTable.fnIsDataTable(gp)){$("#grillaPorcentajes").dataTable().fnClearTable();}
$("#grillaPorcentajes").dataTable({"bJQueryUI":true,"bPaginate":false,"bScrollInfinite":true,"bScrollCollapse":true,"bAutoWidth":false,"sScrollY":"300px","bServerSide":false,"bFilter":false,"aoColumns":_ds[0].columnas,"aaData":_ds[0].datos});gp=$("#grillaUsuarios");if($.fn.DataTable.fnIsDataTable(gp)){$("#grillaUsuarios").dataTable().fnClearTable();}
$("#grillaUsuarios").dataTable({"bJQueryUI":true,"bPaginate":false,"bScrollInfinite":true,"bScrollCollapse":true,"sScrollY":"300px","sScrollX":"100%","bServerSide":false,"bSort":false,"bFilter":false,"aoColumns":_ds[1].columnas,"aaData":_ds[1].datos});gp=$("#grillaEje");if($.fn.DataTable.fnIsDataTable(gp)){$("#grillaEje").dataTable().fnClearTable();}
$("#grillaEje").dataTable({"bJQueryUI":true,"bPaginate":false,"bScrollInfinite":true,"bScrollCollapse":true,"sScrollY":"300px","bServerSide":false,"bSort":false,"bFilter":false,"aoColumns":_ds[2].columnas,"aaData":_ds[2].datos});}catch(ex){if(_ds==null)
notificar("No se pudieron obtener los datos desde el servidor<br><br>"+ex);else
alert(ex);}}