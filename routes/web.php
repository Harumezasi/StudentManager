<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 *  01. 홈 화면 라우팅
 */
Route::name('home.')->group(function() {

    // 전체 메인 페이지
    Route::get('/', [
        'as'    => 'index',
        'uses'  => 'HomeController@index'
    ]);

    // 회원가입 페이지
    Route::get('/join', [
        'as'    => 'join',
        'uses'  => 'HomeController@join'
    ]);

    // 로그인 페이지
    Route::post('/login', [
        'as'    => 'login',
        'uses'  => 'HomeController@login'
    ]);

    // 로그아웃 기능
    Route::get('/logout', [
        'as'    => 'logout',
        'uses'  => 'HomeController@logout'
    ]);

    // 아이디/비밀번호 찾기 관련 기능 정의
    Route::get('/forgot', [
        'as'   => 'forgot',
        'uses' => 'HomeController@forgot'
    ]);
});

// 회원가입 유형 획득
Route::get('/join/{joinType}', 'HomeController@setJoinForm');

// 언어 설정
Route::get('language/{locale}', 'HomeController@setLanguage');

/**
 * 02. 학생 관련 기능 라우팅
 */
Route::name('student.')->group(function() {
    Route::prefix('student')->group(function() {

        // 학생 회원가입 여부 확인 링크
        Route::post('/check_join', [
            'as'    => 'check_join',
            'uses'  => 'StudentController@check_join'
        ]);

        // 학생 회원가입
        Route::post('/store', [
            'as'    => 'store',
            'uses'  => 'StudentController@store'
        ]);

        // 학생 출석 그래프 가져오기
        Route::post('/attendance/graph', [
            'as'    => 'attendance.graph',
            'uses'  => 'StudentController@getAttendanceGraph'
        ]);

        // 하드웨어: 등교
        Route::post('/hardware/come_school', [
            'as'    => 'hardware.come_school',
            'uses'  => 'StudentController@comeSchool'
        ]);

        // 하드웨어: 하교
        Route::post('/hardware/leave_school', [
            'as'    => 'hardware.leave_school',
            'uses'  => 'StudentController@leaveSchool'
        ]);

        // 모바일: 출결 기록 조회
        Route::post('/mobile/attendance', 'StudentController@getAttendanceRecordsAtMobile');

        // 모바일: 학생의 과목 정보 조회
        Route::post('/mobile/lecture', 'StudentController@getLectureDataAtMobile');

        // 학생 계정 접속 이후 사용하는 기능들 => 로그인 여부 확인
        Route::middleware(['check.login'])->group(function() {

            // 학생 메인 페이지
            Route::get('/main', [
                'as'    => 'index',
                'uses'  => 'StudentController@index'
            ]);

            // 학생 회원관리 페이지
            Route::get('/info', [
                'as'    => 'info',
                'uses'  => 'StudentController@info'
            ]);

            /* 신규 추가 */
            // 출결 관리 기능
            Route::get('/attendanceManagement', function(){
                return view('welcome');
            });
            // 학업 관리 기능
            Route::get('/gradeManagement', function(){
                return view('welcome');
            });
            // 상담 관리 기능
            Route::get('/consultingManagement', function(){
                return view('welcome');
            });
            /* End */

            // 출결 관리 기능
            Route::get('/attendance/{period?}/{date?}', [
                'as'    => 'attendance',
                'uses'  => 'StudentController@getAttendanceRecords'
            ]);
            /*
            // 모바일: 등교 인증
            Route::post('/come_school', [
                'as'    => 'come_school',
                'uses'  => 'StudentController@comeSchool'
            ]);

            // 모바일: 하교 인증
            Route::post('/leave_school', [
                'as'    => 'leave_school',
                'uses'  => 'StudentController@leaveSchool'
            ]);
            */
            // 학업 관리 기능
            Route::get('/lecture', [
                'as'    => 'lecture',
                'uses'  => 'StudentController@lectureMain'
            ]);

            Route::get('/counsel', [
                'as'    => 'counsel',
                'uses'  => 'StudentController@counsel'
            ]);
        });
    });
});

/**
 *  03. 지도교수 기능 관련 라우팅
 */
Route::name('tutor.')->group(function() {
    Route::prefix('tutor')->group(function() {

        // 지도교수 회원가입
        Route::post('/store', [
            'as'    => 'store',
            'uses'  => 'TutorController@store'
        ]);

        // 지도교수 회원가입시 아이디 중복 확인
        Route::post('/check_join', [
            'as'    => 'check_join',
            'uses'  => 'TutorController@check_join'
        ]);

        // 모바일 - 내 지도반 학생 리스트 출력
        Route::post('/myclass/student_list', 'TutorController@getMyStudentsListAtAndroid');

        // 모바일 - 오늘자 출석기록 조회
        Route::post('/myclass/today_attendance', 'TutorController@getAttendanceRecordsOfTodayAtMobile');

        // 지도교수 로그인 이후 이용 가능 기능
        Route::middleware(['check.login'])->group(function() {


            // 지도교수 메인 페이지 출력
            Route::get('/main', [
                'as'    => 'index',
                'uses'  => 'TutorController@index'
            ]);


            /* 신규 경로 추가 */
            Route::get('/', function(){
                return view('welcome');
            });

            Route::get('/attendance', function(){
                return view('welcome');
            });

            Route::get('/studentManagement', function(){
                return view('welcome');
            });

            Route::get('/alertStudentSetting', function(){
                return view('welcome');
            });

            /* End */

            // 계정관리
            Route::get('/info', [
                'as'    => 'info',
                'uses'  => 'TutorController@info'
            ]);

            // 지도반 관련
            // 내 지도반 관리
            Route::get('/myclass/manage/{order?}', [
                'as'    => 'myclass.manage',
                'uses'  => 'TutorController@manageMyClass'
            ]);

            // 오늘자 등/하교 출력
            Route::get('/myclass/attendance', [
                'as'    => 'myclass.attendance',
                'uses'  => 'TutorController@getAttendanceRecordsOfToday'
            ]);


            // 학생 상세정보 => 출결 확인
            Route::get('/details/attendance/{std_id}/{period?}/{date?}', [
                'as'    => 'details.attendance',
                'uses'  => 'TutorController@detailsOfAttendance'
            ]);

            // 학생 상세정보 => 성적 확인
            Route::get('/details/scores/{std_id}/{lecture_id?}', [
                'as'    => 'details.scores',
                'uses'  => 'TutorController@detailsOfScores'
            ]);

            // 내 지도반 생성
            Route::get('/myclass/create', [
                'as'    => 'myclass.create',
                'uses'  => 'TutorController@createMyClass'
            ]);

            // 관심학생 알림 설정 페이지 출력
            Route::get('/myclass/needcare', [
                'as'    => 'myclass.needcare',
                'uses'  => 'TutorController@viewNeedCareConfig'
            ]);

            // 알림 저장
            Route::post('/myclass/needcare/store', [
                'as'    => 'myclass.needcare.store',
                'uses'  => 'TutorController@storeNeedCare'
            ]);

            // 관리 & 설정

            // 정보 등록
            // 학생정보 등록 페이지 출력
            Route::get('/config/store/student', [
                'as'    => 'config.store.student',
                'uses'  => 'TutorController@getStudentStorePage'
            ]);

            // 엑셀 파일을 이용한 페이지 출력
            Route::post('/config/store/student/excel/select', [
                'as'    => 'config.store.student.excel.select',
                'uses'  => 'TutorController@selectStudentsListAtExcel'
            ]);

            // 조회한 학생 목록에서 엑셀 파일 저장
            Route::post('/config/store/student/excel/store', [
                'as'    => 'config.store.student.excel.insert',
                'uses'  => 'TutorController@insertStudentsList'
            ]);
        });
    });
});

/**
 *  04. 교과목 교수 기능 관련 라우팅
 */

Route::name('professor.')->group(function() {
   Route::prefix("professor")->group(function() {
       // 교과목교수 아이디 확인
       Route::post('/check_join', [
           'as'     => 'check_join',
           'uses'   => 'ProfessorController@check_join'
       ]);

        // 교과목교수 회원가입
       Route::post('/store', [
           'as'    => 'store',
           'uses'  => 'ProfessorController@store'
       ]);


       // 학생 관리
       // 모바일 : 학생 리스트 조회
       Route::post('/students_list', 'ProfessorController@getMyStudentsList');

       // 교과목교수 로그인 이후 사용 가능 기능
       Route::middleware(['check.login'])->group(function() {

           // 교과목교수 메인 페이지 출력
           Route::get('/main', [
               'as'     => 'index',
               'uses'   => 'ProfessorController@index'
           ]);

           // 수강반 관리

           // 출결 관리
           // 출석체크
           Route::get('/lecture/check_attendance', [
               'as'     => 'lecture.attendance.check',
               'uses'   => 'ProfessorController@checkAttendance'
           ]);


           // 출석체크를 위한 학생명단
           Route::get('/getData/attendanceCheck', [
               'as'     => 'lecture.attendance.check',
               'uses'   => 'ProfessorController@checkAttendance'
           ]);

           // 출석체크를 위한 학생명단
           Route::get('/attendanceCheck', function(){
               return view('welcome');
           });

           // 성적 등록
           Route::get('/gradeRegister', function(){
               return view('welcome');
           });


           // 성적 조회
           Route::get('/details/scores/{stdId}', [
                'as'    => 'details.scores',
                'uses'  => 'ProfessorController@detailsOfStudent'
           ]);

           // 코멘트 조회
           Route::get('/details/comment/{stdId}/{term?}', [
               'as'     => 'details.comments',
               'uses'   => 'ProfessorController@commentsOfStudent'
           ]);

           // 성적 관리
           Route::get('/scores/store', [
                'as'    => 'scores.store.main',
                'uses'  => function() {
                    return view('professor_score_store', [
                        'title' => __('page_title.professor_score_store_main'),
                    ]);
                }
           ]);

           // 엑셀 양식 다운로드
           Route::post('/scores/store/excel/export', [
                'as'    => 'scores.store.excel.export',
                'uses'  => 'ProfessorController@exportScoresExcelForm'
           ]);

           // 엑셀 입력
           Route::post('/scores/store/excel/import', [
               'as'     => 'scores.store.excel.import',
               'uses'   => 'ProfessorController@storeScoreAtExcel'
           ]);

           // 교과목교수 상담관리 페이지
           Route::get('/counsel', [
               'as'     => 'counsel',
               'uses'   => 'ProfessorController@counsel'
           ]);
       });
   });
});