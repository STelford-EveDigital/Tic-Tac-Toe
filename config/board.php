<?php

return [
    // Standard blank board setup.
    'blank' => [
        'a1' => '', 'a2' => '', 'a3' => '',
        'b1' => '', 'b2' => '', 'b3' => '',
        'c1' => '', 'c2' => '', 'c3' => '',
    ],
    // Array of possible game winning matches
    'matches' => [
        ['a1', 'a2', 'a3'], // Horizontal
        ['b1', 'b2', 'b3'],
        ['c1', 'c2', 'c3'],
        ['a1', 'b1', 'c1'], // Vertical
        ['a2', 'b2', 'c2'],
        ['a3', 'b3', 'c3'],
        ['a1', 'b2', 'c3'], // Diagonal
        ['a3', 'b2', 'c1']
    ]
];