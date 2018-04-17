<?php

use Illuminate\Database\Seeder;
use App\Professor;

class ProfessorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // 지도교수 생성
        $tutor = new Professor();

        $tutor->id          = 'tutor';
        $tutor->manager     = null;
        $tutor->expire_date = null;
        $tutor->password    = password_hash('aaaa', PASSWORD_DEFAULT);
        $tutor->name        = "정영철";
        $tutor->phone       = "0539405765";
        $tutor->email       = 'ycjung@yjc.ac.kr';
        $tutor->office      = "본관 326호";
        $tutor->face_photo  = "/source/prof_face/ycjung.jpg";

        $tutor->save();

        // 교과목교수 목록
        $professors = [
               'prof1'      => [
                   'name'           => '서희경',
                   'phone'          => '0539405309',
                   'email'          => 'seohk17@yjc.ac.kr',
                   'office'         => '본관 323호',
                   'face_photo'     => '/source/prof_face/hkseo.jpg'
               ],
                'prof2'      => [
                    'name'           => '김종율',
                    'phone'          => '0539405301',
                    'email'          => 'xmaskjr@yjc.ac.kr',
                    'office'         => '본관 326호',
                    'face_photo'     => '/source/prof_face/jykim.jpg'
                ],
                'prof3'      => [
                    'name'           => '기쿠치',
                    'phone'          => '0539405318',
                    'email'          => 'figures@yjc.ac.kr',
                    'office'         => '본관 427호',
                    'face_photo'     => '/source/prof_face/kikuti.jpg'
                ],
                'prof4'      => [
                    'name'           => '김기종',
                    'phone'          => '0539405310',
                    'email'          => 'kjkim@yjc.ac.kr',
                    'office'         => '본관 309호',
                    'face_photo'     => '/source/prof_face/kjkim.jpg'
                ],
                'prof5'      => [
                    'name'           => '박성철',
                    'phone'          => '0539405307',
                    'email'          => 'scpark@yjc.ac.kr',
                    'office'         => '본관 322호',
                    'face_photo'     => '/source/prof_face/scpack.jpg'
                ],
        ];

        // 계정 생성
        foreach($professors as  $id => $professor) {
            $prof = new Professor();

            // 공통 정보 입력
            $prof->id           = $id;
            $prof->manager      = 'tutor';
            $prof->expire_date  = '2018-12-31';
            $prof->password     = password_hash('aaaa', PASSWORD_DEFAULT);

            // 개별 정보 입력
            foreach($professor as $columnName => $value) {
                $prof->{$columnName} = $value;
            }

            $prof->save();
        }
    }
}
