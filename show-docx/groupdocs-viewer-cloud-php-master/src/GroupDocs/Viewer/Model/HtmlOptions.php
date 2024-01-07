<?php
/*
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose Pty Ltd" file="HtmlOptions.php">
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
use \GroupDocs\Viewer\ObjectSerializer;

/*
 * HtmlOptions
 *
 * @description Options for rendering document into HTML
 */
class HtmlOptions extends RenderOptions 
{
    const DISCRIMINATOR = null;

    /*
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = "HtmlOptions";

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'externalResources' => 'bool',
        'resourcePath' => 'string',
        'isResponsive' => 'bool',
        'minify' => 'bool',
        'excludeFonts' => 'bool',
        'fontsToExclude' => 'string[]',
        'forPrinting' => 'bool',
        'imageHeight' => 'int',
        'imageWidth' => 'int',
        'imageMaxHeight' => 'int',
        'imageMaxWidth' => 'int',
        'renderToSinglePage' => 'bool'
    ];

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'externalResources' => null,
        'resourcePath' => null,
        'isResponsive' => null,
        'minify' => null,
        'excludeFonts' => null,
        'fontsToExclude' => null,
        'forPrinting' => null,
        'imageHeight' => 'int32',
        'imageWidth' => 'int32',
        'imageMaxHeight' => 'int32',
        'imageMaxWidth' => 'int32',
        'renderToSinglePage' => null
    ];

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes + parent::swaggerTypes();
    }

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats + parent::swaggerFormats();
    }

    /*
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'externalResources' => 'ExternalResources',
        'resourcePath' => 'ResourcePath',
        'isResponsive' => 'IsResponsive',
        'minify' => 'Minify',
        'excludeFonts' => 'ExcludeFonts',
        'fontsToExclude' => 'FontsToExclude',
        'forPrinting' => 'ForPrinting',
        'imageHeight' => 'ImageHeight',
        'imageWidth' => 'ImageWidth',
        'imageMaxHeight' => 'ImageMaxHeight',
        'imageMaxWidth' => 'ImageMaxWidth',
        'renderToSinglePage' => 'RenderToSinglePage'
    ];

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'externalResources' => 'setExternalResources',
        'resourcePath' => 'setResourcePath',
        'isResponsive' => 'setIsResponsive',
        'minify' => 'setMinify',
        'excludeFonts' => 'setExcludeFonts',
        'fontsToExclude' => 'setFontsToExclude',
        'forPrinting' => 'setForPrinting',
        'imageHeight' => 'setImageHeight',
        'imageWidth' => 'setImageWidth',
        'imageMaxHeight' => 'setImageMaxHeight',
        'imageMaxWidth' => 'setImageMaxWidth',
        'renderToSinglePage' => 'setRenderToSinglePage'
    ];

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'externalResources' => 'getExternalResources',
        'resourcePath' => 'getResourcePath',
        'isResponsive' => 'getIsResponsive',
        'minify' => 'getMinify',
        'excludeFonts' => 'getExcludeFonts',
        'fontsToExclude' => 'getFontsToExclude',
        'forPrinting' => 'getForPrinting',
        'imageHeight' => 'getImageHeight',
        'imageWidth' => 'getImageWidth',
        'imageMaxHeight' => 'getImageMaxHeight',
        'imageMaxWidth' => 'getImageMaxWidth',
        'renderToSinglePage' => 'getRenderToSinglePage'
    ];

    /*
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return parent::attributeMap() + self::$attributeMap;
    }

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return parent::setters() + self::$setters;
    }

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return parent::getters() + self::$getters;
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
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);

        $this->container['externalResources'] = isset($data['externalResources']) ? $data['externalResources'] : null;
        $this->container['resourcePath'] = isset($data['resourcePath']) ? $data['resourcePath'] : null;
        $this->container['isResponsive'] = isset($data['isResponsive']) ? $data['isResponsive'] : null;
        $this->container['minify'] = isset($data['minify']) ? $data['minify'] : null;
        $this->container['excludeFonts'] = isset($data['excludeFonts']) ? $data['excludeFonts'] : null;
        $this->container['fontsToExclude'] = isset($data['fontsToExclude']) ? $data['fontsToExclude'] : null;
        $this->container['forPrinting'] = isset($data['forPrinting']) ? $data['forPrinting'] : null;
        $this->container['imageHeight'] = isset($data['imageHeight']) ? $data['imageHeight'] : null;
        $this->container['imageWidth'] = isset($data['imageWidth']) ? $data['imageWidth'] : null;
        $this->container['imageMaxHeight'] = isset($data['imageMaxHeight']) ? $data['imageMaxHeight'] : null;
        $this->container['imageMaxWidth'] = isset($data['imageMaxWidth']) ? $data['imageMaxWidth'] : null;
        $this->container['renderToSinglePage'] = isset($data['renderToSinglePage']) ? $data['renderToSinglePage'] : null;
    }

    /*
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = parent::listInvalidProperties();

        if ($this->container['externalResources'] === null) {
            $invalidProperties[] = "'externalResources' can't be null";
        }
        if ($this->container['isResponsive'] === null) {
            $invalidProperties[] = "'isResponsive' can't be null";
        }
        if ($this->container['minify'] === null) {
            $invalidProperties[] = "'minify' can't be null";
        }
        if ($this->container['excludeFonts'] === null) {
            $invalidProperties[] = "'excludeFonts' can't be null";
        }
        if ($this->container['forPrinting'] === null) {
            $invalidProperties[] = "'forPrinting' can't be null";
        }
        if ($this->container['imageHeight'] === null) {
            $invalidProperties[] = "'imageHeight' can't be null";
        }
        if ($this->container['imageWidth'] === null) {
            $invalidProperties[] = "'imageWidth' can't be null";
        }
        if ($this->container['imageMaxHeight'] === null) {
            $invalidProperties[] = "'imageMaxHeight' can't be null";
        }
        if ($this->container['imageMaxWidth'] === null) {
            $invalidProperties[] = "'imageMaxWidth' can't be null";
        }
        if ($this->container['renderToSinglePage'] === null) {
            $invalidProperties[] = "'renderToSinglePage' can't be null";
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
        if (!parent::valid()) {
            return false;
        }

        if ($this->container['externalResources'] === null) {
            return false;
        }
        if ($this->container['isResponsive'] === null) {
            return false;
        }
        if ($this->container['minify'] === null) {
            return false;
        }
        if ($this->container['excludeFonts'] === null) {
            return false;
        }
        if ($this->container['forPrinting'] === null) {
            return false;
        }
        if ($this->container['imageHeight'] === null) {
            return false;
        }
        if ($this->container['imageWidth'] === null) {
            return false;
        }
        if ($this->container['imageMaxHeight'] === null) {
            return false;
        }
        if ($this->container['imageMaxWidth'] === null) {
            return false;
        }
        if ($this->container['renderToSinglePage'] === null) {
            return false;
        }
        return true;
    }


    /*
     * Gets externalResources
     *
     * @return bool
     */
    public function getExternalResources()
    {
        return $this->container['externalResources'];
    }

    /*
     * Sets externalResources
     *
     * @param bool $externalResources Controls output HTML document resources (styles, images and fonts) linking. By default this option is disabled and all the resources are embedded into HTML document.
     *
     * @return $this
     */
    public function setExternalResources($externalResources)
    {
        $this->container['externalResources'] = $externalResources;

        return $this;
    }

    /*
     * Gets resourcePath
     *
     * @return string
     */
    public function getResourcePath()
    {
        return $this->container['resourcePath'];
    }

    /*
     * Sets resourcePath
     *
     * @param string $resourcePath Path for the HTML resources (styles, images and fonts). For example when resource path is http://example.com/api/pages/{page-number}/resources/{resource-name} the {page-number} and {resource-name} templates will be replaced with page number and resource name accordingly. This option is ignored when ExternalResources option is disabled.
     *
     * @return $this
     */
    public function setResourcePath($resourcePath)
    {
        $this->container['resourcePath'] = $resourcePath;

        return $this;
    }

    /*
     * Gets isResponsive
     *
     * @return bool
     */
    public function getIsResponsive()
    {
        return $this->container['isResponsive'];
    }

    /*
     * Sets isResponsive
     *
     * @param bool $isResponsive Indicates whether rendering will provide responsive web pages, that look well on different device types. Default value is false.
     *
     * @return $this
     */
    public function setIsResponsive($isResponsive)
    {
        $this->container['isResponsive'] = $isResponsive;

        return $this;
    }

    /*
     * Gets minify
     *
     * @return bool
     */
    public function getMinify()
    {
        return $this->container['minify'];
    }

    /*
     * Sets minify
     *
     * @param bool $minify Enables HTML content and HTML resources minification
     *
     * @return $this
     */
    public function setMinify($minify)
    {
        $this->container['minify'] = $minify;

        return $this;
    }

    /*
     * Gets excludeFonts
     *
     * @return bool
     */
    public function getExcludeFonts()
    {
        return $this->container['excludeFonts'];
    }

    /*
     * Sets excludeFonts
     *
     * @param bool $excludeFonts When enabled prevents adding any fonts into HTML document
     *
     * @return $this
     */
    public function setExcludeFonts($excludeFonts)
    {
        $this->container['excludeFonts'] = $excludeFonts;

        return $this;
    }

    /*
     * Gets fontsToExclude
     *
     * @return string[]
     */
    public function getFontsToExclude()
    {
        return $this->container['fontsToExclude'];
    }

    /*
     * Sets fontsToExclude
     *
     * @param string[] $fontsToExclude This option is supported for presentations only. The list of font names, to exclude from HTML document
     *
     * @return $this
     */
    public function setFontsToExclude($fontsToExclude)
    {
        $this->container['fontsToExclude'] = $fontsToExclude;

        return $this;
    }

    /*
     * Gets forPrinting
     *
     * @return bool
     */
    public function getForPrinting()
    {
        return $this->container['forPrinting'];
    }

    /*
     * Sets forPrinting
     *
     * @param bool $forPrinting Indicates whether to optimize output HTML for printing.
     *
     * @return $this
     */
    public function setForPrinting($forPrinting)
    {
        $this->container['forPrinting'] = $forPrinting;

        return $this;
    }

    /*
     * Gets imageHeight
     *
     * @return int
     */
    public function getImageHeight()
    {
        return $this->container['imageHeight'];
    }

    /*
     * Sets imageHeight
     *
     * @param int $imageHeight The height of an output image in pixels. (When converting single image to HTML only)
     *
     * @return $this
     */
    public function setImageHeight($imageHeight)
    {
        $this->container['imageHeight'] = $imageHeight;

        return $this;
    }

    /*
     * Gets imageWidth
     *
     * @return int
     */
    public function getImageWidth()
    {
        return $this->container['imageWidth'];
    }

    /*
     * Sets imageWidth
     *
     * @param int $imageWidth The width of the output image in pixels. (When converting single image to HTML only)
     *
     * @return $this
     */
    public function setImageWidth($imageWidth)
    {
        $this->container['imageWidth'] = $imageWidth;

        return $this;
    }

    /*
     * Gets imageMaxHeight
     *
     * @return int
     */
    public function getImageMaxHeight()
    {
        return $this->container['imageMaxHeight'];
    }

    /*
     * Sets imageMaxHeight
     *
     * @param int $imageMaxHeight Max height of an output image in pixels. (When converting single image to HTML only)
     *
     * @return $this
     */
    public function setImageMaxHeight($imageMaxHeight)
    {
        $this->container['imageMaxHeight'] = $imageMaxHeight;

        return $this;
    }

    /*
     * Gets imageMaxWidth
     *
     * @return int
     */
    public function getImageMaxWidth()
    {
        return $this->container['imageMaxWidth'];
    }

    /*
     * Sets imageMaxWidth
     *
     * @param int $imageMaxWidth Max width of an output image in pixels. (When converting single image to HTML only)
     *
     * @return $this
     */
    public function setImageMaxWidth($imageMaxWidth)
    {
        $this->container['imageMaxWidth'] = $imageMaxWidth;

        return $this;
    }

    /*
     * Gets renderToSinglePage
     *
     * @return bool
     */
    public function getRenderToSinglePage()
    {
        return $this->container['renderToSinglePage'];
    }

    /*
     * Sets renderToSinglePage
     *
     * @param bool $renderToSinglePage Enables HTML content will be rendered to single page
     *
     * @return $this
     */
    public function setRenderToSinglePage($renderToSinglePage)
    {
        $this->container['renderToSinglePage'] = $renderToSinglePage;

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


