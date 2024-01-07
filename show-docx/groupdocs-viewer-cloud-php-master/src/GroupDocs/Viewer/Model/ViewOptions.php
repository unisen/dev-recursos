<?php
/*
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose Pty Ltd" file="ViewOptions.php">
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
 * ViewOptions
 *
 * @description View options
 */
class ViewOptions implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /*
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = "ViewOptions";

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'fileInfo' => '\GroupDocs\Viewer\Model\FileInfo',
        'viewFormat' => 'string',
        'outputPath' => 'string',
        'fontsPath' => 'string',
        'watermark' => '\GroupDocs\Viewer\Model\Watermark',
        'renderOptions' => '\GroupDocs\Viewer\Model\RenderOptions'
    ];

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'fileInfo' => null,
        'viewFormat' => null,
        'outputPath' => null,
        'fontsPath' => null,
        'watermark' => null,
        'renderOptions' => null
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
        'fileInfo' => 'FileInfo',
        'viewFormat' => 'ViewFormat',
        'outputPath' => 'OutputPath',
        'fontsPath' => 'FontsPath',
        'watermark' => 'Watermark',
        'renderOptions' => 'RenderOptions'
    ];

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'fileInfo' => 'setFileInfo',
        'viewFormat' => 'setViewFormat',
        'outputPath' => 'setOutputPath',
        'fontsPath' => 'setFontsPath',
        'watermark' => 'setWatermark',
        'renderOptions' => 'setRenderOptions'
    ];

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'fileInfo' => 'getFileInfo',
        'viewFormat' => 'getViewFormat',
        'outputPath' => 'getOutputPath',
        'fontsPath' => 'getFontsPath',
        'watermark' => 'getWatermark',
        'renderOptions' => 'getRenderOptions'
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

    const VIEW_FORMAT_HTML = 'HTML';
    const VIEW_FORMAT_PNG = 'PNG';
    const VIEW_FORMAT_JPG = 'JPG';
    const VIEW_FORMAT_PDF = 'PDF';
    

    
    /*
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getViewFormatAllowableValues()
    {
        return [
            self::VIEW_FORMAT_HTML,
            self::VIEW_FORMAT_PNG,
            self::VIEW_FORMAT_JPG,
            self::VIEW_FORMAT_PDF,
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
        $this->container['fileInfo'] = isset($data['fileInfo']) ? $data['fileInfo'] : null;
        $this->container['viewFormat'] = isset($data['viewFormat']) ? $data['viewFormat'] : null;
        $this->container['outputPath'] = isset($data['outputPath']) ? $data['outputPath'] : null;
        $this->container['fontsPath'] = isset($data['fontsPath']) ? $data['fontsPath'] : null;
        $this->container['watermark'] = isset($data['watermark']) ? $data['watermark'] : null;
        $this->container['renderOptions'] = isset($data['renderOptions']) ? $data['renderOptions'] : null;
    }

    /*
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['viewFormat'] === null) {
            $invalidProperties[] = "'viewFormat' can't be null";
        }
        $allowedValues = $this->getViewFormatAllowableValues();
        if (!in_array($this->container['viewFormat'], $allowedValues)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'viewFormat', must be one of '%s'",
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

        if ($this->container['viewFormat'] === null) {
            return false;
        }
        $allowedValues = $this->getViewFormatAllowableValues();
        if (!in_array($this->container['viewFormat'], $allowedValues)) {
            return false;
        }
        return true;
    }


    /*
     * Gets fileInfo
     *
     * @return \GroupDocs\Viewer\Model\FileInfo
     */
    public function getFileInfo()
    {
        return $this->container['fileInfo'];
    }

    /*
     * Sets fileInfo
     *
     * @param \GroupDocs\Viewer\Model\FileInfo $fileInfo File info
     *
     * @return $this
     */
    public function setFileInfo($fileInfo)
    {
        $this->container['fileInfo'] = $fileInfo;

        return $this;
    }

    /*
     * Gets viewFormat
     *
     * @return string
     */
    public function getViewFormat()
    {
        return $this->container['viewFormat'];
    }

    /*
     * Sets viewFormat
     *
     * @param string $viewFormat View format (HTML, PNG, JPG, or PDF) Default value is HTML.
     *
     * @return $this
     */
    public function setViewFormat($viewFormat)
    {
        $allowedValues = $this->getViewFormatAllowableValues();
        if ((!is_numeric($viewFormat) && !in_array($viewFormat, $allowedValues)) || (is_numeric($viewFormat) && !in_array($allowedValues[$viewFormat], $allowedValues))) {
            throw new \InvalidArgumentException(sprintf("Invalid value for 'viewFormat', must be one of '%s'", implode("', '", $allowedValues)));
        }
			
        $this->container['viewFormat'] = $viewFormat;

        return $this;
    }

    /*
     * Gets outputPath
     *
     * @return string
     */
    public function getOutputPath()
    {
        return $this->container['outputPath'];
    }

    /*
     * Sets outputPath
     *
     * @param string $outputPath The output path Default value is 'viewer\\{input file path}_{file extension}\\'
     *
     * @return $this
     */
    public function setOutputPath($outputPath)
    {
        $this->container['outputPath'] = $outputPath;

        return $this;
    }

    /*
     * Gets fontsPath
     *
     * @return string
     */
    public function getFontsPath()
    {
        return $this->container['fontsPath'];
    }

    /*
     * Sets fontsPath
     *
     * @param string $fontsPath The path to directory containing custom fonts in storage
     *
     * @return $this
     */
    public function setFontsPath($fontsPath)
    {
        $this->container['fontsPath'] = $fontsPath;

        return $this;
    }

    /*
     * Gets watermark
     *
     * @return \GroupDocs\Viewer\Model\Watermark
     */
    public function getWatermark()
    {
        return $this->container['watermark'];
    }

    /*
     * Sets watermark
     *
     * @param \GroupDocs\Viewer\Model\Watermark $watermark Text watermark
     *
     * @return $this
     */
    public function setWatermark($watermark)
    {
        $this->container['watermark'] = $watermark;

        return $this;
    }

    /*
     * Gets renderOptions
     *
     * @return \GroupDocs\Viewer\Model\RenderOptions
     */
    public function getRenderOptions()
    {
        return $this->container['renderOptions'];
    }

    /*
     * Sets renderOptions
     *
     * @param \GroupDocs\Viewer\Model\RenderOptions $renderOptions Rendering options
     *
     * @return $this
     */
    public function setRenderOptions($renderOptions)
    {
        $this->container['renderOptions'] = $renderOptions;

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


