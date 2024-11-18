<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\AbstractMaileonService;
use de\xqueue\maileon\api\client\json\JSONSerializer;
use de\xqueue\maileon\api\client\MaileonAPIException;
use de\xqueue\maileon\api\client\MaileonAPIResult;

/**
 * This service wraps the REST API calls for the data extension features.
 */
class DataExtensionsService extends AbstractMaileonService
{
    /**
     * Mandatory mime_type as all endpoints use json.
     */
    const MIME_TYPE = "application/vnd.maileon.api+json";

    /**
     * Get all available data types
     *
     * @return MaileonAPIResult
     * The result object of the API call,
     *
     * @throws MaileonAPIException
     * If there was a connection problem or a server error occurred.
     */
    public function getDataTypes()
    {
        return $this->get("dataextensions/datatypes", [], self::MIME_TYPE, 'DataType');
    }

    /**
     * @param string $dataExtensionId
     * The ID of the data extension to be deleted
     * @return MaileonAPIResult
     * The result object of the API call
     * @throws MaileonAPIException
     * If there was a connection problem or a server error occurred.
     */
    public function deleteDataExtensionById($dataExtensionId)
    {
        return $this->delete('dataextensions/' . $dataExtensionId, [], self::MIME_TYPE);
    }

    /**
     * Returns a data extension with the provided ID.
     *
     * @param string $dataExtensionId
     * The ID of the data extension to be retrieved
     * @return MaileonAPIResult
     * The result object of the API call,
     * with a Data Extension available at MaileonAPIResult::getResult()
     * @throws MaileonAPIException
     *  If there was a connection problem or a server error occurred.
     */
    public function getDataExtensionById($dataExtensionId)
    {
        return $this->get("dataextensions/" . $dataExtensionId, [], self::MIME_TYPE, DataExtension::class);
    }

    /**
     * Creates a data extension.
     *
     * @param DataExtension $dataExtension
     * The Data Extension to be created
     * @return MaileonAPIResult
     * the result object of the API call
     * @throws MaileonAPIException
     * if there was a connection problem or a server error occurred
     */
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