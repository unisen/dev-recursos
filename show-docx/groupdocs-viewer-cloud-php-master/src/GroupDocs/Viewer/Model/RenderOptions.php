<?php
/*
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose Pty Ltd" file="RenderOptions.php">
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
 * RenderOptions
 *
 * @description Rendering options
 */
class RenderOptions implements ArrayAccess
{
    const DISCRIMINATOR = 'Type';

    /*
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = "RenderOptions";

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'startPageNumber' => 'int',
        'countPagesToRender' => 'int',
        'pagesToRender' => 'int[]',
        'pageRotations' => '\GroupDocs\Viewer\Model\PageRotation[]',
        'defaultFontName' => 'string',
        'defaultEncoding' => 'string',
        'detectEncoding' => 'bool',
        'renderComments' => 'bool',
        'renderNotes' => 'bool',
        'renderHiddenPages' => 'bool',
        'spreadsheetOptions' => '\GroupDocs\Viewer\Model\SpreadsheetOptions',
        'cadOptions' => '\GroupDocs\Viewer\Model\CadOptions',
        'emailOptions' => '\GroupDocs\Viewer\Model\EmailOptions',
        'projectManagementOptions' => '\GroupDocs\Viewer\Model\ProjectManagementOptions',
        'pdfDocumentOptions' => '\GroupDocs\Viewer\Model\PdfDocumentOptions',
        'wordProcessingOptions' => '\GroupDocs\Viewer\Model\WordProcessingOptions',
        'outlookOptions' => '\GroupDocs\Viewer\Model\OutlookOptions',
        'archiveOptions' => '\GroupDocs\Viewer\Model\ArchiveOptions',
        'textOptions' => '\GroupDocs\Viewer\Model\TextOptions',
        'mailStorageOptions' => '\GroupDocs\Viewer\Model\MailStorageOptions',
        'visioRenderingOptions' => '\GroupDocs\Viewer\Model\VisioRenderingOptions',
        'webDocumentOptions' => '\GroupDocs\Viewer\Model\WebDocumentOptions'
    ];

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'startPageNumber' => 'int32',
        'countPagesToRender' => 'int32',
        'pagesToRender' => 'int32',
        'pageRotations' => null,
        'defaultFontName' => null,
        'defaultEncoding' => null,
        'detectEncoding' => null,
        'renderComments' => null,
        'renderNotes' => null,
        'renderHiddenPages' => null,
        'spreadsheetOptions' => null,
        'cadOptions' => null,
        'emailOptions' => null,
        'projectManagementOptions' => null,
        'pdfDocumentOptions' => null,
        'wordProcessingOptions' => null,
        'outlookOptions' => null,
        'archiveOptions' => null,
        'textOptions' => null,
        'mailStorageOptions' => null,
        'visioRenderingOptions' => null,
        'webDocumentOptions' => null
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
        'startPageNumber' => 'StartPageNumber',
        'countPagesToRender' => 'CountPagesToRender',
        'pagesToRender' => 'PagesToRender',
        'pageRotations' => 'PageRotations',
        'defaultFontName' => 'DefaultFontName',
        'defaultEncoding' => 'DefaultEncoding',
        'detectEncoding' => 'DetectEncoding',
        'renderComments' => 'RenderComments',
        'renderNotes' => 'RenderNotes',
        'renderHiddenPages' => 'RenderHiddenPages',
        'spreadsheetOptions' => 'SpreadsheetOptions',
        'cadOptions' => 'CadOptions',
        'emailOptions' => 'EmailOptions',
        'projectManagementOptions' => 'ProjectManagementOptions',
        'pdfDocumentOptions' => 'PdfDocumentOptions',
        'wordProcessingOptions' => 'WordProcessingOptions',
        'outlookOptions' => 'OutlookOptions',
        'archiveOptions' => 'ArchiveOptions',
        'textOptions' => 'TextOptions',
        'mailStorageOptions' => 'MailStorageOptions',
        'visioRenderingOptions' => 'VisioRenderingOptions',
        'webDocumentOptions' => 'WebDocumentOptions'
    ];

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'startPageNumber' => 'setStartPageNumber',
        'countPagesToRender' => 'setCountPagesToRender',
        'pagesToRender' => 'setPagesToRender',
        'pageRotations' => 'setPageRotations',
        'defaultFontName' => 'setDefaultFontName',
        'defaultEncoding' => 'setDefaultEncoding',
        'detectEncoding' => 'setDetectEncoding',
        'renderComments' => 'setRenderComments',
        'renderNotes' => 'setRenderNotes',
        'renderHiddenPages' => 'setRenderHiddenPages',
        'spreadsheetOptions' => 'setSpreadsheetOptions',
        'cadOptions' => 'setCadOptions',
        'emailOptions' => 'setEmailOptions',
        'projectManagementOptions' => 'setProjectManagementOptions',
        'pdfDocumentOptions' => 'setPdfDocumentOptions',
        'wordProcessingOptions' => 'setWordProcessingOptions',
        'outlookOptions' => 'setOutlookOptions',
        'archiveOptions' => 'setArchiveOptions',
        'textOptions' => 'setTextOptions',
        'mailStorageOptions' => 'setMailStorageOptions',
        'visioRenderingOptions' => 'setVisioRenderingOptions',
        'webDocumentOptions' => 'setWebDocumentOptions'
    ];

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'startPageNumber' => 'getStartPageNumber',
        'countPagesToRender' => 'getCountPagesToRender',
        'pagesToRender' => 'getPagesToRender',
        'pageRotations' => 'getPageRotations',
        'defaultFontName' => 'getDefaultFontName',
        'defaultEncoding' => 'getDefaultEncoding',
        'detectEncoding' => 'getDetectEncoding',
        'renderComments' => 'getRenderComments',
        'renderNotes' => 'getRenderNotes',
        'renderHiddenPages' => 'getRenderHiddenPages',
        'spreadsheetOptions' => 'getSpreadsheetOptions',
        'cadOptions' => 'getCadOptions',
        'emailOptions' => 'getEmailOptions',
        'projectManagementOptions' => 'getProjectManagementOptions',
        'pdfDocumentOptions' => 'getPdfDocumentOptions',
        'wordProcessingOptions' => 'getWordProcessingOptions',
        'outlookOptions' => 'getOutlookOptions',
        'archiveOptions' => 'getArchiveOptions',
        'textOptions' => 'getTextOptions',
        'mailStorageOptions' => 'getMailStorageOptions',
        'visioRenderingOptions' => 'getVisioRenderingOptions',
        'webDocumentOptions' => 'getWebDocumentOptions'
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
        $this->container['startPageNumber'] = isset($data['startPageNumber']) ? $data['startPageNumber'] : null;
        $this->container['countPagesToRender'] = isset($data['countPagesToRender']) ? $data['countPagesToRender'] : null;
        $this->container['pagesToRender'] = isset($data['pagesToRender']) ? $data['pagesToRender'] : null;
        $this->container['pageRotations'] = isset($data['pageRotations']) ? $data['pageRotations'] : null;
        $this->container['defaultFontName'] = isset($data['defaultFontName']) ? $data['defaultFontName'] : null;
        $this->container['defaultEncoding'] = isset($data['defaultEncoding']) ? $data['defaultEncoding'] : null;
        $this->container['detectEncoding'] = isset($data['detectEncoding']) ? $data['detectEncoding'] : null;
        $this->container['renderComments'] = isset($data['renderComments']) ? $data['renderComments'] : null;
        $this->container['renderNotes'] = isset($data['renderNotes']) ? $data['renderNotes'] : null;
        $this->container['renderHiddenPages'] = isset($data['renderHiddenPages']) ? $data['renderHiddenPages'] : null;
        $this->container['spreadsheetOptions'] = isset($data['spreadsheetOptions']) ? $data['spreadsheetOptions'] : null;
        $this->container['cadOptions'] = isset($data['cadOptions']) ? $data['cadOptions'] : null;
        $this->container['emailOptions'] = isset($data['emailOptions']) ? $data['emailOptions'] : null;
        $this->container['projectManagementOptions'] = isset($data['projectManagementOptions']) ? $data['projectManagementOptions'] : null;
        $this->container['pdfDocumentOptions'] = isset($data['pdfDocumentOptions']) ? $data['pdfDocumentOptions'] : null;
        $this->container['wordProcessingOptions'] = isset($data['wordProcessingOptions']) ? $data['wordProcessingOptions'] : null;
        $this->container['outlookOptions'] = isset($data['outlookOptions']) ? $data['outlookOptions'] : null;
        $this->container['archiveOptions'] = isset($data['archiveOptions']) ? $data['archiveOptions'] : null;
        $this->container['textOptions'] = isset($data['textOptions']) ? $data['textOptions'] : null;
        $this->container['mailStorageOptions'] = isset($data['mailStorageOptions']) ? $data['mailStorageOptions'] : null;
        $this->container['visioRenderingOptions'] = isset($data['visioRenderingOptions']) ? $data['visioRenderingOptions'] : null;
        $this->container['webDocumentOptions'] = isset($data['webDocumentOptions']) ? $data['webDocumentOptions'] : null;

        // Initialize discriminator property with the model name.
        $discriminator = array_search('Type', self::$attributeMap);
        $this->container[$discriminator] = static::$swaggerModelName;
    }

    /*
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['startPageNumber'] === null) {
            $invalidProperties[] = "'startPageNumber' can't be null";
        }
        if ($this->container['countPagesToRender'] === null) {
            $invalidProperties[] = "'countPagesToRender' can't be null";
        }
        if ($this->container['renderComments'] === null) {
            $invalidProperties[] = "'renderComments' can't be null";
        }
        if ($this->container['renderNotes'] === null) {
            $invalidProperties[] = "'renderNotes' can't be null";
        }
        if ($this->container['renderHiddenPages'] === null) {
            $invalidProperties[] = "'renderHiddenPages' can't be null";
        }
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

        if ($this->container['startPageNumber'] === null) {
            return false;
        }
        if ($this->container['countPagesToRender'] === null) {
            return false;
        }
        if ($this->container['renderComments'] === null) {
            return false;
        }
        if ($this->container['renderNotes'] === null) {
            return false;
        }
        if ($this->container['renderHiddenPages'] === null) {
            return false;
        }
        return true;
    }


    /*
     * Gets startPageNumber
     *
     * @return int
     */
    public function getStartPageNumber()
    {
        return $this->container['startPageNumber'];
    }

    /*
     * Sets startPageNumber
     *
     * @param int $startPageNumber Page number from which rendering should be started
     *
     * @return $this
     */
    public function setStartPageNumber($startPageNumber)
    {
        $this->container['startPageNumber'] = $startPageNumber;

        return $this;
    }

    /*
     * Gets countPagesToRender
     *
     * @return int
     */
    public function getCountPagesToRender()
    {
        return $this->container['countPagesToRender'];
    }

    /*
     * Sets countPagesToRender
     *
     * @param int $countPagesToRender Count pages which should be rendered
     *
     * @return $this
     */
    public function setCountPagesToRender($countPagesToRender)
    {
        $this->container['countPagesToRender'] = $countPagesToRender;

        return $this;
    }

    /*
     * Gets pagesToRender
     *
     * @return int[]
     */
    public function getPagesToRender()
    {
        return $this->container['pagesToRender'];
    }

    /*
     * Sets pagesToRender
     *
     * @param int[] $pagesToRender Pages list to render. Ignored, if StartPageNumber and CountPagesToRender are provided
     *
     * @return $this
     */
    public function setPagesToRender($pagesToRender)
    {
        $this->container['pagesToRender'] = $pagesToRender;

        return $this;
    }

    /*
     * Gets pageRotations
     *
     * @return \GroupDocs\Viewer\Model\PageRotation[]
     */
    public function getPageRotations()
    {
        return $this->container['pageRotations'];
    }

    /*
     * Sets pageRotations
     *
     * @param \GroupDocs\Viewer\Model\PageRotation[] $pageRotations Page rotations
     *
     * @return $this
     */
    public function setPageRotations($pageRotations)
    {
        $this->container['pageRotations'] = $pageRotations;

        return $this;
    }

    /*
     * Gets defaultFontName
     *
     * @return string
     */
    public function getDefaultFontName()
    {
        return $this->container['defaultFontName'];
    }

    /*
     * Sets defaultFontName
     *
     * @param string $defaultFontName Default font name may be specified in following cases: - You want to generally specify the default font to fall back on, if particular font   in the document cannot be found during rendering. - Your document uses fonts, that contain non-English characters and you want to make sure   any missing font is replaced with one that has the same character set available.
     *
     * @return $this
     */
    public function setDefaultFontName($defaultFontName)
    {
        $this->container['defaultFontName'] = $defaultFontName;

        return $this;
    }

    /*
     * Gets defaultEncoding
     *
     * @return string
     */
    public function getDefaultEncoding()
    {
        return $this->container['defaultEncoding'];
    }

    /*
     * Sets defaultEncoding
     *
     * @param string $defaultEncoding Default encoding for the plain text files such as .csv, .txt and .eml files when encoding is not specified in header
     *
     * @return $this
     */
    public function setDefaultEncoding($defaultEncoding)
    {
        $this->container['defaultEncoding'] = $defaultEncoding;

        return $this;
    }

    /*
     * Gets detectEncoding
     *
     * @return bool
     */
    public function getDetectEncoding()
    {
        return $this->container['detectEncoding'];
    }

    /*
     * Sets detectEncoding
     *
     * @param bool $detectEncoding This option enables TXT, TSV, and CSV files encoding detection. In case the encoding can't be detected the DefaultEncoding is used.
     *
     * @return $this
     */
    public function setDetectEncoding($detectEncoding)
    {
        $this->container['detectEncoding'] = $detectEncoding;

        return $this;
    }

    /*
     * Gets renderComments
     *
     * @return bool
     */
    public function getRenderComments()
    {
        return $this->container['renderComments'];
    }

    /*
     * Sets renderComments
     *
     * @param bool $renderComments When enabled comments will be rendered to the output
     *
     * @return $this
     */
    public function setRenderComments($renderComments)
    {
        $this->container['renderComments'] = $renderComments;

        return $this;
    }

    /*
     * Gets renderNotes
     *
     * @return bool
     */
    public function getRenderNotes()
    {
        return $this->container['renderNotes'];
    }

    /*
     * Sets renderNotes
     *
     * @param bool $renderNotes When enabled notes will be rendered to the output
     *
     * @return $this
     */
    public function setRenderNotes($renderNotes)
    {
        $this->container['renderNotes'] = $renderNotes;

        return $this;
    }

    /*
     * Gets renderHiddenPages
     *
     * @return bool
     */
    public function getRenderHiddenPages()
    {
        return $this->container['renderHiddenPages'];
    }

    /*
     * Sets renderHiddenPages
     *
     * @param bool $renderHiddenPages When enabled hidden pages, sheets or slides will be rendered to the output
     *
     * @return $this
     */
    public function setRenderHiddenPages($renderHiddenPages)
    {
        $this->container['renderHiddenPages'] = $renderHiddenPages;

        return $this;
    }

    /*
     * Gets spreadsheetOptions
     *
     * @return \GroupDocs\Viewer\Model\SpreadsheetOptions
     */
    public function getSpreadsheetOptions()
    {
        return $this->container['spreadsheetOptions'];
    }

    /*
     * Sets spreadsheetOptions
     *
     * @param \GroupDocs\Viewer\Model\SpreadsheetOptions $spreadsheetOptions Rendering options for Spreadsheet source file formats Spreadsheet file formats include files with extensions: .xls, .xlsx, .xlsm, .xlsb, .csv, .ods, .ots, .xltx, .xltm, .tsv
     *
     * @return $this
     */
    public function setSpreadsheetOptions($spreadsheetOptions)
    {
        $this->container['spreadsheetOptions'] = $spreadsheetOptions;

        return $this;
    }

    /*
     * Gets cadOptions
     *
     * @return \GroupDocs\Viewer\Model\CadOptions
     */
    public function getCadOptions()
    {
        return $this->container['cadOptions'];
    }

    /*
     * Sets cadOptions
     *
     * @param \GroupDocs\Viewer\Model\CadOptions $cadOptions Rendering options for CAD source file formats CAD file formats include files with extensions: .dwg, .dxf, .dgn, .ifc, .stl
     *
     * @return $this
     */
    public function setCadOptions($cadOptions)
    {
        $this->container['cadOptions'] = $cadOptions;

        return $this;
    }

    /*
     * Gets emailOptions
     *
     * @return \GroupDocs\Viewer\Model\EmailOptions
     */
    public function getEmailOptions()
    {
        return $this->container['emailOptions'];
    }

    /*
     * Sets emailOptions
     *
     * @param \GroupDocs\Viewer\Model\EmailOptions $emailOptions Rendering options for Email source file formats Email file formats include files with extensions: .msg, .eml, .emlx, .ifc, .stl
     *
     * @return $this
     */
    public function setEmailOptions($emailOptions)
    {
        $this->container['emailOptions'] = $emailOptions;

        return $this;
    }

    /*
     * Gets projectManagementOptions
     *
     * @return \GroupDocs\Viewer\Model\ProjectManagementOptions
     */
    public function getProjectManagementOptions()
    {
        return $this->container['projectManagementOptions'];
    }

    /*
     * Sets projectManagementOptions
     *
     * @param \GroupDocs\Viewer\Model\ProjectManagementOptions $projectManagementOptions Rendering options for MS Project source file formats Project file formats include files with extensions: .mpt, .mpp
     *
     * @return $this
     */
    public function setProjectManagementOptions($projectManagementOptions)
    {
        $this->container['projectManagementOptions'] = $projectManagementOptions;

        return $this;
    }

    /*
     * Gets pdfDocumentOptions
     *
     * @return \GroupDocs\Viewer\Model\PdfDocumentOptions
     */
    public function getPdfDocumentOptions()
    {
        return $this->container['pdfDocumentOptions'];
    }

    /*
     * Sets pdfDocumentOptions
     *
     * @param \GroupDocs\Viewer\Model\PdfDocumentOptions $pdfDocumentOptions Rendering options for PDF source file formats
     *
     * @return $this
     */
    public function setPdfDocumentOptions($pdfDocumentOptions)
    {
        $this->container['pdfDocumentOptions'] = $pdfDocumentOptions;

        return $this;
    }

    /*
     * Gets wordProcessingOptions
     *
     * @return \GroupDocs\Viewer\Model\WordProcessingOptions
     */
    public function getWordProcessingOptions()
    {
        return $this->container['wordProcessingOptions'];
    }

    /*
     * Sets wordProcessingOptions
     *
     * @param \GroupDocs\Viewer\Model\WordProcessingOptions $wordProcessingOptions Rendering options for WordProcessing source file formats
     *
     * @return $this
     */
    public function setWordProcessingOptions($wordProcessingOptions)
    {
        $this->container['wordProcessingOptions'] = $wordProcessingOptions;

        return $this;
    }

    /*
     * Gets outlookOptions
     *
     * @return \GroupDocs\Viewer\Model\OutlookOptions
     */
    public function getOutlookOptions()
    {
        return $this->container['outlookOptions'];
    }

    /*
     * Sets outlookOptions
     *
     * @param \GroupDocs\Viewer\Model\OutlookOptions $outlookOptions Rendering options for Outlook source file formats
     *
     * @return $this
     */
    public function setOutlookOptions($outlookOptions)
    {
        $this->container['outlookOptions'] = $outlookOptions;

        return $this;
    }

    /*
     * Gets archiveOptions
     *
     * @return \GroupDocs\Viewer\Model\ArchiveOptions
     */
    public function getArchiveOptions()
    {
        return $this->container['archiveOptions'];
    }

    /*
     * Sets archiveOptions
     *
     * @param \GroupDocs\Viewer\Model\ArchiveOptions $archiveOptions Rendering options for Archive source file formats
     *
     * @return $this
     */
    public function setArchiveOptions($archiveOptions)
    {
        $this->container['archiveOptions'] = $archiveOptions;

        return $this;
    }

    /*
     * Gets textOptions
     *
     * @return \GroupDocs\Viewer\Model\TextOptions
     */
    public function getTextOptions()
    {
        return $this->container['textOptions'];
    }

    /*
     * Sets textOptions
     *
     * @param \GroupDocs\Viewer\Model\TextOptions $textOptions Rendering options for Text source file formats
     *
     * @return $this
     */
    public function setTextOptions($textOptions)
    {
        $this->container['textOptions'] = $textOptions;

        return $this;
    }

    /*
     * Gets mailStorageOptions
     *
     * @return \GroupDocs\Viewer\Model\MailStorageOptions
     */
    public function getMailStorageOptions()
    {
        return $this->container['mailStorageOptions'];
    }

    /*
     * Sets mailStorageOptions
     *
     * @param \GroupDocs\Viewer\Model\MailStorageOptions $mailStorageOptions Rendering options for Mail storage (Lotus Notes, MBox) data files.
     *
     * @return $this
     */
    public function setMailStorageOptions($mailStorageOptions)
    {
        $this->container['mailStorageOptions'] = $mailStorageOptions;

        return $this;
    }

    /*
     * Gets visioRenderingOptions
     *
     * @return \GroupDocs\Viewer\Model\VisioRenderingOptions
     */
    public function getVisioRenderingOptions()
    {
        return $this->container['visioRenderingOptions'];
    }

    /*
     * Sets visioRenderingOptions
     *
     * @param \GroupDocs\Viewer\Model\VisioRenderingOptions $visioRenderingOptions Rendering options for Visio source file formats
     *
     * @return $this
     */
    public function setVisioRenderingOptions($visioRenderingOptions)
    {
        $this->container['visioRenderingOptions'] = $visioRenderingOptions;

        return $this;
    }

    /*
     * Gets webDocumentOptions
     *
     * @return \GroupDocs\Viewer\Model\WebDocumentOptions
     */
    public function getWebDocumentOptions()
    {
        return $this->container['webDocumentOptions'];
    }

    /*
     * Sets webDocumentOptions
     *
     * @param \GroupDocs\Viewer\Model\WebDocumentOptions $webDocumentOptions This rendering options enables you to customize the appearance of the output HTML/PDF/PNG/JPEG when rendering Web documents.
     *
     * @return $this
     */
    public function setWebDocumentOptions($webDocumentOptions)
    {
        $this->container['webDocumentOptions'] = $webDocumentOptions;

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


