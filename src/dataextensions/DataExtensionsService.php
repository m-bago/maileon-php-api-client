<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\AbstractMaileonService;
use de\xqueue\maileon\api\client\MaileonAPIResult;

class DataExtensionsService extends AbstractMaileonService
{
    private $mimeType = "application/vnd.maileon.api+json";

    public function getDataTypes(): MaileonAPIResult
    {
        return $this->get("dataextensions/datatypes", [], $this->mimeType);
    }

    //TODO implement properly
//    public function deleteDataExtension(string $dataExtensionId)
//    {
//        $queryParameters = [
//            'id' => $dataExtensionId
//        ];
//        return $this->delete('dataextensions/', $queryParameters, );
//    }

    public function getDataExtension(string $dataExtensionId): MaileonAPIResult
    {
        $queryParameters = [
            'id' => $dataExtensionId
        ];

        return $this->get("dataextensions/", $queryParameters, $this->mimeType);
    }
}