<?php

namespace Tests\Feature;

use App\Member;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemberTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function it_should_calculate_ranking()
    {
        create('App\Member',['total'=>5]);
        create('App\Member',['total'=>10]);
        create('App\Member',['total'=>8]);
        create('App\Member',['total'=>3]);
        create('App\Member',['total'=>8]);
        create('App\Member',['total'=>2,'nickname'=>'BBB','score1'=>3]);
        create('App\Member',['total'=>2,'nickname'=>'AAB','score1'=>2]);
        create('App\Member',['total'=>2,'nickname'=>'AAA','score1'=>2]);

        Member::computeRanks();

        $members = Member::getRanked();



        $this->assertEquals($members[0]->rank,1);
        $this->assertEquals($members[1]->rank,2);
        $this->assertEquals($members[2]->rank,2);
        $this->assertEquals($members[3]->rank,4);
        $this->assertEquals($members[4]->rank,5);
        $this->assertEquals($members[5]->rank,6);
        $this->assertEquals($members[5]->nickname,'BBB');
        $this->assertEquals($members[6]->rank,6);
        $this->assertEquals($members[6]->nickname,'AAA');
        $this->assertEquals($members[7]->rank,6);
        $this->assertEquals($members[7]->nickname,'AAB');



    }

    /** @test */
    public function it_should_not_calculate_ranking_for_robots()
    {
        create('App\Member',['total'=>10]);
        create('App\Member',['total'=>8, 'type'=>'Robot']);
        create('App\Member',['total'=>6]);
        create('App\Member',['total'=>4]);
        create('App\Member',['total'=>4]);


        Member::computeRanks();

        $members = Member::getRanked();

        $this->assertEquals(1,$members[0]->rank);
        $this->assertEquals("Robot", $members[1]->type);
        $this->assertEquals("Human", $members[2]->type);
        $this->assertEquals(2, $members[2]->rank);
        $this->assertEquals(3, $members[3]->rank);
        $this->assertEquals(3, $members[4]->rank);


    }


        /** @test */
    public function it_should_clean_nickname()
    {

        //$nickname = "Foo";
        //self::assertEquals("Foo",Member::cleanNickname($nickname));

        $nickname = "\"Foo\"";
        $this->assertEquals("Foo",Member::cleanNickname($nickname));




    }

        /** @test */
    public function it_should_detect_humans_and_bots()
    {

        $nickname = "User A";
        $this->assertEquals("Human",Member::getType($nickname));
        $nickname = "ED-209";
        $this->assertEquals("Robot",Member::getType($nickname));
        $nickname = "R2-D2";
        $this->assertEquals("Robot",Member::getType($nickname));
        $nickname = "Robby";
        $this->assertEquals("Robot",Member::getType($nickname));
        $nickname = "T-1000";
        $this->assertEquals("Robot",Member::getType($nickname));



    }


}
