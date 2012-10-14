
function CMovida(sesionActual){this.sesionActual=sesionActual;this.categoriasActuales;}
CMovida.prototype.obtenerMovidaPredeterminada=function(idPerfil){var _ret=0;try{var _servicio=new ConexionManager();var parametros=new SOAPClientParameters();parametros.add("iddialogo",idPerfil);_ret=_servicio.conexion("obtenerMovidaCrearDialogo",parametros);}catch(ex){return 0;}
return _ret;}
CMovida.prototype.insertarMovidaCrearDialogo=function(idCategoria,idMovida){var _ret=false;try{var _servicio=new ConexionManager();var parametros=new SOAPClientParameters();parametros.add("idcategoria",idCategoria);parametros.add("idmovida",idMovida);_ret=_servicio.conexion("insertarMovidaCrearDialogo",parametros);}catch(ex){return false;}
return _ret;}
CMovida.prototype.listarCategorias=function(){var _ret=new Array();try{var _servicio=new ConexionManager();var parametros=new SOAPClientParameters();parametros.add("sesion",JSON.stringify(this.sesionActual));_ret=_servicio.conexion("listarCategoriasMovida",parametros);}catch(ex){}
return _ret;}
CMovida.prototype.crearCategoria=function(nombre){var _nueva=new CategoriaMovida();_nueva.nombre=nombre;_nueva.idCategoria=0;_nueva.movidas=new Array();return _nueva;}
CMovida.prototype.crearMovida=function(titulo,descripcion){var _nueva=new Movida();_nueva.Nombre=titulo;_nueva.descripcion=descripcion;_nueva.IdMovida=0;return _nueva;}
CMovida.prototype.guardarCategoriaMovida=function(categoria){var cat=new CategoriaMovida();var _retorno=false;try{var _cm=new ConexionManager();var parametros=new SOAPClientParameters();parametros.add("sesion",JSON.stringify(this.sesionActual));for(var c in categoria){if(c=="movidas")
{var movs=new Array();for(var i=0;i<categoria[c].length;i++){if(categoria[c][i]!=null){var movida=new Movida();movida.autor=JSON.stringify(categoria[c][i].autor);movida.IdMovida=JSON.stringify(categoria[c][i].IdMovida);movida.Nombre=JSON.stringify(categoria[c][i].Nombre);movida.descripcion=JSON.stringify(categoria[c][i].descripcion);movida.eje=JSON.stringify(categoria[c][i].eje);movs.push(movida);}}
cat[c]=movs;}else
cat[c]=JSON.stringify(categoria[c]);}
parametros.add("categoria",cat);_retorno=_cm.conexion("guardarPerfilMovida",parametros);}catch(ex){}
return _retorno;}