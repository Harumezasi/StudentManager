<template>
  <v-app>
    <v-parallax src="/images/attendance.jpg" height="400">
      <v-layout
        column
        align-center
        justify-center
        class="black--text"
       >
       <h1 class="attendanceCheckTitleEng text-xs-center">Attendance Management</h1>
       <h1 class="attendanceCheckTitleJap text-xs-center">테스트중</h1>
     </v-layout>
    </v-parallax>

    <v-tabs fixed-tabs>
      <v-tab
      v-for="menuTitle in menu"
      :key = "menuTitle.key"
      :to="{path:menuTitle.link}"
      >
        {{ menuTitle.title }}
      </v-tab>
    </v-tabs>

  <div>
    Sorry is not data
  </div>
</v-app>
</template>
<script>
export default {
  data() {
    return {
      menu : [
        { title: '출결확인', link: 'attendanceCheck', key: 1},
        { title: '출결내역', link: 'attendanceList', key: 2}
      ]
    }
  }
}
</script>
