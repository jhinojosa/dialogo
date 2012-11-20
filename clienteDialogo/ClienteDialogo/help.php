<?php
session_start();

// se cierra la sesion?
if (isset($_REQUEST['logout'])) {
    
    // Se destruyen todas las variables de sesion
    $_SESSION = array();

    // la sesion es destruida!
    session_destroy();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--[if lt IE 7]> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js"> <!--<![endif]-->

<head>

<title>Sistema para el diálogo remoto</title>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Description" />
<meta name="keywords" content="" />
<meta name="robots" content="all" />
<meta name="author" content="Author"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- css-->
<link rel="stylesheet/less" type="text/css" href="../estilos/style.less">
<link rel="stylesheet" href="../estilos/css/bootstrap.css" type="text/css" media="screen" />
<!-- /css-->

<!-- modernizr -->
<!--<script type="text/javascript" src="js/modernizr.js"></script>-->
<!-- /modernizr -->

<!--Favicon-->
<link rel="shortcut icon" href="../Favicon/favicon.ico">

<script>
    /**
     * Deshabilita el volver a la ventana anterior al cerrar la aplicación desde el botón.
     */
    if (history.forward(1)){location.replace(history.forward(1))}
</script>
<script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>
<script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>

<script src="InicioSesion.js" type="text/javascript"></script>
<script src="recuperacionContrasena.js" type="text/javascript"></script>
<script src="Controles/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>
<script src="../ClienteDialogo.GUI/datatypes/Usuario.js" type="text/javascript"></script>
<script src="../ClienteDialogo.GUI/datatypes/Sesion.js" type="text/javascript"></script>
<script src="Controladores/CValidacionUsuario.js" type="text/javascript"></script>
<script src="Controladores/ConexionManager.js" type="text/javascript"></script>
<script src="VentanaRegistro.js" type="text/javascript"></script>
</head>

<body data-spy="scroll" data-target="#ayuda-index">
    <div id = "warning">
        
        <!--[if IE 6]>
        <p>
            La versión de Internet Explorer que est&aacute;s utilizando
            no está actualizada. <br />
            Este sitio funcionar&aacute; mejor si actualizas tu navegador.
            <a href="http://www.microsoft.com/latam/windows/internet-explorer/">Actualizar Internet Explorer</a>
        </p>
        <![endif]-->
        
        <noscript>
            <p>
                Es necesario que tengas activado Javascript en su navegador 
                para utilizar todas las funciones de este sitio.
                <a href="#">
                    &iquest;C&oacute;mo activar Javascript?
                </a>
            </p>
        </noscript>
    </div><!-- #warning -->
    

    <div id="page" class="container">
        
        <div id="header" class="row">

            <!-- logo de la app -->
            <div id="app-logo" class="span2">
                <img src="../estilos/img/html/app-logo.png" alt="" />
            </div>
            <!-- fin logo de la app -->

            <!-- titulo de la app -->
            <div id="app-title" class="span4">
                <h5>Universidad de Santiago de Chile <br>
                    Departamento de Ingeniería Informática</h5>
                <h3>Diálogo Remoto</h3>
            </div>
            <!-- fin titulo de la app -->

            <!-- formulario de inicio de sesión -->
            <div id="top-login" class="span6">
                <form id="login" class="form-inline">
                    <legend>Iniciar Sesión</legend>
                    <div id="top-user">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <input id="usuario" type="text" class="input-medium" placeholder="Nombre de Usuario">
                        </div>
                    </div>        
                    <div id="top-password">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <input id="contrasegna" type="password" class="input-small" placeholder="Contraseña">
                        </div>
                        <a id="forgotPassword" href="#myModal" role="button" data-toggle="modal">¿Olvido su Contraseña?</a>
                    </div>
                    <a id="ingresar" class="btn btn-primary clearfix">Ingresar</a>
                </form>

                <?php require_once 'recuperacionContrasena.php';?>
                <?php require_once 'Controles/ControlNotificacion/ControlNotificacion.php';?>
            </div>
            <!-- fin de formulario de inicio de sesión -->                           
        </div> <!-- #header -->

    <div id="menu-bar" class="row">
        <div class="span12">
            <div class="navbar">
                <div class="navbar-inner">
                    <ul class="nav">
                        <li><a rel="tooltip" title="first tooltip" href="#"><i class="icon-home"></i> Portada</a></li>
                    </ul>
                    <ul class="nav pull-right">
                        <li class="active"><a href="#"><i class="icon-question-sign"></i> Ayuda</a></li>
                        <li><a href="#"><i class="icon-info-sign"></i> Acerca de</a></li>
                    </ul>
                 </div>
            </div>    
        </div>  
    </div><!-- #menu-bar -->


    <div id="barra-estado" class="row">
        <div class="span12">
            <ul class="breadcrumb">
                <li class="active"><i class="icon-question-sign"></i> Acerca de</li>
            </ul>
        </div> 
    </div> <!-- #barra-estado -->       

    <div class="row" id="content">

        <div id="ayuda-index" class="span4">
            <ul class="bs-docs-sidenav nav nav-list affix">
              <li><a href="#dialogo-remoto">  1. ¿Qué es Diálogo Remoto?</a></li>
              <li><a href="#compatibilidad">  2. Compatibilidad</a></li>
              <li><a href="#registrandose">   3. Registrándose como usuario</a></li>
              <li><a href="#ingresando">      4. Ingresando al sistema</a></li>
              <li><a href="#accediendo">      5. Acceder a un diálogo</a></li>
              <li><a href="#propiedades">     6. Propiedades del diálogo y el acta dialogal</a></li>
              <li><a href="#marcadores">      7. Marcadores de acceso rápido</a></li>
              <li><a href="#intervencion">    8. Buscando una intervención</a></li>
              <li><a href="#creando">         9. Creando un nuevo diálogo</a></li>
              <li><a href="#realizando">      10. Realizando una intervención en un diálogo</a></li>
              <li><a href="#acceder-acerca">  11. Acceder a la información "Acerca de" de la aplicación</a></li>
              <li><a href="#mapa">            12. Mapa de intervenciones</a></li>
            </ul>
        </div>
          <div class="span8">
            <h3>Bienvenido a la guía de usuario de Diálogo Remoto</h3>
            
            <div id="dialogo-remoto" class="help-section">
              <h3>¿Qué es Diálogo Remoto?</h3>
              <p>Diálogo remoto es una aplicación que busca mejorar los sistemas de comunicación remota, en forma de texto.</p>
              <p>Un diálogo es la forma de realizar un intercambio de información, en el cual los participantes logren generar nuevo conocimiento al realizar intervenciones cooperativas.</p>
              <p>El objetivo de esta aplicación, es dar una estructura que permita mejorar el orden y tipo de intervenciones que se realizan, en pro de guiarla a un “Diálogo”, en vez de una discusión.</p>
              <p>Para iniciar la aplicación, debe ingresar a  la siguiente dirección en su navegador web: <a href="http://dialogoactivo.diinf.usach.cl">http://dialogoactivo.diinf.usach.cl</a>.</p>
            </div>

            <div id="compatibilidad" class="help-section">
              <h3>Compatibilidad</h3>
              <p>Se recomienda para el correcto funcionamiento, la utilización de uno de los siguientes navegadores Web:•  Se recomienda para el correcto funcionamiento, la utilización de uno de los siguientes navegadores Web:</p>
              <p>
                    <a href="https://www.google.com/intl/es/chrome/browser/?hl=es" rel="tooltip" data-original-title="Chrome"><img src="../estilos/img/html/gc_64.png"></a>
                    <a href="http://www.mozilla.org/es-ES/firefox/new/" title="Firefox" rel="tooltip"><img src="../estilos/img/html/ff_64.png"></a>
                    <a href="http://www.opera.com/" title="Opera" rel="tooltip"><img src="../estilos/img/html/o_64.png"></a>
                    <a href="http://www.apple.com/es/safari/" title="Safari" rel="tooltip"><img src="../estilos/img/html/s_64.png"></a>
              </p>
              <p>Debe de instalar la Máquina Virtual de Java. El software lo puede descargar e instalar desde la siguiente dirección: <a href="http://www.java.com/es/download/">http://www.java.com/es/download/</a></p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/java-download-ss.png" alt=""></div></p>
              <p>Haga "Clic" en "Descarga gratuita de Java".  Llegará a la siguiente pantalla donde de nuevo debe de hacer "clic" en "Descarga gratuita de Java". Tras hacer "clic" en "Descarga gratuita de Java" llegará a una solicitud para descargar o ejecutar la aplicación. Debe de nuevo hacer "clic" en ejecutar. Luego aparecerá el siguiente mensaje</p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/java-download-confirm-ss.png" alt=""></div></p>
              <p>Nuevamente hacer click en “Ejecutar”. Con esto se ejecutará el instalador.</p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/java-install-ss.png" alt=""></div></p>
              <p>Ahora se encuentra con una pantalla de bienvenida a Java. Hacer "Click" en el botón instalar, siga los pasos referentes a continuar la instalación y rápidamente</p>
            </div>

            <div id="registrandose" class="help-section">
              <h3>Registrándose como usuario</h3>
              <p>En la página de inicio, a la derecha, está el menú de registro siempre disponible. Para registrarse, debe realizar los siguientes pasos:</p>
              <ul>
                <li>Debe llenar los campos de la zona de registro según los ejemplos que aparecen en cada espacio.</li>
                <li>Debe asegurarse de cumplir con los formatos mostrados en los ejemplos. En el caso del campo del correo electrónico, por ejemplo, se debe ingresar una dirección válida, que cumpla el formato “usuario@dominio.com”. Si no se cumple con este formato, no podrá continuar con el registro. </li>
                <li>No se puede dejar campos sin rellenar.</li>
                <li>Una vez completados todos los campos de forma válida, se debe presionar el botón “Registrar”. Aparecerá un mensaje que confirma la correcta realización de la operación.</li>
              </ul>
              <p>En la siguiente figura se puede observar el campo de registro:</p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/register-ss.png" alt=""><small>Figura: Campo de Registro</small></div></p>
            </div>

            <div id="ingresando" class="help-section">
              <h3>Ingresando al sistema</h3>
              <p>Para iniciar una cuenta de usuario se deben realizar los siguientes pasos:</p>
              <ul>
                <li>Se debe contar con una cuenta de usuario registrada y conocer su nombre de usuario y contraseña.</li>
                <li>En la parte superior derecha de la página,  hay una sección llamada “Inicio de Sesión”. En él aparecen dos campos que se pueden llenar con información.  El primer campo posee el texto de ejemplo “Nombre de usuario”. Al hacer click en él se debe  escribir el nombre de usuario de la cuenta con la que se desea ingresar.</li>
                <li>En el segundo campo, se debe ingresar la contraseña de la cuenta asociada.</li>
                <li>Luego se debe hacer click en el botón “Ingresar”</li>
                <li>Si la información ingresada es correcta, la aplicación habrá iniciado sesión con estos datos de usuario. </li>
                <li>Si los datos son erróneos, informará del error.</li>
              </ul>
              <p>En la siguiente figura se puede observar el campo de inicio de sesión.</p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/login-ss.png" alt=""><small>Figura: Campo de Inicio de Sesión</small></div></p>
            </div>

            <div id="accediendo" class="help-section">
              <h3>Acceder a un diálogo</h3>
              <ul>
                <li>Para acceder a un diálogo, debe iniciar sesión con una cuenta de usuario válida. </li>
                <li>Una vez realizado esto, la aplicación lo enviará a la vista que incluye la lista de diálogos disponibles.</li>
                <li>Se debe hacer “click” en el nombre del diálogo que se desea revisar. </li>
                <li>En la ventana del diálogo seleccionado se pueden ver las intervenciones, navegar por ellas, responderles y ver las estadísticas de participación.</li>
                <li>Además, aparece un mapa de intervenciones o “navegador del diálogo”, el cual es explicado en el punto <a href="#mapa">12</a>.</li>
              </ul>
              <p>En la siguiente figura se puede observar la lista de diálogos disponibles.</p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/list-dialogs-ss.png" alt=""><small>Figura: Lista de diálogos disponibles</small></div></p>
              <p>Una vez ingresado al diálogo, se observa lo siguiente:</p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/in-dialog-ss.png" alt=""><small>Figura: En el diálogo</small></div></p>
            </div>

            <div id="propiedades" class="help-section">
              <h4>Propiedades del diálogo y Aca dialogal</h4>
              <ul>
                <li>Se puede acceder a información del diálogo, como el nombre del creador y la fecha de creación, además de visualizar información estadística. </li>
                <li>Para esto, debe hacer click en la pestaña “Acerca del diálogo”, que se encuentra en el menú del diálogo seleccionado (Punto 3.3 Acceder a un diálogo).</li>
                <li>Se puede observar información de quien inició el diálogo, algunos datos estadísticos del balance del diálogo y además, en la parte inferior de esta pantalla se puede ingresar actas dialogales, las cuales simulan la creación de un acta para un diálogo presencial. Todo esto se puede observar en la figura a continuación.</li>
              </ul>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/dialog-properties-ss.png" alt=""><small>Figura: Propiedades del diálogo</small></div></p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/dialog-record-ss.png" alt=""><small>Figura: Acta dialogal</small></div></p>
            </div>

            <div id="marcadores" class="help-section">
              <h3>Marcadores de acceso rápido</h3>
              <ol>
                <li>Las intervenciones seleccionadas como marcadores están disponibles en la ventana de marcadores
                  <ol>
                    <li>Para acceder a esta ventana, se debe hacer click en el botón “ver marcadores” que se encuentra en la ventana principal. </li>
                    <li>Esto se puede observar en la figura a continuación:</li>
                    <p><div class="thumbnail"><img src="../estilos/img/html/help/button-access-ss.png" alt=""><small>Figura: Botón de acceso a marcadores</small></div></p>
                  </ol>
                </li>
                <li>Para crear un nuevo marcador
                  <ol>
                    <li>Debe dirigirse al diálogo de su interés</li>
                    <li>En la intervención que desea marcar, debe hacer click en “Agregar a marcadores”. Con esto la intervención será incluida en el menú de marcadores.</li>
                    <li>Esto se puede observar en la figura a continuación:</li>
                    <p><div class="thumbnail"><img src="../estilos/img/html/help/add-mark-ss.png" alt=""><small>Figura: Agregar Marcador</small></div></p>
                  </ol>
                </li>
              </ol>
            </div>

            <div id="intervencion" class="help-section">
              <h3>Buscando una intervención</h3>
              <p>La aplicación incluye un sistema de búsqueda de intervenciones. Para buscar una intervención debe realizar lo siguiente:</p>
              <ul>
                <li>Diríjase al menú principal de la aplicación.</li>
                <li>Arriba a la derecha aparece un campo denominado “buscar intervenciones”</li>
                <li>Para realizar una búsqueda se debe ingresar el nombre del usuario que realizó la intervención</li>
                <li>Aparecerá un listado con las intervenciones del usuario. </li>
                <li>Para acceder a la intervención, solo debe hacer click sobre esta.</li>
              </ul>
              <p>A continuación se muestra una figura que muestra esta opción:</p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/find-int-ss.png" alt=""><small>Figura: Agregar Marcador</small></div></p>
            </div>

            <div id="creando" class="help-section">
              <h3>Creando un nuevo diálogo</h3>
              <p>Para crear un nuevo diálogo se debe:</p>
              <ul>
                <li>Acceder con una cuenta de usuario válida al sistema.</li>
                <li>En la ventana principal, seleccionar la opción “nuevo diálogo”</li>
                <p><div class="thumbnail"><img src="../estilos/img/html/help/new-dialog-ss.png" alt=""><small>Figura: Botón "Nuevo Diálogo"</small></div></p>
                <li>Aparecerá una nueva ventana en la cual se solicita completar los campos disponibles.</li>
                <li>Completar los campos solicitados. </li>
                <li>Para configurar las características del diálogo, hacer click en  en el botón “cambiar configuración”</li>
                <p><div class="thumbnail"><img src="../estilos/img/html/help/dialog-access-config-ss.png" alt=""><small>Figura: Ventana de Nuevo Diálogo. Acceso a la configuración del diálogo</small></div></p>
                <li>Se accederá con esto al siguiente menú:</li>
                <p><div class="thumbnail"><img src="../estilos/img/html/help/dialog-config-ss.png" alt=""><small>Figura: Ventana de Configuración de Diálogo</small></div></p>
                <li>Seleccionar un tipo de perfil desde el menú y luego completar los campos con los porcentajes solicitados. Entre todos los tipos de movida, los porcentajes deben sumar 100.<p>NOTA: Las opciones “Reglas de Diálogo” y “Permisos de Diálogo” no están disponibles en esta versión.</p></li>
                <li>Una vez configurado el diálogo, presionar el botón azul “Guardar Configuración”</li>
                <li>Se regresará al menú de “Nuevo Diálogo”. </li>
                <li>Para finalizar, presionar el botón azul “Publicar” para completar la publicación. Su nuevo diálogo estará disponible en la lista de diálogos.</li>
                <p><div class="thumbnail"><img src="../estilos/img/html/help/publish-new-dialog-ss.png" alt=""><small>Figura: Publicar Nuevo Diálogo</small></div></p>
              </ul>
            </div>

            <div id="realizando" class="help-section">
              <h3>Realizando una intervención en un diálogo</h3>
              <p>Para acceder a un diálogo vigente, debe realizar los pasos de la ayuda 3.3. Para realizar una intervención, debe hacer lo siguiente:</p>
              <ul>
                <li>Ingresar al diálogo en el que desea intervenir</li>
                <li>Elegir la intervención a la cual desea responder. Hacer click  en el botón “Responder a todo”</li>
                <p><div class="thumbnail"><img src="../estilos/img/html/help/ans-int-ss.png" alt=""><small>Figura: Responder una intervención</small></div></p>
                <li>Seleccionar el tipo de intervención que realizará, en un menú de selección que aparece en el costado derecho del campo de la nueva intervención. Esto es importante para el control estadístico y balance del diálogo.</li>
                <li>ngresar el texto de la intervención</li>
                <p><div class="thumbnail"><img src="../estilos/img/html/help/config-int-ss.png" alt=""><small>Figura: Configuración de la intervención y publicación de esta.</small></div></p>
                <li>Una vez realizado esto, presionar el botón “Enviar” para completar la publicación.</li>
              </ul>
            </div>

            <div id="acceder-acerca" class="help-section">
              <h3>Acceder a la información “Acerca de” la aplicación</h3>
              <p>Existen 2 formas de acceder a la información adicional de la aplicación.</p>
              <ol>
                <li>La primera de ellas de logra desde el menú inicial, antes de realizar el inicio de sesión. 
                  <ol>
                    <li>Para esto, el usuario debe dirigirse al sector izquierdo de la página, en la sección llamada “¿Qué es Dialogo Remoto?</li>
                    <li>En esta sección, aparece un botón que dice “Saber más”. Hacer click en el. Se abrirá una ventana que mostrará la información adicional.</li>
                  </ol>
                </li>
                <li>La segunda forma es por medio del botón “Acerca de” que se encuentra en el menú superior de todas las pantallas.</li>
              </ol>
              <p>A continuación se muestran figuras con las formas de acceder a la información adicional.</p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/read-more-ss.png" alt=""><small>Figura: Acceder al “Acerca de” desde la portada</small></div></p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/navbar-about-ss.png" alt=""><small>Figura: Acceder desde el menú principal</small></div></p>
            </div>

            <div id="mapa" class="help-section">
              <h3>Mapa de intervenciones o Navegador de diálogo</h3>
              <p>Este es un elemento guía que aparece sobre la sección de intervenciones en un diálogo. Su utilidad radica en que permite ver de forma visual, la estructura que lleva el diálogo hasta el momento, ver quién le responde a quién, saber que intervención tiene más respuestas, además de que cuando el diálogo es muy prolongado, saber con claridad a quién debo responder a la hora de hacer una intervención, para mantener el sentido del diálogo.</p>
              <p>Para utilizarlo solo se debe acceder al diálogo. El mapa se despliega automáticamente, como se puede observar en la imagen a continuación:</p>
              <p><div class="thumbnail"><img src="../estilos/img/html/help/map-ss.png" alt=""><small>Figura: Mapa de intervenciones</small></div></p>
            </div>

          </div>

    </div><!-- #content -->
    <script type="text/javascript">
      $(document).ready(function(){
        $('.bs-docs-sidenav').affix({
            offset: {
              top: 240,
              bottom: 400
            }
        });
        $('.help-section').tooltip({
          selector: "a[rel=tooltip]"
        })
      });
    </script>

        <!-- no agregar nada más, de aquí en adelante va footer.php -->
<?php require_once '../footer.php';?>

        
