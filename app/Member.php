<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    public static function getRanked()
    {
        return Member::orderBy('total', 'desc')->orderBy('type','asc')->orderBy('nickname', 'asc')->get();

    }

    public static function computeRanks()
    {

        //Compute the ranks
        $rank = 0;
        $cpt = 0;
        $total = 9999999999999;

        $members = Member::orderBy('total', 'desc')->orderBy('nickname', 'asc')->get();
        foreach ($members as $member) {

            if ($member->type == "Human") {
                $cpt++;
                if ($member->total < $total) {
                    $rank = $cpt;
                    $total = $member->total;
                }
            }
//            if ($member->type == "Robot") {
  //              $rank = 0;
    //        }

            //var_dump($member->nickname . ' - ' . $member->total . ' - ' . $rank . ' - ' . $member->type);
            Member::where('nickname', 'LIKE', $member->nickname)->update(['rank' => $rank]);
        }
    }


    public
    function css()
    {
        $css = "";


        if ($this->type == "Robot") {
            $css .= " bg-grey-darkest text-green text-md font-mono opacity-75";
        } else {


            switch ($this->rank) {
                case 1:
                    $css .= " bg-blue-dark text-xl uppercase text-white";
                    break;
                case 2:
                    $css .= " bg-blue text-xl text-white";
                    break;
                case 3:
                    $css .= " bg-blue-light text-xl text-white";
                    break;
                default:
                    $css .= " bg-blue-lighter text-black";
                    break;
            }


        }

        return ($css);
    }

    public
    static function cleanNickname($nickname)
    {

        return str_replace("\"", "", $nickname);

    }

    public
    static function getType($nickname)
    {

        $robots = ["ED-209", "R2-D2", "Robby", "T-1000"];
        return in_array($nickname, $robots) ? "Robot" : "Human";

    }
}
