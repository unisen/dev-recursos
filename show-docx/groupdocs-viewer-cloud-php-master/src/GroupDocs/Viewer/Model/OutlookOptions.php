<?php
/*
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose Pty Ltd" file="OutlookOptions.php">
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
 * OutlookOptions
 *
 * @description Provides options for rendering Outlook data files
 */
class OutlookOptions implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /*
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = "OutlookOptions";

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'folder' => 'string',
        'textFilter' => 'string',
        'addressFilter' => 'string',
        'maxItemsInFolder' => 'int'
    ];

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'folder' => null,
        'textFilter' => null,
        'addressFilter' => null,
        'maxItemsInFolder' => 'int32'
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
        'folder' => 'Folder',
        'textFilter' => 'TextFilter',
        'addressFilter' => 'AddressFilter',
        'maxItemsInFolder' => 'MaxItemsInFolder'
    ];

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'folder' => 'setFolder',
        'textFilter' => 'setTextFilter',
        'addressFilter' => 'setAddressFilter',
        'maxItemsInFolder' => 'setMaxItemsInFolder'
    ];

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'folder' => 'getFolder',
        'textFilter' => 'getTextFilter',
        'addressFilter' => 'getAddressFilter',
        'maxItemsInFolder' => 'getMaxItemsInFolder'
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
        $this->container['folder'] = isset($data['folder']) ? $data['folder'] : null;
        $this->container['textFilter'] = isset($data['textFilter']) ? $data['textFilter'] : null;
        $this->container['addressFilter'] = isset($data['addressFilter']) ? $data['addressFilter'] : null;
        $this->container['maxItemsInFolder'] = isset($data['maxItemsInFolder']) ? $data['maxItemsInFolder'] : null;
    }

    /*
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['maxItemsInFolder'] === null) {
            $invalidProperties[] = "'maxItemsInFolder' can't be null";
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

        if ($this->container['maxItemsInFolder'] === null) {
            return false;
        }
        return true;
    }


    /*
     * Gets folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->container['folder'];
    }

    /*
     * Sets folder
     *
     * @param string $folder The name of the folder (e.g. Inbox, Sent Item or Deleted Items) to render
     *
     * @return $this
     */
    public function setFolder($folder)
    {
        $this->container['folder'] = $folder;

        return $this;
    }

    /*
     * Gets textFilter
     *
     * @return string
     */
    public function getTextFilter()
    {
        return $this->container['textFilter'];
    }

    /*
     * Sets textFilter
     *
     * @param string $textFilter The keywords used to filter messages
     *
     * @return $this
     */
    public function setTextFilter($textFilter)
    {
        $this->container['textFilter'] = $textFilter;

        return $this;
    }

    /*
     * Gets addressFilter
     *
     * @return string
     */
    public function getAddressFilter()
    {
        return $this->container['addressFilter'];
    }

    /*
     * Sets addressFilter
     *
     * @param string $addressFilter The email-address used to filter messages by sender or recipient
     *
     * @return $this
     */
    public function setAddressFilter($addressFilter)
    {
        $this->container['addressFilter'] = $addressFilter;

        return $this;
    }

    /*
     * Gets maxItemsInFolder
     *
     * @return int
     */
    public function getMaxItemsInFolder()
    {
        return $this->container['maxItemsInFolder'];
    }

    /*
     * Sets maxItemsInFolder
     *
     * @param int $maxItemsInFolder The maximum number of messages or items, that can be rendered from one folder
     *
     * @return $this
     */
    public function setMaxItemsInFolder($maxItemsInFolder)
    {
        $this->container['maxItemsInFolder'] = $maxItemsInFolder;

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


