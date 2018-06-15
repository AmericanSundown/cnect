<?php

namespace App\Console\Commands;

use App\Member;
use App\Ranking;
use Illuminate\Console\Command;

class Snapshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cnect:snapshot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Snapshot the current situation';

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
        // Loop through members
        $members = Member::all();
        foreach ($members as $member) {
            // Save nickname, ranking and date
            $ranking = new Ranking;
            $ranking->nickname = $member->nickname;
            $ranking->rank = $member->rank;
            $ranking->save();
        }

    }
}
