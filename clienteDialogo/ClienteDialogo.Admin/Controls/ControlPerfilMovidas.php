<div class="controlPerfilMovidas">
    <div>
        <div class="cont ui-corner-all">
            <div><b>Perfiles</b></div>
            <div class="grillaContainer">
                <table id="grillaPerfiles">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="inputContainer">
                <div>Nuevo perfil</div>
                <div class="formContainer">
                    <div class="inputText">Nombre:</div>
                    <input class="ui-corner-all  formInput txtNombrePerfil" type="text">
                    <div class="inputText">Descripción:</div>
                    <textarea class="ui-corner-all formTextarea txtDescripcionPerfil"></textarea>

                    <div class="clear"></div>
                    <button class="btnAdd btnAddPerfil">Agregar</button>
                </div>
            </div>
        </div>

        <div class="clear" style="height: 20px;"></div>

        <div class="contMovidas ui-corner-all">
            <div><b>Movidas</b></div>
            <div class="grillaContainer">
                <table id="grillaMovidas">
                    <thead></thead>
                    <tbody></tbody>
                </table>

                <button class="btnUpdateMov" title="Actualiza las movidas del perfil seleccionado.">Actualizar modificaciones</button>

            </div>
            <div class="inputContainer">
                <div>Nueva movida</div>
                <div class="formContainer">
                    <div class="inputText">Nombre:</div>
                    <input class=" ui-corner-all formInput txtNombreMovida" type="text">
                    <div class="inputText">Descripción:</div>
                    <textarea class="ui-corner-all formTextarea txtDescripcionMovida"></textarea>
                    <div class="inputText">Eje:</div>
                    <select class="ui-corner-all formInput cmbEje"></select>
                    <div class="clear"></div>
                    <button class="btnAdd btnAddMovida">Agregar</button>
                    <div class="clear"></div>
                    <div id="movidaCreacionSetupContainer" class="ui-corner-all" title="Permite la selección de la movida a utilizar en la creación de los diálogos">
                        <div>Movida determinada para crear un diálogo:</div>
                        <select id="cmbSelectMovida" class="formInput"></select>
                        <button id="btnAplicarMovidaDeterminada" class="btnAdd">Aplicar</button>
<!--                        <button id="btnAplicarMovidaDeterminada" class="btnAdd">Cambiar</button>-->
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear" style="height: 10px;"></div>
    <div class="btnGuardarMovidasContainer">
        <button class="btnGuardarMovidas">Guardar perfiles</button>
    </div>
</div>