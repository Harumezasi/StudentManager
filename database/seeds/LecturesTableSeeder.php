<?php

use Illuminate\Database\Seeder;
use App\Lecture;
use App\Subject;
use App\Professor;

/**
 * 클래스명:                       LecturesTableSeeder
 * 클래스 설명:                    강의 더미 데이터를 생성하는 시더
 * 만든이:                         3-WDJ 8조 春目指す 1401213 이승민
 * 만든날:                         2018년 4월 02일
 */
class LecturesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // 과목 목록 구하기
        $subjects = Subject::all()->all();

        foreach($subjects as $subject) {
            $loop_count = $subject->division_flag ? 2 : 1;
            for ($iCount = 0; $iCount < $loop_count; $iCount++) {
                // 교수 배정
                $professor = null;
                if($subject->id == 11111111) {
                    // 전공 과목 => 분반
                    if($iCount == 0) {
                        $professor = 'prof5';
                    } else {
                        $professor = 'prof2';
                    }
                } else if($subject->id == 22222222) {
                    // 일본어 과목 => 분반
                    if($iCount == 0) {
                        $professor = 'prof3';
                    } else {
                        $professor = 'prof1';
                    }
                } else if($subject->id == 33333333){
                    // DB 과목 => 단일
                    $professor = 'prof4';
                }

                $lecture = new Lecture();

                $lecture->subject_id        = $subject->id;
                $lecture->divided_class_id  = $subject->division_flag ? chr($iCount + 65) : NULL;
                $lecture->professor         = $professor;

                $lecture->save();
            }
        }
    }
}
