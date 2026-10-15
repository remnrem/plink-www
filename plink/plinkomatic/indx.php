<?php

  // Control dynamic style sheet
  $styleBodyIndent=true;
  $styleBodyBGcolor="#FFDBB7";

  if (file_exists( 'TreeMenuXL.php' ))
    include_once( 'TreeMenuXL.php' );
  else 
    include_once( $_SERVER['DOCUMENT_ROOT'] . '/bin/TreeMenuXL.php' );

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><!-- InstanceBegin template="/Templates/stdlayout01.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>HTML_TreeMenuXL Info Page</title>
<script src="TreeMenu.js" language="JavaScript" type="text/javascript"></script>
<link href="TreeMenu.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
  // Include dynamic style sheet.
  echo '<style type="text/css">'."\n  <!--\n";
  if (file_exists( 'ccSiteStyle.css.php' )) {
    include_once( 'ccSiteStyle.css.php' );
  } 
  else {
    include_once( $_SERVER['DOCUMENT_ROOT'] . '/ccSiteStyle.css.php' );
  }
  echo "\n  -->\n</style>\n";
  if (false) {
?>
<link href="/ccSiteStyle.css" rel="stylesheet" type="text/css">
<?php } ?>
<script type="text/javascript" language="JavaScript">
  // Bust my page out of any frames
  if (top != self) top.location.href = location.href;
</script>
</head>

  $nodeProperties = array();
  $pgmenu  = new HTML_TreeMenuXL();
  $pgmenuTop  = new HTML_TreeNodeXL("TreeMenuXL Page Contents", "#", $nodeProperties);
  $pgmenu->addItem($pgmenuTop);
  $nx = &$pgmenuTop->
    addItem(new HTML_TreeNodeXL("Introduction to HTML_TreeMenuXL", "#intro", $nodeProperties));
  $nx = &$pgmenuTop->
    addItem(new HTML_TreeNodeXL("Using HTML_TreeMenuXL", "#chips_version", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("Basic TreeMenus", "#basic", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("TreeMenus With Style", "#style", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("TreeMenus Without Icons", "#noicons", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("Rigid and Expanded TreeMenus", "#rigid", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("Controlling Indenting and Vertical Spacing", "#advanced_spacing", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("LinkSelect, User Images and User Styles", "#advanced_linkselect", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("Listbox Menus", "#listbox", $nodeProperties));
  $nx = &$pgmenuTop->addItem(new HTML_TreeNodeXL("History of TreeMenuXL", "#history", $nodeProperties));  
  $nx->
    addItem(new HTML_TreeNodeXL("TreeMenuXL 1.1", "#xl11", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("TreeMenuXL 1.2", "#xl12", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("Summary of New Features in TreeMenuXL", "#summary_of_new_features", $nodeProperties));
  $pgmenuTop->addItem(new HTML_TreeNodeXL("HTML_TreeMenu Reference", "#reference", $nodeProperties));  
  $pgmenuTop->addItem(new HTML_TreeNodeXL("Things To Do", "#thingstodo", $nodeProperties));  
  $pgmenuTop->addItem(new HTML_TreeNodeXL("TreeMenuXL Source Code", "#sourcecode", $nodeProperties));  

  // Create the presentation object
  $pgmenuTree = &new HTML_TreeMenu_RigidXL($pgmenu, array('images'=>'TMimagesAlt', "defaultClass"=>"auto"));
  $pgmenuTree->printMenu();
?>

<h2>What's Here?</h2>

</body>
</html>
