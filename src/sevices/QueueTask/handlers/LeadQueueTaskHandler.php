<?php

namespace LeadHandler\sevices\QueueTask\handlers;

use LeadHandler\sevices\lead\models\Lead;
use LeadHandler\sevices\lead\services\LeadServiceInterface;
use PhpAmqpLib\Message\AMQPMessage;

class LeadQueueTaskHandler implements QueueTaskHandlerInterface
{
    public function __construct(
        private readonly LeadServiceInterface $leadService,
    ){}

    public function process(AMQPMessage $msg): void
    {
        /** @var Lead $lead */
        $lead = unserialize($msg->body);

        $this->leadService->execute($lead);

        $msg->ack();
    }
}
