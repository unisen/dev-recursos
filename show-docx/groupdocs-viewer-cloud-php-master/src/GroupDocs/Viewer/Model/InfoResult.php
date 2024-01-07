<?php
/*
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose Pty Ltd" file="InfoResult.php">
 *   Copyright (c) 2003-2023 Aspose Pty Ltd
 * </copyright>
 * <summary>
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 * 
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 * 
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 * </summary>
 * --------------------------------------------------------------------------------------------------------------------
 */

namespace GroupDocs\Viewer\Model;

use \ArrayAccess;
use \GroupDocs\Viewer\ObjectSerializer;

/*
 * InfoResult
 *
 * @description View result information
 */
class InfoResult implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /*
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = "InfoResult";

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'formatExtension' => 'string',
        'format' => 'string',
        'pages' => '\GroupDocs\Viewer\Model\PageInfo[]',
        'attachments' => '\GroupDocs\Viewer\Model\AttachmentInfo[]',
        'archiveViewInfo' => '\GroupDocs\Viewer\Model\ArchiveViewInfo',
        'cadViewInfo' => '\GroupDocs\Viewer\Model\CadViewInfo',
        'projectManagementViewInfo' => '\GroupDocs\Viewer\Model\ProjectManagementViewInfo',
        'outlookViewInfo' => '\GroupDocs\Viewer\Model\OutlookViewInfo',
        'pdfViewInfo' => '\GroupDocs\Viewer\Model\PdfViewInfo'
    ];

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'formatExtension' => null,
        'format' => null,
        'pages' => null,
        'attachments' => null,
        'archiveViewInfo' => null,
        'cadViewInfo' => null,
        'projectManagementViewInfo' => null,
        'outlookViewInfo' => null,
        'pdfViewInfo' => null
    ];

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /*
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'formatExtension' => 'FormatExtension',
        'format' => 'Format',
        'pages' => 'Pages',
        'attachments' => 'Attachments',
        'archiveViewInfo' => 'ArchiveViewInfo',
        'cadViewInfo' => 'CadViewInfo',
        'projectManagementViewInfo' => 'ProjectManagementViewInfo',
        'outlookViewInfo' => 'OutlookViewInfo',
        'pdfViewInfo' => 'PdfViewInfo'
    ];

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'formatExtension' => 'setFormatExtension',
        'format' => 'setFormat',
        'pages' => 'setPages',
        'attachments' => 'setAttachments',
        'archiveViewInfo' => 'setArchiveViewInfo',
        'cadViewInfo' => 'setCadViewInfo',
        'projectManagementViewInfo' => 'setProjectManagementViewInfo',
        'outlookViewInfo' => 'setOutlookViewInfo',
        'pdfViewInfo' => 'setPdfViewInfo'
    ];

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'formatExtension' => 'getFormatExtension',
        'format' => 'getFormat',
        'pages' => 'getPages',
        'attachments' => 'getAttachments',
        'archiveViewInfo' => 'getArchiveViewInfo',
        'cadViewInfo' => 'getCadViewInfo',
        'projectManagementViewInfo' => 'getProjectManagementViewInfo',
        'outlookViewInfo' => 'getOutlookViewInfo',
        'pdfViewInfo' => 'getPdfViewInfo'
    ];

    /*
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /*
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /*
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /*
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['formatExtension'] = isset($data['formatExtension']) ? $data['formatExtension'] : null;
        $this->container['format'] = isset($data['format']) ? $data['format'] : null;
        $this->container['pages'] = isset($data['pages']) ? $data['pages'] : null;
        $this->container['attachments'] = isset($data['attachments']) ? $data['attachments'] : null;
        $this->container['archiveViewInfo'] = isset($data['archiveViewInfo']) ? $data['archiveViewInfo'] : null;
        $this->container['cadViewInfo'] = isset($data['cadViewInfo']) ? $data['cadViewInfo'] : null;
        $this->container['projectManagementViewInfo'] = isset($data['projectManagementViewInfo']) ? $data['projectManagementViewInfo'] : null;
        $this->container['outlookViewInfo'] = isset($data['outlookViewInfo']) ? $data['outlookViewInfo'] : null;
        $this->container['pdfViewInfo'] = isset($data['pdfViewInfo']) ? $data['pdfViewInfo'] : null;
    }

    /*
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /*
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        return true;
    }


    /*
     * Gets formatExtension
     *
     * @return string
     */
    public function getFormatExtension()
    {
        return $this->container['formatExtension'];
    }

    /*
     * Sets formatExtension
     *
     * @param string $formatExtension File format extension
     *
     * @return $this
     */
    public function setFormatExtension($formatExtension)
    {
        $this->container['formatExtension'] = $formatExtension;

        return $this;
    }

    /*
     * Gets format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->container['format'];
    }

    /*
     * Sets format
     *
     * @param string $format File format
     *
     * @return $this
     */
    public function setFormat($format)
    {
        $this->container['format'] = $format;

        return $this;
    }

    /*
     * Gets pages
     *
     * @return \GroupDocs\Viewer\Model\PageInfo[]
     */
    public function getPages()
    {
        return $this->container['pages'];
    }

    /*
     * Sets pages
     *
     * @param \GroupDocs\Viewer\Model\PageInfo[] $pages View result pages
     *
     * @return $this
     */
    public function setPages($pages)
    {
        $this->container['pages'] = $pages;

        return $this;
    }

    /*
     * Gets attachments
     *
     * @return \GroupDocs\Viewer\Model\AttachmentInfo[]
     */
    public function getAttachments()
    {
        return $this->container['attachments'];
    }

    /*
     * Sets attachments
     *
     * @param \GroupDocs\Viewer\Model\AttachmentInfo[] $attachments Attachments
     *
     * @return $this
     */
    public function setAttachments($attachments)
    {
        $this->container['attachments'] = $attachments;

        return $this;
    }

    /*
     * Gets archiveViewInfo
     *
     * @return \GroupDocs\Viewer\Model\ArchiveViewInfo
     */
    public function getArchiveViewInfo()
    {
        return $this->container['archiveViewInfo'];
    }

    /*
     * Sets archiveViewInfo
     *
     * @param \GroupDocs\Viewer\Model\ArchiveViewInfo $archiveViewInfo Represents view information for archive file
     *
     * @return $this
     */
    public function setArchiveViewInfo($archiveViewInfo)
    {
        $this->container['archiveViewInfo'] = $archiveViewInfo;

        return $this;
    }

    /*
     * Gets cadViewInfo
     *
     * @return \GroupDocs\Viewer\Model\CadViewInfo
     */
    public function getCadViewInfo()
    {
        return $this->container['cadViewInfo'];
    }

    /*
     * Sets cadViewInfo
     *
     * @param \GroupDocs\Viewer\Model\CadViewInfo $cadViewInfo Represents view information for CAD drawing
     *
     * @return $this
     */
    public function setCadViewInfo($cadViewInfo)
    {
        $this->container['cadViewInfo'] = $cadViewInfo;

        return $this;
    }

    /*
     * Gets projectManagementViewInfo
     *
     * @return \GroupDocs\Viewer\Model\ProjectManagementViewInfo
     */
    public function getProjectManagementViewInfo()
    {
        return $this->container['projectManagementViewInfo'];
    }

    /*
     * Sets projectManagementViewInfo
     *
     * @param \GroupDocs\Viewer\Model\ProjectManagementViewInfo $projectManagementViewInfo Represents view information for MS Project document
     *
     * @return $this
     */
    public function setProjectManagementViewInfo($projectManagementViewInfo)
    {
        $this->container['projectManagementViewInfo'] = $projectManagementViewInfo;

        return $this;
    }

    /*
     * Gets outlookViewInfo
     *
     * @return \GroupDocs\Viewer\Model\OutlookViewInfo
     */
    public function getOutlookViewInfo()
    {
        return $this->container['outlookViewInfo'];
    }

    /*
     * Sets outlookViewInfo
     *
     * @param \GroupDocs\Viewer\Model\OutlookViewInfo $outlookViewInfo Represents view information for Outlook Data file
     *
     * @return $this
     */
    public function setOutlookViewInfo($outlookViewInfo)
    {
        $this->container['outlookViewInfo'] = $outlookViewInfo;

        return $this;
    }

    /*
     * Gets pdfViewInfo
     *
     * @return \GroupDocs\Viewer\Model\PdfViewInfo
     */
    public function getPdfViewInfo()
    {
        return $this->container['pdfViewInfo'];
    }

    /*
     * Sets pdfViewInfo
     *
     * @param \GroupDocs\Viewer\Model\PdfViewInfo $pdfViewInfo Represents view information for PDF document
     *
     * @return $this
     */
    public function setPdfViewInfo($pdfViewInfo)
    {
        $this->container['pdfViewInfo'] = $pdfViewInfo;

        return $this;
    }
    /*
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /*
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /*
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /*
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /*
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


