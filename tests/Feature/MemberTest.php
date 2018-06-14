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
        create('App\Member',['total'=>0,'nickname'=>'BBB']);
        create('App\Member',['total'=>0,'nickname'=>'AAA']);

        Member::computeRanks();

        $members = Member::getRanked();



        $this->assertEquals($members[0]->rank,1);
        $this->assertEquals($members[1]->rank,2);
        $this->assertEquals($members[2]->rank,2);
        $this->assertEquals($members[3]->rank,4);
        $this->assertEquals($members[4]->rank,5);
        $this->assertEquals($members[5]->rank,6);
        $this->assertEquals($members[5]->nickname,'AAA');
        $this->assertEquals($members[6]->rank,6);
        $this->assertEquals($members[6]->nickname,'BBB');



    }


        /** @test */
    public function it_should_clean_nickname()
    {

        //$nickname = "Foo";
        //self::assertEquals("Foo",Member::cleanNickname($nickname));

        $nickname = "\"Foo\"";
        self::assertEquals("Foo",Member::cleanNickname($nickname));




    }


}
