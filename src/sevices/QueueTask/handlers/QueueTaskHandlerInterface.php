<?php

namespace LeadHandler\sevices\QueueTask\handlers;

use PhpAmqpLib\Message\AMQPMessage;

interface QueueTaskHandlerInterface
{
    public function process(AMQPMessage $msg): void;
}
