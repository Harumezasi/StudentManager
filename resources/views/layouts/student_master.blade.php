<?php
/**
 * Created by PhpStorm.
 * User: Seungmin Lee
 * Date: 2018-03-26
 * Time: 오후 7:10
 */
?>
@extends('layouts.master')
@section('body.header')
    @include('partials.logout')
    <!-- 툴바는 추후 삭제예정 -->
    @include('partials.student_toolbar')
    <!-- 섹션은 제일 아래에 추가된다. -->
@endsection
