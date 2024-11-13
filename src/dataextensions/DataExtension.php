<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\json\AbstractJSONWrapper;

/* TODO:
        - error handling comes here if mandatory field values are not set (?) if so, implement
        - validate field values eg:(delete_date accepted format)
        - proper PHP Docs
        - look more into AbstractJSONWRapper's functionality
*/

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
     * @var DeleteIntervalUnit $delete_interval_unit
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
        $this->delete_interval = $this->shouldSetDeleteInterval($retentionPolicy) ? $delete_interval : null;
        $this->delete_interval_unit = $this->shouldSetDeleteInterval($retentionPolicy) ? $delete_interval_unit : null;
        $this->fields = $fields;
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

    /**
     * Determine whether to set delete_interval & delete_interval_unit property values
     *
     * @param $retentionPolicy
     * @return bool
     */
    private function shouldSetDeleteInterval($retentionPolicy)
    {
        return $retentionPolicy !== RetentionPolicy::$NONE && $retentionPolicy !== RetentionPolicy::$EXTENSION_DATE;
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['retention_policy'] = $this->retention_policy->getType();

        if (isset($this->delete_date_interval)) {
            $array['delete_date_interval'] = $this->delete_interval_unit->getType();
        }
        return $array;
    }

    /**
     * Override AbstractJSONWrapper
     *
     * @return string
     * a human-readable representation listing all the attributes of this data extension and their respective values.
     */
    public function toString()
    {
        $fields = implode(', ', $this->fields);

        return sprintf(
            "DataExtension:\n" .
            "Name: %s\n" .
            "Description: %s\n" .
            "Retention Policy: %s\n" .
            "Delete Date: %s\n" .
            "Delete Date (as long): %d\n" .
            "Delete Interval: %d\n" .
            "Delete Interval Unit: %s\n" .
            "Fields: %s\n",
            $this->name ?? 'N/A',
            $this->description ?? 'N/A',
            $this->retention_policy->getType() ?? 'N/A',
            $this->delete_date ?? 'N/A',
            $this->delete_date_as_long ?? 0,
            $this->delete_interval ?? 0,
            $this->delete_interval_unit->getUnit() ?? 'N/A',
            $fields
        );
    }
}