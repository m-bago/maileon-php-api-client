<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\AbstractMaileonService;
use de\xqueue\maileon\api\client\json\JSONSerializer;
use de\xqueue\maileon\api\client\MaileonAPIResult;

class DataExtensionsService extends AbstractMaileonService
{
    const MIME_TYPE = "application/vnd.maileon.api+json";

    public function getDataTypes(): MaileonAPIResult
    {
        return $this->get("dataextensions/datatypes", [], self::MIME_TYPE);
    }

    //TODO currently returns 403 Status code
    // with user has no privileges for requested method as resultXml
    public function deleteDataExtensionById(string $dataExtensionId)
    {
        $queryParameters = [
            'id' => $dataExtensionId
        ];

        return $this->delete('dataextensions/', $queryParameters);
    }

    public function getDataExtensionById(string $dataExtensionId)
    {
        return $this->get("dataextensions/" . $dataExtensionId, [], self::MIME_TYPE);
    }

    public function createDataExtension($dataExtension)
    {
        return $this->post('dataextensions', JSONSerializer::json_encode($dataExtension), [], self::MIME_TYPE);
    }

    /**
     * Updates an existing Data Extension.
     *
     * @param integer $dataExtensionId
     * The ID of the Data Extension to update.
     *
     * @param DataExtension $dataExtension
     * An instance of DataExtension containing the updated values for the Data Extension.
     *
     * @return MaileonAPIResult
     * Returns a MaileonAPIResult object with the outcome of the update operation.
     */
    public function updateDataExtension($dataExtensionId, $dataExtension)
    {
        return $this->put(
            "dataextensions/" . $dataExtensionId,
            JSONSerializer::json_encode($dataExtension),
            [],
            self::MIME_TYPE
        );
    }

    /**
     * Manages records within a specified Data Extension by inserting, updating, upserting, or deleting records.
     *
     * @param integer $dataExtensionId
     * The ID of the Data Extension in which records are to be managed.
     *
     * @param DataExtensionRecord $record
     * An instance of DataExtensionRecord containing field names and record values.
     *
     * @param ImportOption $importOption
     * An instance of ImportOption specifying the operation to perform (INSERT, UPDATE, etc.).
     *
     * @return MaileonAPIResult
     * Returns a MaileonAPIResult object with the outcome of the record management operation.
     */
    public function manageRecords($dataExtensionId, $record, $importOption)
    {
        $queryParameters = [
            'importOption' => $importOption->getOption(),
        ];

        return $this->post(
            "dataextensions/" . $dataExtensionId,
            JSONSerializer::json_encode($record),
            $queryParameters,
            self::MIME_TYPE
        );
    }
}