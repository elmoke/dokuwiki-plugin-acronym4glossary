<?php
/**
 * DokuWiki Plugin acronym4glossary (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Michael Schuh <mike.schuh@gmx.at>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_acronym4glossary extends DokuWiki_Syntax_Plugin {
		
		var $acrData = array();
		
    function getInfo() {
      return array(
              'author' => 'Michael Schuh',
              'email'  => 'mike.schuh@gmx.at',
              'date'   => '2010-06-16',
              'name'   => 'acronym4glossary plugin (syntax component)',
              'desc'   => 'This plugin uses the acronyms to build a glossary',
              'url'    => 'http://blog.imho.at/20100819/artikel/dokuwiki-plugin-acronym4glossary',
              );
    }

		function getType() {
			return 'container';
			//return 'FIXME: container|baseonly|formatting|substition|protected|disabled|paragraphs';
		}

		function getPType() {
			return 'normal';
			//return 'FIXME: normal|block|stack';
		}

    function getSort() {
        return 190;
    }


    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<GLOSSARY>',$mode,'plugin_acronym4glossary');
    }

		function handle($match, $state, $pos, &$handler){
			$this->acrData = getAcronyms();
			return $data;
    }

		function render($mode, &$renderer, $data) {
			if($mode != 'xhtml') return false;
			$renderer->doc .= "<ul>\n";
			$actLetter = "a";
			foreach($this->acrData as $key => $value) {
				if(strtolower($key{0}) != $actLetter) {
					$actLetter = strtolower($key{0});
					$renderer->doc .= "<br />";
				}
				$renderer->doc .= "<li>\n".$key." - " . $value."</li>";
			}
			$renderer->doc .= "</ul>";
			return true;
		}
}

// vim:ts=4:sw=4:et:enc=utf-8:
