$(function(){
    $("#grillaPerfiles").dataTable({
        
        "bJQueryUI" : true,
        "bPaginate" : false,
        "bScrollInfinite" : true,
        "bScrollCollapse" : false,
        "sScrollY" : "210px",
        "bServerSide" : false,
        "bFilter":false,
        "bAutoWidth":false,
        "oLanguage":{
            "sInfo": "",
            "sSearch": "Buscar entre las reglas: ",
            "sZeroRecords": "No se obtuvieron resultados que coincidan con su búsqueda",
            "sProcessing": "Cargando...",
            "sEmptyTable": "No hay perfiles disponibles",
            "sInfoFiltered": "Se han encontrado _TOTAL_ coincidencias",
            "sInfoEmpty": ""
            
        },
        "aoColumns":[{
            sTitle: "idCategoria",
            bVisible: false
        },{
            sTitle: "Nombre"
        },{
            sTitle: "Descripción"
        }]
            
    });
    
    $("#grillaMovidas").dataTable({
        
        "bJQueryUI" : true,
        "bPaginate" : false,
        "bScrollInfinite" : true,
        "bScrollCollapse" : false,
        "sScrollY" : "210px",
        "bServerSide" : false,
        "bFilter":false,
        "bAutoWidth":false,
        "oLanguage":{
            "sInfo": "",
            "sSearch": "Buscar entre las reglas: ",
            "sZeroRecords": "No se obtuvieron resultados que coincidan con su búsqueda",
            "sProcessing": "Cargando...",
            "sEmptyTable": "No hay movidas disponibles",
            "sInfoFiltered": "Se han encontrado _TOTAL_ coincidencias",
            "sInfoEmpty": ""
            
        },
        "aoColumns":[{
            sTitle: "idMovida",
            bVisible: false
        },{
            sTitle: "Nombre",
            sClass: "editable"
        },{
            sTitle: "Descripción",
            sClass: "editable"
        }]
            
    });
    
    
    $(".btnAddPerfil").button();
    $(".btnAddMovida").button();
    $(".btnUpdateMov").button(),
    $(".btnGuardarMovidas").button();
    $("#btnAplicarMovidaDeterminada").button();
});


function ControlPerfilMovidas(){
    me = this;
    
    this.controlador;
    this.sesionActual;
    this.categorias;
    this.initializeComponents();
}

ControlPerfilMovidas.prototype.initializeComponents=function(){
    $(".btnAddPerfil").click(function(){
        me.btnAddPerfil_Click();
    });
    $(".btnAddMovida").click(function(){
        me.btnAddMovida_Click();
    });
    $(".btnGuardarMovidas").click(function(){
        
        me.btnGuardarMovidas_Click(); 
    });
    $(".btnUpdateMov").click(function(){
        me.btnUpdateMov_Click();
        
    });
      
    $("#btnAplicarMovidaDeterminada").click(function(){
        me.btnAplicarMovidaDeterminada_Click(); 
    });
}
    
ControlPerfilMovidas.prototype.btnAplicarMovidaDeterminada_Click = function(){
        //Obtengo el valor de movida seleccionado.
        var _movida = $("#cmbSelectMovida option:selected").val();
        var _idPerfil = $("#grillaPerfiles").dataTable().fnGetData($("#grillaPerfiles tbody tr.ui-state-focus")[0])[0];
        
        //método de controlador para guardar el ID de la movida en cuestión.
        var _exito = me.controlador.insertarMovidaCrearDialogo(_idPerfil, _movida);
        
        if(_exito){
            notificar("Movida asignada como predeterminada para la creación");
        }else
            notificar("La movida no se pudo asignar como predeterminada para la creación")
    }
    
ControlPerfilMovidas.prototype.cargarMovidas=function(sesionActual){
    this.sesionActual = sesionActual;
    this.controlador = new CMovida(me.sesionActual);
    this.actualizarLista();
        
}

ControlPerfilMovidas.prototype.actualizarLista=function(){
    var movida = this.controlador.listarCategorias();
    movida.pop();
    this.categorias = movida;
    //Llenar grillaPerfiles con movida.
    
    for(var m in movida){
        $("#grillaPerfiles").dataTable().fnAddData([movida[m].idCategoria, movida[m].nombre, movida[m].descripcion]);
    }
    
    /**
     * Definición del evento de click en la fila.
     */
    $("#grillaPerfiles tbody tr").click(function(e){
        if($(this).hasClass('ui-state-focus')){
            $(this).removeClass('ui-state-focus');
        }else{
            $("#grillaPerfiles").dataTable().$('tr.ui-state-focus').removeClass('ui-state-focus');
            $(this).addClass('ui-state-focus');
             
            var _perfilActual = $("#grillaPerfiles").dataTable().fnGetData(this);
            me.grillaPerfiles_SelectedCellsChanged(_perfilActual);
        }
    });
    
    if($(".cmbEje").val() == null || $(".cmbEje").length == 0 ){
        $(".cmbEje").html('<option value="0">Buscar entender</option>'+
            '<option value="1">Darse a entender</option>');
    }
    
}

ControlPerfilMovidas.prototype.btnUpdateMov_Click=function(){
    
    //Obtener el id del perfil seleccionado, desde la tabla de perfiles.
    var profileId = $("#grillaPerfiles").dataTable().fnGetData($("#grillaPerfiles tbody tr.ui-state-focus")[0])[0];
    //Obtener las movidas de este perfil
    var editingRow = $("#grillaMovidas").dataTable().fnGetNodes();
    //    var p = $("#grillaMovidas").dataTable().fnGetData(editingRow[0]);
    
    if(editingRow.length > 0 && typeof(editingRow) != 'undefined' ){
        //Elimina las movidas nulas.
        for(var i=0;i<me.categorias.length;i++){
            for(var j=0;j<me.categorias[i].movidas.length;j++){
                if(me.categorias[i].movidas[j] == null){
                    me.categorias[i].movidas.splice(j,1);
                }
            }
        }
        for(var i=0;i<me.categorias.length;i++){
            if(me.categorias[i].idCategoria == profileId){
                for(var j=0; j < me.categorias[i].movidas.length; j++){
                    me.categorias[i].movidas[j].Nombre = editingRow[j].children[0].innerHTML;
                    me.categorias[i].movidas[j].descripcion = editingRow[j].children[1].innerHTML;
                }
            }
        }
    
        var _exito = false;
        for(i=0;i<me.categorias.length;i++){
            if(me.categorias[i].idCategoria == profileId){
                _exito = me.controlador.guardarCategoriaMovida(me.categorias[i]);
                break;
            }
        }
        
        if(_exito)
            notificar("Movidas actualizadas correctamente.");
        else
            notificar("Error en la actualización de movidas.")
    }
        
}

ControlPerfilMovidas.prototype.grillaPerfiles_SelectedCellsChanged=function(perfil){
    
    $("#grillaMovidas").dataTable().fnClearTable();
    $("#grillaMovidas tbody").empty();
    //Llena la lista de movidas con las movidas del perfil seleccionado.
    var movs;
    for(var i=0;i<me.categorias.length;i++){
        if(me.categorias[i].idCategoria == perfil[0]){
            movs = me.categorias[i].movidas;
        }
    }
    
    
    /**
     * Obtengo la movida predeterminada del diálogo, y la establezco como seleccionada.
     */
    var _idPerfil = $("#grillaPerfiles").dataTable().fnGetData($("#grillaPerfiles tbody tr.ui-state-focus")[0])[0];
    var movsel = me.controlador.obtenerMovidaPredeterminada(_idPerfil);
    
    
    $("#cmbSelectMovida").empty();
    $("#cmbSelectMovida").append("<option value=\"0\">-seleccione una movida predeterminada-</option>");
    for(m in movs){
        if(movs[m]!=null){
            //Carga las movidas en la tabla de movidas
            $("#grillaMovidas").dataTable().fnAddData([movs[m].IdMovida, movs[m].Nombre, movs[m].descripcion]);
            //carga las movidas en cmbSelectMovida
       
            $("#cmbSelectMovida").append("<option value=\"" + movs[m].IdMovida + "\">" + movs[m].Nombre + "</option>")
        }
    }
    
    
    $("#cmbSelectMovida option[value="+movsel+"]").attr("selected", "true");
    
    $(".editable").editable(function(value, settings){
        return value;
    },{
        type:"text",
        onblur:'submit',
        event:'dblclick',
        onreset:'submit',
        placeholder:''
    //        submit:"OK"
    });
    
    
    
}

ControlPerfilMovidas.prototype.btnAddPerfil_Click=function(){
    //Recoge todos los perfiles.
    var _perfiles = me.categorias;
    
    var _nombrePerfil = $(".txtNombrePerfil").val();
    var _descPerfil = $(".txtDescripcionPerfil").val();
    
    if(_nombrePerfil == null || $.trim(_nombrePerfil).length == 0){
        notificar("Ingrese un nombre para el perfil");
        return;
    }
    
    if(_descPerfil == null || $.trim(_descPerfil).length == 0){
        notificar("Ingrese una descripción para el perfil");
        return;
    }
    
    for(var i=0;i<_perfiles.length;i++){
        if(_perfiles[i].nombre.toLowerCase() == $(".txtNombrePerfil").val().toLowerCase()){
            notificar("El perfil ya existe.<br>Utilice otro nombre.");
            return;
        }
    }
    
    var _nueva = me.controlador.crearCategoria(_nombrePerfil);
    _nueva.descripcion = _descPerfil;
    _perfiles.push(_nueva);
    me.categorias = _perfiles;
    
    //cargo _perfiles en grillaPerfiles.
    $("#grillaPerfiles").dataTable().fnClearTable();
    $("#grillaPerfiles tbody").empty();
    for(var p in _perfiles)
        $("#grillaPerfiles").dataTable().fnAddData([_perfiles[p].idCategoria, _perfiles[p].nombre, _perfiles[p].descripcion]);
    
    $("#grillaPerfiles tbody tr").click(function(e){
        if($(this).hasClass('ui-state-focus')){
            $(this).removeClass('ui-state-focus');
        }else{
            $("#grillaPerfiles").dataTable().$('tr.ui-state-focus').removeClass('ui-state-focus');
            $(this).addClass('ui-state-focus');
             
            var _perfilActual = $("#grillaPerfiles").dataTable().fnGetData(this);
            me.grillaPerfiles_SelectedCellsChanged(_perfilActual);
        }
    });
}

ControlPerfilMovidas.prototype.btnAddMovida_Click=function(){
    try{
        var _nombreMovida = $(".txtNombreMovida").val();
        var _descripcionMovida = $(".txtDescripcionMovida").val();
        var _eje = $(".cmbEje option:selected").val();
        
        if(_eje == null){
            notificar("Seleccione un eje");
            return;
        }
        if(_nombreMovida == null || $.trim(_nombreMovida).length == 0){
            notificar("Ingrese un nombre para la movida");
            return;
        }
        if(_descripcionMovida == null || $.trim(_descripcionMovida).length == 0){
            notificar("Ingrese una descripción para la movida");
            return;
        }
        
        var _obj = $("#grillaPerfiles tbody tr.ui-state-focus");
        _obj = $("#grillaPerfiles").dataTable().fnGetData(_obj[0]);
        var _movs;
        for(var cat in me.categorias){
            if(me.categorias[cat] != null){
                if(me.categorias[cat].idCategoria == _obj[0]){
                    _movs = me.categorias[cat].movidas;
                }
            }
        }
        
        for(m in _movs){
            if(_movs[m] != null)
                if(_movs[m].Nombre.toLowerCase() == $.trim(_nombreMovida).toLowerCase()){
                    notificar("Ingrese un nombre diferente para la nueva movida");
                    return;
                }
        }
        
        
        var nueva = me.controlador.crearMovida(_nombreMovida, _descripcionMovida);
        nueva.eje = _eje;
        _movs.push(nueva);
        _obj.movidas = _movs;
        me.categorias.movidas = _movs;
        
        
        //Actualizar la tabla de movidas.
        $("#grillaMovidas").dataTable().fnClearTable();
        $("#grillaMovidas tbody").empty();
        
        for(var m in _movs){
            if(_movs[m] != null){
                $("#grillaMovidas").dataTable().fnAddData([_movs[m].IdMovida, _movs[m].Nombre, _movs[m].descripcion]);
            }
        }
        
        $(".editable").editable(function(value, settings){
            return value;
        },{
            type:"text",
            onblur:'submit',
            event:'dblclick',
            placeholder:''
        //submit:"OK"
        });
        
        
        
    }catch(ex){
        alert(ex);
    }
}

ControlPerfilMovidas.prototype.btnGuardarMovidas_Click=function(){
    try{
        
       
        var movidas = me.categorias;
        var exito = true;
        
        var gm = $("#grillaMovidas").dataTable().fnGetData();
              
        for(var i=0;i<movidas.length; i++){
            exito = me.controlador.guardarCategoriaMovida(movidas[i]);
        }
        
        if(exito){
            $(".formContainer input").val("");
            $(".formContainer textarea").val("");
            notificar("Perfiles y movidas guardados exitosamente");
        }else{
            notificar("No se pudo guardar algunas movidas.");
        }
       
    }catch(ex){
        notificar("Ocurrió un error al guardar las movidas");
        
    }
    
}