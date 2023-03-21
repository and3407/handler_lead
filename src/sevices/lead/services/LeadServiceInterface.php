<?php

namespace LeadHandler\sevices\lead\services;

use LeadHandler\sevices\lead\models\Lead;

interface LeadServiceInterface
{
    public function execute(Lead $lead): void;
}
