<?php
// Pull in the NuSOAP code
require_once("nusoap.php");
$namespace="http://dialogo/servicioDialogo/lib/hellowsdl.php";
// Create the server instance
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL("hellowsdl", $namespace);
$server->wsdl->schemaTargetNamespace=$namespace;
// Register the method to expose
$server->register("hello",                // method name
    array("name" => "xsd:string"),        // input parameters
    array("return" => "xsd:string"),      // output parameters
    $namespace,                      // namespace
    "urn:hellowsdl#hello",                // soapaction
    "rpc",                                // style
    "encoded",                            // use
    "Says hello to the caller",            // documentation
    "http://schemas.xmlsoap.org/soap/encoding/"
);

$server->register("bye",                // method name
    array("name" => "xsd:string"),        // input parameters
    array("return" => "xsd:string"),      // output parameters
    $namespace,                      // namespace
    "urn:hellowsdl#bye",                // soapaction
    "rpc",                                // style
    "encoded",                            // use
    "Says bye to the caller",            // documentation
    "http://schemas.xmlsoap.org/soap/encoding/"
);
// Define the method as a PHP function
function hello($name) {
        return "Hello, " . $name;
}

function bye($name){
        $array = array(
                "ingles"=>"Bye",
                "espanol"=>"Adios",
                "italiano"=>"Ciao"
                );
        
        //return json_encode($array);
        return $name.": Resultado de prueba ENVIADO desde el servicio web.";
        
}
// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
$server->service($HTTP_RAW_POST_DATA);
?>