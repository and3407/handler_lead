<?php

namespace LeadHandler\controllers;

use LeadHandler\sevices\QueueTask\Queues;
use LeadHandler\sevices\QueueTask\services\QueueTaskServiceInterface;

class TaskController
{
    public function __construct(
        private readonly QueueTaskServiceInterface $queueTaskService,
    ) {}

    public function __invoke(): void
    {
        $this->queueTaskService->handleTask(Queues::LEAD_QUEUE);
    }
}
