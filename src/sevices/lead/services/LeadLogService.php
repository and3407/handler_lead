<?php

namespace LeadHandler\sevices\lead\services;

use DateTime;
use LeadHandler\sevices\lead\models\Lead;

class LeadLogService implements LeadServiceInterface
{
    private const FILE_PATH = '/var/www/html/handlerlead/logs';
    private const FILE_NAME = '/log.txt';

    public function __construct(
        private readonly LeadServiceInterface $leadService,
    ){}

    public function execute(Lead $lead): void
    {
        $this->leadService->execute($lead);

        $date = new DateTime();
        $currentDatetime = $date->format('Y-m-d H:i:s');

        $messageLog = "{$lead->getLeadId()} | {$lead->getCategoryName()} | {$currentDatetime}";

        file_put_contents(self::FILE_PATH.self::FILE_NAME, PHP_EOL . $messageLog, FILE_APPEND);
    }
}
