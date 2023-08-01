<?php
/**
 * UpdateIklanFile
 *
 * PHP Version 8.0
 *
 * @category UpdateIklan
 * @package  UpdateIklan
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */
namespace App\Console\Commands;

use Illuminate\Console\Command;
/**
 * UpdateIklanFile
 *
 * PHP Version 8.0
 *
 * @category UpdateIklan
 * @package  UpdateIklan
 * @author   Syafina <syafina@plisca.com.my>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.plisca.com.my/
 */

class UpdateIklan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Update:Iklan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update iklan telah tutup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        shell_exec("python Modules/Tunas/cron/iklantutup.py 2>&1");
        $this->info('Successfully update iklan telah tutup');
    }
}
