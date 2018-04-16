<template>
  <div>
    <!-- Toolbar -->
    <v-toolbar app flat color="white" fixed v-show="!login">
      <!-- Toolbar: Logo Section -->
      <v-toolbar-title>
        <router-link to="/student/main"><img class="logo-box" src="/images/logo.png" /></router-link>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <!-- Toolbar: Menu Section -->
      <v-toolbar-items class="hidden-sm-and-down">
        <v-btn flat slot="activator" v-for="item in studentMenu" :to="item.link" :key = "item.key">{{item.title}}</v-btn>
      </v-toolbar-items>
      <!-- 로그아웃 버튼 -->
      <div class="logoutButton">
        <a href="/logout">LOGOUT</a>
        <div class="effect"></div>
      </div>
    </v-toolbar>
  </div>
</template>

<style>
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
</style>

<script>

export default {
  data : () =>({
    login : true,
    studentMenu : [
      {title : '출결관리',link : '/student/attendanceManagement', key: 1},
      {title : '학업관리',link : '/student/gradeManagement',  key: 2},
      {title : '상담관리',link : '/student/consultingManagement',  key: 3},
    ]
  }),
  created : function () {
    this.login = (this.$route.path == '/' ? true : false) ;
  }
}
</script>
