<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\json\AbstractJSONWrapper;

/**
 * Class DataExtensionRecord
 * Represents a set of records to be managed within a Data Extension.
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
     */
    public function __construct($field_names = array(), $records_list = array())
    {
        $this->field_names = $field_names;
        $this->records_list = $this->createRecordsList($records_list);
    }

    // TODO: How to handle records_list?

    public function addRecord(array $values)
    {
        $this->records_list[] = ["values" => $values];
    }

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
