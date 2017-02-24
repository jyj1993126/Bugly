<?php
namespace jyj1993126\Bugly\Laravel;

use Illuminate\Console\Command;

/**
 * @author Leon J
 * @since 2017/2/23
 */
class BuglyCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bugly:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create bugly response migration';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $migrationFile = base_path("/database/migrations")."/".date('Y_m_d_His')."_bugly_setup_table.php";

        file_put_contents($migrationFile, file_get_contents(__DIR__ . '/Stubs/migration.stub'));

        $this->info('migration successfully created!');
    }
}