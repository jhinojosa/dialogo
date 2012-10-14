<div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Recuperación de Contraseña</h3>
    </div>
    <div class="modal-body">
        <form id="passwordRecoveryForm" class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="usr"><i class="icon-user"></i> Ingrese su nombre de usuario:</label>
                <div class="controls">
                    <input id="usr" name="usr"  type="text" id="inputEmail" placeholder="ej: jperez">
                    <span class="help-block">Ingrese el nombre de usuario que usa para iniciar sesión</span>
                </div>
            </div>
        </form>
        <div id="errorLabel" class="alert" >
            
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Volver</button>
        <a id="recuperarPass" class="btn btn-primary">Recuperar Contraseña</a>
    </div>
</div>