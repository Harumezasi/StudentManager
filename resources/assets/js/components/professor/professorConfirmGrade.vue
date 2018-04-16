<template>
<div>
  <v-parallax src="../images/grade.jpg" height="400">
    <v-layout column align-center justify-center class="black--text">
      <h1 class="attendanceCheckTitleEng text-xs-center">성적 확인</h1>
      <h1 class="attendanceCheckTitleJap text-xs-center"></h1>
    </v-layout>
  </v-parallax>

  <v-tabs fixed-tabs>
    <v-tab :to="{path:'gradeRegister'}">
      성적등록
    </v-tab>
    <v-tab :to="{path:'confirmGrade'}">
      성적확인
    </v-tab>
  </v-tabs>
</div>
</template>

<style>
.contents {
  text-align: center;
}

.attendanceCheckTitleEng {
  color: white;
  font-family: inherit;
}

.attendanceCheckTitleJap {
  color: rgb(0, 0, 0);
  font-size: 20px;
  font-family: MS Gothic;
}

.custom-loader {
  animation: loader 1s infinite;
  display: flex;
}

@-moz-keyframes loader {
  from {
    transform: rotate(0);
  }
  to {
    transform: rotate(360deg);
  }
}

@-webkit-keyframes loader {
  from {
    transform: rotate(0);
  }
  to {
    transform: rotate(360deg);
  }
}

@-o-keyframes loader {
  from {
    transform: rotate(0);
  }
  to {
    transform: rotate(360deg);
  }
}

@keyframes loader {
  from {
    transform: rotate(0);
  }
  to {
    transform: rotate(360deg);
  }
}
</style>

<script>
export default {
  data() {
    return {
      loader: null,
      loading1: false,
      loading2: false
    }
  },
  watch: {
    loader() {
      const l = this.loader
      this[l] = !this[l]

      setTimeout(() => (this[l] = false), 3000)

      this.loader = null
    }
  }
}
</script>
