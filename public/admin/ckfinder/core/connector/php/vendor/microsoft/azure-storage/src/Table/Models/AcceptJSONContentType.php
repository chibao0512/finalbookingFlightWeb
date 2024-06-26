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
 * @package   MicrosoftAzure\Storage\Table\Models
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2017 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */
 
namespace MicrosoftAzure\Storage\Table\Models;

use MicrosoftAzure\Storage\Common\Internal\Utilities;
use MicrosoftAzure\Storage\Common\Internal\Resources;
use MicrosoftAzure\Storage\Common\Internal\Validate;

/**
 * Holds constant and logic for accept JSON content type.
 *
 * @location  Microsoft
 * @package   MicrosoftAzure\Storage\Table\Models
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2017 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */
class AcceptJSONContentType
{
    const NO_METADATA      = Resources::JSON_NO_METADATA_CONTENT_TYPE;
    const MINIMAL_METADATA = Resources::JSON_MINIMAL_METADATA_CONTENT_TYPE;
    const FULL_METADATA    = Resources::JSON_FULL_METADATA_CONTENT_TYPE;

    public static function validateAcceptContentType($contentType)
    {
        Validate::isTrue(
            $contentType == self::NO_METADATA ||
            $contentType == self::MINIMAL_METADATA ||
            $contentType == self::FULL_METADATA,
            Resources::INVALID_ACCEPT_CONTENT_TYPE
        );
    }
}
