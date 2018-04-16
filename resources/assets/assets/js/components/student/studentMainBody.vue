<template>
    <!-- Contents ( Main Image, Notice ) -->
    <div class="contents">

      <!-- Parallax Scroll -->
      <section>
        <v-parallax src="/images/bg.png" height="740"></v-parallax>
      </section>

      <!-- Main Contents Section -->
      <v-layout column wrap class="my-5" align-center>
        <v-flex xs12 sm4 class="my-3">
          <div class="text-xs-center">
            <!-- NOTICE -->
            <h2 class="headline">NOTICE</h2>
            <span class="subheading"> 최신 알림을 확인해보세요.</span>
          </div>
        </v-flex>
        <v-flex xs12>
          <v-container grid-list-xl>
            <v-layout row wrap align-center>
              <!-- Notice: 최근알림 -->
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
              <!-- Notice: 최근출결 -->
              <v-flex xs12 md6>
                <v-card hover>
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline">
                      <v-icon>directions_walk</v-icon>&nbsp;최근 출결</div>
                    <v-btn flat class="blue--text">Read More</v-btn>
                  </v-card-title>
                  <v-card-text>
                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse
                    potenti.
                  </v-card-text>
                </v-card>
              </v-flex>
              <!-- Notice: 성적 등록 알림 -->
              <v-flex xs12 md6>
                <v-card hover>
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline text-xs-center">
                      <v-icon>check</v-icon>&nbsp;성적 등록 알림</div>
                    <v-btn flat class="blue--text">Read More</v-btn>
                  </v-card-title>
                  <v-card-text>
                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse
                    potenti.
                  </v-card-text>
                </v-card>
              </v-flex>
              <!-- Notice: 오늘의 강의 -->
              <v-flex xs12 md6>
                <v-card hover>
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline text-xs-center">
                      <v-icon>event</v-icon>&nbsp;오늘의 강의</div>
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

      <!-- Footer -->
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
    /*-- Footer Link --*/
    links: ['Home', 'About Us', 'Services', 'Contact Us']

  })
}
</script>
