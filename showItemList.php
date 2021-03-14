<?php
header("content-type: text/xml");

// read the xml file into a dom structure
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false; // remove whitespace nodes 
$xml->load("products.xml");

// retrieve the get request values
$men_all = $_GET["menall"];
$men_top = $_GET["mentop"];
$men_pants = $_GET["menpants"];

$women_all = $_GET["womenall"];
$women_top = $_GET["womentop"];
$women_pants = $_GET["womenpants"];

$search = $_GET["s"];
$click = $_GET["goitem"];

$top_nodes = $xml->getElementsByTagName("tops");
$pant_nodes = $xml->getElementsByTagName("pants");



if ($men_top != null || $men_pants != null || $men_all != null) {
  $womens = $xml->getElementsByTagName("women");
  for ($i = $womens->length - 1; $i >= 0; $i--) {
    $node = $womens->item($i);
    $node->parentNode->removeChild($node);
  }
}

if ($women_top != null || $women_pants != null || $women_all != null) {
  $men = $xml->getElementsByTagName("men");
  for ($i = $men->length - 1; $i >= 0; $i--) {
    $node = $men->item($i);
    $node->parentNode->removeChild($node);
  }
}

if ($click != null) {
  $found = false;
  $topx = $xml->getElementsByTagName("top");
  
  for ($i = $topx->length - 1; $i >= 0; $i--) {
    $node = $topx->item($i);
    if ($node->getAttribute("pid") != $click) {
      $node->parentNode->removeChild($node);
    }
  }
  if ($found != true) {
    $pantx = $xml->getElementsByTagName("pant");
    for ($i = $pantx->length - 1; $i >= 0; $i--) {
      $node = $pantx->item($i);
      if ($node->getAttribute("pid") != $click) {
        $node->parentNode->removeChild($node);
      }
    }
  }
}
 echo $xml->saveXML();
?>
