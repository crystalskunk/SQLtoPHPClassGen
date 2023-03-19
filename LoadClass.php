<?php
/*
echo 'dirname(__FILE__) : ' . dirname(__FILE__) .'<br />';
echo '__DIR__ : ' . __DIR__ .'<br />';
*/
function LoadClass($classname) {
	if (strpos($classname, 'PHPExcel') === false && strpos($classname, 'ReCaptcha') === false) {
	
		if (strpos($classname, '_') !== false || $classname == 'Machin') {
			$ClassFilePath = './resources/class.' . strtolower($classname) . '.php';
			require $ClassFilePath;
		}
		else {
			require './resources/class.' . strtolower($classname) . '.php';
		}
	}
	
}
spl_autoload_register('LoadClass');
?>