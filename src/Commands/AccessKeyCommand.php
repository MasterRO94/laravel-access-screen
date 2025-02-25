<?php

declare(strict_types=1);

namespace MasterRO\AccessScreen\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;

class AccessKeyCommand extends Command
{
    use ConfirmableTrait;

    protected $signature = 'access-screen:key 
                {--generate : Generate and set new Access Screen Key} 
                {--force : Force the operation to run}';

    protected $description = 'Retrieve the access key or generate one.';

    public function handle(): int
    {
        $generate = $this->option('generate');

        if (!$generate) {
            $this->components->info('Access key: "' . config('access-screen.access_key') . '"');

            return static::SUCCESS;
        }

        $key = $this->generateKey();

        if (!$this->setKeyInEnvironmentFile($key)) {
            return static::SUCCESS;
        }

        $this->laravel['config']['access-screen.access_key'] = $key;

        $this->components->info('Access Screen Key set successfully.');
        $this->components->info("Access Screen Key: \"{$key}\"");

        return static::SUCCESS;
    }

    protected function generateKey(): string
    {
        return str(config('access-screen.app_name', 'Laravel'))
            ->ucsplit()
            ->map(static fn(string $word) => mb_substr($word, 0, 1))
            ->add('AK')
            ->merge([
                str(str()->random(7))->upper(),
                str(str()->random(7))->upper(),
                str(str()->random(7))->upper(),
            ])
            ->join('-');
    }

    protected function setKeyInEnvironmentFile(string $key): bool
    {
        $currentKey = $this->laravel['config']['access-screen.access_key'];

        $confirmToProceedCallback = static fn() => $currentKey !== 'REPLACE_WITH_ACCESS_KEY';

        if (
            strlen($currentKey) !== 0
            && !$this->confirmToProceed('Access Key is already set', $confirmToProceedCallback)
        ) {
            return false;
        }

        $this->writeNewEnvironmentFileWith($key);

        return true;
    }

    protected function writeNewEnvironmentFileWith(string $key): void
    {
        $line = "ACCESS_SCREEN_KEY={$key}";

        $replaced = preg_replace(
            $this->keyReplacementPattern(),
            $line,
            $input = file_get_contents($this->laravel->environmentFilePath()),
        );

        if ($replaced === $input || $replaced === null) {
            $replaced .= "\n{$line}\n";
        }

        file_put_contents($this->laravel->environmentFilePath(), $replaced);
    }

    protected function keyReplacementPattern(): string
    {
        $escaped = preg_quote('=' . $this->laravel['config']['access-screen.access_key'], '/');

        return "/^ACCESS_SCREEN_KEY{$escaped}/m";
    }
}
