<?php

$context->set('elasticsearch.login', $_SESSION['login']);
$context->set('elasticsearch.password', $_SESSION['password']);
$context->set('elasticsearch.host', $_SESSION['host']);
$context->set('elasticsearch.port', $_SESSION['port']);

$context->set('elasticsearch.baseurl', 'http://'.$context->get('elasticsearch.login').':'.$context->get('elasticsearch.password').'@'.$context->get('elasticsearch.host').':'.$context->get('elasticsearch.port').'/');

$es_all = $context->get('elasticsearch.baseurl').'_all';
$data_all = file_get_contents($es_all);
$data_all = json_decode($data_all);

$es_stats = $context->get('elasticsearch.baseurl').'_cluster/stats';
$data_stats = file_get_contents($es_stats);
$data_stats = json_decode($data_stats);


