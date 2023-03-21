<?php

namespace LeadHandler\sevices\QueueTask\handlers;

use LeadHandler\sevices\QueueTask\Queues;

class HandlerFactory
{
    public function __construct(
        private readonly LeadQueueTaskHandler $leadQueueTaskHandler,
    ){}

    public function getHandler(string $queue): QueueTaskHandlerInterface|null
    {
        return match ($queue) {
            Queues::LEAD_QUEUE => $this->leadQueueTaskHandler,
            default => null,
        };
    }
}
