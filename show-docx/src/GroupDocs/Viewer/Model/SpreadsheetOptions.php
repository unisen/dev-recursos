<?php
/*
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose Pty Ltd" file="SpreadsheetOptions.php">
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
 * SpreadsheetOptions
 *
 * @description Rendering options for Spreadsheet file formats. Spreadsheet file formats include files with extensions: .xls, .xlsx, .xlsm, .xlsb, .csv, .ods, .ots, .xltx, .xltm, .tsv
 */
class SpreadsheetOptions implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /*
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = "SpreadsheetOptions";

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'paginateSheets' => 'bool',
        'countRowsPerPage' => 'int',
        'countColumnsPerPage' => 'int',
        'renderGridLines' => 'bool',
        'renderEmptyRows' => 'bool',
        'renderEmptyColumns' => 'bool',
        'renderHiddenRows' => 'bool',
        'renderHiddenColumns' => 'bool',
        'renderHeadings' => 'bool',
        'renderPrintAreaOnly' => 'bool',
        'textOverflowMode' => 'string'
    ];

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'paginateSheets' => null,
        'countRowsPerPage' => 'int32',
        'countColumnsPerPage' => 'int32',
        'renderGridLines' => null,
        'renderEmptyRows' => null,
        'renderEmptyColumns' => null,
        'renderHiddenRows' => null,
        'renderHiddenColumns' => null,
        'renderHeadings' => null,
        'renderPrintAreaOnly' => null,
        'textOverflowMode' => null
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
        'paginateSheets' => 'PaginateSheets',
        'countRowsPerPage' => 'CountRowsPerPage',
        'countColumnsPerPage' => 'CountColumnsPerPage',
        'renderGridLines' => 'RenderGridLines',
        'renderEmptyRows' => 'RenderEmptyRows',
        'renderEmptyColumns' => 'RenderEmptyColumns',
        'renderHiddenRows' => 'RenderHiddenRows',
        'renderHiddenColumns' => 'RenderHiddenColumns',
        'renderHeadings' => 'RenderHeadings',
        'renderPrintAreaOnly' => 'RenderPrintAreaOnly',
        'textOverflowMode' => 'TextOverflowMode'
    ];

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'paginateSheets' => 'setPaginateSheets',
        'countRowsPerPage' => 'setCountRowsPerPage',
        'countColumnsPerPage' => 'setCountColumnsPerPage',
        'renderGridLines' => 'setRenderGridLines',
        'renderEmptyRows' => 'setRenderEmptyRows',
        'renderEmptyColumns' => 'setRenderEmptyColumns',
        'renderHiddenRows' => 'setRenderHiddenRows',
        'renderHiddenColumns' => 'setRenderHiddenColumns',
        'renderHeadings' => 'setRenderHeadings',
        'renderPrintAreaOnly' => 'setRenderPrintAreaOnly',
        'textOverflowMode' => 'setTextOverflowMode'
    ];

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'paginateSheets' => 'getPaginateSheets',
        'countRowsPerPage' => 'getCountRowsPerPage',
        'countColumnsPerPage' => 'getCountColumnsPerPage',
        'renderGridLines' => 'getRenderGridLines',
        'renderEmptyRows' => 'getRenderEmptyRows',
        'renderEmptyColumns' => 'getRenderEmptyColumns',
        'renderHiddenRows' => 'getRenderHiddenRows',
        'renderHiddenColumns' => 'getRenderHiddenColumns',
        'renderHeadings' => 'getRenderHeadings',
        'renderPrintAreaOnly' => 'getRenderPrintAreaOnly',
        'textOverflowMode' => 'getTextOverflowMode'
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

    const TEXT_OVERFLOW_MODE_OVERLAY = 'Overlay';
    const TEXT_OVERFLOW_MODE_OVERLAY_IF_NEXT_IS_EMPTY = 'OverlayIfNextIsEmpty';
    const TEXT_OVERFLOW_MODE_AUTO_FIT_COLUMN = 'AutoFitColumn';
    const TEXT_OVERFLOW_MODE_HIDE_TEXT = 'HideText';
    

    
    /*
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTextOverflowModeAllowableValues()
    {
        return [
            self::TEXT_OVERFLOW_MODE_OVERLAY,
            self::TEXT_OVERFLOW_MODE_OVERLAY_IF_NEXT_IS_EMPTY,
            self::TEXT_OVERFLOW_MODE_AUTO_FIT_COLUMN,
            self::TEXT_OVERFLOW_MODE_HIDE_TEXT,
        ];
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
        $this->container['paginateSheets'] = isset($data['paginateSheets']) ? $data['paginateSheets'] : null;
        $this->container['countRowsPerPage'] = isset($data['countRowsPerPage']) ? $data['countRowsPerPage'] : null;
        $this->container['countColumnsPerPage'] = isset($data['countColumnsPerPage']) ? $data['countColumnsPerPage'] : null;
        $this->container['renderGridLines'] = isset($data['renderGridLines']) ? $data['renderGridLines'] : null;
        $this->container['renderEmptyRows'] = isset($data['renderEmptyRows']) ? $data['renderEmptyRows'] : null;
        $this->container['renderEmptyColumns'] = isset($data['renderEmptyColumns']) ? $data['renderEmptyColumns'] : null;
        $this->container['renderHiddenRows'] = isset($data['renderHiddenRows']) ? $data['renderHiddenRows'] : null;
        $this->container['renderHiddenColumns'] = isset($data['renderHiddenColumns']) ? $data['renderHiddenColumns'] : null;
        $this->container['renderHeadings'] = isset($data['renderHeadings']) ? $data['renderHeadings'] : null;
        $this->container['renderPrintAreaOnly'] = isset($data['renderPrintAreaOnly']) ? $data['renderPrintAreaOnly'] : null;
        $this->container['textOverflowMode'] = isset($data['textOverflowMode']) ? $data['textOverflowMode'] : null;
    }

    /*
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['paginateSheets'] === null) {
            $invalidProperties[] = "'paginateSheets' can't be null";
        }
        if ($this->container['countRowsPerPage'] === null) {
            $invalidProperties[] = "'countRowsPerPage' can't be null";
        }
        if ($this->container['countColumnsPerPage'] === null) {
            $invalidProperties[] = "'countColumnsPerPage' can't be null";
        }
        if ($this->container['renderGridLines'] === null) {
            $invalidProperties[] = "'renderGridLines' can't be null";
        }
        if ($this->container['renderEmptyRows'] === null) {
            $invalidProperties[] = "'renderEmptyRows' can't be null";
        }
        if ($this->container['renderEmptyColumns'] === null) {
            $invalidProperties[] = "'renderEmptyColumns' can't be null";
        }
        if ($this->container['renderHiddenRows'] === null) {
            $invalidProperties[] = "'renderHiddenRows' can't be null";
        }
        if ($this->container['renderHiddenColumns'] === null) {
            $invalidProperties[] = "'renderHiddenColumns' can't be null";
        }
        if ($this->container['renderHeadings'] === null) {
            $invalidProperties[] = "'renderHeadings' can't be null";
        }
        if ($this->container['renderPrintAreaOnly'] === null) {
            $invalidProperties[] = "'renderPrintAreaOnly' can't be null";
        }
        if ($this->container['textOverflowMode'] === null) {
            $invalidProperties[] = "'textOverflowMode' can't be null";
        }
        $allowedValues = $this->getTextOverflowModeAllowableValues();
        if (!in_array($this->container['textOverflowMode'], $allowedValues)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'textOverflowMode', must be one of '%s'",
                implode("', '", $allowedValues)
            );
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

        if ($this->container['paginateSheets'] === null) {
            return false;
        }
        if ($this->container['countRowsPerPage'] === null) {
            return false;
        }
        if ($this->container['countColumnsPerPage'] === null) {
            return false;
        }
        if ($this->container['renderGridLines'] === null) {
            return false;
        }
        if ($this->container['renderEmptyRows'] === null) {
            return false;
        }
        if ($this->container['renderEmptyColumns'] === null) {
            return false;
        }
        if ($this->container['renderHiddenRows'] === null) {
            return false;
        }
        if ($this->container['renderHiddenColumns'] === null) {
            return false;
        }
        if ($this->container['renderHeadings'] === null) {
            return false;
        }
        if ($this->container['renderPrintAreaOnly'] === null) {
            return false;
        }
        if ($this->container['textOverflowMode'] === null) {
            return false;
        }
        $allowedValues = $this->getTextOverflowModeAllowableValues();
        if (!in_array($this->container['textOverflowMode'], $allowedValues)) {
            return false;
        }
        return true;
    }


    /*
     * Gets paginateSheets
     *
     * @return bool
     */
    public function getPaginateSheets()
    {
        return $this->container['paginateSheets'];
    }

    /*
     * Sets paginateSheets
     *
     * @param bool $paginateSheets Allows to enable worksheets pagination. By default one worksheet is rendered into one page.
     *
     * @return $this
     */
    public function setPaginateSheets($paginateSheets)
    {
        $this->container['paginateSheets'] = $paginateSheets;

        return $this;
    }

    /*
     * Gets countRowsPerPage
     *
     * @return int
     */
    public function getCountRowsPerPage()
    {
        return $this->container['countRowsPerPage'];
    }

    /*
     * Sets countRowsPerPage
     *
     * @param int $countRowsPerPage The number of rows rendered into one page when PaginateSheets is enabled. Default value is 50.
     *
     * @return $this
     */
    public function setCountRowsPerPage($countRowsPerPage)
    {
        $this->container['countRowsPerPage'] = $countRowsPerPage;

        return $this;
    }

    /*
     * Gets countColumnsPerPage
     *
     * @return int
     */
    public function getCountColumnsPerPage()
    {
        return $this->container['countColumnsPerPage'];
    }

    /*
     * Sets countColumnsPerPage
     *
     * @param int $countColumnsPerPage The columns count to include into each page when splitting worksheet into pages.
     *
     * @return $this
     */
    public function setCountColumnsPerPage($countColumnsPerPage)
    {
        $this->container['countColumnsPerPage'] = $countColumnsPerPage;

        return $this;
    }

    /*
     * Gets renderGridLines
     *
     * @return bool
     */
    public function getRenderGridLines()
    {
        return $this->container['renderGridLines'];
    }

    /*
     * Sets renderGridLines
     *
     * @param bool $renderGridLines Indicates whether to render grid lines
     *
     * @return $this
     */
    public function setRenderGridLines($renderGridLines)
    {
        $this->container['renderGridLines'] = $renderGridLines;

        return $this;
    }

    /*
     * Gets renderEmptyRows
     *
     * @return bool
     */
    public function getRenderEmptyRows()
    {
        return $this->container['renderEmptyRows'];
    }

    /*
     * Sets renderEmptyRows
     *
     * @param bool $renderEmptyRows By default empty rows are skipped. Enable this option in case you want to render empty rows.
     *
     * @return $this
     */
    public function setRenderEmptyRows($renderEmptyRows)
    {
        $this->container['renderEmptyRows'] = $renderEmptyRows;

        return $this;
    }

    /*
     * Gets renderEmptyColumns
     *
     * @return bool
     */
    public function getRenderEmptyColumns()
    {
        return $this->container['renderEmptyColumns'];
    }

    /*
     * Sets renderEmptyColumns
     *
     * @param bool $renderEmptyColumns By default empty columns are skipped. Enable this option in case you want to render empty columns.
     *
     * @return $this
     */
    public function setRenderEmptyColumns($renderEmptyColumns)
    {
        $this->container['renderEmptyColumns'] = $renderEmptyColumns;

        return $this;
    }

    /*
     * Gets renderHiddenRows
     *
     * @return bool
     */
    public function getRenderHiddenRows()
    {
        return $this->container['renderHiddenRows'];
    }

    /*
     * Sets renderHiddenRows
     *
     * @param bool $renderHiddenRows Enables rendering of hidden rows.
     *
     * @return $this
     */
    public function setRenderHiddenRows($renderHiddenRows)
    {
        $this->container['renderHiddenRows'] = $renderHiddenRows;

        return $this;
    }

    /*
     * Gets renderHiddenColumns
     *
     * @return bool
     */
    public function getRenderHiddenColumns()
    {
        return $this->container['renderHiddenColumns'];
    }

    /*
     * Sets renderHiddenColumns
     *
     * @param bool $renderHiddenColumns Enables rendering of hidden columns.
     *
     * @return $this
     */
    public function setRenderHiddenColumns($renderHiddenColumns)
    {
        $this->container['renderHiddenColumns'] = $renderHiddenColumns;

        return $this;
    }

    /*
     * Gets renderHeadings
     *
     * @return bool
     */
    public function getRenderHeadings()
    {
        return $this->container['renderHeadings'];
    }

    /*
     * Sets renderHeadings
     *
     * @param bool $renderHeadings Enables headings rendering.
     *
     * @return $this
     */
    public function setRenderHeadings($renderHeadings)
    {
        $this->container['renderHeadings'] = $renderHeadings;

        return $this;
    }

    /*
     * Gets renderPrintAreaOnly
     *
     * @return bool
     */
    public function getRenderPrintAreaOnly()
    {
        return $this->container['renderPrintAreaOnly'];
    }

    /*
     * Sets renderPrintAreaOnly
     *
     * @param bool $renderPrintAreaOnly Enables rendering worksheet(s) sections which is defined as print area. Renders each print area in a worksheet as a separate page.
     *
     * @return $this
     */
    public function setRenderPrintAreaOnly($renderPrintAreaOnly)
    {
        $this->container['renderPrintAreaOnly'] = $renderPrintAreaOnly;

        return $this;
    }

    /*
     * Gets textOverflowMode
     *
     * @return string
     */
    public function getTextOverflowMode()
    {
        return $this->container['textOverflowMode'];
    }

    /*
     * Sets textOverflowMode
     *
     * @param string $textOverflowMode The text overflow mode for rendering spreadsheet documents into HTML
     *
     * @return $this
     */
    public function setTextOverflowMode($textOverflowMode)
    {
        $allowedValues = $this->getTextOverflowModeAllowableValues();
        if ((!is_numeric($textOverflowMode) && !in_array($textOverflowMode, $allowedValues)) || (is_numeric($textOverflowMode) && !in_array($allowedValues[$textOverflowMode], $allowedValues))) {
            throw new \InvalidArgumentException(sprintf("Invalid value for 'textOverflowMode', must be one of '%s'", implode("', '", $allowedValues)));
        }
			
        $this->container['textOverflowMode'] = $textOverflowMode;

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


