<?php

use Illuminate\Database\Seeder;
use App\Subject;
use App\Group;

/**
 * 클래스명:                       SubjectsTableSeeder
 * 클래스 설명:                    과목 더미 데이터를 생성하는 시더
 * 만든이:                         3-WDJ 8조 春目指す 1401213 이승민
 * 만든날:                         2018년 4월 02일
 */
class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory(Subject::class, 30)->create();

        $group = Group::all()->all()[0];
        // 전공 과목 - 분반 생성
        $major = new Subject();

        $major->year            = 2018;
        $major->term            = 1;
        $major->group_id        = $group->id;
        $major->id              = 11111111;
        $major->name            = "웹 프로그래밍";
        $major->division_flag   = true;

        $major->save();

        // 일본어 과목 - 분반 생성
        $japanese = new Subject();

        $japanese->year             = 2018;
        $japanese->term             = 1;
        $japanese->group_id         = $group->id;
        $japanese->id               = 22222222;
        $japanese->name             = "실무 일본어";
        $japanese->division_flag    = true;

        $japanese->save();

        // 데이터베이스 => 단일과목
        $db = new Subject();

        $db->year            = 2018;
        $db->term            = 1;
        $db->group_id        = $group->id;
        $db->id              = 33333333;
        $db->name            = "데이터베이스설계";
        $db->division_flag   = false;

        $db->save();
    }
}
