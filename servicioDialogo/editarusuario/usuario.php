<?php	error_reporting(E_ALL);ini_set('display_errors', '1');?><?php	class usuario	{function get_user($id_user){$id_user=substr($id_user,6);$id_user=substr($id_user,0,-6);////////////////////////////////////////////////try {$dbconn3 = pg_connect("host=127.0.0.1 port=5432 dbname=dialogo user=dialogo password=dialogo123");//$result = pg_prepare($dbconn3,'q', 'INSERT into valor_uf(valor_en_pesos,fecha,fecha_registro) values($1,$2,now())');$result = pg_prepare($dbconn3,'q', 'select * from usuario where x_id_usuario=$1');$result = pg_execute($dbconn3,'q',  array($id_user)); $red = pg_fetch_all($result);return $red[0];die(print_r($red));} catch (Zend_Db_Adapter_Exception $e) {echo "catch";//error con las credenciales del usuario o la base de datos.die($e->getMessage());} catch (Zend_Exception $e) {echo "catch1";//echo $e->getMessage();// error en la consultadie($e->getMessage());	}}function update_nombre($id_user,$nombre){$id_user=substr($id_user,6);$id_user=substr($id_user,0,-6);////////////////////////////////////////////////try {$dbconn3 = pg_connect("host=127.0.0.1 port=5432 dbname=dialogo user=dialogo password=dialogo123");//$result = pg_prepare($dbconn3,'q', 'INSERT into valor_uf(valor_en_pesos,fecha,fecha_registro) values($1,$2,now())');$result = pg_prepare($dbconn3,'q1', 'update usuario set x_nombre_completo=$1 where x_id_usuario=$2');$result = pg_execute($dbconn3,'q1',  array($nombre,$id_user)); $red = pg_fetch_all($result);return 1;die(print_r($red));} catch (Zend_Db_Adapter_Exception $e) {echo "catch";//error con las credenciales del usuario o la base de datos.die($e->getMessage());} catch (Zend_Exception $e) {echo "catch1";//echo $e->getMessage();// error en la consultadie($e->getMessage());	}}function update_mail($id_user,$nombre){if (!filter_var($nombre, FILTER_VALIDATE_EMAIL)) {    return -1;}$id_user=substr($id_user,6);$id_user=substr($id_user,0,-6);////////////////////////////////////////////////try {$dbconn3 = pg_connect("host=127.0.0.1 port=5432 dbname=dialogo user=dialogo password=dialogo123");//$result = pg_prepare($dbconn3,'q', 'INSERT into valor_uf(valor_en_pesos,fecha,fecha_registro) values($1,$2,now())');$result = pg_prepare($dbconn3,'q1', 'update usuario set x_email_usuario=$1 where x_id_usuario=$2');$result = pg_execute($dbconn3,'q1',  array($nombre,$id_user)); $red = pg_fetch_all($result);return 1;die(print_r($red));} catch (Zend_Db_Adapter_Exception $e) {echo "catch";//error con las credenciales del usuario o la base de datos.die($e->getMessage());} catch (Zend_Exception $e) {echo "catch1";//echo $e->getMessage();// error en la consultadie($e->getMessage());	}}function update_clave($id_user,$clave_antigua,$nombre,$nombre1){if ($nombre!=$nombre1) {return -1; //no coinsiden ambas}$id_user=substr($id_user,6);$id_user=substr($id_user,0,-6);////////////////////////////////////////////////try {$dbconn3 = pg_connect("host=127.0.0.1 port=5432 dbname=dialogo user=dialogo password=dialogo123");$result = pg_prepare($dbconn3,'q2', 'select x_password from usuario where x_id_usuario=$1 ');$result = pg_execute($dbconn3,'q2',  array($id_user));$red = pg_fetch_all($result);$red = pg_fetch_all($result);if($red[0]['x_password']!=md5($clave_antigua)){return -2; //no coinice clave antigua}$result = pg_prepare($dbconn3,'q1', 'update usuario set x_password=$1 where x_id_usuario=$2 and x_password=$3');$result = pg_execute($dbconn3,'q1',  array(md5($nombre),$id_user,md5($clave_antigua)));return 1;die(print_r($red));} catch (Zend_Db_Adapter_Exception $e) {echo "catch";//error con las credenciales del usuario o la base de datos.die($e->getMessage());} catch (Zend_Exception $e) {echo "catch1";//echo $e->getMessage();// error en la consultadie($e->getMessage());	}}//////////////////////////////////////////////}?>