<?php
/**
 * Fabrik Form View Template: Bootstrap Tab CSS
 *
 * @package     Joomla
 * @subpackage  Fabrik
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

header('Content-type: text/css');
$c = (int) $_REQUEST['c'];
$view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'form';
echo "

.fabrikGroup {
clear: left;
}

.fabrikChildGroup {
float: left;
min-width: 48%;
margin: 5px;
display: table;
}

.row-striped {
margin: 3px;
border: 1px;
background: #fefefe;
}
";
?>