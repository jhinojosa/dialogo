/*
 * A JavaScript implementation of the RSA Data Security, Inc. MD5 Message
 * Digest Algorithm, as defined in RFC 1321.
 * Copyright (C) Paul Johnston 1999 - 2000.
 * Updated by Greg Holt 2000 - 2001.
 * See http://pajhome.org.uk/site/legal.html for details.
 */
 
/*
 * Convert a 32-bit number to a hex string with ls-byte first
 */
var hex_chr = "0123456789abcdef";
function rhex(num)
{
  str = "";
  for(j = 0; j <= 3; j++)
    str += hex_chr.charAt((num >> (j * 8 + 4)) & 0x0F) +
           hex_chr.charAt((num >> (j * 8)) & 0x0F);
  return str;
}
 
/*
 * Convert a string to a sequence of 16-word blocks, stored as an array.
 * Append padding bits and the length, as described in the MD5 standard.
 */
function str2blks_MD5(str)
{
  nblk = ((str.length + 8) >> 6) + 1;
  blks = new Array(nblk * 16);
  for(i = 0; i < nblk * 16; i++) blks[i] = 0;
  for(i = 0; i < str.length; i++)
    blks[i >> 2] |= str.charCodeAt(i) << ((i % 4) * 8);
  blks[i >> 2] |= 0x80 << ((i % 4) * 8);
  blks[nblk * 16 - 2] = str.length * 8;
  return blks;
}
 
/*
 * Add integers, wrapping at 2^32. This uses 16-bit operations internally 
 * to work around bugs in some JS interpreters.
 */
function add(x, y)
{
  var lsw = (x & 0xFFFF) + (y & 0xFFFF);
  var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
  return (msw << 16) | (lsw & 0xFFFF);
}
 
/*
 * Bitwise rotate a 32-bit number to the left
 */
function rol(num, cnt)
{
  return (num << cnt) | (num >>> (32 - cnt));
}
 
/*
 * These functions implement the basic operation for each round of the
 * algorithm.
 */
function cmn(q, a, b, x, s, t)
{
  return add(rol(add(add(a, q), add(x, t)), s), b);
}
function ff(a, b, c, d, x, s, t)
{
  return cmn((b & c) | ((~b) & d), a, b, x, s, t);
}
function gg(a, b, c, d, x, s, t)
{
  return cmn((b & d) | (c & (~d)), a, b, x, s, t);
}
function hh(a, b, c, d, x, s, t)
{
  return cmn(b ^ c ^ d, a, b, x, s, t);
}
function ii(a, b, c, d, x, s, t)
{
  return cmn(c ^ (b | (~d)), a, b, x, s, t);
}
 
/*
 * Take a string and return the hex representation of its MD5.
 */
function calcMD5(str)
{
  x = str2blks_MD5(str);
  a =  1732584193;
  b = -271733879;
  c = -1732584194;
  d =  271733878;
 
  for(i = 0; i < x.length; i += 16)
  {
    olda = a;
    oldb = b;
    oldc = c;
    oldd = d;
 
    a = ff(a, b, c, d, x[i+ 0], 7 , -680876936);
    d = ff(d, a, b, c, x[i+ 1], 12, -389564586);
    c = ff(c, d, a, b, x[i+ 2], 17,  606105819);
    b = ff(b, c, d, a, x[i+ 3], 22, -1044525330);
    a = ff(a, b, c, d, x[i+ 4], 7 , -176418897);
    d = ff(d, a, b, c, x[i+ 5], 12,  1200080426);
    c = ff(c, d, a, b, x[i+ 6], 17, -1473231341);
    b = ff(b, c, d, a, x[i+ 7], 22, -45705983);
    a = ff(a, b, c, d, x[i+ 8], 7 ,  1770035416);
    d = ff(d, a, b, c, x[i+ 9], 12, -1958414417);
    c = ff(c, d, a, b, x[i+10], 17, -42063);
    b = ff(b, c, d, a, x[i+11], 22, -1990404162);
    a = ff(a, b, c, d, x[i+12], 7 ,  1804603682);
    d = ff(d, a, b, c, x[i+13], 12, -40341101);
    c = ff(c, d, a, b, x[i+14], 17, -1502002290);
    b = ff(b, c, d, a, x[i+15], 22,  1236535329);    
 
    a = gg(a, b, c, d, x[i+ 1], 5 , -165796510);
    d = gg(d, a, b, c, x[i+ 6], 9 , -1069501632);
    c = gg(c, d, a, b, x[i+11], 14,  643717713);
    b = gg(b, c, d, a, x[i+ 0], 20, -373897302);
    a = gg(a, b, c, d, x[i+ 5], 5 , -701558691);
    d = gg(d, a, b, c, x[i+10], 9 ,  38016083);
    c = gg(c, d, a, b, x[i+15], 14, -660478335);
    b = gg(b, c, d, a, x[i+ 4], 20, -405537848);
    a = gg(a, b, c, d, x[i+ 9], 5 ,  568446438);
    d = gg(d, a, b, c, x[i+14], 9 , -1019803690);
    c = gg(c, d, a, b, x[i+ 3], 14, -187363961);
    b = gg(b, c, d, a, x[i+ 8], 20,  1163531501);
    a = gg(a, b, c, d, x[i+13], 5 , -1444681467);
    d = gg(d, a, b, c, x[i+ 2], 9 , -51403784);
    c = gg(c, d, a, b, x[i+ 7], 14,  1735328473);
    b = gg(b, c, d, a, x[i+12], 20, -1926607734);
     
    a = hh(a, b, c, d, x[i+ 5], 4 , -378558);
    d = hh(d, a, b, c, x[i+ 8], 11, -2022574463);
    c = hh(c, d, a, b, x[i+11], 16,  1839030562);
    b = hh(b, c, d, a, x[i+14], 23, -35309556);
    a = hh(a, b, c, d, x[i+ 1], 4 , -1530992060);
    d = hh(d, a, b, c, x[i+ 4], 11,  1272893353);
    c = hh(c, d, a, b, x[i+ 7], 16, -155497632);
    b = hh(b, c, d, a, x[i+10], 23, -1094730640);
    a = hh(a, b, c, d, x[i+13], 4 ,  681279174);
    d = hh(d, a, b, c, x[i+ 0], 11, -358537222);
    c = hh(c, d, a, b, x[i+ 3], 16, -722521979);
    b = hh(b, c, d, a, x[i+ 6], 23,  76029189);
    a = hh(a, b, c, d, x[i+ 9], 4 , -640364487);
    d = hh(d, a, b, c, x[i+12], 11, -421815835);
    c = hh(c, d, a, b, x[i+15], 16,  530742520);
    b = hh(b, c, d, a, x[i+ 2], 23, -995338651);
 
    a = ii(a, b, c, d, x[i+ 0], 6 , -198630844);
    d = ii(d, a, b, c, x[i+ 7], 10,  1126891415);
    c = ii(c, d, a, b, x[i+14], 15, -1416354905);
    b = ii(b, c, d, a, x[i+ 5], 21, -57434055);
    a = ii(a, b, c, d, x[i+12], 6 ,  1700485571);
    d = ii(d, a, b, c, x[i+ 3], 10, -1894986606);
    c = ii(c, d, a, b, x[i+10], 15, -1051523);
    b = ii(b, c, d, a, x[i+ 1], 21, -2054922799);
    a = ii(a, b, c, d, x[i+ 8], 6 ,  1873313359);
    d = ii(d, a, b, c, x[i+15], 10, -30611744);
    c = ii(c, d, a, b, x[i+ 6], 15, -1560198380);
    b = ii(b, c, d, a, x[i+13], 21,  1309151649);
    a = ii(a, b, c, d, x[i+ 4], 6 , -145523070);
    d = ii(d, a, b, c, x[i+11], 10, -1120210379);
    c = ii(c, d, a, b, x[i+ 2], 15,  718787259);
    b = ii(b, c, d, a, x[i+ 9], 21, -343485551);
 
    a = add(a, olda);
    b = add(b, oldb);
    c = add(c, oldc);
    d = add(d, oldd);
  }
  return rhex(a) + rhex(b) + rhex(c) + rhex(d);
}

$(function() {
    $("span.title").css("cursor","default");
    $(".controlDisplayIntervencionContainer").css("cursor","default");
    $(".controlDisplayIntervencionBotonera").css("cursor","default");
    $(".controlDisplayIntervencionTexto").css("cursor","default");
    $(".controlDisplayIntervencionImagenContainer").css("cursor","default");
    $(".btnVerContextoContainer").css("cursor","default");
    $(".tipoMovidaContainer").css("cursor","default");
});


/**
 *Control de usuario que presenta una serie de intervenciones en forma anidada.
 */
function NavegadorHilo(){
    
    var me = this;
    /*
    Define a su padre (controlador, quien instancia al widget)
    @type VentanaDialogo
     */
    me._ventanaPadre= new Array();
    
    
    
    /*Determina si debe mostrar textos en controles acorde al rol facilitador.
     *@type bool
     */
    me.modoFacilitador;
   
    /*
     *Define los tipos de movida para la corrección.
     *@type Movida[]
     */
    me.tiposMovida=new Object();
   
    /*@type List<NodoHilo>
     */
    me.nodosAgregados;
   
    /*No ha lugar en la migración.
     *@type ControlTemplate
     */
    me.Templatecontenido;
   
    {
        me.nodosAgregados = new Array();
    //me.nodosAnidados = new Array();
    }
    
    


    /**
     *Setter de _ventanaPadre
     */
    NavegadorHilo.prototype.setVentanaPadre=function(clasePadre){
        me._ventanaPadre = clasePadre;
    }
    
    NavegadorHilo.prototype.setTiposMovida=function(tiposMovida){
        me.tiposMovida = tiposMovida;
    }
    
    NavegadorHilo.prototype.setModoFaciliador = function(valor){
        me.modoFacilitador = valor;
    }


    /**
     * Agrega la informacion referente a cada intervención a cada elemento del arbol jerárquico.
     * Intervencion, carga el cmbMovidas, carga el contexto de la intervencion,
     * la movida que corresponde a la intervencion, el usuario creador, la fecha/hora de la intervencion,
     * en fin: agrega los elementos html que la componen. 
     * NOTA: Puede ser mejorada.
     * @param {Intervencion} param La intervención a ingresar al árbol jerárquico.
     * @param {bool} isRaiz si es que la intervencion a ingresar es raíz.
     * @return {string} Un nodo del arbol jerárquico, en formato HTML.
     */
    NavegadorHilo.prototype.agregarControlDisplayTextoIntervencion = function(param, isRaiz) {
        //var ret = "<div style=\"background-color: #005190; width: 600px; height: 120px;\">" + "<div style=\"background-color: orange; width: 70%; float: left; height: 30px; \">" + "<button class=\"btnVerContexto\">Ver contexto</button>" + "</div>" + "<div style=\"background-color: green; height: 30px; float: left; width: 30%; text-align: right;\">" + "<a style=\"padding:10px;\">Tipo de movida</a>" + "</div>" + "<div style=\"height: 60px; width: 50px; background-color: gray; float: left;\"></div>" + "<div style=\"height: 60px; width:550px; background-color: yellow; float: left;\">" + "<textarea>" + param + "</textarea>" + " </div>" + "</div>";
        var ret ="<div class=\"controlDisplayIntervencionContainer ui-corner-all\" style=\"width: 700px;\">";
        
        //Quita el botón ver Conexto en caso de ser nodo Raíz e impide el seteo del campo correspondiente.
        if(isRaiz){
            ret += "<div class=\"btnVerContextoContainer\" style=\"width: 520px\"><i>Publicado por "+param.usuarioCreador.nombreUsuario+" el "+param.FechaCreacion+"</i>";
        }else{
            ret += "<div class=\"btnVerContextoContainer\" style=\"width: 520px\"><i>Publicado por "+param.usuarioCreador.nombreUsuario+" el "+param.FechaCreacion+" en respuesta a "+param.intervencionRespuesta.usuarioCreador.nombreUsuario+"</i>"+
            "<button id=\"verCont_"+param.idIntervencion+"\" class=\"btnVerContexto\">"+
            "Ver contexto"+
            " </button>";
        }
        
        ret+="</div>"+
        "<div class=\"tipoMovidaContainer \" style=\"width:180px; font-size:11px; \">";
    
        //Setea la movida, si es que fue corregida.
        if(param.correccionMovida!=null && param.correccionMovida.length > 0){
            //para cada movida
            for(var i=0;i<me.tiposMovida.length;i++){
                if(me.tiposMovida[i].IdMovida == param.correccionMovida[0].IdMovida){
                    //en aplicacion original se setea el combobox el valor.
                    ret+=me.tiposMovida[i].Nombre;
                }
            }
        //si coinciden los id de las movidas.
        //ése es el valor seleccionado
        }else{
            ret+=param.tipoMovida.Nombre;
        }
        
        ret+="</div>"+
        "<div class=\"clear\"></div>"+
        "<div class=\"controlDisplayIntervencionContexto controlDisplayIntervencionContextoOut\" id=\"contexto_"+param.idIntervencion+"\" style=\"width: 695px;\"><i>";
        
        var gravatar;
        //var gravatar = "http://www.gravatar.com/avatar/" + calcMD5(param.usuarioCreador.email) + "/?s=50";
        if (param.usuarioCreador.email) gravatar = "http://www.gravatar.com/avatar/" + calcMD5(param.usuarioCreador.email) + "/?s=50";
        else gravatar = "http://www.gravatar.com/avatar/" + calcMD5('bb@asdasdasjkl.asd') + "/?s=50";
        
        //Setea el contexto de la intervención.
        if(param.intervencionRespuesta!=null){
            ret += param.TextoRespuesta;
        }
        ret += "</i></div>"+
        "<div class=\"controlDisplayIntervencionImagenContainer\" style=\"width:50px; margin-left:3px;\">"+
        "<img alt=\"avatar_"+ param.usuarioCreador.nombreUsuario+"\" src=\""+ gravatar +"\" width=\"50\" height=\"\" >"+
        "</div>"+
        "<div class=\"controlDisplayIntervenciontexto\" id=\"textoIntervencion_"+param.idIntervencion+"\" style=\"width:640px; height:55px; overflow:auto\" >"+
        //Procesa la intervención para separarla en párrafos.
        me.separaEnParrafos(param.Texto)+
        "</div>"+
        "<div class=\"clear\"></div>"+
        "<div class=\"controlDisplayIntervencionBotonera\">"+
        "<button class =\"btnEscribirNota\" id=\"escribeNota_"+param.idIntervencion+"\">Escribir nota...</button>"+
        "<button class =\"btnAgregarMarcador\" id=\"agregaMarcadores_"+param.idIntervencion+"\">Agregar a marcadores</button>"+
        "<button class =\"btnResponderATodo\" id=\"respondeTodo_"+param.idIntervencion+"\">Responder a todo</button>";
        //si está en modo facilitador, se muestra el botón como Corregir, sino se muestra como sugerir.
        if(me.modoFacilitador){
            ret+="<button class=\"btnSugerirCorreccion\" id=\"btnSugerirCorreccion"+param.idIntervencion+"\" style=\"float:right; margin-top: 3px; line-height: 15px;\">Corregir</button>";
        }else{
            ret+="<button class=\"btnSugerirCorreccion\" id=\"btnSugerirCorreccion"+param.idIntervencion+"\" style=\"float:right; margin-top: 3px; line-height: 15px;\">Sugerir</button>";
        }
        ret+="<select class=\"cmbTipoMovidas\" id=\"cmbTipoMovidas_"+param.idIntervencion+"\" style=\" width: 130px; float:right; margin-top:5px;\"><select>"+
        "</div>"+
        "</div>";
//        var p = $("#cmbTipoMovidas_" + param.idIntervencion);
//        $("#cmbTipoMovidas_" + param.idIntervencion +"option[value="+ param.tipoMovida.Nombre+"]").attr("selected",true);
        //var ret ="<div style=\"width:550px; height: 120px; background-color:orange;\"></div>";
    
        return ret;
    }

    /**No es parte del diseño original,
     * Es necesario separar cada párrafo en divs distintos de modo de poder identificarlos para
     * realizar la respuesta por párrafos.
     * @param {string} texto
     * @return {string} el contenido separado en parrafos.
     */
    NavegadorHilo.prototype.separaEnParrafos=function(texto){
        //<br> separa los párrafos
        var _parrafos = texto.split("<br>");
        var _nuevoTexto="";
        for(var i =0;i<_parrafos.length;i++){
            _nuevoTexto+="<div class=\"parrafo\">"+_parrafos[i]+"</div>";
        }
    
        return _nuevoTexto;
    }


    /*Limpiar el árbol
     */
    NavegadorHilo.prototype.limpiar = function(){
        //debería vaciar la lista de origen de datos.
        $("#arbol").tree("destroy");
        me.nodosAgregados=new Array();
    }

    /**
     *@param {Intervencion} intraiz
     */
    NavegadorHilo.prototype.agregarNodoRaiz = function(intraiz){
        var _imagenUsuario = me._ventanaPadre.getImage(intraiz.usuarioCreador.nombreUsuario);
        intraiz.usuarioCreador.imagen = _imagenUsuario;
            
        //Un elemento del árbol.
        var _nuevo = new NodoHilo();
        //id del elemento del arbol
        _nuevo.id = intraiz.idIntervencion;
        //objeto intervención correspondiente al elemento del árbol.
        _nuevo.intervencion = intraiz;
        //        var _imagenUsuario = me._ventanaPadre.getImage(intraiz.usuarioCreador.nombreUsuario);
        //        intraiz.usuarioCreador.imagen = _imagenUsuario;
        //crea elemento del arbol, en HTML. Esto a partir del objeto Intervención.
        _nuevo.label = me.agregarControlDisplayTextoIntervencion(intraiz, true);
        //arreglo para los nodos hijo.
        _nuevo.children = new Array();
        //Nivel del nodo actual.
        _nuevo.Nivel =1;
        //lista de nodos que han sido agregados al árbol.
        me.nodosAgregados.push(_nuevo);
    //me.nodosAnidados.push(_nuevo);
    }

    /**
     *Genera una lista de nodos anidados en base a una lista de intervenciones de un diálogo.
     *@param {Intervencion[]} listaIntervenciones
     */
    NavegadorHilo.prototype.agregarNodos = function(listaIntervenciones){
        for(var i=0;i<listaIntervenciones.length; i++){
            var _imagenUsuario = me._ventanaPadre.getImage(listaIntervenciones[i].usuarioCreador.nombreUsuario);
            listaIntervenciones[i].usuarioCreador.imagen = _imagenUsuario;
        }
        
        
        
        for(var i=0;i<listaIntervenciones.length; i++){
            try{
                if(listaIntervenciones[i].intervencionRespuesta != null){
                    var _agregarNodo = false;
                    var _nuevo = null;
                    for(var j=0;j<me.nodosAgregados.length;j++){
                        try{
                            
                            if(listaIntervenciones[i].intervencionRespuesta.idIntervencion == me.nodosAgregados[j].id){
                                _nuevo = new NodoHilo();
                                _agregarNodo = true;
                                _nuevo.id = listaIntervenciones[i].idIntervencion;
                                _nuevo.intervencion = listaIntervenciones[i];
                                
                                _nuevo.label = me.agregarControlDisplayTextoIntervencion(listaIntervenciones[i], false);
                                _nuevo.Nivel = me.nodosAgregados[j].Nivel+1;
                                me.nodosAgregados[j].children.push(_nuevo);
                                break;
                            }
                        }catch(ex){
                        //alert(ex);
                        }
                    }
                
                }
                else{
                //alert("==NULL"+inte.usuarioCreador.nombreUsuario);
                //me.agregarNodoRaiz(listaIntervenciones[i]);
                }
            }catch(ex){
                alert(ex);
            }
            if(_agregarNodo){
                me.nodosAgregados.push(_nuevo);
            //me.nodosAnidados.push(_nuevo);
            }
        }
    
    }

    /**
     *Ingresa cada elemento controlDisplayIntervencion en el arbol jqTree.
     *@param {Intervenciones[]} listaAnidada Lista anidada de intervenciones.
     */
    NavegadorHilo.prototype.setNavegadorHilo = function(listaAnidada){
        //borrar contenido anterior.
        //        $("#arbol").tree("destroy");
        //ingresaValores();
        
        
        
        var data = new Array();
        data[0] = listaAnidada;
       
        $('#arbol').tree({
            data : data,
            autoOpen : true,
            dragAndDrop : false,
            saveState : false,
            selectable : false
        });
       
       
        /*Seteo de botones y sus acciones*/
        {
        
        
            //seteo de menú contextual
            var _contextMenu = new responderContextMenu();
            _contextMenu.ventanaPadre = me;
            _contextMenu.setMenu();
            //FIN menu contextual
            
            /*cmbTipoMovidas*/
            if(me.modoFacilitador)
                $(".cmbTipoMovidas").prop("title","¿Desea corregir la movida?");
            else
                $(".cmbTipoMovidas").prop("title","¿Desea sugerir otra movida?");
                /*FIN cmbTipoMovidas*/
            
                /*boton Ver Contexto*/
            
                $(".btnVerContexto").button();
                        
            $(".btnVerContexto").click(function(){
                var p = $(this);
                var id = p[0].id.split("_");
                $("#contexto_"+id[1]).toggleClass("controlDisplayIntervencionContextoOut",100);
            
                return false;
            });
            /*FIN boton ver contexto*/
            
            /*Boton escribir/ver nota*/
            $(".btnEscribirNota").button({
                icons: {
                    primary: 'ui-icon-document'
                }
            });
            
            $(".btnEscribirNota").prop("title","Permite ver y agregar notas asociadas a esta intervención. Las intervenciones son personales.");
            
            $(".btnEscribirNota").click(function(){
                //               id = this.id;
                //               alert(id);
                me.abrirNotas(this.id.replace("escribeNota_",""));
            });
            
            /*FIN boton escribir/ver nota*/
            
            /*Boton agregar marcador*/
            $(".btnAgregarMarcador").button({
                icons: {
                    primary: 'ui-icon-agregarmarcadores'
                }
            });
            
            $(".btnAgregarMarcador").prop("title","Agrega esta intervención a la lista de marcadores.");
            
            $(".btnAgregarMarcador").click(function(){
                me.agregarMarcador(this.id.replace("agregaMarcadores_",""));
            });
            /*FIN boton agregar marcador*/
    
            /*responder a todo.*/
            $(".btnResponderATodo").button({
                icons: {
                    primary: 'ui-icon-responderatodo'
                }
            });
            
            //$(".btnResponderATodo").prop("title","Seleccione el texto para responder una parte");
           
            $(".btnResponderATodo").click(function(){
                var p = $(this);
                var id = p[0].id.split("_");
                var _nodoArbol = $("#arbol").tree('getNodeById',id[1]);
                //nodoIntervencion, texto
                me._ventanaPadre.agregarTabRespuesta(_nodoArbol.intervencion, _nodoArbol.intervencion.Texto);
                
            });
            
            /*FIN responder a todo*/
        
            /*boton sugerir*/
            $(".btnSugerirCorreccion").click(function(){
                //recuperar la intervención desde la que se envía.
                var idIntervencion = this.id;
                idIntervencion = idIntervencion.replace("btnSugerirCorreccion","");
                //recuperar el objeto movida.
                var _selectedOption = $("#cmbTipoMovidas_"+idIntervencion+" option:selected").val();
                var _seleccionada;
                for(var i=0;i<me.tiposMovida.length;i++){
                    if(me.tiposMovida[i].Nombre == _selectedOption){
                        _seleccionada = me.tiposMovida[i];
                    }
                }
                
                me.sugerirIntervencion(idIntervencion, _seleccionada);
            });
            /*FIN boton sugerir*/
            
            /*cargar comboMovidas*/
            //NOTA: Esto carga todas las movidas unas cantidadDeNodos veces.
            for(var i=0;i<me.tiposMovida.length;i++){
                $(".cmbTipoMovidas").append("<option>"+me.tiposMovida[i].Nombre+"</option>");
            }
            /*FIN cargar combo movidas*/
            
            
            //setea otros elementos de vistas.
            $(".controlDisplayIntervencionContexto div").css("cursor", "default");
            $(".controlDisplayIntervenciontexto div").css('cursor', 'text');
        }
    /*FIN seteo botones y sus acciones*/
    
    }

    
    /**
 * Ejecuta las acciones referentes a responder un párrafo
 * Método llamado desde responderContextMenu.js.-
 * @param {Object} parrafo Objeto HTML que contiene el parrafo seleccionado.
 * @param {string} idIntervencion ID de la intervencion a la que pertenece el párrafo que se responderá
 */
    NavegadorHilo.prototype.responderParrafo = function(texto, idIntervencion){
        try{
            //            idIntervencion = idIntervencion.split("_");
            //            //alert(parrafo.innerHTML+" ,"+idIntervencion[1]);
            //            alert(me.nodosAgregados);
            //            //llama a agregarTabRespuesta de ventanaPAdre.
            //            me._ventanaPadre.agregarTabRespuesta(idIntervencion, parrafo);
            
            //n del tipo NodoHilo.
            var _n = me.buscarNodo(idIntervencion.split("_")[1]);
            if(_n != null){
                _n.intervencion.Texto = texto;
                me._ventanaPadre.agregarTabRespuesta(_n.intervencion, texto);
            }
        }catch(ex){
            alert(ex);
        }
    }
    
    /**Entrega el nodo que originó el mensaje, la intervencion que da lugar a la respuesta.
 *@param {string} idIntervencion Origen es un idIntervencion
 *@return {NodoHilo}
 */
    NavegadorHilo.prototype.buscarNodo = function(idIntervencion){
        for(var i=0;i<me.nodosAgregados.length;i++){
            if(me.nodosAgregados[i].id==idIntervencion){
                return me.nodosAgregados[i];
            }
        }
        return null;
    }

    /**
 * Ejecuta las acciones referentes a responder a todo el texto.
 * 
 */
    NavegadorHilo.prototype.respondeTodo = function(textoIntervencion){
        //responde el párrafo con todo el texto como parámetro.
        alert(textoIntervencion.innerHTML+" ,"+textoIntervencion.id.split("_")[1]);
    }

    NavegadorHilo.prototype.agregarMarcador=function(origen){
        //llama a agregarMarcador de ventanaPadre
        var _n = me.buscarNodo(origen);
        me._ventanaPadre.agregarMarcador(_n.intervencion);
    }

    NavegadorHilo.prototype.abrirNotas=function(origen){
        //llama a abrirVentanaNotas de ventanaPadre
        try{
            //NodoHilo
            var _n = me.buscarNodo(origen);
            //Entrega el objeto Intervención relacionado con el nodo actual.
            me._ventanaPadre.abrirVentanaNotas(_n.intervencion);
        }catch(ex){
        }
    }

    /**
 * @param {string} idIntervencion
 * @param {Movida} movida.
 */
    NavegadorHilo.prototype.sugerirIntervencion=function(idIntervencion, movida){
        //alert("NavegadorHilo.sugerirIntervencion");
        //llama a guardarSugerenciaMovida de ventanaPadre
        var _n = new NodoHilo();
        _n = me.buscarNodo(idIntervencion);
        me._ventanaPadre.guardarSugerenciaMovida(_n.intervencion, movida);
    }

}

/*NodoHilo*/
function NodoHilo() {
    this.label;
    this.children = new Array();
    this.id;
    this.values;
    this.Nivel;
    
    this.intervencion = new Intervencion();
}
