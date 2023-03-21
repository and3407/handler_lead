<?php

use DI\Container;
use LeadHandler\sevices\lead\services\LeadLogService;
use LeadHandler\sevices\lead\services\LeadProcessService;
use LeadHandler\sevices\lead\services\LeadServiceInterface;
use LeadHandler\sevices\QueueTask\handlers\HandlerFactory;
use LeadHandler\sevices\QueueTask\services\QueueTaskServiceInterface;
use LeadHandler\sevices\QueueTask\services\RabbitmqQueueTaskService;

return [
    QueueTaskServiceInterface::class => function (Container $container) {
        return new RabbitmqQueueTaskService(
            $container->get(HandlerFactory::class)
        );
    },
    LeadServiceInterface::class => function (Container $container) {
        return new LeadLogService(
            $container->get(LeadProcessService::class)
        );
    }
];
