<?php

require 'vendor/autoload.php';

Dotenv::load(__DIR__);
$uptimeRobotApiKey = getenv('UR_API_KEY');
$use24HTime = getenv('USE_24H_TIME') ?: false;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ParseException;

$client = new Client(
    [
        'defaults' => [
            'query' => [
                'apiKey'            => $uptimeRobotApiKey,
                'format'            => 'json',
                'noJsonCallback'    => 1
            ]
        ]
    ]
);

$graph = [
    'graph' => [
        'title' => 'Uptime Robot Statistics',
        'yAxis' => [
            'scaleTo' => 1,
            'units' => [
                'suffix' => 'ms'
            ]
        ],
        'refreshEveryNSeconds' => 300,
    ]
];

$monitorIds = [];

for ($i = 1; $i <= 10; $i++) {
    if (empty($id = getenv('MONITOR_' . $i . '_ID'))) {
        continue;
    }

    $monitorIds[] = $id;
}

$uptimeMonitors = $client->get(
    'https://api.uptimerobot.com/getMonitors',
    [
        'query' => [
            'responseTimes' => 1,
            'monitors' => implode('-', $monitorIds),
            'showTimezone' => 1
        ]
    ]
);

try {
    $uptimeMonitors = $uptimeMonitors->json();
} catch (ParseException $e) {
    $graph['graph']['error'] = [
        'message' => 'Unable to read Uptime Robot API Response',
        'detail' => 'API Error reported: ' . $e->getMessage()
    ];

    exit(json_encode($graph));
}

foreach ($uptimeMonitors['monitors']['monitor'] as $monitor) {
    for ($i = 0; $i <= count($monitor['responsetime']); $i++) {
        if ($i % 10 == 0) {
            $timestamp = Carbon::createFromFormat(
                'm/d/Y H:i:s',
                $monitor['responsetime'][$i]['datetime']
            );

            if ($use24HTime) {
                $timestamp = $timestamp->format('H:i');
            } else {
                $timestamp = $timestamp->format('h:i A');
            }

            $response[] = [
                'title' => $timestamp,
                'value' => (int) $monitor['responsetime'][$i]['value']
            ];
        }
    }

    $graphs[] = [
        'title' =>  $monitor['friendlyname'],
        'datapoints' => $response
    ];

    unset($response);
}

$graph['graph']['datasequences'] = $graphs;

exit(json_encode($graph));