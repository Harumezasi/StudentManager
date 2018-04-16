<?php
/**
 * Created by PhpStorm.
 * User: Seungmin Lee
 * Date: 2018-03-27
 * Time: 오후 12:32
 */
?>
<div>
  <span>{{ session()->get('user')['info']->name }}</span>님 안녕하세요.
  <a href="{{ route('home.logout') }}">
    <Button id="logout_Button">@lang('interface.logout')</button>
  </a>
</div>
@section('style_logout')
<style>
  #logout_Button {
    width: 100px;
    height: 50px;
  }
</style>
@endsection
