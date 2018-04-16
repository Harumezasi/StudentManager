<?php
/**
 * Created by PhpStorm.
 * User: Seungmin Lee
 * Date: 2018-03-26
 * Time: 오후 7:10
 */
?>
<div id='student_menu'>
  <div class='student_top_menu'>
    <div>&lt;학생&gt;프로젝트 로고</div>
    <a v-on:mouseover="menu_change(1)" href="{{ route('student.attendance') }}"><div>@lang('attendance.title')</div></a>
    <a v-on:mouseover="menu_change(2)" href="{{ route('student.lecture.main') }}"><div>@lang('lecture.title')</div></a>
    <a v-on:mouseover="menu_change(3)" href="#"><div>상담 관리</div></a>
  </div>
</div>
@section('script_toolbar')
<script>
  new Vue({
    el:'#student_menu',
    data : {
      menuNumber : 0
    },
    methods : {
      menu_change : function(num){
        this.menuNumber = num;
        console.log(this.menuNumber);
      }
    }
  })
</script>
@endsection
@section('style_toolbar')
<style>
#student_menu {

}

.student_top_menu {
  width : 100%;
  min-width: 1500px;
  height: 100px;
  border: 1px solid black;
}

.student_top_menu div {
  float: left;
  width : 300px;
  height: 100px;
  margin : 0px 25px;
  border: 1px solid black;
}

.student_top_menu a {
  width: 100%;
  height: 100%;
}
</style>
@endsection
