<?php

namespace LeadHandler\controllers;

use LeadGenerator\Generator;
use LeadGenerator\Lead as IncomingLead;
use LeadHandler\sevices\lead\models\Lead;
use LeadHandler\sevices\QueueTask\Queues;
use LeadHandler\sevices\QueueTask\services\QueueTaskServiceInterface;

class StartController
{
    public function __construct(
        private readonly Generator $generator,
        private readonly QueueTaskServiceInterface $queueTaskService,
    ) {}

    public function __invoke(): void
    {
        $this->generator->generateLeads(100, function (IncomingLead $lead) {
            $this->queueTaskService->createTask(
                Queues::LEAD_QUEUE,
                serialize(new Lead($lead->id, $lead->categoryName))
            );
        });
    }
}
