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
            <form action="" method="post">
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
                        <option value="1">출석</option>
                        <option value="2">지각</option>
                        <option value="3">결석</option>
                        <option value="4">조퇴</option>
                    </select>
                </label>
                을
                <label>
                    <select name="continuity_flag">
                        <option value="true">연속</option>
                        <option value="false">누적</option>
                    </select>
                </label>
                <input type="number" name="count" max="99">
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

    </div>
@endsection