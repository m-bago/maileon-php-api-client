<?php

namespace de\xqueue\maileon\api\client\dataextensions;

class Field
{
    /**
     * @var int|null $id
     */
    public $id;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string|null $description
     */
    public $description;

    /**
     * @var bool $nullable
     */
    public $nullable;

    /**
     * @var bool $unique_identifier
     */
    public $unique_identifier;

    /**
     * @var DataType $data_type
     */
    public $data_type;

    /**
     * @var mixed|null $default_value
     */
    public $default_value;

    /**
     * Constructor initializing a Field for Data Extension.
     *
     * @param int $id
     * ID of the specified field. Don't provide when instantiating a new object
     * as it gets assigned internally at Maileon when the field gets created.
     * Value is provided when deserializing via getDataExtensionById().
     *
     * @param string $name
     * The name of the field. Required*
     *
     * @param string $description
     * The description of the field.
     *
     * @param bool $nullable
     * Indicates if the field is nullable. Required*
     *
     * @param bool $unique_identifier
     * Indicates if the field is a unique identifier.
     * Required* At least one field must be marked as
     * unique identifier
     *
     * @param DataType $data_type
     * Indicates the field's data type. Required*
     * Possible values are DataType::$STRING, DataType::$DOUBLE,
     * DataType::$FLOAT, DataType::$INTEGER, DataType::$BOOLEAN,
     * DataType::$DATE, DataType::$TIMESTAMP, DataType::$CONTACT_EMAIL,
     * DataType::CONTACT_EXTERNAL_ID.
     *
     * @param mixed $default_value
     * A default value if a field is missing when adding new values.
     * Must comply with the data type.
     */
    public function __construct($id = null, $name, $description = null, $nullable, $unique_identifier, $data_type, $default_value = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->nullable = $nullable;
        $this->unique_identifier = $unique_identifier;
        $this->data_type = $data_type;
        $this->default_value = $default_value;
    }
}