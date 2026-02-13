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
            ], [
                'name'    => 'date_format',
                'title'   => 'krayin-formatter::app.formatting.date_format',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => 'd M Y (13 Feb 2026)',
                        'value' => 'd M Y',
                    ], [
                        'title' => 'd-m-Y (13-02-2026)',
                        'value' => 'd-m-Y',
                    ], [
                        'title' => 'm/d/Y (02/13/2026)',
                        'value' => 'm/d/Y',
                    ], [
                        'title' => 'Y-m-d (2026-02-13)',
                        'value' => 'Y-m-d',
                    ],
                ],
            ], [
                'name'    => 'timezone',
                'title'   => 'krayin-formatter::app.formatting.timezone',
                'type'    => 'select',
                'options' => 'Vallory\KrayinFormatter\Helpers\FormatterCore@timezones',
            ],
        ],
    ],
];
