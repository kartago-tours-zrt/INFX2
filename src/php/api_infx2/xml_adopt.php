<?php 
function xml_adopt2($root, $new, $namespace = null) {
    // first add the new node
    // NOTE: addChild does NOT escape "&" ampersands in (string)$new !!!
    //  replace them or use htmlspecialchars(). see addchild docs comments.
    $node = $root->addChild($new->getName(), (string) $new, $namespace);
    // add any attributes for the new node
    foreach($new->attributes() as $attr => $value) {
        $node->addAttribute($attr, $value);
    }
    // get all namespaces, include a blank one
    $namespaces = array_merge(array(null), $new->getNameSpaces(true));
    // add any child nodes, including optional namespace
    foreach($namespaces as $space) {
      foreach ($new->children($space) as $child) {
        xml_adopt($node, $child, $space);
      }
    }
}

function xml_adopt($root, $new) {
    $rootDom = dom_import_simplexml($root);
    $newDom = dom_import_simplexml($new);
    $rootDom->appendChild($rootDom->ownerDocument->importNode($newDom, true));
}
?>