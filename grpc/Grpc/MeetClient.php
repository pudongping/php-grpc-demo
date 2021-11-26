<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Grpc;

/**
 */
class MeetClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Grpc\HelloRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Hello(\Grpc\HelloRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/grpc.Meet/Hello',
        $argument,
        ['\Grpc\HelloResponse', 'decode'],
        $metadata, $options);
    }

}
