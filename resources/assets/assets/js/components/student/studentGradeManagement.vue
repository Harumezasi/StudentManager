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
          <v-flex xs12>
            <v-data-table
               :headers="headers"
               :items="attendanceData"
               hide-actions
               class="elevation-0"
             >
               <template slot="items" slot-scope="props">
                 <!-- 출석과 최근 출석 -->
                 <td class="text-xs-center">{{ props.item.attendance }}</td>
                 <td class="text-xs-center">{{ props.item.nearest_attendance }}</td>
                 <!-- 지각과 최근 지각-->
                 <td class="text-xs-center">{{ props.item.late }}</td>
                 <td class="text-xs-center">{{ props.item.nearest_late }}</td>
                 <!-- 결석과 최근 결석 -->
                 <td class="text-xs-center">{{ props.item.absence }}</td>
                 <td class="text-xs-center">{{ props.item.nearest_absence }}</td>
                 <!-- 조퇴와 최근 조퇴 -->
                 <td class="text-xs-center">{{ props.item.early }}</td>
                 <td class="text-xs-center">{{ props.item.nearest_early }}</td>
               </template>
             </v-data-table>
           </v-flex>
    </v-layout>
  </div>
</div>
</template>

<style>

</style>

<script>
/*-- 학기 ㄷㅔ이터 --*/
export default {
  data() {
    return {
      e1: null,
      semester: [{
          text: '2016년 1학기'
        },
        {
          text: '2016년 2학기'
        },
        {
          text: '2017년 1학기'
        },
        {
          text: '2017년 2학기'
        },
        {
          text: '2018년 1학기'
        },
      ],
      /*-- 학업 테이블 영역 --*/
      fields: [ '종류', '횟수', '취득가능점수','취득점수', '평균', '반영 비율' ],
      grade: [
        { 종류: '중간', 횟수: 0, 취득가능점수: 0, 취득점수: 0, 평균: 0, 반영비율: '35%'  },
        { 종류: '기말', 횟수: 0, 취득가능점수: 0, 취득점수: 0, 평균: 0, 반영비율: '35%'  },
        { 종류: '과제', 횟수: 0, 취득가능점수: 0, 취득점수: 0, 평균: 0, 반영비율: '35%'  },
        { 종류: '쪽지', 횟수: 0, 취득가능점수: 0, 취득점수: 0, 평균: 0, 반영비율: '35%'  },
      ],
      /*-- 테이블 선 나오게 함 --*/
      bordered: true,
    }
  }
}
</script>
