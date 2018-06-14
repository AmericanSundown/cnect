<?php

namespace App\Console\Commands;

use App\Member;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class scorecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cnect:scorecast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve data from scorecast';

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

        $cookieJar = CookieJar::fromArray([
            '__utna' => env('SCORECAST_COOKIE')
        ], 'scorecast.fr');


        var_dump("hello cnect");
        $client = new Client();

        $isPrimary = true;

        $competitions = explode(",", env("SCORECAST_COMPETITIONS"));
        foreach ($competitions as $competition) {
            $res = $client->get('https://www.scorecast.fr/standings.php?iid=' . $competition . '&format=csv', ['cookies' => $cookieJar]);
            $this->processResults($res, $isPrimary);
            $isPrimary = false;
        }


    }

    /**
     * @param $res
     * @param boolean $isPrimary
     */
    protected function processResults($res, $isPrimary): void
    {
        $results = explode("\n", $res->getBody());

        array_shift($results);
        array_pop($results);

        //Update or Create

        foreach ($results as $line) {
            $result = explode(";", $line);

            if ($isPrimary == false) {
                //Check for Christophe
                if ($result[1] == "Christophe" || $result[1] == "ansergey" ) {
                    var_dump("found " .$result[1]. ", not doing anything with him");
                    continue;
                }
            }

            var_dump($result[1]);
            $member = Member::firstOrNew(['nickname' => $result[1]]);
            $member->total = $result[2];
            $member->score1 = $result[3] == '' ? 0 : $result[3];
            $member->score2 = $result[4] == '' ? 0 : $result[4];
            $member->score3 = $result[5] == '' ? 0 : $result[5];
            $member->save();


        }
    }
}