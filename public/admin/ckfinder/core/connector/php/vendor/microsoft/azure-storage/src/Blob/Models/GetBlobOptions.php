<?php

/**
 * LICENSE: The MIT License (the "License")
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * https://github.com/azure/azure-storage-php/LICENSE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * PHP version 5
 *
 * @location  Microsoft
 * @package   MicrosoftAzure\Storage\Blob\Models
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */
 
namespace MicrosoftAzure\Storage\Blob\Models;

use MicrosoftAzure\Storage\Common\Internal\Validate;

/**
 * Optional parameters for getBlob wrapper
 *
 * @location  Microsoft
 * @package   MicrosoftAzure\Storage\Blob\Models
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */
class GetBlobOptions extends BlobServiceOptions
{
    private $_snapshot;
    private $_computeRangeMD5;
    private $_rangeStart;
    private $_rangeEnd;
    
    /**
     * Gets blob snapshot.
     *
     * @return string
     */
    public function getSnapshot()
    {
        return $this->_snapshot;
    }

    /**
     * Sets blob snapshot.
     *
     * @param string $snapshot value.
     *
     * @return void
     */
    public function setSnapshot($snapshot)
    {
        $this->_snapshot = $snapshot;
    }
    
    /**
     * Gets rangeStart
     *
     * @return integer
     */
    public function getRangeStart()
    {
        return $this->_rangeStart;
    }
    
    /**
     * Sets rangeStart
     *
     * @param integer $rangeStart the blob lease id.
     *
     * @return void
     */
    public function setRangeStart($rangeStart)
    {
        Validate::isInteger($rangeStart, 'rangeStart');
        $this->_rangeStart = $rangeStart;
    }
    
    /**
     * Gets rangeEnd
     *
     * @return integer
     */
    public function getRangeEnd()
    {
        return $this->_rangeEnd;
    }
    
    /**
     * Sets rangeEnd
     *
     * @param integer $rangeEnd range end value in bytes
     *
     * @return void
     */
    public function setRangeEnd($rangeEnd)
    {
        Validate::isInteger($rangeEnd, 'rangeEnd');
        $this->_rangeEnd = $rangeEnd;
    }
    
    /**
     * Gets computeRangeMD5
     *
     * @return boolean
     */
    public function getComputeRangeMD5()
    {
        return $this->_computeRangeMD5;
    }
    
    /**
     * Sets computeRangeMD5
     *
     * @param boolean $computeRangeMD5 value
     *
     * @return void
     */
    public function setComputeRangeMD5($computeRangeMD5)
    {
        Validate::isBoolean($computeRangeMD5);
        $this->_computeRangeMD5 = $computeRangeMD5;
    }
}
