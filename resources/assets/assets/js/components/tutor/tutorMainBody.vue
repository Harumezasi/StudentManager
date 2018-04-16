<template>

<!-- Contents ( Main Image, Notice ) -->
<div class="contents">
  <!-- Parallax Scroll -->
  <section>
    <v-parallax src="/images/bg.png" height="740"></v-parallax>
  </section>

  <!-- All Layout -->
  <v-layout column wrap class="my-5" align-center>

    <v-flex xs12 sm4 class="my-3">
      <div class="text-xs-center">
        <h2 class="headline">NOTICE</h2>
        <span class="subheading"> 최신 알림을 확인해보세요.</span>
      </div>
    </v-flex>
    <v-flex xs12>
      <v-container grid-list-xl>
        <v-layout row wrap align-center>
          <v-flex xs12 md6>
            <v-card hover>
              <v-card-title primary-title class="layout justify-center">
                <div class="headline">
                  <v-icon>notifications</v-icon>&nbsp;최근 알림</div>
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
                <div class="headline">
                  <v-icon>directions_run</v-icon>&nbsp;금일 지각자</div>
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
                <div class="headline text-xs-center">
                  <v-icon>face</v-icon>&nbsp;상담요청</div>
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
                <div class="headline text-xs-center">
                  <v-icon>favorite</v-icon>&nbsp;사랑이 필요한 학생</div>
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
  <v-footer height="auto" class="blue lighten-2">
    <v-layout row wrap justify-center>
      <v-btn color="white" flat v-for="link in links" :key="link">
        {{ link }}
      </v-btn>
      <v-flex xs12 py-3 text-xs-center white--text>
        &copy;2018 — <strong>すくすく</strong>
      </v-flex>
    </v-layout>
  </v-footer>
</div>

</template>

<style>
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

</style>

<script>
export default {
  data: () => ({
    /*--- Jclass Menu ---*/
    JclassItems: [{
        title: '출결관리',
        path: '/attendanceCheck'
      },
      {
        title: '성적관리',
        path: '/gradeRegister'
      }
    ],
    /*--- Consulting Management Menu ---*/
    consultItems: [{
        title: '상담요청하기',
        path: '/attendanceCheck'
      },
      {
        title: '상담요청확인',
        path: '/gradeRegister'
      }
    ],
    links: ['Home', 'About Us', 'Services', 'Contact Us']
  })
}
</script>
