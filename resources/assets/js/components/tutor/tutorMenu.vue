<template>
    <!-- Toolbar -->
    <v-toolbar app flat color="white" fixed v-show="!login">
      <!-- Toolbar: Logo Section -->
      <v-toolbar-title>
        <router-link to="/tutor/main"><img class="logo-box" src="/images/logo.png" /></router-link>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <!-- Toolbar: Menu Section -->
      <v-toolbar-items class="hidden-sm-and-down" v-for="item in tutorMenu" :key="item.key">
        <v-menu v-if="item.hover" open-on-hover bottom>
          <v-btn flat slot="activator" :to="item.link">{{item.title}}</v-btn>
          <v-list>
            <!-- 튜터 부분에 호버 메뉴 (출결관리) 부분과 관련된곳 -->
            <v-list-tile v-for="hoverItem in item.hover" :key="hoverItem.title" router :to="hoverItem.link">
              <v-list-tile-title>{{ hoverItem.title }}</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
        <v-btn v-else flat slot="activator" :to="item.link">{{item.title}}</v-btn>
      </v-toolbar-items>
      <!-- 로그아웃 버튼 -->
      <div class="logoutButton">
        <a href="/logout"> LOGOUT </a>
        <div class="effect"></div>
      </div>
    </v-toolbar>
</template>

<style>
.logoutButton {
  width:140px;
  height:50px;
  border:2px solid #0897ee;
  float:left;
  text-align:center;
  cursor:pointer;
  position:relative;
  box-sizing:border-box;
  overflow:hidden;
  margin:0 0 1px 50px;
}
.logoutButton a{
  font-family:arial;
  font-size:16px;
  color:#0897ee;
  text-decoration:none;
  line-height:50px;
  transition:all .5s ease;
  z-index:2;
  position:relative;
}
.effect{
  width:140px;
  height:50px;
  top:-50px;
  background:#0897ee;
  position:absolute;
  transition:all .5s ease;
  z-index:1;
}
.logoutButton:hover .effect{
  top:0;
}
.logoutButton:hover a{
  color:#fff;
}
/* end */

.logo-box {
  width: 150px;
  height: auto;
}

/*-- Responsive Web Settings --*/
@media ( max-width: 480px) {
  .container {
    width: auto;
  }
  .content {
    float: none;
    width: auto;
  }
}
</style>

<script>

export default {
  data : () =>({
    tutorMenu : [{
      title : '출결관리',
      hover : [
               { title: '등/하교 출결', link : '/tutor/attendance' },
               { title: '알림 설정', link : '/tutor/alertStudentSetting' },
      ]},
      { title : '학생관리', link : '/tutor/studentManagement'},
      { title : '설정/관리', link : '/tutor/main'},
    ],
    login : true
  }),
  created : function () {
    this.login = (this.$route.path == '/' ? true : false) ;
  }
}
</script>
