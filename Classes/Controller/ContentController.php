<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Controller
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_F2facebook_Controller_ContentController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * Inicializacion comun para todas las Action
	 *
	 * @see Tx_Extbase_MVC_Controller_ActionController::initializeAction()
	 * @return void
	 */
	public function initializeAction() {
			// En TS plugin.tx_f2facebook.settings.actioname.js
			// Puede ser relativo a EXT:
		$this->addJavaScript(str_replace('EXT:', t3lib_extMgm::siteRelPath('f2facebook'), $this->settings[$this->request->getControllerActionName()]['js']));
			// En TS plugin.tx_f2facebook.settings.actioname.stylesheet
			// Puede ser relativo a EXT:
		$this->addStylesheet(str_replace('EXT:', t3lib_extMgm::siteRelPath('f2facebook'), $this->settings[$this->request->getControllerActionName()]['stylesheet']));

		$this->getFacebookJavaScript();


	}

	/**
	 * Sobrescribit el fichero de plantilla para usar uno personalizado
	 *
	 * @param object $view The view object
	 * @see Tx_Extbase_MVC_Controller_ActionController::initializeView()
	 * @return void
	 */
	public function initializeView($view) {
			// Utiliza el template pasado en el Flexform
		$this->overrideViewFile(trim($this->settings['templateFile']));
			// se pasan las varables de settings a la vista
		$this->view->assign('settings', $this->settings);
	}

	/**
	 * Activity Feed
	 *
	 * @return html generado por la vista
	 */
	public function activityFeedAction() {

	}

	/**
	 * Live Stream
	 *
	 * @return html generado por la vista
	 */
	public function liveStreamAction() {

	}

	/**
	 * ALike Button
	 *
	 * @return html generado por la vista
	 */
	public function likeButtonAction() {

	}

	/**
	 * Facepile
	 *
	 * @return html generado por la vista
	 */
	public function facepileAction() {

	}

	/**
	 * Like Box
	 *
	 * @return html generado por la vista
	 */
	public function likeBoxAction() {

	}

	/**
	 * Login button
	 *
	 * @return html generado por la vista
	 */
	public function loginButtonAction() {

	}

	/**
	 * Recommendations
	 *
	 * @return html generado por la vista
	 */
	public function recommendationsAction() {

	}

	/**
	 * Comments
	 *
	 * @return html generado por la vista
	 */
	public function commentsAction() {

	}

	/**
	 * Incluye el javascript y el tag para que carge el JS SDK de facebook
	 * Lo incluye una sola vez por pagina
	 *
	 * @return void
	 */
	private function getFacebookJavaScript() {
		if ( !isset($GLOBALS['f2facebook_js'])) {
			$GLOBALS['f2facebook_js'] = TRUE;

			$javascript = "
				<script>
					window.fbAsyncInit = function() {
						FB.init({
							appId: '".$this->settings['apiIdKey']."',
							status: true,
							cookie: true,
							xfbml: true
						});
					};
					function getCode(){

						var e = document.createElement('script'); e.async = true;
						e.src = document.location.protocol + '//connect.facebook.net/".$this->settings['language']."/all.js';
						document.getElementById('fb-root').appendChild(e);
					};
				</script>";


			$this->response->addAdditionalHeaderData($javascript);
			$this->response->appendContent('<div id="fb-root"></div><script type="text/javascript">getCode();</script>');
		}
	}

	/**
	 * Carga un CSS configurado como plugin.tx_f2facebook.settings.actioname.stylesheet
	 *
	 * @param string $stylesheet Path con la CSS
	 * @return void
	 */
	private function addStylesheet($stylesheet) {
		if ($stylesheet && file_exists($stylesheet)) {
				// different solution to add the css if the action is cached or uncached
			if ($this->request->isCached()) {
					$GLOBALS['TSFE']->getPageRenderer()->addCssFile($stylesheet);
			} else {
					$this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="'.
									$stylesheet.'" media="all" />');
			}
		}
	}

	/**
	 * Carga un JS configurado como plugin.tx_f2facebook.settings.actioname.js
	 *
	 * @param string $jsFile JavaScript file
	 * @return void
	 */
	private function addJavaScript($jsFile) {
		if ($jsFile && file_exists($jsFile)) {
				// different solution to add the JS if the action is cached or uncached
			if ($this->request->isCached()) {
					$GLOBALS['TSFE']->getPageRenderer()->addJsFile($jsFile);
			} else {

					$this->response->addAdditionalHeaderData('<script src="'.
									$jsFile.'" type="text/javascript" />');
			}
		}
	}

	/**
	 * Permite cargar otro template en la vista
	 *
	 * @param file $templateFile Fichero fluid
	 * @return void
	 */
	private function overrideViewFile($templateFile) {
		if ($templateFile && file_exists($templateFile)) {
			$this->view->setTemplatePathAndFilename($templateFile);
		}
	}

}

?>