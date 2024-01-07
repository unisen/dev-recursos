<?php
/*
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose Pty Ltd" file="CadOptions.php">
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
 * CadOptions
 *
 * @description Rendering options for CAD file formats. CAD file formats include files with extensions: .dwg, .dxf, .dgn, .ifc, .stl
 */
class CadOptions implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /*
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = "CadOptions";

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'scaleFactor' => 'double',
        'width' => 'int',
        'height' => 'int',
        'tiles' => '\GroupDocs\Viewer\Model\Tile[]',
        'renderLayouts' => 'bool',
        'layoutName' => 'string',
        'layers' => 'string[]'
    ];

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'scaleFactor' => 'double',
        'width' => 'int32',
        'height' => 'int32',
        'tiles' => null,
        'renderLayouts' => null,
        'layoutName' => null,
        'layers' => null
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
        'scaleFactor' => 'ScaleFactor',
        'width' => 'Width',
        'height' => 'Height',
        'tiles' => 'Tiles',
        'renderLayouts' => 'RenderLayouts',
        'layoutName' => 'LayoutName',
        'layers' => 'Layers'
    ];

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'scaleFactor' => 'setScaleFactor',
        'width' => 'setWidth',
        'height' => 'setHeight',
        'tiles' => 'setTiles',
        'renderLayouts' => 'setRenderLayouts',
        'layoutName' => 'setLayoutName',
        'layers' => 'setLayers'
    ];

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'scaleFactor' => 'getScaleFactor',
        'width' => 'getWidth',
        'height' => 'getHeight',
        'tiles' => 'getTiles',
        'renderLayouts' => 'getRenderLayouts',
        'layoutName' => 'getLayoutName',
        'layers' => 'getLayers'
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
        $this->container['scaleFactor'] = isset($data['scaleFactor']) ? $data['scaleFactor'] : null;
        $this->container['width'] = isset($data['width']) ? $data['width'] : null;
        $this->container['height'] = isset($data['height']) ? $data['height'] : null;
        $this->container['tiles'] = isset($data['tiles']) ? $data['tiles'] : null;
        $this->container['renderLayouts'] = isset($data['renderLayouts']) ? $data['renderLayouts'] : null;
        $this->container['layoutName'] = isset($data['layoutName']) ? $data['layoutName'] : null;
        $this->container['layers'] = isset($data['layers']) ? $data['layers'] : null;
    }

    /*
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['scaleFactor'] === null) {
            $invalidProperties[] = "'scaleFactor' can't be null";
        }
        if ($this->container['width'] === null) {
            $invalidProperties[] = "'width' can't be null";
        }
        if ($this->container['height'] === null) {
            $invalidProperties[] = "'height' can't be null";
        }
        if ($this->container['renderLayouts'] === null) {
            $invalidProperties[] = "'renderLayouts' can't be null";
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

        if ($this->container['scaleFactor'] === null) {
            return false;
        }
        if ($this->container['width'] === null) {
            return false;
        }
        if ($this->container['height'] === null) {
            return false;
        }
        if ($this->container['renderLayouts'] === null) {
            return false;
        }
        return true;
    }


    /*
     * Gets scaleFactor
     *
     * @return double
     */
    public function getScaleFactor()
    {
        return $this->container['scaleFactor'];
    }

    /*
     * Sets scaleFactor
     *
     * @param double $scaleFactor Scale factor allows to change the size of the output document. Values higher than 1 will enlarge output result and values between 0 and 1 will make output result smaller. This option is ignored when either Height or Width options are set.
     *
     * @return $this
     */
    public function setScaleFactor($scaleFactor)
    {
        $this->container['scaleFactor'] = $scaleFactor;

        return $this;
    }

    /*
     * Gets width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->container['width'];
    }

    /*
     * Sets width
     *
     * @param int $width Width of the output result in pixels
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->container['width'] = $width;

        return $this;
    }

    /*
     * Gets height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->container['height'];
    }

    /*
     * Sets height
     *
     * @param int $height Height of the output result in pixels
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->container['height'] = $height;

        return $this;
    }

    /*
     * Gets tiles
     *
     * @return \GroupDocs\Viewer\Model\Tile[]
     */
    public function getTiles()
    {
        return $this->container['tiles'];
    }

    /*
     * Sets tiles
     *
     * @param \GroupDocs\Viewer\Model\Tile[] $tiles The drawing regions to render This option supported only for DWG and DWT file types The RenderLayouts and LayoutName options are ignored when rendering by tiles
     *
     * @return $this
     */
    public function setTiles($tiles)
    {
        $this->container['tiles'] = $tiles;

        return $this;
    }

    /*
     * Gets renderLayouts
     *
     * @return bool
     */
    public function getRenderLayouts()
    {
        return $this->container['renderLayouts'];
    }

    /*
     * Sets renderLayouts
     *
     * @param bool $renderLayouts Indicates whether layouts from CAD document should be rendered
     *
     * @return $this
     */
    public function setRenderLayouts($renderLayouts)
    {
        $this->container['renderLayouts'] = $renderLayouts;

        return $this;
    }

    /*
     * Gets layoutName
     *
     * @return string
     */
    public function getLayoutName()
    {
        return $this->container['layoutName'];
    }

    /*
     * Sets layoutName
     *
     * @param string $layoutName The name of the specific layout to render. Layout name is case-sensitive
     *
     * @return $this
     */
    public function setLayoutName($layoutName)
    {
        $this->container['layoutName'] = $layoutName;

        return $this;
    }

    /*
     * Gets layers
     *
     * @return string[]
     */
    public function getLayers()
    {
        return $this->container['layers'];
    }

    /*
     * Sets layers
     *
     * @param string[] $layers The CAD drawing layers to render By default all layers are rendered; Layer names are case-sensitive
     *
     * @return $this
     */
    public function setLayers($layers)
    {
        $this->container['layers'] = $layers;

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


