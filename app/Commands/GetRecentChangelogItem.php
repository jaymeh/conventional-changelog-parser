<?php

namespace App\Commands;

use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class GetRecentChangelogItem extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'changelog:get-recent';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Retrieves the most recent change to the changelog.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = Storage::get('CHANGELOG.md');

        if (!$file) {
            $this->error('Cannot locate CHANGELOG.md file within project');
            return self::FAILURE;
        }

        // Process the changelog.
        preg_match(
            '/(?!\-\-\-\n)(###[\s\S]*?)(?=\-\-\-\n)/s',
            file_get_contents('CHANGELOG.md'),
            $matches
        );

        if (!count($matches)) {
            $this->error('Could not find most recent changelog item.');
            return self::FAILURE;
        }

        // Trim the output of the string and then add only one line break.
        $this->output->write(trim($matches[0])."\n");
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
