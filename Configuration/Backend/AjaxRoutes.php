<?php

/**
 * Definitions for routes provided by EXT:taskcenter
 */
return [
    // Collapse
    'togglemodules_toggle' => [
        'path' => '/togglemodules/toggle',
        'target' => \GeorgRinger\ToggleModules\ModuleStatus::class . '::saveToggleState'
    ],
];
