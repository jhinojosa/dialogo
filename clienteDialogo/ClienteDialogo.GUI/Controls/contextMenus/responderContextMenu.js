
function responderContextMenu(){var me=this;me.ventanaPadre=new Array();responderContextMenu.prototype.setMenu=function(){$(".parrafo").contextMenu({menu:'myMenu'},function(action,el,pos){if(action=="respondeParrafo"){me.ventanaPadre.responderParrafo(el[0].innerHTML,el[0].parentElement.id);}
if(action=="respondeTodo"){me.ventanaPadre.responderParrafo(el[0].parentNode.innerHTML,el[0].parentNode.id);}});}
responderContextMenu.prototype.respondeParrafo=function(parrafo,idIntervencion){idIntervencion=idIntervencion.split("_");alert(parrafo.innerHTML+" ,"+idIntervencion[1]);}
responderContextMenu.prototype.respondeTodo=function(textoIntervencion){alert(textoIntervencion.innerHTML+" ,"+textoIntervencion.id.split("_")[1]);}}