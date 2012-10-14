function hola(event){
    var p = event;
    p=0;
}


$(function() {
    //oButton = $(".Boton");
    //manejador de eventos:
    //evento: click.
    //aplicado sobre <tr></tr>
    //realizando la acción de 
    //oButton.on("click","div",nada);
    });


/*
 *Control de usuario que muestra una representacion de grado para las intervenciones de un dialogo.
 */
function DialogBrowser() {
    //private LinkedList<NodoBrowser>
    this.coleccionNodos = new Array();

    //arreglo de intervenciones.
    this.intervenciones = new Array();

    

    this.posx = 1;
    //No usado.
    //this.estiloBoton;
    //:string
    this.ultimoUsuario = "";

    //:IBrowserDialogo
    this.Padre;
}


/** 
 * Redibuja el control con los datos asociados..
 * @param
 * @return
 */
DialogBrowser.prototype.refrescar = function() {
    //alert("refrescar");
        
    this.coleccionNodos = new Array();
    try {
        //borrar todos los elementos del nodoBrowser.
        $("div#dialogBrowser div, div#dialogBrowser hr").remove();
        $("div#dialogBrowser div, div#dialogBrowser hr").unbind();
        this.posx = 1;
    } catch(ex) {
    }

    //recorrer el arreglo de intervenciones.
    var _intervenciones = this.intervenciones;
    for(var i = 0; i < _intervenciones.length; i = i + 1) {
        //crea el nuevo nodoBrowser.
        var _nuevo = new NodoBrowser(_intervenciones[i]);

        if(_intervenciones[i].intervencionRespuesta == null) {
            //No es respuesta y debe agregarse un nodo principal.
            _nuevo.setCoordenadaX(1);
            _nuevo.setCoordenadaY(1);
            this.ultimoUsuario = _intervenciones[i].usuarioCreador.nombreUsuario;
            this.agregarNodoSolitario(_nuevo);
            //agrega aagregarNodoSolitariol final de coleccionNodos.
            this.coleccionNodos.push(_nuevo);

        } else {
            this.agregarNodoVecino(_nuevo, _intervenciones[i].intervencionRespuesta);
            this.coleccionNodos.push(_nuevo);
        }
    }

}

/**
 *Busca la intervencion de la lista de intervenciones según un ID.
 *@param {string} id
 *@param {Intervencion[]} _intervenciones
 *@return {Intervencion}
 */
function buscarIntervencionPorId(id, _intervenciones){
    for(var i=0;i<_intervenciones.length;i++){
        if(_intervenciones[i].id.toString() == id.toString()){
            return _intervenciones[i];
        }
    }
    return null;
}



function btnSeleccionarNodo_Click(event, _navegadorHilo){
    //Obtiene la intervencion asociada al boton presionado
    //id de la intervención.
    $("body").css("cursor","wait");
    var _botonPresionado;
    
    var _copiaPadre = event.target.id.lastIndexOf("--");
    if(_copiaPadre != -1){
        _botonPresionado = event.target.id.substring(0,event.target.id.lastIndexOf("--"));
    }
    else
        _botonPresionado = event.target.id;
    
    var _intervenciones = _navegadorHilo.nodosAgregados;
    //busca la intervencion.
    var _Padre = buscarIntervencionPorId(_botonPresionado, _intervenciones);
    
    //limpia la lista.
    //_navegadorHilo.setNavegadorHilo(eArray);
    
    
    $("#arbol").empty();
    $("#arbol").unbind();
    $("#arbol").tree = null;
    //carga esa intervencion en el navegadorHilo.
    _navegadorHilo.setNavegadorHilo(_Padre);
    
    
    
    //setea el cursor a modo normal.
    $("body").css("cursor","default");
    
}

/** 
 * Inserta un nodo solitario, el creador del dialogo.
 * @param {NodoBrowser} nodo
 * @return
 */
DialogBrowser.prototype.agregarNodoSolitario = function(nodo) {
    //crea nuevo botón.
    var _nuevoBtn = "<div onclick=\"btnSeleccionarNodo_Click(event, Navegador)\" class=\"Boton\" id=\"" + nodo.idIntervencion + "\">" + nodo.usuario + "</div>";
    //lo muestra en la pantalla.
    $("#dialogBrowser").append(_nuevoBtn);
    //var p=$("#dialogBrowser");
    //setea posicion X, setea posicion Y.

    // node = nodo;
    $("#" + nodo.idIntervencion).offset(function() {
        var a = new Array();
        a.top = $("#dialogBrowser").offset().top + nodo.CoordenadaY;
        a.left = $("#dialogBrowser").offset().left + nodo.CoordenadaX;
        return a;
    });

    $("#" + nodo.idIntervencion).css("cursor", "pointer");

    $("#" + nodo.idIntervencion).tipsy({
        gravity : 's',
        html : true,
        bgcolor : "#005190",
        txtcolor : "#dddddd",
        title : function() {
            //nodo.Texto NO SE MUESTRA COMPLETO!!!
            var text = nodo.Texto;
            var _recorte = text.split(" ");
            var _texto = "<b>Texto:</b><br>";
            if(_recorte.length > 4) {
                for(var i = 0; i < 4; i++) {
                    _texto += _recorte[i] + " ";
                }
                _texto += "...";
            } else
                _texto += nodo.Texto;

            return _texto;
        }
    });
}

DialogBrowser.prototype.isNodeOverALine = function(nodo){
    
    var _contenido = $("#dialogBrowser").children();
    var _lineaHorizontal = new Array();
    for(var i=0;i<_contenido.length; i++){
        if(_contenido[i].classList[0]=="linea"
            && _contenido[i].classList[1]=="horizontal"){
            _lineaHorizontal.push(_contenido[i]);
        }
    }
    
    for(i=0;i<_lineaHorizontal;i++){
        var pos = $("#"+_lineaHorizontal[i].id).offset();
        var ancho = $("#"+_lineaHorizontal[i].id).width();
        //punto final de la línea horizontal.
        var fin = pos.left + ancho;
        
        var nodoPos = $("#"+nodo.idIntervencion).offset();
        var nodoAncho = $("#"+nodo.idIntervencion).outerWidth();
        var rightSide = nodoPos.left + nodoAncho;
        
        if(fin > rightSide)
            return true;
    }
    return false;
}

DialogBrowser.prototype.escapeHtml=function(string){
    var _ret = string.replace(/<br>/gi, "\n");
    _ret = _ret.replace(/<div align="center">|<div align="left">|<div align="right">/gi, "");
    _ret = _ret.replace(/<i>|<u>|<b>/gi, "");
    _ret = _ret.replace(/<\/div>|<\/b>|<\/i>|<\/u>/gi,"");
    
    
    return _ret;
}
/** 
 * Inserta un nodo vecino.
 * @param {NodoBrowser} nodo
 * @param {Intervencion} padre
 * @return
 */
DialogBrowser.prototype.agregarNodoVecino = function(nodo, padre) {
    try {
        //:NodoBrowser
        var _nodoPadre = this.buscarNodo(padre);
        if(this.ultimoUsuario != nodo.usuario) {
            this.posx++;
            nodo.setCoordenadaX(this.posx);
            //verificar si hay una fila de nodos en el lugar donde se colocará.
            //SE REPARA UN BUG???
            //_nodoPadre.AlturaHijo++;
            nodo.setCoordenadaY(++_nodoPadre.AlturaHijo);
            
            //crea un nuevo botón
            var _nuevoBtn = "<div onclick=\"btnSeleccionarNodo_Click(event, Navegador)\" class=\"Boton\" id=\"" + nodo.idIntervencion + "\">" + nodo.usuario + " </div>";
            //muestra el nuevo botón}.
            $("#dialogBrowser").append(_nuevoBtn);
            //setea X y setea Y.
            //node = nodo;
            $("#" + nodo.idIntervencion).offset(function() {
                var a = new Array();
                //verificar si en Y existen nodos.
                a.top = $("#dialogBrowser").offset().top + nodo.CoordenadaY;
                a.left = $("#dialogBrowser").offset().left + nodo.CoordenadaX;
                return a;
            });
            
            if(this.isNodeOverALine(nodo)){
                alert("Nodo está sobre una línea");
                _nodoPadre.AlturaHijo+=2;
                nodo.setCoordenadaY(_nodoPadre.AlturaHijo);
                
                $("#" + nodo.idIntervencion).offset(function() {
                    var a = new Array();
                    //verificar si en Y existen nodos.
                    a.top = $("#dialogBrowser").offset().top + nodo.CoordenadaY;
                    a.left = $("#dialogBrowser").offset().left + nodo.CoordenadaX;
                    return a;
                });
            }
            
            //setear cursor.
            $("#" + nodo.idIntervencion).css("cursor", "pointer");

            //setear tooltip.
            $("#" + nodo.idIntervencion).tipsy({
                gravity : 's',
                html : true,
                bgcolor : "#005190",
                txtcolor : "#dddddd",
                title : function() {
                    var text = nodo.Texto;
                    var _recorte = text.split(" ");
                    var _texto = "<b>Texto:</b><br>";
                    if(_recorte.length > 4) {
                        for(var i = 0; i < 4; i++) {
                            _texto += _recorte[i] + " ";
                        }
                        _texto += "...";
                    } else
                        _texto += nodo.Texto;

                    _texto += "<br><b>En respuesta a:</b><br>";
                    _texto += padre.Texto;

                    return _texto;
                }
            });

            this.ultimoUsuario = nodo.usuario;

            //Si el nodo padre NO está a la misma altura del nodo actual.
            if(nodo.CoordenadaY != _nodoPadre.CoordenadaY) {
                this.copiarNodoPadre(_nodoPadre, nodo);
            } else {
                //_nodoPadre es obtenido desde la búsqueda entre los nodos.
                nodoPadre = _nodoPadre;
                //dibuja la línea de union
                $("#dialogBrowser").append("<hr class=\"linea horizontal\" id=\"" + nodo.idIntervencion + padre.idIntervencion + "\"/>");
                $("#" + nodo.idIntervencion + padre.idIntervencion).offset(function() {
                    var a = Array();
                    a.top = $("#" + padre.idIntervencion).offset().top + $("#" + padre.idIntervencion).outerHeight()/2;
                    a.left = $("#" + padre.idIntervencion).offset().left +  $("#" + nodoPadre.idIntervencion).outerWidth();
                    return a;
                });

                //ajusta el tamaño de la linea de union.
                var nP = $("#" + nodoPadre.idIntervencion).offset().left;
                var nN = $("#" + nodo.idIntervencion).offset().left - $("#" + nodo.idIntervencion).outerWidth() + 2;
                var ancho = nN - nP;
                //setea la altura en funcion de la distancia de los componentes.
                $("#" + nodo.idIntervencion + padre.idIntervencion).width(ancho);
                
                $("#" + nodo.idIntervencion + padre.idIntervencion).prop("title", "Respuesta a:\n" + this.escapeHtml(nodoPadre.Texto));
            //                $("#" + nodo.idIntervencion + padre.idIntervencion).tipsy({
            //                    gravity : 'n',
            //                    html : true,
            //                    bgcolor : "#eeeeee",
            //                    txtcolor : "#24476C",
            //                    title : function() {
            //                        var _texto = "<i><b>Respuesta a:</b></i><br>";
            //                        var text = nodoPadre.Texto;
            //                        _texto += text;
            //                        return _texto;
            //                    }
            //                });

            }
        } else {
            nodo.setCoordenadaX(this.posx);
            _nodoPadre.AlturaHijo++;
            nodo.setCoordenadaY(_nodoPadre.AlturaHijo);

            //crea el botón
            var _nuevo = "<div onclick=\"btnSeleccionarNodo_Click(event, Navegador)\" class=\"Boton\" id=\"" + nodo.idIntervencion + "\">" + nodo.usuario + "</div>";
            //muestra el nuevo botón}.
            $("#dialogBrowser").append(_nuevo);
            //setea X y setea Y.
            node = nodo;
            $("#" + nodo.idIntervencion).offset(function() {
                var a = new Array();
                a.top = $("#dialogBrowser").offset().top + node.CoordenadaY;
                a.left = $("#dialogBrowser").offset().left + node.CoordenadaX;
                return a;
            });
            
            //setear cursor.
            $("#" + nodo.idIntervencion).css("cursor", "pointer");

            //setear tooltip.
            $("#" + nodo.idIntervencion).tipsy({
                gravity : 's',
                html : true,
                bgcolor : "#005190",
                txtcolor : "#dddddd",
                title : function() {
                    var text = nodo.Texto;
                    var _recorte = text.split(" ");
                    var _texto = "<b>Texto:</b><br>";
                    if(_recorte.length > 4) {
                        for(var i = 0; i < 4; i++) {
                            _texto += _recorte[i] + " ";
                        }
                        _texto += "...";
                    } else
                        _texto += nodo.Texto;

                    _texto += "<br><b>En respuesta a:</b><br>";
                    _texto += padre.Texto;

                    return _texto;
                }
            });
            
            this.copiarNodoPadre(_nodoPadre, nodo);
        }
    } catch(ex) {
        alert(ex);
    }
}



/**
 *Copia el nodo padre de la nueva intervención debajo del original.
 *@param {DialogBrowser} nodoPadre
 *@param {DialogBrowser} siguiente
 *@return
 */
DialogBrowser.prototype.copiarNodoPadre = function(nodoPadre, siguiente) {
    try {
        nodoPadre.AlturaHijo++;
        
        //_origen representa el id de nodoPadre.
        _origen = nodoPadre.idIntervencion;

        //nuevo boton
        var _nuevo = "<div onclick=\"btnSeleccionarNodo_Click(event, Navegador)\" class=\"Boton\" id=\"" + nodoPadre.idIntervencion + "--" + siguiente.idIntervencion + "\">" + nodoPadre.usuario + "</div>";
        //representa el ID del nodo que se crea actualmente, para utilizacion futura.
        var _nuevoId = nodoPadre.idIntervencion + "--" + siguiente.idIntervencion;
        //muestra la línea}.
        $("#dialogBrowser").append(_nuevo);
        //setea X y setea Y.
        
        $("#" + nodoPadre.idIntervencion + "--" + siguiente.idIntervencion).offset(function() {
            var a = new Array();
            a.top = $("#dialogBrowser").offset().top + siguiente.CoordenadaY;
            a.left = $("#dialogBrowser").offset().left + nodoPadre.CoordenadaX;
            return a;
        });
        
        //setear opacidad.
        $("#" + nodoPadre.idIntervencion + "--" + siguiente.idIntervencion).css("opacity",0.8);
        
        //configuración de puntero.
        $("#" + nodoPadre.idIntervencion + "--" + siguiente.idIntervencion).css("cursor", "pointer");

        //configuración de Tooltip
        $("#" + nodoPadre.idIntervencion + "--" + siguiente.idIntervencion).tipsy({
            gravity : 's',
            html : true,
            txtcolor : "#dddddd",
            bgcolor : "#005190",
            title : function() {
                return nodoPadre.Texto;
            }
        });
        //arreglo con todos los elementos de div#dialogBrowser
        var _botones = $("#dialogBrowser").children();

        //dibujo de línea vertical.
        //Es una sola línea que va desde el nodo padre superior hasta el inferior.
        //pasa por detrás de los botones.
        {
            //crea nueva linea
            var _union = "<hr class=\"linea vertical\" id=\"" + nodoPadre.idIntervencion + "_" + siguiente.idIntervencion + "\"/>";
            //muestra la nueva linea.
            $("#dialogBrowser").append(_union);
            //bool _dibujarLinea = true;
            var _dibujarLinea = true;
            //_punto1 es un id de intervencion, utilizado para identificar al nodo.
            var _punto1 = _origen;

            try {
                var mayorY = 0;
                for(var i = 0; i < _botones.length; i++) {
                    try {
                        var _el = _botones[i];
                        //elemento en la i-ésima posicion del arreglo.
                        //obtiene un nodo del grafo.
                        var _x = $("#" + _el.id).offset().left;
                        //valor de posicion Left del nodo.
                        var _y = $("#" + _el.id).offset().top;
                        //valor de posicion top del nodo.
                        if(_y > mayorY && _x == nodoPadre.CoordenadaX && _y > nodoPadre.CoordenadaY
                            // _nuevo: string html que representa un botón.
                            // _el: string que debería representar el i-ésimo botón del arreglo.
                            && _el.id != _nuevoId) {
                            _punto1 = _el;
                            mayorY = _y;

                            var _newId = _nuevoId.split("--")[0]
                            //comparar el idIntervencion del boton actual con
                            //el idIntervencion del nodo del que es respuesta.
                            if(_el.id.toString() != _newId[0].toString()) {
                                _dibujarLinea = false;
                            }
                        }
                    } catch(ex) {
                        alert(ex);
                    }
                }
            } catch(ex) {
                alert(ex);
            }

            if(_dibujarLinea) {
                //id de la linea vertical en cuestion.
                var _idVertical = nodoPadre.idIntervencion + "_" + siguiente.idIntervencion;

                //setea posicion inicial de la linea.
                $("#" + _idVertical).offset(function() {
                    var a = Array();
                    a.top = $("#" + _punto1).offset().top + $("#" + _punto1).outerHeight() - 1;
                    a.left = $("#" + _punto1).offset().left + $("#" + nodoPadre.idIntervencion).outerWidth() / 2;
                    return a;
                });
                //setea el largo de la linea.
                //_nuevoId es el id de la copia del nodoPadre a agregar.
                $("#" + _idVertical).height(function() {
                    var _inicio = $("#" + nodoPadre.idIntervencion).offset().top;
                    var _fin = $("#" + _nuevoId).offset().top - $("#" + _nuevoId).outerHeight() + 1;
                    return _fin - _inicio;
                });

                //setear tooltip de línea.
                $("#" + _idVertical).prop("title", "Respuesta a: \n" + this.escapeHtml(nodoPadre.Texto));
                
            //                $("#" + _idVertical).tipsy({
            //                    gravity : 'w',
            //                    html : true,
            //                    bgcolor : "#eeeeee",
            //                    txtcolor : "#24476C",
            //                    title : function() {
            //                        var _texto = "<i><b>Respuesta a:</b></i><br>";
            //                        _texto += nodoPadre.Texto;
            //                        return _texto;
            //                    }
            //                });

            }

        }

        //dibujo de línea horizontal.
        {
            _union = "<hr class=\"linea horizontal\" id=\"" + nodoPadre.idIntervencion + "_-" + siguiente.idIntervencion + "\"/>";
            $("#dialogBrowser").append(_union);

            _punto1 = _nuevoId;
            var _punto2 = siguiente.idIntervencion;

            var _idHorizontal = nodoPadre.idIntervencion + "_-" + siguiente.idIntervencion;

            //setea posicion inicial de la linea.
            $("#" + _idHorizontal).offset(function() {
                var a = Array();
                a.top = $("#" + _punto1).offset().top + $("#" + _punto1).outerHeight() / 2;
                a.left = $("#" + _punto1).offset().left + $("#" + _punto1).outerWidth();
                return a;
            });
            //setea el largo de la linea.
            //_nuevoId es el id de la copia del nodoPadre a agregar.

            $("#" + _idHorizontal).width(function() {
                var _inicio = $("#" + _punto1).offset().left;
                var _fin = $("#" + _punto2).offset().left - $("#" + _punto2).outerWidth();
                if(_fin - _inicio > 0)
                    return _fin - _inicio + 3;
                else
                    return 0;
            });

            //setear tooltip de línea.
            $("#" + _idHorizontal).prop("title", "Respuesta a:\n" + this.escapeHtml(nodoPadre.Texto));

        //            $("#" + _idHorizontal).tipsy({
        //                gravity : 'n',
        //                html : true,
        //                bgcolor : "#eeeeee",
        //                txtcolor : "#24476C",
        //                title : function() {
        //                    var _texto = "<i><b>Respuesta a:</b></i><br>";
        //                    _texto += nodoPadre.Texto;
        //                    return _texto;
        //                }
        //            });
        }
    } catch(ex) {
        alert(ex);
    }
}

/*
 *busca el nodo identificado segun intervencion.
 *@param {Intervencion} intervencion
 *@return {nodoBrowser}
 */
DialogBrowser.prototype.buscarNodo = function(intervencion) {
    //busca en coleccionNodos el nodo con idIntervencion igual al id del parametro.
    //coleccionNodos es el arreglo de nodos ya mostrados.
    for(var i = 0; i < this.coleccionNodos.length; i += 1) {
        if(this.coleccionNodos[i].idIntervencion == intervencion.idIntervencion) {
            return this.coleccionNodos[i];
        }
    }
    return null;
}




//**********//
//NodoBrowser.
//:Intervencion.
/*
 *  Clase auxiliar para el widget.
 * @class NodoBrowser
 * @param {Intervencion} contenido
 */
function NodoBrowser(contenido) {
    //:Intervencion
    this.contenido = contenido;
    //:int
    this.pos_X;
    //:int
    this.pos_Y = 10;
    //por defecto.
    //:int
    this.AlturaHijo;

    this.CoordenadaX;
    this.CoordenadaY;

    //idIntervencion retorna contenido.idIntervencion
    this.idIntervencion = contenido.idIntervencion;
    //:string
    this.usuario = contenido.usuarioCreador.nombreUsuario;
    //:string
    this.Texto = contenido.Texto;
    //:string
    this.textoRespuesta = contenido.TextoRespuesta;
}

/*
 * @param {int} x
 */
NodoBrowser.prototype.setCoordenadaX = function(x) {
    if(x == 0 || x == 1) {
        x = 1;
        this.pos_X = 10;
        this.CoordenadaX = this.pos_X;
    } else {
        this.pos_X = x * 120;
        this.CoordenadaX = this.pos_X;
    }

}
/*
 * @param {int} y
 */
NodoBrowser.prototype.setCoordenadaY = function(y) {
    this.AlturaHijo = y;
    if(y == 0)
        y = 1;

    this.pos_Y = y * 30;
    this.CoordenadaY = this.pos_Y;
    if(y > 1) {
        this.pos_Y += 10;
        this.CoordenadaY = this.pos_Y;
    }
    if(y > 2) {
        this.pos_Y += 10 * y;
        this.CoordenadaY = this.pos_Y;
    }
}