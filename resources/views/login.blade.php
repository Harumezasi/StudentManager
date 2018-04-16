<?php
/**
 * Created by PhpStorm.
 * 페이지 설명: 메인 로그인 페이지
 * User: Seungmin Lee
 * Date: 2018-03-15
 * Time: 오후 3:44
 */
?>
@extends('layouts.master')
@section('body.section')
<div id=login_layout>
  <div id=login_topscreen>
  <div id=login_screen>
    <form method="post" action="{{ route('home.login') }}">
        {!! csrf_field() !!}
        <!-- 로그인 상단부 -->
        <div id="login_top">
          <!-- 로그인 로고 -->
          <div id="login_logo">
            Login
          </div>
          <!-- 학생 버튼 -->
          <div id='login_select'>
            <div class="login_select_button">
              <div>
                <label for="student">@lang('account.student')</label>
                <input type="radio" name="type" value="{{ $user_type['student'] }}" id="student" required>
                {!! $errors->first('student', '<span class="form-error">:message</span>') !!}
              </div>
            </div>
            <!-- 교수 버튼 -->
            <div class="login_select_button">
              <div>
                <label for="professor">@lang('account.professor')</label>
                <input type="radio" name="type" value="{{ $user_type['professor'] }}" id="professor">
                {!! $errors->first('professor', '<span class="form-error">:message</span>') !!}
              </div>
            </div>
          </div>
        </div>
        <!-- 로그인 중앙부 -->
        <div id=login_middle>
          <!-- 로그인 정보입력 -->
          <div id=login_input>
            <div class=login_input_area>
                <label for="id">@lang('account.id')</label>
                <input type="text" name="id" id="id" value="{{ old('id') }}" required>
                {!! $errors->first('id', '<span class="form-error">:message</span>') !!}
            </div>
            <div class=login_input_area>
                <label for="password">@lang('account.pw')</label>
                <input type="password" id="password" name="password" required>
                {!! $errors->first('password', '<span class="form-error">:message</span>') !!}
            </div>
          </div>
          <!-- 로그인 액션 -->
          <div id=login_action>
              <button type="submit">@lang('interface.login')</button>
          </div>
      </div>
      <!-- 회원가입 및 아이디/비밀번호 찾기 -->
      <div id=login_join_other>
        <div><a href="{{ route('home.join') }}">@lang('interface.join')</a></div>
        <div><a href="{{ route('home.forgot') }}">@lang('interface.forgot')</a></div>
      </div>
    </form>
  </div>
    <!-- 광고 배너 -->
    <div id=login_banner_screen>

    </div>
</div>
</div>
@endsection
@section('script')
<script>

</script>
@endsection
@section('style')
<style>
  #login_layout {
    width: 900px;
    height: 270px;
    background-color: rgba( 204, 204, 204, 0.9 );
    border-radius:10px;
  }

  #login {
    width: 840px;
    height: 270px;
    margin: auto;
  }

  #login_top {
    width : 400px;
    line-height: 100px;
  }

  #login_logo{
    width: 200px;
    height: 100px;
    float:left;
    font-size: 50px;
    font-family: cursive;
    text-align: center;
  }

  #login_select {
    text-align: right;
    float:right;
  }

  #login_select{
    height: 100px;
  }

  .login_select_button{
    display: inline-block;
    float:left;
    height: 100px;
    position: relative;
  }

  .login_select_button div {
    width: 100px;
    line-height: 50px;
    display: inline-block;
    vertical-align: bottom;
  }

  .login_select_button label {
    font-size : 20px;
  }

  #login_middle {
    display: inline-block;
    width: 400px;
  }

  #login_input {
    width: 300px;
    height: 100px;
    float:left;

  }

  .login_input_area label {
    width: 50px;
    height: 50px;
    margin: 0px;
    font-size: 30px;
    text-align: center;
  }

  .login_input_area input {
    float:right;
    width: 240px;
    height: 50px;
  }

  #login_action {
    float:left;
  }

  #login_action button {
    width: 100px;
    height: 100px;
  }

  #login_join_other {
    width: 400px;
  }

  #login_join_other div {
    float:left;
    width: 200px;
    line-height: 50px;
    text-align: center;
  }

  #login_join_other a {
    vertical-align: middle;
  }

  #login_screen {
    width:400px;
    height: 250px;
    float: left;
    margin: 10px;
  }

  #login_banner_screen {
    width: 400px;
    height: 250px;
    background-color: black;
    border-radius: 10px;
    float:left;
    margin: 10px;
  }
</style>
@endsection
