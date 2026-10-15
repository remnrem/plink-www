<?php
include_once('HTML/TreeMenu.php');
$menu_styles = new HTML_TreeNode(array('text'=>'Styles'));
$menu_pays = new HTML_TreeNode(array('text'=>'Countries'));
$menu_restaurants = new HTML_TreeNode(array('text'=>'Restaurants'));
$menu_plats = new HTML_TreeNode(array('text'=>'Menus'));
for ($i=1;$i<10;$i++) {    
$menu_styles->addItem(new HTML_TreeNode(array('icon'=>'Image '.($i+0))));
$menu_pays->addItem(new HTML_TreeNode(array('icon'=>'Image '.($i+10))));    
$menu_restaurants->addItem(new HTML_TreeNode(array('icon'=>'Image '.($i+20))));    
$menu_plats->addItem(new HTML_TreeNode(array('icon'=>'Image '.($i+30))));
}
$menu  = new HTML_TreeMenu();
$menu->addItem($menu_styles);
$menu->addItem($menu_pays);
$menu->addItem($menu_restaurants);
$menu->addItem($menu_plats);

// Chose a generator. You can generate DHTML or a Listbox
$tree = new HTML_TreeMenu_DHTML($menu);
echo $tree->toHTML();
?>



