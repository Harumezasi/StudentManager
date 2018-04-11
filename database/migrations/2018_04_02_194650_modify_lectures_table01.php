<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 클래스명:                       ModifyLecturesTable01
 * 클래스 설명:                    강의 테이블의 첫번째 변경에 대해 관리하는 마이그레이션
 * 만든이:                         3-WDJ 1401213 이승민
 * 만든날:                         2018년 4월 02일
 */
class ModifyLecturesTable01 extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        /**
         *  DB 스키마 변경 내역
         *
         *  작성일자    : 2018년 4월 02일
         *  작성자      : 1401213 이승민
         *
         *  이슈 발생 테이블:  lectures (개설 강의)
         *  이슈: 본래의 의도와 달리 칼럼의 제약조건 규칙에 nullable 이 적용되지 않음
         *
         *  변경 요소
         *      Attendances (출석)
         *          	기존 칼럼의 변경
         *              	divided_class_id (int) – 제약조건 변경
         *                  	분반 코드
         *                  	변경: NOT NULL 제약조건 삭제
         */

        Schema::table('lectures', function(Blueprint $table) {
            $table->string('divided_class_id', 2)->nullable()->default(NULL)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::table('lectures', function(Blueprint $table) {
            $table->string('divided_class_id', 2)->nullable(FALSE)->change();
        });
    }
}
