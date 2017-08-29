<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'toggle modules',
    'description' => '+',
    'category' => 'be',
    'author' => 'Georg Ringer',
    'state' => 'alpha',
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-8.6.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'GeorgRinger\\ToggleModules\\' => 'Classes'
        ]
    ],
];
