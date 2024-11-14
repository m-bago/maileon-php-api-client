<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\json\AbstractJSONWrapper;

/**
 * Class DataExtensionRecord
 * Represents a set of records to be managed within a Data Extension.
 *
 * @author Milan Nagy <milan.nagy@xqueue.com>
 */
class DataExtensionRecord extends AbstractJSONWrapper
{
    /**
     * @var array $field_names
     * Array containing the names of fields within each record.
     */
    public $field_names;

    /**
     * @var array $records_list
     * Array of associative arrays, where each entry has "values" as a key with an array of values as its value.
     */
    public $records_list = [];

    /**
     * DataExtensionRecord constructor.
     *
     * @param array $field_names
     * Array of field names that define the structure of each record in the Data Extension.
     *
     * @param array $records_list
     * Optional array of initial records to include, an array of values matching the order of $field_names.
     */
    public function __construct($field_names = array(), $records_list = array())
    {
        $this->field_names = $field_names;
        $this->records_list = $this->createRecordsList($records_list);
    }

    /**
     * Adds a new record to the records_list.
     *
     * @param array $values
     * An array of values matching the structure of $field_names.
     *
     * @return void
     */
    public function addRecord(array $values)
    {
        $this->records_list[] = ["values" => $values];
    }

    /**
     * Creates the formatted records list.
     *
     * @param array $records_list
     * An array of records, where each record is an array of values.
     *
     * @return array
     * Returns an array of associative arrays where each entry has "values" as a key.
     */
    private function createRecordsList($records_list): array
    {
        $result = [];
        foreach ($records_list as $record) {
            $result[] = ["values" => $record];
        }
        return $result;
    }

    /**
     * Converts the record data into an array format compatible with the API.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            "field_names" => $this->field_names,
            "records_list" => $this->records_list
        ];
    }

    /**
     * Returns a human-readable representation of the record.
     *
     * @return string
     */
    public function toString(): string
    {
        return sprintf(
            "DataExtensionRecord:\nField Names: %s\nRecords List: %s\n",
            implode(", ", $this->field_names),
            implode(", ", $this->records_list)
        );
    }
}
