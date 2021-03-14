<?php
header("content-type: text/xml");

// read the xml file into a dom structure
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false; // remove whitespace nodes 
$xml->load("products.xml");

// retrieve the get request values

$search = $_GET["s"];

if($search!= null){

    $top_nodes = $xml->getElementsByTagName("top");
    for ($i = $top_nodes->length - 1; $i >= 0; $i--) {
      $node = $top_nodes->item($i);
      if($node->getElementsByTagName("name")[0]->nodeValue != $search && $node->getElementsByTagName("color")[0]->nodeValue!= $search && $node->getElementsByTagName("origin")[0]->nodeValue!= $search)
      $node->parentNode->removeChild($node);
    }
    
    $pant_nodes = $xml->getElementsByTagName("pant");
    for ($i = $pant_nodes->length - 1; $i >= 0; $i--) {
        $node = $pant_nodes->item($i);
        if($node->getElementsByTagName("name")[0]->nodeValue != $search && $node->getElementsByTagName("color")[0]->nodeValue!= $search && $node->getElementsByTagName("origin")[0]->nodeValue!= $search)
        $node->parentNode->removeChild($node);
      }
}

 echo $xml->saveXML();
?>