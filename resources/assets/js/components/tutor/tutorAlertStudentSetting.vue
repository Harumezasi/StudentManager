<template>

  <div>
    <v-parallax src="/images/attendance.jpg" height="400">
      <v-layout column align-center justify-center class="black--text">
        <h1 class="attendanceCheckTitleEng text-xs-center">Attendance Management</h1>
        <h1 class="attendanceCheckTitleJap text-xs-center">出席管理</h1>
      </v-layout>
    </v-parallax>

    <div class="text-xs-center">
      <h2 class="headline">알림설정</h2>
    </div>

    <v-flex xs 12>
      <v-container grid-list-xl>
        <v-layout row wrap align-center>
          <v-flex xs12 md4>
            <v-chip color="blue lighten-1" text-color="white">알림추가</v-chip>
          </v-flex>
        </v-layout>
      </v-container>
    </v-flex>

    <!-- 알림추가 영역 -->
    <!-- 자꾸 이상하게 정렬되서 밑에처럼 레이아웃 배치함. 복잡해도 일단 양해 바람 -->
    <v-flex xs 12>
      <v-container grid-list-xl>
        <v-layout row wrap align-center>
          <!-- 기간 설정 (ex. 일주일, 한달) 부분 -->
          <v-flex xs12 md1>
            <v-select :items="period" v-model="e1" label="Select" single-line></v-select>
          </v-flex>
          <!-- ~동안 -->
          <v-flex xs12 md1>
            <strong>동안</strong>
          </v-flex>
          <!-- 상태 (ex. 출석, 결석 등) -->
          <v-flex xs12 md1>
            <v-select :items="attendance" v-model="e2" label="Select" single-line></v-select>
          </v-flex>
          <!-- ~을 -->
          <v-flex xs12 md1>
            <strong>을</strong>
          </v-flex>
          <!-- 빈도 (ex. 연속, 누적) -->
          <v-flex xs12 md1>
            <v-select :items="frequency" v-model="e3" label="Select" single-line></v-select>
          </v-flex>
          <!-- 횟수 (ex. 3회, 4회) -->
          <v-flex xs12 md1>
            <v-text-field
              name="inputNum"
              label="횟수"
              id="num"
              >
            </v-text-field>
          </v-flex>
          <!-- ~이상 했을 시, -->
          <v-flex xs12 md2>
            <strong>이상 시,</strong>
          </v-flex>
          <!-- 알림 보낼 대상 설정 (ex. 교수, 학생) -->
          <v-flex xs12 md2>
            <v-select :items="noticeTarget" v-model="e4" label="Select" single-line></v-select>
          </v-flex>
          <!-- ~에게 알림 -->
          <v-flex xs12 md1>
            <strong>에게 알림</strong>
          </v-flex>
          <!-- 알림 추가 버튼 -->
          <v-flex xs12 md1>
            <v-btn color="primary">추가</v-btn>
          </v-flex>
        </v-layout>
      </v-container>
    </v-flex>

    <v-flex xs 12>
      <v-container grid-list-xl>
        <v-layout row wrap align-center>
          <v-flex xs12 md4>
            <v-chip color="blue lighten-1" text-color="white">알림확인</v-chip>
          </v-flex>
        </v-layout>
      </v-container>
    </v-flex>

    <!-- 알림 확인 부분은 위에 데이터가 전달되야 뜨는건데 어떻게 해야할지 몰라서
    일단 형태만 냅둠 -->
    <v-flex xs12>
      <v-container grid-list-xl>
        <v-layout row wrap align-center>
          <v-flex xs12 md8>
            <p>{{ selected }}</p>
            <v-checkbox label="일주일 동안 지각을 누적 3회 이상 시, 교수(나)와 학생에게 알림 " v-model="selected" value="confirm"></v-checkbox>
          </v-flex>
          <v-flex xs12 md4>
            <v-btn color = "primary">수정</v-btn>
            <v-btn color = "red">삭제</v-btn>
          </v-flex>
        </v-layout>
      </v-container>
    </v-flex>
  </div>
</template>

<style>
body {
  background-color: rgb(255, 255, 255);
}
</style>

<script>
export default {
  data() {
    return {
      /*-- select (기간, 상태, 빈도, 알림대상) --*/
      e1: null,
      e2: null,
      e3: null,
      e4: null,
      /*-- 기간 --*/
      period: [{
          text: '일주일'
        },
        {
          text: '한달'
        },
        {
          text: '기간설정'
        }
      ],
      /*-- 상태 --*/
      attendance: [{
          text: '출석'
        },
        {
          text: '지각'
        },
        {
          text: '조퇴'
        },
        {
          text: '결석'
        }
      ],
      /*-- 빈도 --*/
      frequency: [{
          text: '연속'
        },
        {
          text: '누적'
        }
      ],
      /*-- 알림대상 --*/
      noticeTarget: [{
          text: '교수(나)'
        },
        {
          text: '학생'
        },
        {
          text: '교수(나)와 학생'
        }

      ],

    }
  }
  /* Data End */
}
</script>
