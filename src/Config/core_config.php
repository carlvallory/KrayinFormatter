<?php

return [
    [
        'key'    => 'general.general.formatting',
        'name'   => 'krayin-formatter::app.formatting.title',
        'info'   => 'krayin-formatter::app.formatting.info',
        'sort'   => 10,
        'fields' => [
            [
                'name'    => 'thousand_separator',
                'title'   => 'krayin-formatter::app.formatting.thousand_separator',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'krayin-formatter::app.formatting.options.comma',
                        'value' => 'comma',
                    ], [
                        'title' => 'krayin-formatter::app.formatting.options.dot',
                        'value' => 'dot',
                    ],
                ],
            ],
        ],
    ],
];
