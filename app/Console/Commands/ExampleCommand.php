<?php

namespace App\Console\Commands;
use App\Models\Helpers\ParseHTMLHelper;
use App\User;
use Illuminate\Console\Command;
use App\Models\Helpers\RequestHelper;
use Mews\Purifier\Purifier;
use PHPHtmlParser\Dom;
use App\Models\Routine;

class ExampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:example';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {

//        $a = new Routine();
//        $a->name = 'Programming';
//        $a->time_start = '8:00';
//        $a->time_stop = '18:00';
//        $a->date = date('Y-m-d');
//        $a->user_id = 1;
//        $a->save();
        Routine::findForUser(1);
    }
}
