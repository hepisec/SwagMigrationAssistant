<?php declare(strict_types=1);
/*
 * (c) shopware AG <info@shopware.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagMigrationAssistant\Profile\Shopware63\Converter;

use Shopware\Core\Framework\Log\Package;
use SwagMigrationAssistant\Migration\MigrationContextInterface;
use SwagMigrationAssistant\Profile\Shopware6\Converter\OrderConverter;
use SwagMigrationAssistant\Profile\Shopware6\DataSelection\DataSet\OrderDataSet;
use SwagMigrationAssistant\Profile\Shopware63\Shopware63Profile;

#[Package('services-settings')]
class Shopware63OrderConverter extends OrderConverter
{
    public function supports(MigrationContextInterface $migrationContext): bool
    {
        return $migrationContext->getProfile()->getName() === Shopware63Profile::PROFILE_NAME
            && $this->getDataSetEntity($migrationContext) === OrderDataSet::getEntity();
    }
}
