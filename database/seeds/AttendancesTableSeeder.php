<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\LeaveSchool;
use App\ComeSchool;
use App\Attendance;
use App\Http\DbInfoEnum;
use Illuminate\Support\Carbon;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = today();
        $students = Student::all();

        // 3월 출석기록 생성
        for ($iCount = 1; $iCount <= 31; $iCount++) {
            foreach ($students as $student) {
                // 현재 일자 구하기
                $nowDate = Carbon::createFromDate($today->year, 3, $iCount);

                // 일정 확률의 결석 구하기
                $absence_flag = random_int(0, 1000);
                // 1 / 1000의 확률에 걸린 불운의 주인공 => 결석
                if ($absence_flag === 1) {
                    Attendance::insert([
                        'reg_date' => $nowDate->format('Y-m-d'),
                        'std_id' => $student->id,
                        'come_school' => null,
                        'leave_school' => null,
                        'absence_flag' => true
                    ]);
                    continue;
                }

                // 해당 일자에 해당 학생의 출석 데이터가 들어 있으면 => 예외
                if (sizeof(Attendance::where([
                        ['reg_date', $nowDate->format('Y-m-d')], ['std_id', $student->id]
                    ])->get()) > 0) {
                    continue;
                }

                // 등교 데이터 생성
                $come_school_time = Carbon::create(
                    $nowDate->year, $nowDate->month, $nowDate->day, random_int(6, 9), random_int(0, 59), random_int(0, 59));

                $come_school = new ComeSchool();
                $come_school->reg_time = $come_school_time;
                $come_school->lateness_flag = ($come_school_time->hour < 9) ? false : true;
                $come_school->classification = ($come_school_time->hour < 9) ? 1 : 2;

                $come_school->save();

                // 하교 데이터 생성
                $leave_school_time = Carbon::create(
                    $nowDate->year, $nowDate->month, $nowDate->day, random_int(20, 23), random_int(0, 59), random_int(0, 59));

                $leave_school = new LeaveSchool();
                $leave_school->reg_time = $leave_school_time;
                $leave_school->early_flag = ($leave_school_time->hour >= 21) ? false : true;
                $leave_school->classification = ($leave_school_time->hour >= 21) ? 1 : 2;

                $leave_school->save();

                // 출석 데이터 생성
                $attendance = new Attendance();

                $attendance->reg_date = Carbon::createFromDate($come_school_time->year, $come_school_time->month, $come_school_time->day);
                $attendance->std_id = $student->id;
                $attendance->come_school = $come_school->id;
                $attendance->leave_school = $leave_school->id;

                $attendance->save();
            }
        }

        // 4월 출석기록 생성
        for ($iCount = 19; $iCount <= 28; $iCount++) {
            foreach ($students as $student) {
                // 현재 일자 구하기
                $nowDate = Carbon::createFromDate($today->year, 4, $iCount);

                // 해당 일자에 해당 학생의 출석 데이터가 들어 있으면 => 예외
                if (sizeof(Attendance::where([
                        ['reg_date', $nowDate->format('Y-m-d')], ['std_id', $student->id]
                    ])->get()) > 0) {
                    continue;
                }

                $come_hour = null;
                $come_school_time = null;
                if (($student->id == 1601286 || $student->id == 1301143) && $iCount > 5) {
                    // 준규형 & 형석이형 => 연속 지각 10회 이상
                    $come_school_time = Carbon::create(
                        $nowDate->year, $nowDate->month, $nowDate->day, random_int(9, 12), random_int(0, 59), random_int(0, 59));

                } else
                    // 다른 사람 => 랜덤 생성
                    $come_school_time = Carbon::create(
                        $nowDate->year, $nowDate->month, $nowDate->day, random_int(6, 9), random_int(0, 59), random_int(0, 59));


                $come_school = new ComeSchool();
                $come_school->reg_time = $come_school_time;
                $come_school->lateness_flag = ($come_school_time->hour < 9) ? false : true;
                $come_school->classification = ($come_school_time->hour < 9) ? 1 : 2;

                $come_school->save();

                // 하교 데이터 생성
                $leave_school_time = Carbon::create(
                    $nowDate->year, $nowDate->month, $nowDate->day, random_int(20, 23), random_int(0, 59), random_int(0, 59));

                $leave_school = new LeaveSchool();
                $leave_school->reg_time = $leave_school_time;
                $leave_school->early_flag = ($leave_school_time->hour >= 21) ? false : true;
                $leave_school->classification = ($leave_school_time->hour >= 21) ? 1 : 2;

                $leave_school->save();

                // 출석 데이터 생성
                $attendance = new Attendance();

                $attendance->reg_date = Carbon::createFromDate($nowDate->year, $nowDate->month, $nowDate->day);
                $attendance->std_id = $student->id;
                $attendance->come_school = $come_school->id;
                $attendance->leave_school = $leave_school->id;

                $attendance->save();
            }
        }

            /*
        // 데모 당일 생성
        foreach ($students as $student) {
            if (in_array($student->id, [
                1301235, 1401134, 1401145, 1401185, 1401213, 1601155, 1601230
            ])) {
                // 우리조원 => 예외
                continue;
            } else {
                // 다른 조원 => 데이터 생성
                $nowDate = Carbon::createFromDate($today->year, 4, 18);

                // 1 / 20의 확률로 미출석
                $absence_flag = random_int(1, 20);
                if ($absence_flag === 1) {
                    continue;
                }

                $come_hour = null;
                $come_school_time = null;
                if ($student->id == 1601286 || $student->id == 1301143) {
                    // 준규형 & 형석이형 => 연속 지각 10회 이상
                    $come_school_time = Carbon::create(
                        $nowDate->year, $nowDate->month, $nowDate->day, random_int(9, 12), random_int(0, 59), random_int(0, 59));

                } else
                    // 다른 사람 => 랜덤 생성
                    $come_school_time = Carbon::create(
                        $nowDate->year, $nowDate->month, $nowDate->day, random_int(6, 9), random_int(0, 59), random_int(0, 59));
            }

            $come_school = new ComeSchool();
            $come_school->reg_time = $come_school_time;
            $come_school->lateness_flag = ($come_school_time->hour < 9) ? false : true;
            $come_school->classification = ($come_school_time->hour < 9) ? 1 : 2;

            $come_school->save();

            // 하교 데이터 생성
            $leave_school_time = Carbon::create(
                $nowDate->year, $nowDate->month, $nowDate->day, random_int(20, 23), random_int(0, 59), random_int(0, 59));

            $leave_school = new LeaveSchool();
            $leave_school->reg_time = $leave_school_time;
            $leave_school->early_flag = ($leave_school_time->hour >= 21) ? false : true;
            $leave_school->classification = ($leave_school_time->hour >= 21) ? 1 : 2;

            $leave_school->save();

            // 출석 데이터 생성
            $attendance = new Attendance();

            $attendance->reg_date = Carbon::createFromDate($nowDate->year, $nowDate->month, $nowDate->day);
            $attendance->std_id = $student->id;
            $attendance->come_school = $come_school->id;
            $attendance->leave_school = $leave_school->id;

            $attendance->save();
        }
*/

        /*
        // 01. 변수 설정
        $today = today();
        $students = Student::all();
        $recent_attendance = new Carbon(Attendance::whereMonth(
            DbInfoEnum::ATTENDANCES['reg_date'], '>=', today()->startOfMonth()->format('m')
            )->max('reg_date'));

        for($iCount = $recent_attendance; $iCount <= $today->day; $iCount++) {
            foreach($students as $student) {
                $nowDate = Carbon::createFromDate($today->year, $today->month, $iCount);
                if(sizeof(Attendance::where([
                    [DbInfoEnum::ATTENDANCES['reg_date'], $nowDate->format('Y-m-d')],
                        [DbInfoEnum::ATTENDANCES['std_id'], $student->id]])->get()) > 0) {
                    continue;
                }

                // 등교 데이터 생성
                $come_hour      = random_int(6, 9);
                $zero_to_sixty  = random_int(0, 59);

                $come_school_time = Carbon::create($today->year, $today->month, $iCount, $come_hour, $zero_to_sixty, $zero_to_sixty);

                $come_school = new ComeSchool();
                $come_school->reg_time          = $come_school_time;
                $come_school->lateness_flag     = ($come_hour < 9) ? false : true;
                $come_school->classification    = ($come_hour < 9) ? 1 : 2;

                $come_school->save();

                // 하교 데이터 생성
                $leave_hour = random_int(20, 23);
                $leave_school_time = Carbon::create($today->year, $today->month, $iCount, $leave_hour, $zero_to_sixty, $zero_to_sixty);

                $leave_school = new LeaveSchool();
                $leave_school->reg_time         = $leave_school_time;
                $leave_school->early_flag       = ($leave_hour >= 21) ? false : true;
                $leave_school->classification   = ($leave_hour >= 21) ? 1 : 2;

                $leave_school->save();

                // 출석 데이터 생성
                $attendance = new Attendance();

                $attendance->reg_date       = Carbon::createFromDate($come_school_time->year, $come_school_time->month, $come_school_time->day);
                $attendance->std_id         = $student->id;
                $attendance->come_school    = $come_school->id;
                $attendance->leave_school   = $leave_school->id;

                $attendance->save();
            }
        }
        */
    }
}
