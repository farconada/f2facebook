<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

/**
 * Esta extension configura varios plugins
 */
// TODO hacer que las acciones sean cacheables

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'Content' => 'activityFeed,comments,facepile,likeButton,likeBox,liveStream,loginButton,recommendations',
	),
	array(
		'Content' => '',
	)
);



// Preview del plugin en la vista de lista
if (TYPO3_MODE == 'BE') {
			// Hook for the TV page module used for preview of content
		$TYPO3_CONF_VARS['EXTCONF']['templavoila']['mod1']['renderPreviewContentClass']['f2facebook_bepreview'] = 'EXT:f2facebook/Classes/Util/class.tx_f2facebook_bepreview.php:tx_f2facebook_bepreview';
}

?>
