<?php
/**
 * 페이지 설명: <지도교수> 학생별 코멘트 확인 페이지
 * User: Seungmin Lee
 * Date: 2018-04-13
 * Time: 오전 2:11
 */
?>
@extends('layouts.tutor_master')
@section('body.section')
    <!-- 알림 추가 -->
    <div>
        <h2>알림 추가</h2>
        <span>
            <form action="{{ route('tutor.myclass.needcare.store') }}" method="post">
                {{ csrf_field() }}
                <label>
                    <select name="days_unit">
                        <option value="week">일주일</option>
                        <option value="month">한 달</option>
                        <option value="input">직접 설정</option>
                    </select>
                </label>
                동안
                <label>
                    <select name="attendance_type">
                        <option value="late">지각</option>
                        <option value="absence">결석</option>
                        <option value="early">조퇴</option>
                    </select>
                </label>
                을
                <label>
                    <select name="continuity_flag">
                        <option value="true">연속</option>
                        <option value="false">누적</option>
                    </select>
                </label>
                <input type="number" name="count" min="1" max="99" required>
                회 이상 할 경우
                <label>
                    <select name="target">
                        <option value="tutor">나</option>
                        <option value="student">학생</option>
                        <option value="both">나와 학생</option>
                    </select>
                </label>
                에게 알림
                <input type="submit" value="추가">
            </form>
        </span>
    </div>
    <!-- 알림 확인 -->
    <div>
        <h2>알림 설정</h2>
        <select name="days_unit">

        </select>
    </div>
@endsection
@section('script')
    <script language="JavaScript">
        $(document).ready(function() {
            // 기간 선택자 이벤트 설정 (사용자가 직접 입력을 선택하면 => 입력창 출력
            $('select[name=days_unit]').each(function () {

                $(this).change(function() {
                    if($(this).val() === 'input') {
                        $(this).parent().append(
                            $('<input type="number" min="1" max="99" name="input_days_unit" required>')
                        );
                    } else {
                        $(this).next().remove();
                    }
                });
            });
        });
    </script>
@endsection