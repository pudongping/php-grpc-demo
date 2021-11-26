<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/meet.proto

namespace Grpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>grpc.HelloResponse</code>
 */
class HelloResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string meeting = 1;</code>
     */
    protected $meeting = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $meeting
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Meet::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string meeting = 1;</code>
     * @return string
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * Generated from protobuf field <code>string meeting = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setMeeting($var)
    {
        GPBUtil::checkString($var, True);
        $this->meeting = $var;

        return $this;
    }

}

