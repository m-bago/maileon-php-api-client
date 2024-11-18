<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\json\AbstractJSONWrapper;

class Field extends AbstractJSONWrapper
{
    public $id;
    public $name;
    public $description;
    public $nullable;
    public $unique_identifier;
    public $data_type;
    public $default_value;

    public function fromArray($object_vars)
    {
        if (property_exists($object_vars, 'id')) {
            $this->id = $object_vars->id;
        }
        if (property_exists($object_vars, 'name')) {
            $this->name = $object_vars->name;
        }
        if (property_exists($object_vars, 'description')) {
            $this->description = $object_vars->description;
        }
        if (property_exists($object_vars, 'nullable')) {
            $this->nullable = $object_vars->nullable;
        }
        if (property_exists($object_vars, 'unique_identifier')) {
            $this->unique_identifier = $object_vars->unique_identifier;
        }
        if (property_exists($object_vars, 'data_type')) {
            $this->data_type = $object_vars->data_type;
        }
        if (property_exists($object_vars, 'default_value')) {
            $this->default_value = $object_vars->default_value;
        }

        parent::fromArray($object_vars);
    }

    public function toString()
    {
        return sprintf(
            "Field:\n" .
            "Name: %s\n" .
            "Description: %s\n" .
            "Nullable: %s\n" .
            "Unique-Identifier: %s\n" .
            "Data-Type: %s\n" .
            "Default-Value: %s\n",
            $this->name,
            $this->description,
            $this->nullable == "" ? 'false' : 'true',
            $this->unique_identifier == 0 ? 'false' : 'true',
            $this->data_type,
            $this->default_value == "" ? 'N/A' : $this->default_value
        );
    }
}