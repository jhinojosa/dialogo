function responderContextMenu(){
    //ventana origen;
    var me = this;
    me.ventanaPadre=new Array();




    responderContextMenu.prototype.setMenu = function(){
        $(".parrafo").contextMenu({
            menu: 'myMenu'
        },
        function(action, el, pos) {
            if(action == "respondeParrafo"){
                //responderContextMenu.prototype.respondeParrafo(el[0], el[0].parentElement.id);
                
                me.ventanaPadre.responderParrafo(el[0].innerHTML, el[0].parentElement.id);
            }
            if(action == "respondeTodo"){
                //NavegadorHilo.prototype.respondeTodo(el[0].parentNode);
                me.ventanaPadre.responderParrafo(el[0].parentNode.innerHTML, el[0].parentNode.id);
            }

        });
    }

    /**
 * Ejecuta las acciones referentes a responder un párrafo
 * @param {Object} parrafo Objeto HTML que contiene el parrafo seleccionado.
 * @param {string} idIntervencion ID de la intervencion a la que pertenece el párrafo que se responderá
 */
    responderContextMenu.prototype.respondeParrafo = function(parrafo, idIntervencion){
        
        idIntervencion = idIntervencion.split("_");
        alert(parrafo.innerHTML+" ,"+idIntervencion[1]);
    }

    /**
 * Ejecuta las acciones referentes a responder a todo el texto.
 * 
 */
    responderContextMenu.prototype.respondeTodo = function(textoIntervencion){
        
        alert(textoIntervencion.innerHTML+" ,"+textoIntervencion.id.split("_")[1]);
    }

}