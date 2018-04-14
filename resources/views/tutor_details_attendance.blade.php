<?php
/**
 * 페이지 설명: <지도교수> 내 학생 상세 정보 확인 페이지 - 출결 정보
 * User: Seungmin Lee
 * Date: 2018-04-14
 * Time: 오후 7:03
 */
?>
@extends('layouts.tutor_details_master')
@section('details.section')
    <!-- 상단 인터페이스 => 등/하교 출결, 분석  -->
    <div>
        <b>등/하교 출결</b>
        <a href="">출결 분석</a>
    </div>
    <hr>
    <!-- 하단 인터페이스 => 출결 그래프, 상세 -->
    <div>
        <!-- 출결 그래프 -->
        <div>
            <h3>출결 그래프</h3>
            <!-- 조회 기간 선택 -->
            <div>
                <input type="button" value="연간">
                <input type="button" value="월간">
                <input type="button" value="주간">
                <input type="button" value="@lang('pagination.previous')"> {{-- 지난 페이지 --}}
                <span>2018년 2월{{-- 현재 일자 --}}</span>
                <input type="button" value="@lang('pagination.next')">{{-- 다음 패이지 --}}
            </div>
            <!-- 그래프 자리 -->
            <div>
                <div>{{-- 출석 --}}</div>
                <div>{{-- 지각 --}}</div>
                <div>{{-- 결석 --}}</div>
                <div>{{-- 조퇴 --}}</div>
            </div>
        </div>
        <!-- 상세 정보 -->
        <div>
            <h3>상세</h3>
            <!-- 출결 정보  -->
            <table border="1">
                <!-- 총 *** 횟수 -->
                <tr>
                    <th>총 출석횟수</th>
                    <td></td>
                    <th>총 지각횟수</th>
                    <td></td>
                    <th>총 결석횟수</th>
                    <td></td>
                    <th>총 조퇴횟수</th>
                    <td></td>
                </tr>
                <!-- 최근 등교 시각, 연속 *** 횟수 -->
                <tr>
                    <th>최근 등교시각</th>
                    <td></td>
                    <th>연속 지각횟수</th>
                    <td></td>
                    <th>연속 결석횟수</th>
                    <td></td>
                    <th>연속 조퇴횟수</th>
                    <td></td>
                </tr>
                <tr>
                    <th>최근 하교시각</th>
                    <td></td>
                    <th>최근 지각일자</th>
                    <td></td>
                    <th>최근 결석일자</th>
                    <td></td>
                    <th>최근 조퇴일지</th>
                    <td></td>
                </tr>
            </table>
            <table border="1">
                <thead>
                    <tr>
                        <th>날짜</th>
                        <th>출결</th>
                        <th>시간</th>
                        <th>비고</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
