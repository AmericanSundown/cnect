<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    public static function getRanked()
    {
        return Member::orderBy('rank', 'asc')->orderBy('nickname', 'asc')->get();

    }

    public static function computeRanks()
    {

        //Compute the ranks
        $rank = 0;
        $cpt = 0;
        $total = 9999999999999;
        $members = Member::orderBy('total', 'desc')->orderBy('nickname', 'asc')->get();
        foreach ($members as $member) {
            $cpt++;
            if ($member->total < $total) {
                $rank = $cpt;
                $total = $member->total;
            }
            //var_dump($member->nickname . ' - ' . $member->total . ' - ' . $rank);
            Member::where('nickname', 'LIKE', $member->nickname)->update(['rank' => $rank]);
        }


    }

    public function css()
    {
        $css = "";
        if ($this->rank == 1) {
            $css .= " text-2xl uppercase ";
        }
        if ($this->rank == 2) {
            $css .= " text-2xl";
        }
        if ($this->rank == 3) {
            $css .= " text-xl";
        }
        return ($css);
    }
}
