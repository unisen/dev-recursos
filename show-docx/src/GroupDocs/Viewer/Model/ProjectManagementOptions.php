<?php
/*
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose Pty Ltd" file="ProjectManagementOptions.php">
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
 * ProjectManagementOptions
 *
 * @description Rendering options for Project file formats. Project file formats include files with extensions: .mpt, .mpp
 */
class ProjectManagementOptions implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /*
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = "ProjectManagementOptions";

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'pageSize' => 'string',
        'timeUnit' => 'string',
        'startDate' => '\DateTime',
        'endDate' => '\DateTime'
    ];

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'pageSize' => null,
        'timeUnit' => null,
        'startDate' => 'date-time',
        'endDate' => 'date-time'
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
        'pageSize' => 'PageSize',
        'timeUnit' => 'TimeUnit',
        'startDate' => 'StartDate',
        'endDate' => 'EndDate'
    ];

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'pageSize' => 'setPageSize',
        'timeUnit' => 'setTimeUnit',
        'startDate' => 'setStartDate',
        'endDate' => 'setEndDate'
    ];

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'pageSize' => 'getPageSize',
        'timeUnit' => 'getTimeUnit',
        'startDate' => 'getStartDate',
        'endDate' => 'getEndDate'
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

    const PAGE_SIZE_UNSPECIFIED = 'Unspecified';
    const PAGE_SIZE_LETTER = 'Letter';
    const PAGE_SIZE_LEDGER = 'Ledger';
    const PAGE_SIZE_A0 = 'A0';
    const PAGE_SIZE_A1 = 'A1';
    const PAGE_SIZE_A2 = 'A2';
    const PAGE_SIZE_A3 = 'A3';
    const PAGE_SIZE_A4 = 'A4';
    const TIME_UNIT_UNSPECIFIED = 'Unspecified';
    const TIME_UNIT_DAYS = 'Days';
    const TIME_UNIT_THIRDS_OF_MONTHS = 'ThirdsOfMonths';
    const TIME_UNIT_MONTHS = 'Months';
    

    
    /*
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPageSizeAllowableValues()
    {
        return [
            self::PAGE_SIZE_UNSPECIFIED,
            self::PAGE_SIZE_LETTER,
            self::PAGE_SIZE_LEDGER,
            self::PAGE_SIZE_A0,
            self::PAGE_SIZE_A1,
            self::PAGE_SIZE_A2,
            self::PAGE_SIZE_A3,
            self::PAGE_SIZE_A4,
        ];
    }
    
    /*
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTimeUnitAllowableValues()
    {
        return [
            self::TIME_UNIT_UNSPECIFIED,
            self::TIME_UNIT_DAYS,
            self::TIME_UNIT_THIRDS_OF_MONTHS,
            self::TIME_UNIT_MONTHS,
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
        $this->container['pageSize'] = isset($data['pageSize']) ? $data['pageSize'] : null;
        $this->container['timeUnit'] = isset($data['timeUnit']) ? $data['timeUnit'] : null;
        $this->container['startDate'] = isset($data['startDate']) ? $data['startDate'] : null;
        $this->container['endDate'] = isset($data['endDate']) ? $data['endDate'] : null;
    }

    /*
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['pageSize'] === null) {
            $invalidProperties[] = "'pageSize' can't be null";
        }
        $allowedValues = $this->getPageSizeAllowableValues();
        if (!in_array($this->container['pageSize'], $allowedValues)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'pageSize', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['timeUnit'] === null) {
            $invalidProperties[] = "'timeUnit' can't be null";
        }
        $allowedValues = $this->getTimeUnitAllowableValues();
        if (!in_array($this->container['timeUnit'], $allowedValues)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'timeUnit', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['startDate'] === null) {
            $invalidProperties[] = "'startDate' can't be null";
        }
        if ($this->container['endDate'] === null) {
            $invalidProperties[] = "'endDate' can't be null";
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

        if ($this->container['pageSize'] === null) {
            return false;
        }
        $allowedValues = $this->getPageSizeAllowableValues();
        if (!in_array($this->container['pageSize'], $allowedValues)) {
            return false;
        }
        if ($this->container['timeUnit'] === null) {
            return false;
        }
        $allowedValues = $this->getTimeUnitAllowableValues();
        if (!in_array($this->container['timeUnit'], $allowedValues)) {
            return false;
        }
        if ($this->container['startDate'] === null) {
            return false;
        }
        if ($this->container['endDate'] === null) {
            return false;
        }
        return true;
    }


    /*
     * Gets pageSize
     *
     * @return string
     */
    public function getPageSize()
    {
        return $this->container['pageSize'];
    }

    /*
     * Sets pageSize
     *
     * @param string $pageSize The size of the page.
     *
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $allowedValues = $this->getPageSizeAllowableValues();
        if ((!is_numeric($pageSize) && !in_array($pageSize, $allowedValues)) || (is_numeric($pageSize) && !in_array($allowedValues[$pageSize], $allowedValues))) {
            throw new \InvalidArgumentException(sprintf("Invalid value for 'pageSize', must be one of '%s'", implode("', '", $allowedValues)));
        }
			
        $this->container['pageSize'] = $pageSize;

        return $this;
    }

    /*
     * Gets timeUnit
     *
     * @return string
     */
    public function getTimeUnit()
    {
        return $this->container['timeUnit'];
    }

    /*
     * Sets timeUnit
     *
     * @param string $timeUnit The time unit to use as minimal point.
     *
     * @return $this
     */
    public function setTimeUnit($timeUnit)
    {
        $allowedValues = $this->getTimeUnitAllowableValues();
        if ((!is_numeric($timeUnit) && !in_array($timeUnit, $allowedValues)) || (is_numeric($timeUnit) && !in_array($allowedValues[$timeUnit], $allowedValues))) {
            throw new \InvalidArgumentException(sprintf("Invalid value for 'timeUnit', must be one of '%s'", implode("', '", $allowedValues)));
        }
			
        $this->container['timeUnit'] = $timeUnit;

        return $this;
    }

    /*
     * Gets startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->container['startDate'];
    }

    /*
     * Sets startDate
     *
     * @param \DateTime $startDate The start date of a Gantt Chart View to render.
     *
     * @return $this
     */
    public function setStartDate($startDate)
    {
        $this->container['startDate'] = $startDate;

        return $this;
    }

    /*
     * Gets endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->container['endDate'];
    }

    /*
     * Sets endDate
     *
     * @param \DateTime $endDate The end date of a Gantt Chart View to render.
     *
     * @return $this
     */
    public function setEndDate($endDate)
    {
        $this->container['endDate'] = $endDate;

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


