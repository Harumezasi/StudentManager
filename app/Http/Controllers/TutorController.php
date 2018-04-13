<?php

namespace App\Http\Controllers;

use App\NeedCareAlert;
use App\Professor;
use App\Group;
use App\Http\Controllers\ConstantEnum;
use Illuminate\Http\Request;
use PHPUnit\Util\RegularExpression;

/**
 * 클래스명:                       TutorController
 * @package                        App\Http\Controllers
 * 클래스 설명:                    지도교수가 사용하는 기능에 대해 정의하는 클래스
 * 만든이:                         3-WDJ 8조 春目指す 1401213 이승민
 * 만든날:                         2018년 3월 28일
 *
 * 생성자 매개변수 목록
 *  null
 *
 * 멤버 메서드 목록
 *
 */
class TutorController extends Controller {
    // 01. 멤버 변수 설정
    const   USER_TYPE   = ConstantEnum::USER_TYPE['tutor'];
    const   MIN_STRLEN  = 2;

    // 03. 멤버 메서드 정의
    /**
     * 함수명:                         index
     * 함수 설명:                      지도 교수가 로그인했을 때 가장 먼저 보는 메인 페이지를 출력
     * 만든날:                         2018년 3월 28일
     *
     * 매개변수 목록
     * null
     *
     * 지역변수 목록
     * null
     *
     * 반환값
     * @return                         \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        // 01. 내 지도반 존재여부 조회
        // 현재 내 지도반이 있는지 조회
        $prof       = new Professor();
        $myId       = session()->get('user')['info']->id;

        // 지도반이 없으면 지도반 생성 페이지로 이동
        if(!$prof->isExistMyGroup($myId)) {
            flash()->warning(__('message.tutor_not_exists_myclass'))->important();

            return redirect(route('tutor.myclass.create'));
        }

        // 지도반이 있으면 타이틀을 설정하고 메인 페이지로 이동
        $data = [
            'title'     => __('page_title.tutor_index')
        ];

        return view('tutor_main', $data);
    }

    // 03-01. 회원관리 기능

    /**
     * 함수명:                         store
     * 함수 설명:                      사용자의 회원가입 정보를 받아 검증 & 지도교수 데이터로 저장
     * 만든날:                         2018년 3월 28일
     *
     * 매개변수 목록
     * @param Request $request :                View 단에서 전달받은 요청 데이터
     *
     * 지역변수 목록
     * $rules(array):                  Form 데이터 유효성 검증 규칙
     *
     * 반환값
     * @return                         \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        // 01. form 입력값 검증
        $rules = [
            'id'                => 'required',
            'id_check'          => 'required|accepted',
            'name'              => 'required',
            'password'          => 'required',
            'check_password'    => 'required|same:password',
            'email'             => 'required|email',
            'phone'             => 'required|digits:11',
            'office'            => 'required'
        ];
        $this->validate($request, $rules);

        // 02. 교수 데이터 입력
        $professor = new Professor();
        $professor->id          = $request->post('id');
        $professor->name        = $request->post('name');
        $professor->password    = password_hash($request->post('password'), PASSWORD_DEFAULT);
        $professor->email       = $request->post('email');
        $professor->phone       = $request->post('phone');
        $professor->office      = $request->post('office');

        // 저장 실패시 전 페이지로 돌아감
        if(!$professor->save()) {
            flash()->error(__('message.join_failed'))->important();
            return back();
        }

        flash(__('message.join_success'));
        return redirect(route('home.index'));
    }

    /**
     * 함수명:                         check_join
     * 함수 설명:                      사용자가 입력한 ID의 현재 회원가입 여부를 조회
     * 만든날:                         2018년 3월 28일
     *
     * 매개변수 목록
     * @param $request:                View 단의 요청 메시지
     *
     * 지역변수 목록
     * $regMsg(string):                View 단에 반환할 메시지
     * $input_id(string):              사용자가 입력한 ID
     * $professor:                     입력 ID로 DB를 조회한 결과
     *
     * 반환값
     * @return                         \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function check_join(Request $request) {
        // 01. 변수 설정
        $reqMsg     = '';
        $input_id   = $request->post('id');

        // 02. 해당 학번의 가입 여부 조회
        $professor = Professor::find($input_id);

        if (strlen($input_id) > self::MIN_STRLEN && is_null($professor)) {
            $reqMsg = 'TRUE';
        } else {
            $reqMsg = "FALSE";
        }

        return response()->json(['msg' => $reqMsg], 200);
    }

    /**
     * 함수명:                         login
     * 함수 설명:                      사용자의 회원가입 정보를 받아 검증 & 지도교수 데이터로 저장
     * 만든날:                         2018년 3월 28일
     *
     * 매개변수 목록
     * @param $professor:              검증이 끝난 교수 데이터
     *
     * 지역변수 목록
     * null
     *
     * 반환값
     * @return                         \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Professor $professor) {
        // 01. 세션에 사용자 정보 등록
        $user_type = self::USER_TYPE;
        session([
            'user' => [
                'type'  => $user_type,
                'info'  => $professor
            ]
        ]);

        flash()->success(__('message.login_success', ['Name' => $professor->name]));
        return redirect(route('tutor.index'));
    }

    public function info() {
        $data = [
            'title'             => __('page_title.tutor_info'),
        ];

        return view('tutor_info', $data);
    }

    // 03-02. 지도반 관리 기능
    /**
     * 함수명:                         storeMyClass
     * 함수 설명:                      사용자의 지도반 생성
     * 만든날:                         2018년 4월 02일
     *
     * 매개변수 목록
     * @param $request:                요청 메시지
     *
     * 지역변수 목록
     * null
     *
     * 반환값
     * @return                         \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createMyClass(Request $request) {
        // 01. 요청 데이터 수신
        // 요청 데이터가 없을 경우 => 반 생성 양식을 반환
        if(is_null($request->input('name'))) {
            $data = [
                'title'     => __('page_title.tutor_myclass_create'),
                'req'       => $request
            ];

            return view('tutor_myclass_create', $data);
        }
        // 요청 데이터가 있을 경우 => 입력받은 데이터 검증
        else {
            // 데이터 검증 양식
            $this->validate($request, [
                'name'          => 'required|between:2,30',
                'school_time'   => 'required|date_format:H:i',
                'home_time'     => 'required|date_format:H:i|after:school_time'
            ]);

            // 반 생성
            $group = new Group();
            $group->tutor       = session()->get('user')['info']->id;
            $group->name        = $request->input('name');
            $group->school_time = $request->input('school_time');
            $group->home_time   = $request->input('home_time');

            if(!$group->save()) {
                flash()->error(__('message.tutor_myclass_create'))->important();

                return back();
            }

            flash()->success(__('message.tutor_store_myclass_success'));
            return redirect(route('tutor.index'));
        }
    }

    /**
     * 함수명:                         manageMyClass
     * 함수 설명:                      사용자의 지도반 학생들 목록을 출력
     * 만든날:                         2018년 4월 10일
     *
     * 매개변수 목록
     * @param $argOrder:               정렬 방식
     *
     * 지역변수 목록
     * null
     *
     * 반환값
     * @return                         \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageMyClass($argOrder = 'id') {
        // 01. 변수 설정
        $professor = Professor::find(session()->get('user')['info']->id);
        $studentList = $professor->selectStudentsOfMyClass($argOrder);

        $data = [
            'title'         => __('page_title.tutor_myclass_manage'),
            'order'         => $argOrder,
            'student_list'  => $studentList
        ];

        return view('tutor_myclass_manage', $data);
    }

    // 모바일
    public function getMyStudentsListAtAndroid() {
        $profId = session()->get('user')['info']->id;

        $studentsList = Professor::get($profId)->selectStudentsOfMyClass();
    }

    // 03-03. 알림 설정
    // 알림 설정 페이지 출력
    public function viewNeedCareConfig() {
        // 현재 지도교수가 가지고 있는 알림 데이터 확인
        $profId = session()->get('user')['info']->id;




        // View 단에 전송할 데이터 추출
        $data = [
            'title' => '관심학생 알림 설정'
        ];

        return view('tutor_myclass_care', $data);
    }

    // 알림 설정 데이터 저장
    public function storeNeedCare(Request $request) {
        // 01. 유효성 검사
        $this->validate($request, [
            'days_unit'         => 'required',
            'attendance_type'   => 'required',
            'continuity_flag'   => 'required',
            'count'             => 'required',
            'target'            => 'required',
            'input_days_unit'   => 'required_if:days_unit,input|numeric'
        ]);

        // 데이터 획득
        $myId               = session()->get('user')['info']->id;
        $days_unit          = $request->post('days_unit');
        $attendance_type    = $request->post('attendance_type');
        $continuity_flag    = $request->post('continuity_flag');
        $count              = $request->post('count');
        $target             = $request->post('target');
        $input_days_unit    = $request->has('input_days_unit') ? $request->post('input_days_unit') : NULL;

        // 데이터 가공
        // 관측 기간
        $days = null;
        switch($days_unit) {
            case 'week':
                $days = 7;
                break;
            case 'month':
                $days = 30;
                break;
            case 'input':
                $days = $input_days_unit;
                break;
        };


        $notification_flag = null;
        switch($continuity_flag) {
            case true:
            case 'true':
                switch($attendance_type) {
                    case 'late':
                        $notification_flag = 0;
                        break;
                    case 'early':
                        $notification_flag = 1;
                        break;
                    case 'absence':
                        $notification_flag = 2;
                        break;
                }
                break;
            case false:
            case 'false':
                switch($attendance_type) {
                    case 'late':
                        $notification_flag = 3;
                        break;
                    case 'early':
                        $notification_flag = 4;
                        break;
                    case 'absence':
                        $notification_flag = 5;
                        break;
                }
                break;
        }

        // 알림 대상 설정
        $alertStd = false;
        $alertProf = false;
        switch($target) {
            case 'tutor':
                $alertProf = true;
                break;
            case 'student':
                $alertStd = true;
                break;
            case 'both':
                $alertProf = true;
                $alertStd = true;
                break;
        }


        // 알림 설정 저장
        if(NeedCareAlert::insert($myId, $days, $notification_flag, $count, $alertStd, $alertProf) != false) {
            flash()->success('알림 추가하였습니다.');
        } else {
            flash()->error('알림 추가에 실패하였습니다.');
        }
        return back();
    }

    // 03-03. 상담 관리


    // 03-04. 관리 & 설정
    // 학생 목록 저장 페이지 출력
    public function getStudentStorePage() {
        // View 단에 반환할 데이터 바인딩
        $data = [
            'title'     => '지도교수: 정보등록',
        ];

        return view('tutor_config_store_student', $data);
    }

    // 엑셀을 이용한 학생 목록 조회
    public function selectStudentsListAtExcel(Request $request) {
        // 01. 입력값 검증
        $this->validate($request, [
            'std_list'  => 'required|file|mimes:xlsx,xls,csv',
            'student_type'      => 'required|in:freshman,enrolled'
        ]);

        // 02. 변수 설정
        $stdType = $request->post('student_type');
        $file = $request->file('std_list');
        $fileType = ($array = explode('.', $file->getClientOriginalName()))[sizeof($array) - 1];


        return json_encode(app('App\Http\Controllers\ExcelController')->importStudentsList($stdType, $file->path(), $fileType));
    }

    // 조회한 학생 목록에서 선택된 학생 목록을 저장
    public function insertStudentsList(Request $request) {
        // 01. 데이터 유효성 검사
        $this->validate($request, [
            'student_list'      => 'required',
        ]);

        return var_dump($request->post('student_list'));
    }
}
