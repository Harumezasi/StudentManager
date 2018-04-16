  <template>
      <!-- Header ( toolbar, menu ) -->
      <div class="header bv-example-row bv-example-row-flex-cols">
        <!-- Toolbar -->
        <v-toolbar flat color = "white" fixed >
          <!-- Toolbar: Logo Section -->
          <v-toolbar-title>
            <router-link to = "/professor/main"><img class="logo-box" src="../images/logo.png"></router-link>
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <!-- Toolbar: Menu Section -->
          <v-toolbar-items class="hidden-sm-and-down">
          <!-- Menu: JCLASS -->
          <v-menu open-on-hover>
            <v-btn flat slot="activator">JCLASS</v-btn>
            <!-- JCLASS: Attendance, Grade Menu -->
            <v-list>
              <router-link
              :key = "item.id"
              tag = "v-list-tile"
              v-for="item in JclassItems"
              :to = "item.path"
               @click="">
                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
              </router-link>
            </v-list>
          </v-menu>
          <!-- Menu: Consulting Management -->
          <v-menu open-on-hover>
            <v-btn flat slot="activator">상담관리</v-btn>
            <!-- Consulting Management: Confirm Request, Consulting Request -->
            <v-list>
              <router-link
              :key = "item.id"
              tag = "v-list-tile"
              v-for="item in consultItems"
              :to = "item.path"
               @click="">
                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
              </router-link>
            </v-list>
          </v-menu>
        </v-toolbar-items>
        <!-- 로그아웃 버튼 -->
        <div class="logoutButton">
          <div class="effect"></div>
            <a href="/logout"> LOGOUT </a>
        </div>
      </v-toolbar>
    </div>
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

/*--- background-color ---*/
 .header, .contents, .footer {
  background-color: rgb(255, 255, 255);
}

/*-- Header --*/
.header {
  padding: 20px;
  margin-bottom: 20px;
}

/*-- Logo Box --*/
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
  data: () => ({
    /*--- Jclass Menu ---*/
    JclassItems: [{
        title: '출결관리',
        path: 'attendanceCheck',
        key : 1
      },
      {
        title: '성적관리',
        path: 'gradeRegister',
        key : 2
      }
    ],
    /*--- Consulting Management Menu ---*/
    consultItems: [{
        title: '상담요청하기',
        path: 'attendanceCheck',
        key : 1
      },
      {
        title: '상담요청확인',
        path: 'gradeRegister',
        key : 2
      }
    ]
  })
}
</script>
