<?php

require_once '../vendor/autoload.php';

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

$registry = new CollectorRegistry(new InMemory());

$counter = $registry->registerCounter('requests_total', 'count', 'type');
$gauge = $registry->registerGauge('active_users', 'now', 'type');

$counter->inc();
$gauge->set(42);

$renderer = new RenderTextFormat();

header('Content-type: ' . RenderTextFormat::MIME_TYPE);
echo $renderer->render($registry->getMetricFamilySamples());