<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 클래스명:                       Classification
 * 클래스 설명:                    출석 유형 테이블과 연결하는 모델
 * 만든이:                         3-WDJ 1401213 이승민
 * 만든날:                         2018년 3월 19일
 */
class Classification extends Model {
    // 01. 멤버 변수 설정
    public $timestamps  = false;

    // 02. 생성자 정의
    // 03. 멤버 메서드 정의
    /**
     * 함수명:                         comeSchool
     * 함수 설명:                      출석 유형 테이블과 등교 테이블의 연결 관계를 정의
     * 만든날:                         2018년 3월 19일
     *
     * 매개변수 목록
     * null
     *
     * 지역변수 목록
     * null
     *
     * 반환값
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comeSchool() {
        return $this->hasMany('App\ComeSchool', 'classification', 'id');
    }

    /**
     * 함수명:                         leaveSchool
     * 함수 설명:                      출석 유형 테이블과 하교 테이블의 연결 관계를 정의
     * 만든날:                         2018년 3월 19일
     *
     * 매개변수 목록
     * null
     *
     * 지역변수 목록
     * null
     *
     * 반환값
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaveSchool() {
        return $this->hasMany('App\LeaveSchool', 'classification', 'id');
    }
}
