<?php
defined('TYPO3_MODE') or die();

if (TYPO3_MODE === 'BE') {
    $GLOBALS['TYPO3_CONF_VARS']['BE']['toolbarItems'][1503985241] = \GeorgRinger\ToggleModules\Backend\ToolbarItems\ActionToolbarItem::class;
}
