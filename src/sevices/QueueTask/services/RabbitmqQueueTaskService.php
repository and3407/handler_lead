<?php

namespace LeadHandler\sevices\QueueTask\services;

use Exception;
use LeadHandler\sevices\QueueTask\handlers\HandlerFactory;
use LeadHandler\sevices\QueueTask\handlers\QueueTaskHandlerInterface;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitmqQueueTaskService implements QueueTaskServiceInterface
{
    private const HOST = 'rabbitmq';
    private const PORT = '5672';
    private const USER = 'rmuser';
    private const PASSWORD = 'rmpassword';

    public function __construct(
        private readonly HandlerFactory $handlerFactory,
    ){}

    /**
     * @throws Exception
     */
    public function createTask(string $queueName, string $message): void
    {
        $streamConnection = $this->getStreamConnection();
        $channel = $streamConnection->channel();
        $channel->queue_declare($queueName, false, true, false, false);

        $msg = new AMQPMessage(
            $message,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $channel->basic_publish($msg, '', $queueName);
        $channel->close();
        $streamConnection->close();
    }

    /**
     * @throws Exception
     */
    public function handleTask(string $queueName): void
    {
        $handler = $this->handlerFactory->getHandler($queueName);

        if (!$handler instanceof QueueTaskHandlerInterface) {
            return;
        }

        $streamConnection = $this->getStreamConnection();
        $channel = $streamConnection->channel();
        $channel->queue_declare($queueName, false, true, false, false);

        $channel->basic_qos(null, 1, null);
        $channel->basic_consume(
            $queueName,
            '',
            false,
            false,
            false,
            false,
            array($handler, 'process')
        );

        while ($channel->is_open()) {
            $channel->wait();
        }

        $channel->close();
        $streamConnection->close();
    }

    private function getStreamConnection(): AMQPStreamConnection
    {
        return new AMQPStreamConnection(
            self::HOST,
            self::PORT,
            self::USER,
            self::PASSWORD
        );
    }
}
