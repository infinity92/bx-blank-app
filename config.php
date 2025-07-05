<?php
return [
    'title' => 'Storecove e-invoice connector to Bitrix24',
    'version' => '1',
    'steps' => [
        [
            'id' => 'step1',
            'title' => 'Storecove API-key',
            'description' => 'Accept electronic payments through the Fast Payment System. To complete the payment.',
            'fields' => [
                [
                    'id' => 'field1',
                    'label' => 'Storecove API-key',
                    'type' => 'input',
                    // 'value' => 'super value',
                    'placeholder' => 'Put your API-key here',
                ],
            ],
            'help' => true,
        ],
        [
            'id' => 'step2',
            'title' => 'Your country',
            'fields' => [
                [
                    'id' => 'country',
                    'type' => 'dropdown-list',
                    'value' => '1',
                    'items' => [
                        [
                            'value' => '1',
                            'name' => 'Russia',
                        ],
                        [
                            'value' => '2',
                            'name' => 'USA',
                        ],
                        [
                            'value' => '3',
                            'name' => 'German',
                        ],
                    ],
                ],
            ],
        ],
        [
            'id' => 'step3',
            'title' => 'Company properties',
            'fields' => [
                [
                    'id' => 'step3',
                    'type' => 'input',
                    'placeholder' => 'VAT ID',
                    'label' => 'Your company VAD ID',
                ],
            ],
        ],
    ],
    'form' => [
        'id' => 'config-form',
        'action' => 'http://app.kotlyarov.loc',
        'saveCaption' => 'Save',
        'cancelCaption' => 'Cancel',
    ],
];