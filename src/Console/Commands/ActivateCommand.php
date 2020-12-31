<?php

declare(strict_types=1);

namespace Cortex\Tags\Console\Commands;

use Illuminate\Console\ConfirmableTrait;
use Cortex\Foundation\Console\Commands\AbstractModuleCommand;

class ActivateCommand extends AbstractModuleCommand
{
    use ConfirmableTrait;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'cortex:activate:tags {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate Cortex Tags Module';

    /**
     * The current module name.
     *
     * @var string
     */
    protected $module = 'cortex/tags';

    /**
     * Execute the console command.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->process($this->module);
    }

    protected function setComposerModuleAttributes(): array
    {
        return $this->getComposerModuleAttributes($this->module, ['active' => true]);
    }
}
