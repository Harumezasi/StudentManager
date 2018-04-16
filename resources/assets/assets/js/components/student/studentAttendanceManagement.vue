<template>

<div>
  <!-- Parallax Scroll -->
  <v-parallax src="/images/attendance.jpg" height="400">
    <v-layout column align-center justify-center class="black--text">
      <h1 class="attendanceCheckTitleEng text-xs-center">Attendance Management</h1>
      <h1 class="attendanceCheckTitleJap text-xs-center">出席管理</h1>
    </v-layout>
  </v-parallax>

  <div class="contents">
    <v-layout column align-center>
      <v-flex xs12 sm4>
        <div class="text-xs-center">
          <h2 class="headline">등/하교 출결</h2>
        </div>

        <!-- 날짜 선택 (월 선택만 가능하게 함) -->
        <v-dialog
        ref="dialog"
        persistent
        v-model="modal"
        lazy
        full-width
        width="290px"
        :return-value.sync="date"
      >
        <v-text-field
          slot="activator"
          label="Picker in dialog"
          v-model="date"
          prepend-icon="event"
          readonly
        ></v-text-field>
        <v-date-picker type="month" v-model="date" scrollable>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
          <v-btn flat color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
        </v-date-picker>
      </v-dialog>
      </v-flex>

      <!-- 그래프 부분 -->
      <v-container grid-list-xl>
        <v-layout row wrap>
          <v-flex xs12 md3>
            <!-- 출석률 ( 도넛그래프 ) -->
              <v-chip color="green" text-color="white">출석률</v-chip>
              <doughnut-chart></doughnut-chart>
          </v-flex>
          <!-- 한 달 동안 출,지,결,조 를 몇번 했나에 대한 그래프 -->
          <v-flex xs12 md9>
              <bar-chart></bar-chart>
          </v-flex>
        </v-layout>
      </v-container>

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
.contents {
  text-align: center;
  background-color: rgb(255, 255, 255);
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
</style>

<script>

import Vue from 'vue'
import VueChartJs from 'vue-chartjs'
import {Bar} from 'vue-chartjs'
import {Doughnut} from 'vue-chartjs'

/*-- bar --*/
Vue.component('bar-chart', {
  extends: VueChartJs.HorizontalBar,
  data() {
    return {
      // 출석
      attendance : 0,
      // 지각
      late : 0,
      // 결석
      absence : 0,
      // 조퇴
      early : 0
    }
  },
  mounted () {
    this.attendance,
    this.late,
    this.absence,
    this.early,
    this.getData()
  },
  methods : {
    // axios start
    getData() {
      axios.get('/student/attendance')
      .then((response) => {
        this.attendance = response.data.attendance;
        this.late       = response.data.late;
        this.absence    = response.data.absence;
        this.early      = response.data.early;
        /* 그래프를 그린다. */
        this.renderChart({
        labels: ['출석', '지각', '결석', '조퇴'],
        datasets: [
          {
            backgroundColor: ['#009a92','#f6c202','#f53e3e','#787878'],
            pointBackgroundColor: 'white',
            borderWidth: 1,
            pointBorderColor: '#249EBF',
            data: [this.attendance, this.late, this.absence, this.early]
          }
        ],
          responsive: true,
          maintainAspectRatio: false,
          height: 100
        },
        {responsive: true, maintainAspectRatio: false});

      }).catch((error) => {
        console.log(error);
      });
    }
    // axios function End
  }
})

/* 출석률 - 도넛 그래프 */
Vue.component('doughnut-chart', {
  extends: VueChartJs.Doughnut,
  data() {
    return {
      attendanceData : 0,
    }
  },
  mounted () {
    this.attendanceData,
    this.getData()
  },
  methods : {
    // axios start
    getData() {
      axios.get('/student/attendance')
      .then((response) => {
        /* 받아온 값 중 필요한 데이터인 출석률 값만 취한다. */
        this.attendanceData = response.data.attendance_rate;
        /* 그래프를 그린다. */
        this.renderChart({
        datasets: [
          {
            label: '출석률',
            backgroundColor: ['#6bb9ff','rgb(200, 200, 200)'],
            pointBackgroundColor: 'white',
            borderWidth: 1,
            pointBorderColor: '#249EBF',
            data: [this.attendanceData, 100-this.attendanceData]
          }
        ],
            height: 200
        },
        {responsive: true, maintainAspectRatio: false})
      }).catch((error) => {
        console.log(error);
      });
    }
    // axios function End
  }
})

/*-- 표 데이터 --*/
export default {
  data () {
        return {
          headers: [
            { text: '출석', value: 'attendance' },
            { text: '최근출석', value: 'nearest_attendance' },
            { text: '지각', value: 'late' },
            { text: '최근지각', value: 'nearest_late' },
            { text: '결석', value: 'absence' },
            { text: '최근결석', value: 'nearest_absence' },
            { text: '조퇴', value: 'early' },
            { text: '최근조퇴', value: 'nearest_early' }
          ],
          attendanceData: [],
          /*-- 날짜 선택 관련 --*/
          date: null,
          menu: false,
          modal: false
        }
      },
      mounted() {
          this.attendanceData = [];
          this.getData();
      },
      methods: {
        getData() {
          axios.get('/student/attendance')
          .then((response) => {
            this.attendanceData.push(response.data);
          }).catch((error) => {
            console.log(error);
          });
        }
      }
}

</script>
