<form id="register-form" class="form-horizontal">
                    <legend>Regístrate</legend>
                    <div id="lblMensajeError" class="alert alert-warning">
                        <strong>Atención!</strong> <span>Todos los campos son obligatorios</span>
                    </div>
                    <div id="name-form" class="control-group">
                        <label for="" class="control-label">Nombre de Usuario <i class="icon-user"></i></label>
                        <div class="controls">
                            <input name="name" id="name" type="text" placeholder="ej: jperez">
                            <span class="help-block">Solo letras y números sin caracteres especiales</span>
                            <span class="help-block">Este será tu usuario para iniciar sesión</span>
                        </div>
                    </div>
                    <div id="fullname-form" class="control-group">
                        <label for="" class="control-label">Nombre Completo <i class="icon-leaf"></i></label>
                        <div class="controls">
                            <input name="fullname" id="fullname" type="text" placeholder="ej: Juan Pérez"/>
                            <span class="help-block">Ingresa tu Nombre y Apellido</span>
                        </div>
                    </div>
                    <div id="email-form" class="control-group">
                        <label class="control-label" for="inputEmail">Email <i class="icon-envelope"></i></label>
                        <div class="controls">
                            <input name="email" id="email" type="text" id="inputEmail" placeholder="ej: jperez@helloworld.com">
                            <span class="help-block">Ingresar un e-mail válido que se usará para confirmar tu registro</span>
                        </div>
                    </div>
                    <div id="pass-form" class="control-group">
                        <label class="control-label" for="password">Contraseña <i class="icon-lock"></i></label>
                        <div class="controls">
                            <input name="password" id="password" type="password" placeholder="">
                            <span class="help-block">La contraseña debe tener entre 6 a 10 caracteres</span>
                        </div>
                    </div>
                    <div id="pass2-form" class="control-group">
                        <label class="control-label" for="">Re-Ingrese Contraseña <i class="icon-lock"></i></label>
                        <div class="controls">
                            <input name="password2" id="password2" type="password" placeholder="">
                            <span class="help-block">Repita la contraseña para asegurar que se ingresará correctamente</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <a id="registrar" type="submit" class="btn btn-primary">Registrar</a>
                        </div>
                    </div>
                </form>