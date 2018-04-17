<template>

  <div>
    <!-- Parallax Scroll -->
    <v-parallax src="/images/attendance.jpg" height="400">
      <v-layout column align-center justify-center class="black--text">
        <h1 class="attendanceCheckTitleEng text-xs-center">Attendance Management</h1>
        <h1 class="attendanceCheckTitleJap text-xs-center">出席管理</h1>
      </v-layout>
    </v-parallax>

    <div class="text-xs-center">
      <h2 class="headline">등/하교 출결</h2>
    </div>

    <!-- 상단 학생 구분 컬러 영역 -->
    <v-flex xs10>
      <v-container grid-list-xl>
        <v-layout row wrap align-center>
          <v-flex xs10 offset-xs1>
            <div class="attendanceType">
              <v-chip color="primary" text-color="white">등교</v-chip>
              <v-chip color="primary" text-color="white">{{attendanceCount}}</v-chip>
            </div>
              <v-chip color="green" text-color="white">하교</v-chip>
              <v-chip color="green" text-color="white">{{returnHomeCount}}</v-chip>
            <div class="attendanceType">
              <v-chip color="pink lighten-3" text-color="white">관심학생</v-chip>
              <v-chip color="pink lighten-3" text-color="white">{{loveStudentCount}}</v-chip>
            </div>
            <div class="attendanceType">
              <v-chip color="amber" text-color="white">지각</v-chip>
              <v-chip color="amber" text-color="white">{{lateCount}}</v-chip>
            </div>
            <div class="attendanceType">
              <v-chip color="red" text-color="white">결석</v-chip>
              <v-chip color="red" text-color="white">{{absenceCount}}</v-chip>
            </div>
          </v-flex>
        </v-layout>
      </v-container>
    </v-flex>

    <!-- 출결 현황 보기 영역 -->
    <v-flex xs12>
      <v-container grid-list-xl>
        <v-layout row wrap align-center>

          <!-- 지각 -->
          <v-flex xs12 md4>
            <v-card class="elevation-4 transparent">
              <v-card-text class="text-xs-center">
                <v-btn color="primary" depressed block class="attendanceTitle">지각</v-btn>
              </v-card-text>
              <v-card-text class="studentInfoScreen attendanceInfoArea">
                <v-chip color = "amber" v-for="late in lateData" :key="late.name" class="studentInfoArea">
                  <v-card-title>
                    <div>
                      <span>{{ late.name }}</span><br>
                      <span>{{ late.come }}</span>
                    </div>
                  </v-card-title>
                </v-chip>
              </v-card-text>
            </v-card>
          </v-flex>

          <!-- 결석 -->
          <v-flex xs12 md4>
            <v-card class="elevation-4 transparent">
              <v-card-text class="text-xs-center">
                <v-btn color="primary" depressed block class="attendanceTitle">결석</v-btn>
              </v-card-text>
              <v-card-text class="studentInfoScreen attendanceInfoArea">
                <v-chip color = "red" v-for="absence in absenceData" :key="absence.name" class="studentInfoArea">
                  <v-card-title>
                    <div>
                      <span>{{ absence.name }}</span>
                    </div>
                  </v-card-title>
                </v-chip>
              </v-card-text>
            </v-card>
          </v-flex>

          <!-- 관심학생 -->
          <v-flex xs12 md4>
            <v-card class="elevation-4 transparent">
              <v-card-text class="text-xs-center">
                <v-btn color="primary" depressed block class="attendanceTitle">관심학생</v-btn>
              </v-card-text>
              <v-card-text class="studentInfoScreen attendanceInfoArea">
                <v-chip color = "pink lighten-3" v-for="loveStudent in loveStudentData" :key="loveStudent.name" class="studentInfoArea">
                  <v-card-title>
                    <div>
                      <span>{{ loveStudent.name }}</span><br>
                      <span>{{ loveStudent.come }}</span>
                    </div>
                  </v-card-title>
                </v-chip>
              </v-card-text>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-flex>
    <v-flex xs12>
      <v-container grid-list-xl>
        <v-layout row wrap align-center>

          <!-- 등교 -->
          <v-flex xs12 md6>
            <v-card class="elevation-4 transparent">
              <v-card-text class="text-xs-center">
                <v-btn color="primary" depressed block class="attendanceTitle">등교</v-btn>
              </v-card-text>
              <v-card-text class="studentInfoScreen attendanceInfoArea">
                <v-chip color = "green" v-for="attendance in attendanceData" :key="attendance.name" class="studentInfoArea">
                  <v-card-title>
                    <div>
                      <span>{{ attendance.name }}</span><br>
                      <span>{{ attendance.come }}</span>
                    </div>
                  </v-card-title>
                </v-chip>
              </v-card-text>
            </v-card>
          </v-flex>

          <!-- 하교 -->
          <v-flex xs12 md6>
            <v-card class="elevation-4 transparent">
              <v-card-text class="text-xs-center">
                <v-btn color="primary" depressed block class="attendanceTitle">하교</v-btn>
              </v-card-text>
              <v-card-text class="studentInfoScreen attendanceInfoArea">
                <v-chip color = "green" v-for="returnHome in returnHomeData" :key="returnHome.name" class="studentInfoArea">
                  <v-card-title>
                    <div>
                      <span>{{ returnHome.name }}</span><br>
                      <span>{{ returnHome.come }}</span>
                    </div>
                  </v-card-title>
                </v-chip>
              </v-card-text>
            </v-card>
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

  .attendanceType {
    display: inline-block;
  }

  .attendanceTitle {
    font-size: 20px;
    font-weight: bold;
    height: 60px;
  }

  .attendanceInfoArea {
    min-height: 500px;
    max-height: 500px;
    overflow-y: scroll;
  }

  .studentInfoArea {
    width : 200px;
    height : 100px;
    font-size: 15px;
    font-weight: bold;
    text-align: center;
    overflow: hidden;
  }

  .studentInfoScreen {
    text-align:center;
  }
</style>

<script>
export default {
  data () {
    return {
      /*-- 지각 --*/
      lateData : [],
      lateCount : 0,
      /*-- 결석 --*/
      absenceData : [],
      absenceCount : 0,
      /*-- 관심학생 --*/
      loveStudentData : [],
      loveStudentCount : 0,
      /*-- 등교 --*/
      attendanceData : [],
      attendanceCount : 0,
      /*-- 하교 --*/
      returnHomeData : [],
      returnHomeCount : 0,
    }
  },
  mounted() {
      this.getData();
      setInterval(this.getData, 2500);
  },
  methods: {
    getData() {
      axios.get('/tutor/myclass/attendance')
      .then((response) => {
        // 지각자
        this.lateData           = response.data.late_data;
        if(this.lateData == null){
          this.lateCount        = 0;
        } else {
          this.lateCount        = this.lateData.length;
        }

        // 결석자
        this.absenceData        = response.data.absence_data;
        if(this.absenceData == null){
          this.absenceCount     = 0;
        }else{
          this.absenceCount     = this.absenceData.length;
        }

        // 관심
        this.loveStudentData    = response.data.care_data;
        if(this.loveStudentData == null){
          this.loveStudentCount = 0;
        } else {
          this.loveStudentCount = this.loveStudentData.length;
        }

        // 등교
        this.attendanceData     = response.data.attendance_data;
        if(this.attendaceData == 0){
          this.attendanceCount  = 0;
        } else {
          this.attendanceCount  = this.attendanceData.length;
        }

        // 하교
        this.returnHomeData     = response.data.leave_data;
        if(this.returnHomeData == 0){
          this.returnHomeCount  = 0;
        } else {
          this.returnHomeCount  = this.returnHomeData.length;
        }

        console.log('is new Data');

      }).catch((error) => {
        console.log(error);
      });
    }
  }
}
</script>
