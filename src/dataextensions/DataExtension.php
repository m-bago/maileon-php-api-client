<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\json\AbstractJSONWrapper;

class DataExtension extends AbstractJSONWrapper
{
    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var RetentionPolicy $retention_policy
     */
    public $retention_policy;

    /**
     * @var string $delete_date
     */
    public $delete_date;

    /**
     * @var int $delete_date_as_long
     */
    public $delete_date_as_long;

    /**
     * @var int $delete_interval
     */
    public $delete_interval;

    /**
     * @var
     */
    public $delete_interval_unit;

    /**
     * @var array $fields
     */
    public $fields;

    public function __construct(
        $name,
        RetentionPolicy $retentionPolicy,
        $description = null,
        $delete_date = null,
        $delete_date_as_long = null,
        $delete_interval = null,
        $delete_interval_unit = null,
        $fields = array()
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->retention_policy = $retentionPolicy;
        $this->delete_date = $this->shouldSetDeleteDateValue($retentionPolicy, $delete_date_as_long) ? $delete_date : null;
        $this->delete_date_as_long = is_null($delete_date) ? $delete_date_as_long : null;
    }


    /**
     * Determine whether to set delete_date property's value or not.
     *
     * @param RetentionPolicy $retentionPolicy
     * @param string|null $deleteDateAsLong
     *
     * @return bool
     */
    private function shouldSetDeleteDateValue($retentionPolicy, $deleteDateAsLong): bool
    {
        return ($retentionPolicy == RetentionPolicy::$EXTENSION_DATE && is_null($deleteDateAsLong));
    }
}