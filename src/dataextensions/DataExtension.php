<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\json\AbstractJSONWrapper;

/**
 * The wrapper class for a Maileon data extension.
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

    /**
     * Constructor initializing Data Extension with default values.
     *
     * @param string $name
     * The name of the data extension Required*.
     *
     * @param RetentionPolicy $retentionPolicy
     * The retention policy of the data extension Required*.
     *
     * @param string $description
     * The description of the data extension.
     *
     * @param string $delete_date
     * The deletion date of the data extension
     * Accepted formats: Y-m-d, Y-m-d H:i:s, Y-m-dTH:i:sZ.
     * Required* IF retention policy is set to extension_date
     * AND delete_date_as_long is not set.
     *
     * @param int $delete_date_as_long
     * The deletion date timestamp in microseconds
     * (timestamp * 1000) of the data extension.
     * Required* IF retention policy is set to extension_date
     * AND delete_date is not set.
     *
     * @param int $delete_interval
     * The amount of delete_interval_unit as integer
     * for example(delete_interval_unit is set to "DAYS",
     * delete_interval is set to 3 that equals 3 DAYS).
     * Required* IF retention_policy is either extension_duration,
     * extension_duration_renew_on_modification or records_duration.
     *
     * @param DeleteIntervalUnit $delete_interval_unit
     * The date interval unit.
     * Required* IF retention_policy is either extension_duration,
     * extension_duration_renew_on_modification or records_duration.
     *
     * @param array $fields
     * An array of date extension fields.
     * Required*
     */
    public function __construct(
        $name = null,
        $retentionPolicy = null,
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
        $this->delete_date = $delete_date;
        $this->delete_date_as_long = $delete_date_as_long;
        $this->delete_interval = $delete_interval;
        $this->delete_interval_unit = $delete_interval_unit;
        $this->fields = $fields;
    }


    /**
     * Override AbstractJSONWrapper
     * Serialize this object to a JSON String.
     *
     * @return array
     * This class in array form.
     */
    public function toArray()
    {
        $array = parent::toArray();

        if (isset($this->retention_policy)) {
            $array['retention_policy'] = $this->retention_policy->getType();
        }

        if (isset($this->delete_date_interval)) {
            $array['delete_interval'] = $this->delete_interval;
            $array['delete_interval_unit'] = $this->delete_interval_unit->getType();
        }
        foreach ($this->fields as $field) {
            $field->data_type = $field->data_type->getValue();
        }
        return $array;
    }

    /**
     * @Override AbstractJSONWrapper
     *
     * Used to initialize this object from JSON. Override this to modify JSON
     * parameters.
     *
     * @param array $object_vars
     * The array from json_decode
     *
     * @return void
     */
    public function fromArray($object_vars)
    {
        if (property_exists($object_vars, 'fields') && is_array($object_vars->fields)) {
            foreach ($object_vars->fields as $field) {
                $fieldObject = new Field(
                    $field->id,
                    $field->name,
                    null,
                    $field->nullable,
                    $field->unique_identifier,
                    $field->data_type
                );
                if ($field->description) {
                    $fieldObject->description = $field->description;
                }
                if (isset($field->default_value)) {
                    $fieldObject->default_value = $field->default_value;
                }
                $this->fields[] = $fieldObject;
            }
            unset($object_vars->fields);
        }
        parent::fromArray($object_vars);
    }

    /**
     * @Override AbstractJSONWrapper
     * Creates a human-readable representation listing all the
     * attributes of this data extension and their respective values.
     *
     * @return string
     */
    public function toString()
    {
        $fields = "";
        foreach ($this->fields as $field) {
            $fields .= $field . '\n';
        }

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
            $this->name == "" ? 'N/A' : $this->name,
            $this->description == "" ? 'N/A' : $this->description,
            $this->retention_policy->getType() ?? 'N/A',
            $this->delete_date == "" ? 'N/A' : $this->delete_date,
            $this->delete_date_as_long ?? 'N/A',
            $this->delete_interval ?? 'N/A',
            $this->delete_interval_unit ? $this->delete_interval_unit->getUnit() : 'N/A',
            $fields
        );
    }
}