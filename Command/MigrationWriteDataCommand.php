<?php declare(strict_types=1);

namespace SwagMigrationNext\Command;

use InvalidArgumentException;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Struct\Uuid;
use SwagMigrationNext\Migration\MigrationContext;
use SwagMigrationNext\Migration\Service\MigrationWriteServiceInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrationWriteDataCommand extends ContainerAwareCommand
{
    // example call: bin/console migration:write:data -p shopware55 -y product

    /**
     * @var MigrationWriteServiceInterface
     */
    private $migrationWriteService;

    public function __construct(MigrationWriteServiceInterface $migrationWriteService, ?string $name = null)
    {
        parent::__construct($name);
        $this->migrationWriteService = $migrationWriteService;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Writes data with the given profile')
            ->addOption('catalog-id', 'c', InputOption::VALUE_REQUIRED)
            ->addOption('profile', 'p', InputOption::VALUE_REQUIRED)
            ->addOption('entity', 'y', InputOption::VALUE_REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tenantId = $input->getOption('tenant-id');
        $context = Context::createDefaultContext($tenantId);

        $catalogId = $input->getOption('catalog-id');
        if ($catalogId !== null && Uuid::isValid($catalogId)) {
            $context = $context->createWithCatalogIds(array_merge($context->getCatalogIds(), [$catalogId]));
        }

        $profile = $input->getOption('profile');
        if (!$profile) {
            throw new InvalidArgumentException('No profile provided');
        }

        $entity = $input->getOption('entity');
        if (!$entity) {
            throw new InvalidArgumentException('No entity provided');
        }

        $migrationContext = new MigrationContext($profile, '', $entity, [], 0, 1000, $catalogId);

        $output->writeln('Writing data...');

        $this->migrationWriteService->writeData($migrationContext, $context);

        $output->writeln('Writing done.');
    }
}
