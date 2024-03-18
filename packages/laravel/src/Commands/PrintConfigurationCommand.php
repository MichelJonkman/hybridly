<?php

namespace Hybridly\Commands;

use Hybridly\Hybridly;
use Hybridly\Support\Configuration\Configuration;
use Hybridly\Support\RouteExtractor;
use Hybridly\Support\Version;
use Illuminate\Console\Command;

class PrintConfigurationCommand extends Command
{
    protected $signature = 'hybridly:config {--pretty}';
    protected $description = 'Prints the internal Hybridly configuration.';
    protected $hidden = true;

    public function __construct(
        private readonly Hybridly $hybridly,
        private readonly RouteExtractor $routeExtractor,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $configuration = [
            'versions' => [
                'composer' => Version::getComposerVersion(),
                'npm' => Version::getNpmVersion(),
                'is_latest' => Version::isLatestVersion(),
                'latest' => Version::getLatestVersion(),
            ],
            'architecture' => [
                'root_directory' => Configuration::get()->architecture->rootDirectory,
                'components_directory' => Configuration::get()->architecture->componentsDirectory,
                'application_main_path' => Configuration::get()->architecture->getApplicationMainPath(),
            ],
            'components' => [
                'eager' => Configuration::get()->architecture->eagerLoadViews,
                'layouts' => $this->hybridly->getLayouts(),
                'views' => $this->hybridly->getViews(),
                'components' => $this->hybridly->getComponents(),
                'files' => $this->hybridly->getTypeScriptDirectories(),
            ],
            'routing' => $this->routeExtractor->toArray(),
        ];

        $flags = $this->option('pretty')
            ? \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES
            : 0;

        echo json_encode($configuration, $flags);

        return self::SUCCESS;
    }
}
