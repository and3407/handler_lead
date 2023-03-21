<?php

namespace LeadHandler\sevices\lead\models;

class Lead
{
    private int $leadId;
    private string $categoryName;

    public function __construct(int $leadId, string $categoryName)
    {
        $this->leadId = $leadId;
        $this->categoryName = $categoryName;
    }

    public function getLeadId(): int
    {
        return $this->leadId;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }
}
