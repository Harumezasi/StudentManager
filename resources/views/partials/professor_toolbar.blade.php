<?php
/**
 * Created by PhpStorm.
 * User: Seungmin Lee
 * Date: 2018-03-26
 * Time: 오후 7:10
 */
?>

<div id='professor_menu'>
  <div class='professor_top_menu'>
    <div>&lt;교과목교수&gt;프로젝트 로고</div>
    <a href="#" v-on:mouseover="menu_change(1)"><div>회원정보</div></a>
    <a href="{{ route('professor.lecture.main') }}" v-on:mouseover="menu_change(2)"><div>수강반</div></a>
    <a href="#" v-on:mouseover="menu_change(3)"><div>상담관리</div></a>
  </div>
  <div class='professor_bottom_menu' v-if="menuNumber != 0">
    <div class='professor_bottom_menu_info' v-if="menuNumber == 1" style="background-color:gray">테스트1</div>
    <div class='professor_bottom_menu_lecture' v-else-if="menuNumber == 2" style="background-color:yellow">테스트2</div>
    <div class='professor_bottom_menu_advice' v-else-if="menuNumber == 3" style="background-color:cyan">테스트3</div>
  </div>
</div>
@section('script_toolbar')
<script>
  new Vue({
    el:'#professor_menu',
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
#professor_menu {

}

.professor_top_menu {
  width : 100%;
  min-width: 1500px;
  height: 100px;
  border: 1px solid black;
}

.professor_top_menu div {
  float: left;
  width : 300px;
  height: 100px;
  margin : 0px 25px;
  border: 1px solid black;
}

.professor_top_menu a {
  width: 100%;
  height: 100%;
}

.professor_bottom_menu {
  width: 100%;
  min-width: 1500px;
  height: 50px;
  background-color: black;
}

.professor_bottom_menu div {
  width : 300px;
  height: 50px;
  border: 1px solid black;
}
</style>
@endsection
