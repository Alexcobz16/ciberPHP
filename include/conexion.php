<?php
 $xmlFile = 'db/configuracion.xml'; // Ruta del archivo XML y el esquema XSD
 $xsdFile = 'db/configuracion.xsd'; // Archivo XSD para validar el XML
 
 $dsn = "";
 $usuario_bd = "";
 $contrasena_bd = ""; 

// Validar el archivo XML con el esquema XSD
if (file_exists($xmlFile) && file_exists($xsdFile)) {
    $dom = new DOMDocument;

    libxml_use_internal_errors(true);
    $dom->load($xmlFile);

    if ($dom->schemaValidate($xsdFile)) {
        // El XML es válido según el esquema XSD

        // Obtener los elementos mediante XPath
        $xml = simplexml_load_file($xmlFile);

        // Acceder a los elementos
        $dsn = (string)$xml->xpath('//bd/dsn')[0];
        $usuario = (string)$xml->xpath('//bd/usuario')[0];
        $psswd = (string)$xml->xpath('//bd/contrasena')[0];

    } else {
        echo "El archivo XML no es válido según el esquema XSD.";
    }
} else {
    echo "No se encuentran los archivos necesarios (XML o XSD).";
}

?>