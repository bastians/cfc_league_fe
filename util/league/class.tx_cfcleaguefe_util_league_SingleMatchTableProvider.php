<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Rene Nitzsche (rene@system25.de)
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

require_once(t3lib_extMgm::extPath('div') . 'class.tx_div.php');

tx_div::load('tx_cfcleaguefe_util_league_DefaultTableProvider');

/**
 * The a table provider used to compare two opponents of a single match
 */
class tx_cfcleaguefe_util_league_SingleMatchTableProvider extends tx_cfcleaguefe_util_league_DefaultTableProvider{

	private $match;
	
	function tx_cfcleaguefe_util_league_SingleMatchTableProvider($league, $match) {
		$this->setLeague($league);
		$this->match = $match;
		$this->init();
	}

	function getChartClubs(){
		// Die Clubs aus dem Spiel ermitteln
		$clubs = array();
		$clubId = $this->match->getHome()->record['club'];
		if($clubId) $clubs[] = $clubId;
		$clubId = $this->match->getGuest()->record['club'];
		if($clubId) $clubs[] = $clubId;

		return $clubs;
	} 
	function getMarkClubs(){
		return array();
	}

	function getPenalties() {
		return $this->getLeague()->getPenalties();
	}
	function getMatches() {
    return $this->getLeague()->getMatches(2, $this->cfgTableScope);
	}

	protected function init() {
		// Der TableScope wirkt sich auf die betrachteten Spiele (Hin-Rückrunde) aus
		$this->cfgTableScope = 0; // Normale Tabelle
		$this->cfgTableType = 0;
		$this->cfgPointSystem = $this->getLeague()->record['point_system'];
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cfc_league_fe/util/league/class.tx_cfcleaguefe_util_league_SingleMatchTableProvider.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cfc_league_fe/util/league/class.tx_cfcleaguefe_util_league_SingleMatchTableProvider.php']);
}

?>