<?php
/**
 * Created by PhpStorm.
 * User: Manlin
 * Date: 2019/9/21
 * Time: 下午1:51
 */
require '../vendor/autoload.php';
date_default_timezone_set('PRC');

use EasySwoole\Kafka\Config\FetchConfig;
use EasySwoole\Kafka\Fetch;

go(function () {

    $config = FetchConfig::getInstance();
    $config->setMetadataRefreshIntervalMs(10000);
    $config->setMetadataBrokerList('127.0.0.1:9092');
    $config->setBrokerVersion('0.9.0');

    $config->setTopics(['test']);

    EasySwoole\Kafka\SyncMeta\Process::getInstance()->syncMeta();
    EasySwoole\Kafka\Broker::getInstance()->setGroupBrokerId('127.0.0.1:9092');

    $fetch = new Fetch();
    $result = $fetch->fetch();
    var_dump($result);
});
