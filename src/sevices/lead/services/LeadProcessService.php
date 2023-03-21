<?php

namespace LeadHandler\sevices\lead\services;

use LeadHandler\sevices\lead\models\Lead;

class LeadProcessService implements LeadServiceInterface
{
    public function execute(Lead $lead): void
    {
        sleep(2);
    }
}
