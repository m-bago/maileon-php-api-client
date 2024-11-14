<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\json\AbstractJSONWrapper;

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
    public function __construct($field_names = array())
    {
        $this->field_names = $field_names;
    }

    // TODO: How to handle records_list?

    public function addRecord(array $values)
    {
        $this->records_list[] = ["values" => $values];
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
