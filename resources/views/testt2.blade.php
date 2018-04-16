<!DOCTYPE html>
<html>
<head>
  <title>Vuetify Parallax Starter</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
  <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
</head>
<body>
 <div id="app">
   <v-app>
     <!-- Logo Section -->
     <div class="header bv-example-row bv-example-row-flex-cols">
       <v-toolbar flat color = "white">
         <v-toolbar-title>
         <router-link to = "/homeMain"><img class="logo-box" src="{{asset('js/components/images/logo.png')}}" /></router-link>
       </v-toolbar-title>
         <v-spacer></v-spacer>
         <v-toolbar-items class="hidden-sm-and-down">
           <v-menu open-on-hover>
             <v-btn flat slot="activator">JCLASS</v-btn>

             <v-list>
               <router-link
               tag = "v-list-tile"
               v-for="item in listitems"
               :to = "item.path"
                @click="">
                 <v-list-tile-title>{{ item.title }}</v-list-tile-title>
               </router-link>
             </v-list>
           </v-menu>
           <v-btn flat>상담관리</v-btn>
           <v-btn flat>설정관리</v-btn>
         </v-toolbar-items>
       </v-toolbar>
     </div>
     <!-- Contents ( Image, Notice ) -->
     <div class="contents">
       <section>
         <v-parallax src="/images/bg.png" height="650"></v-parallax>
       </section>
       <!-- <slide-y-up-transition  >
           <div v-show="show">Your content here</div>

         </slide-y-up-transition> -->
         <v-layout
              column
              wrap
              class="my-5"
              align-center
            >
         <v-flex xs12 sm4 class="my-3">
                <div class="text-xs-center">
                  <h2 class="headline">NOTICE</h2>
                  <span class="subheading">
                    최신 알림을 확인해보세요.
                  </span>
                </div>
              </v-flex>
       <v-flex xs12>
         <v-container grid-list-xl>
           <v-layout row wrap align-center>
             <v-flex xs12 md6>
               <v-card hover>
                 <v-card-title primary-title class="layout justify-center">
                   <div class="headline"><v-icon>notifications</v-icon>&nbsp;최근 알림</div>
                   <v-btn flat class="blue--text">Read More</v-btn>
                 </v-card-title>
                 <v-card-text>
                   Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse
                   potenti.
                 </v-card-text>
               </v-card>
             </v-flex>
             <v-flex xs12 md6>
               <v-card hover>
                 <v-card-title primary-title class="layout justify-center">
                   <div class="headline"><v-icon>directions_run</v-icon>&nbsp;금일 지각자</div>
                   <v-btn flat class="blue--text">Read More</v-btn>
                 </v-card-title>
                 <v-card-text>
                   Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse
                   potenti.
                 </v-card-text>
               </v-card>
             </v-flex>
             <v-flex xs12 md6>
               <v-card hover>
                 <v-card-title primary-title class="layout justify-center">
                   <div class="headline text-xs-center"><v-icon>face</v-icon>&nbsp;상담요청</div>
                   <v-btn flat class="blue--text">Read More</v-btn>
                 </v-card-title>
                 <v-card-text>
                   Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse
                   potenti.
                 </v-card-text>
               </v-card>
             </v-flex>
             <v-flex xs12 md6>
               <v-card hover>
                 <v-card-title primary-title class="layout justify-center">
                   <div class="headline text-xs-center"><v-icon>favorite</v-icon>&nbsp;사랑이 필요한 학생</div>
                   <v-btn flat class="blue--text">Read More</v-btn>
                 </v-card-title>
                 <v-card-text>
                   Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse
                   potenti.
                 </v-card-text>
               </v-card>
             </v-flex>
           </v-layout>
         </v-container>
       </v-flex>
     </v-layout>
     </div>
   </v-app>
 </div>
 <script src="https://unpkg.com/vue/dist/vue.js"></script>
 <script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>
 <script>
   new Vue({
    el: '#app',
    data : {
      listitems: [{
          title: '출결관리',
          path: '/attendanceCheck'
        },
        {
          title: '학생관리',
          path: '/studentAdministration'
        },
        {
          title: '알림설정',
          path: '/notificationSetting'
        }
      ]
    }
  })
 </script>
</body>
</html>
