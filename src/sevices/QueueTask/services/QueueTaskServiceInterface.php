<?php

namespace LeadHandler\sevices\QueueTask\services;

interface QueueTaskServiceInterface
{
    public function createTask(string $queueName, string $message): void;
    public function handleTask(string $queueName): void;
}
