<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\AbstractMaileonService;

class DataExtensionsService extends AbstractMaileonService
{
    private $mimeType = "application/vnd.maileon.api+json";

    public function getDataTypes()
    {
        return $this->get("dataextensions/datatypes", [], $this->mimeType);
    }
}