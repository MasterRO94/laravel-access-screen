<?php

declare(strict_types=1);

namespace MasterRO\AccessScreen\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'access-screen:publish {--views : Also publish access-screen views}';

    protected $description = 'Publish access-screen assets configs and optionally views.';

    public function handle(): int
    {
        $this->call('vendor:publish', [
            '--tag'   => 'access-screen-assets',
            '--force' => true,
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'access-screen-config',
        ]);

        if ($this->option('views')) {
            $this->call('vendor:publish', [
                '--tag'   => 'access-screen-views',
                '--force' => true,
            ]);
        }

        return static::SUCCESS;
    }
}
