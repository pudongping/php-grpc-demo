<?php

require_once __DIR__ . '/vendor/autoload.php';

use Grpc\HelloRequest;
use Grpc\HelloResponse;
use Grpc\MeetClient;

// 这里的服务端，我使用的是我的另外一个 demo 项目 [go-micro-demo](https://github.com/pudongping/go-micro-demo)
// 启动后的端口为 61327 ，因此我这里也需要连接 61327 端口
// go run main.go --registry=etcd
// 2021-11-27 04:11:55.227014 I | Transport [http] Listening on [::]:61327
// 2021-11-27 04:11:55.227072 I | Broker [http] Connected to [::]:61329
// 2021-11-27 04:11:55.227195 I | Registry [etcd] Registering node: Meet-25b2fcaf-44cc-4c40-be44-f6541e3f6cfd
$hostname = '127.0.0.1:61327';
$meetClient = new MeetClient($hostname, [
    'credentials' => null
]);

$request = new HelloRequest();
$request->setName('Alex');

/**
 * @var HelloResponse $response
 */
list($response, $status) = $meetClient->Hello($request)->wait();
if (0 != $status->code) {
    throw new \RuntimeException($status->detail, $status->code);
}

$meeting = $response->getMeeting();

// 你好，Alex
var_dump($meeting);
