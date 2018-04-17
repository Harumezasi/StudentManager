<template>
<div>
  <!-- 패럴렉스 스크롤 -->
  <v-parallax src="/images/grade.jpg" height="400">
    <v-layout column align-center justify-center class="black--text">
      <h1 class="attendanceCheckTitleEng text-xs-center">학업관리</h1>
      <h1 class="attendanceCheckTitleJap text-xs-center"></h1>
    </v-layout>
  </v-parallax>

  <div class="contents">
    <v-layout column align-center>
          <!-- 출석 관련 표로 보기 영역 -->
          <!-- 기간 -->
          <v-flex xs12>
            <div class="termArea">
              {{ days.year }}년도 {{ days.term }}
            </div>
          </v-flex>
          <!-- 성적 -->
          <v-flex xs12>
            <!-- 반복문 -->
            <div v-for="datas in gradeData" :key="datas.key" class="studentInfoArea">
              <table class="gradeDataTable">
                <tr>
                  <!-- 이미지 들어갈 자리-->
                  <td rowspan="5"><img :src="datas.prof_info.face_photo"></img></td>
                  <td v-for="types in gradeType">{{types}}</td>
                </tr>
                <tr>
                  <td v-for="scores1 in datas.score[1]">{{scores1}}</td>
                </tr>
                <tr>
                  <td v-for="scores1 in datas.score[2]">{{scores1}}</td>
                </tr>
                <tr>
                  <td v-for="scores1 in datas.score[3]">{{scores1}}</td>
                </tr>
                <tr>
                  <td v-for="scores1 in datas.score[4]">{{scores1}}</td>
                </tr>
                <tr>
                <!-- 강의명 -->
                  <td> {{ datas.title }} </td>
                  <td colspan="6"> 학업성취도 : {{ datas.achievement }} %</td>
                </tr>
              </table>
              <!-- 상세보기 -->
              <button>상세보기</button>
              <div>
                <table class="gradeDataTablePlus">
                  <tr>
                    <td v-for="type in plusType">{{type}}</td>
                  </tr>
                  <tr v-for="gainedData in datas.gained_score">
                    <td v-for="datas in gainedData">{{ datas }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </v-flex>

    </v-layout>
  </div>
</div>
</template>

<style>
.studentInfoArea{
  display: inline-block;
  margin : 10px;
}
.studentInfoArea button {
  width : 100px;
  height: 50px;
  background-color: cyan;
  border: 1px solid black;
  margin : 10px;
  font-size: 15px;
  font-weight: bold;
}
.gradeDataTable {
    width : 600px;
    height: 300px;
}
.gradeDataTablePlus {
    width : 600px;
    height: 200px;
}
table {
  text-align: center;
  border: 1px solid black;
  border-radius: 10px;
  font-size: 15px;
  font-weight: bold;
}

img {
  width:  200px;
  height: 250px;
}

td {
  border: 1px solid black;
}
</style>

<script>
/*-- 학기 ㄷㅔ이터 --*/
export default {
  data() {
    return {
      e1: null,
      days : {
        year : null,
        term : null
      },
      fields: {
        type :  'test '
      },
      gradeType: {
        t1 : "",
        t2 : "횟수",
        t3 : "만점",
        t4 : "득점",
        t5 : "평균",
        t6 : "반영비율"
      },
      plusType: {
        t1 : "날짜",
        t2 : "타입",
        t3 : "상세",
        t4 : "득점",
        t5 : "만점",
      },
      gradeData: null,
      /*-- 테이블 선 나오게 함 --*/
      bordered: true,
    }
  },
  mounted(){
    this.getData();
  },
  methods: {
    getData(){
      axios.get('/student/getData/gradeManagement')
      .then((response)=>{
        /* 년도, 학기 */
        this.days.year = response.data.year;
        this.days.term = response.data.term;
        this.gradeData = response.data.lecture_list;
        console.log(this.gradeData);
      })
    }
  }
}
</script>
