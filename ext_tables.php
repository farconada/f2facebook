<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'f2facebook'
);



t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'f2facebook');

// Flexform
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');

	// Icono en el asistente de elementos de contenido
if (TYPO3_MODE == 'BE')	{
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_f2facebook_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'Classes/Util/class.tx_f2facebook_wizicon.php';
}
?>
