<template>
<div>
  <v-parallax src="/images/attendance.jpg" height="400">
    <v-layout
      column
      align-center
      justify-center
      class="black--text"
     >
     <h1 class="attendanceCheckTitleEng text-xs-center">Attendance Management</h1>
     <h1 class="attendanceCheckTitleJap text-xs-center">出席管理</h1>
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

  <div class="contents">
    <v-flex xs12>
      <v-container grid-list-xl>
        <v-layout row wrap>
          <v-flex xs12 md7>
            <v-card>
              <v-card-title>
                JCLASS
                <v-spacer></v-spacer>
                <v-text-field
                  append-icon="search"
                  label="Search"
                  single-line
                  hide-details
                  v-model="search"
                  ></v-text-field>
              </v-card-title>
              <v-data-table
               :headers="headers"
               :items="items"
               :search="search"
               >
                <template slot="items" slot-scope="props">
                  <td>{{ props.item.id }}</td>
                  <td class="text-xs-right">{{ props.item.name }}</td>
                  <td class="text-xs-right">
                      <v-btn color="light-green" slot="activator" normal>학생 정보 보기</v-btn>
                  </td>
                </template>
                <v-alert slot="no-results" :value="true" color="error" icon="warning">
                  Your search for "{{ search }}" found no results.
                </v-alert>
              </v-data-table>
            </v-card>
          </v-flex>

          <v-flex xs12 md5>
            <v-card flat>
              <v-btn block color="amber accent-4" style="height: 100px;">출석 체크 시작</v-btn>
              <div>
                출석체크 진행 시간 : {{ min }}분 0초
              </div>
              <div>
                출석 인원 : 0 / 58
              </div>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-flex>
  </div>
</div>
</template>

<style>
.contents {
  text-align: center;
}

.attendanceCheckTitleEng {
  color: white;
  font-family:inherit;
}

.attendanceCheckTitleJap {
  color: rgb(0, 0, 0);
  font-size: 20px;
  font-family: MS Gothic;
}
</style>

<script>
export default {
  data() {
    return {
      items : [],
      menu : [
        { title: '출결확인', link: 'attendanceCheck', key: 1},
        { title: '출결내역', link: 'attendanceList', key: 2}
      ],
      dialog: false,
      min : 0,
      search: '',
      headers: [{
          text: '학번',
          align: 'left',
          value: 'studentNum'
        },
        {
          text: '이름',
          value: 'name'
        },
        {
          text: '',
          value: 'studentInfo'
        }
      ]
    }
  },
  created() {
      this.items = [];
      this.getData();
  },
  methods: {
    getData() {
      axios.get('/professor/getData/attendanceCheck')
      .then((response) => {
        console.log(response.data);
        this.items = (response.data);
        console.log(this.items);
      }).catch(function (error) {
        console.log(error);
      });
    }
  }
}
</script>
