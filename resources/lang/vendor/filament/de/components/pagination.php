<?php

return [

    'label' => 'Seitennavigation',

    'overview' => '{1} Zeige 1 Ergebnis|[2,*] Zeige :first bis :last von :total Ergebnissen',

    'fields' => [

        'records_per_page' => [

            'label' => 'pro Seite',

            'options' => [
                'all' => 'Alle',
            ],

        ],

    ],

    'actions' => [

        'first' => [
            'label' => 'Erste',
        ],

        'markAsDone' => [
            'label' => 'Als erledigt markieren',
        ],

        'go_to_page' => [
            'label' => 'Weiter zur Seite :page',
        ],

        'last' => [
            'label' => 'Letzte',
        ],

        'next' => [
            'label' => 'Nächste',
        ],

        'previous' => [
            'label' => 'Vorherige',
        ],

    ],

    // Dodane tłumaczenia dotyczące issues
    'admin' => [
        'issues' => [
            'title' => 'Titel',
            'reporter_name' => 'Meldender',
            'status' => 'Status',
            'created_at' => 'Erstellt am',
            'done_at' => 'Erledigt am',
            'recipients' => 'Empfänger',
            'actions' => [
                'markAsDone' => 'Als erledigt markieren',
                'delete' => 'Löschen',
            ],
        ],
    ],

];
