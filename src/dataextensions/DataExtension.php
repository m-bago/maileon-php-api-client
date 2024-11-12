<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\json\AbstractJSONWrapper;

class DataExtension extends AbstractJSONWrapper
{
    private $name;
    private $description;
    private $retention_policy;
    private $delete_date;
    private $delete_date_as_long;
    private $delete_interval;
    private $delete_interval_unit;

    public function __construct(
        string          $name,
        RetentionPolicy $retentionPolicy,
        string          $description = null,
        string          $delete_date = null,
        string          $delete_date_as_long = null
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->retention_policy = $retentionPolicy;
        $this->delete_date = $this->shouldSetDeleteDateValue($retentionPolicy, $delete_date_as_long) ? $delete_date : null;
    }


    /**
     * Determine whether to set delete_date property's value or not.
     * @param RetentionPolicy $retentionPolicy
     * @param string $deleteDateAsLong
     * @return bool
     */
    private function shouldSetDeleteDateValue(RetentionPolicy $retentionPolicy, string $deleteDateAsLong): bool
    {
        return ($retentionPolicy == RetentionPolicy::EXTENSION_DATE && !is_null($deleteDateAsLong));
    }

}