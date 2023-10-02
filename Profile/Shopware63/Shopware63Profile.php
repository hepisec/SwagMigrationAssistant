<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagMigrationAssistant\Profile\Shopware63;

use Shopware\Core\Framework\Log\Package;
use SwagMigrationAssistant\Profile\Shopware6\Shopware6ProfileInterface;

#[Package('services-settings')]
class Shopware63Profile implements Shopware6ProfileInterface
{
    final public const PROFILE_NAME = 'shopware63';

    final public const SOURCE_SYSTEM_NAME = 'Shopware';

    final public const SOURCE_SYSTEM_VERSION = '>=6.3.1.0';

    final public const AUTHOR_NAME = 'shopware AG';

    final public const ICON_PATH = '/swagmigrationassistant/static/img/migration-assistant-plugin.svg';

    public function getName(): string
    {
        return self::PROFILE_NAME;
    }

    public function getSourceSystemName(): string
    {
        return self::SOURCE_SYSTEM_NAME;
    }

    public function getVersion(): string
    {
        return self::SOURCE_SYSTEM_VERSION;
    }

    public function getAuthorName(): string
    {
        return self::AUTHOR_NAME;
    }

    public function getIconPath(): string
    {
        return self::ICON_PATH;
    }
}
