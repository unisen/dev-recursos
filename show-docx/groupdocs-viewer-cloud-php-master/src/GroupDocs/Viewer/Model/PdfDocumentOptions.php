<?php
/*
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose Pty Ltd" file="PdfDocumentOptions.php">
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
 * PdfDocumentOptions
 *
 * @description Provides options for rendering PDF documents
 */
class PdfDocumentOptions implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /*
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = "PdfDocumentOptions";

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'disableCharsGrouping' => 'bool',
        'enableLayeredRendering' => 'bool',
        'enableFontHinting' => 'bool',
        'renderOriginalPageSize' => 'bool',
        'imageQuality' => 'string',
        'renderTextAsImage' => 'bool'
    ];

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'disableCharsGrouping' => null,
        'enableLayeredRendering' => null,
        'enableFontHinting' => null,
        'renderOriginalPageSize' => null,
        'imageQuality' => null,
        'renderTextAsImage' => null
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
        'disableCharsGrouping' => 'DisableCharsGrouping',
        'enableLayeredRendering' => 'EnableLayeredRendering',
        'enableFontHinting' => 'EnableFontHinting',
        'renderOriginalPageSize' => 'RenderOriginalPageSize',
        'imageQuality' => 'ImageQuality',
        'renderTextAsImage' => 'RenderTextAsImage'
    ];

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'disableCharsGrouping' => 'setDisableCharsGrouping',
        'enableLayeredRendering' => 'setEnableLayeredRendering',
        'enableFontHinting' => 'setEnableFontHinting',
        'renderOriginalPageSize' => 'setRenderOriginalPageSize',
        'imageQuality' => 'setImageQuality',
        'renderTextAsImage' => 'setRenderTextAsImage'
    ];

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'disableCharsGrouping' => 'getDisableCharsGrouping',
        'enableLayeredRendering' => 'getEnableLayeredRendering',
        'enableFontHinting' => 'getEnableFontHinting',
        'renderOriginalPageSize' => 'getRenderOriginalPageSize',
        'imageQuality' => 'getImageQuality',
        'renderTextAsImage' => 'getRenderTextAsImage'
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

    const IMAGE_QUALITY_LOW = 'Low';
    const IMAGE_QUALITY_MEDIUM = 'Medium';
    const IMAGE_QUALITY_HIGH = 'High';
    

    
    /*
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getImageQualityAllowableValues()
    {
        return [
            self::IMAGE_QUALITY_LOW,
            self::IMAGE_QUALITY_MEDIUM,
            self::IMAGE_QUALITY_HIGH,
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
        $this->container['disableCharsGrouping'] = isset($data['disableCharsGrouping']) ? $data['disableCharsGrouping'] : null;
        $this->container['enableLayeredRendering'] = isset($data['enableLayeredRendering']) ? $data['enableLayeredRendering'] : null;
        $this->container['enableFontHinting'] = isset($data['enableFontHinting']) ? $data['enableFontHinting'] : null;
        $this->container['renderOriginalPageSize'] = isset($data['renderOriginalPageSize']) ? $data['renderOriginalPageSize'] : null;
        $this->container['imageQuality'] = isset($data['imageQuality']) ? $data['imageQuality'] : null;
        $this->container['renderTextAsImage'] = isset($data['renderTextAsImage']) ? $data['renderTextAsImage'] : null;
    }

    /*
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['disableCharsGrouping'] === null) {
            $invalidProperties[] = "'disableCharsGrouping' can't be null";
        }
        if ($this->container['enableLayeredRendering'] === null) {
            $invalidProperties[] = "'enableLayeredRendering' can't be null";
        }
        if ($this->container['enableFontHinting'] === null) {
            $invalidProperties[] = "'enableFontHinting' can't be null";
        }
        if ($this->container['renderOriginalPageSize'] === null) {
            $invalidProperties[] = "'renderOriginalPageSize' can't be null";
        }
        if ($this->container['imageQuality'] === null) {
            $invalidProperties[] = "'imageQuality' can't be null";
        }
        $allowedValues = $this->getImageQualityAllowableValues();
        if (!in_array($this->container['imageQuality'], $allowedValues)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'imageQuality', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['renderTextAsImage'] === null) {
            $invalidProperties[] = "'renderTextAsImage' can't be null";
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

        if ($this->container['disableCharsGrouping'] === null) {
            return false;
        }
        if ($this->container['enableLayeredRendering'] === null) {
            return false;
        }
        if ($this->container['enableFontHinting'] === null) {
            return false;
        }
        if ($this->container['renderOriginalPageSize'] === null) {
            return false;
        }
        if ($this->container['imageQuality'] === null) {
            return false;
        }
        $allowedValues = $this->getImageQualityAllowableValues();
        if (!in_array($this->container['imageQuality'], $allowedValues)) {
            return false;
        }
        if ($this->container['renderTextAsImage'] === null) {
            return false;
        }
        return true;
    }


    /*
     * Gets disableCharsGrouping
     *
     * @return bool
     */
    public function getDisableCharsGrouping()
    {
        return $this->container['disableCharsGrouping'];
    }

    /*
     * Sets disableCharsGrouping
     *
     * @param bool $disableCharsGrouping Disables chars grouping to keep maximum precision during chars positioning when rendering the page
     *
     * @return $this
     */
    public function setDisableCharsGrouping($disableCharsGrouping)
    {
        $this->container['disableCharsGrouping'] = $disableCharsGrouping;

        return $this;
    }

    /*
     * Gets enableLayeredRendering
     *
     * @return bool
     */
    public function getEnableLayeredRendering()
    {
        return $this->container['enableLayeredRendering'];
    }

    /*
     * Sets enableLayeredRendering
     *
     * @param bool $enableLayeredRendering Enables rendering of text and graphics according to z-order in original PDF document  when rendering into HTML
     *
     * @return $this
     */
    public function setEnableLayeredRendering($enableLayeredRendering)
    {
        $this->container['enableLayeredRendering'] = $enableLayeredRendering;

        return $this;
    }

    /*
     * Gets enableFontHinting
     *
     * @return bool
     */
    public function getEnableFontHinting()
    {
        return $this->container['enableFontHinting'];
    }

    /*
     * Sets enableFontHinting
     *
     * @param bool $enableFontHinting Enables font hinting. The font hinting adjusts the display of an outline font. Supported only for TTF fonts when these fonts are used in source document.
     *
     * @return $this
     */
    public function setEnableFontHinting($enableFontHinting)
    {
        $this->container['enableFontHinting'] = $enableFontHinting;

        return $this;
    }

    /*
     * Gets renderOriginalPageSize
     *
     * @return bool
     */
    public function getRenderOriginalPageSize()
    {
        return $this->container['renderOriginalPageSize'];
    }

    /*
     * Sets renderOriginalPageSize
     *
     * @param bool $renderOriginalPageSize When this option enabled the output pages will have the same size in pixels as page size in a source PDF document. By default GroupDocs.Viewer calculates output image page size for better rendering quality. This option is supported when rendering into PNG or JPG formats.
     *
     * @return $this
     */
    public function setRenderOriginalPageSize($renderOriginalPageSize)
    {
        $this->container['renderOriginalPageSize'] = $renderOriginalPageSize;

        return $this;
    }

    /*
     * Gets imageQuality
     *
     * @return string
     */
    public function getImageQuality()
    {
        return $this->container['imageQuality'];
    }

    /*
     * Sets imageQuality
     *
     * @param string $imageQuality Specifies output image quality for image resources when rendering into HTML. The default value is Low
     *
     * @return $this
     */
    public function setImageQuality($imageQuality)
    {
        $allowedValues = $this->getImageQualityAllowableValues();
        if ((!is_numeric($imageQuality) && !in_array($imageQuality, $allowedValues)) || (is_numeric($imageQuality) && !in_array($allowedValues[$imageQuality], $allowedValues))) {
            throw new \InvalidArgumentException(sprintf("Invalid value for 'imageQuality', must be one of '%s'", implode("', '", $allowedValues)));
        }
			
        $this->container['imageQuality'] = $imageQuality;

        return $this;
    }

    /*
     * Gets renderTextAsImage
     *
     * @return bool
     */
    public function getRenderTextAsImage()
    {
        return $this->container['renderTextAsImage'];
    }

    /*
     * Sets renderTextAsImage
     *
     * @param bool $renderTextAsImage When this option is set to true, the text is rendered as an image in the output HTML. Enable this option to make text unselectable or to fix characters rendering and make HTML look like PDF. The default value is false. This option is supported when rendering into HTML.
     *
     * @return $this
     */
    public function setRenderTextAsImage($renderTextAsImage)
    {
        $this->container['renderTextAsImage'] = $renderTextAsImage;

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


