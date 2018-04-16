<template>

  <div>
    <v-parallax src="/images/grade.jpg" height="400">
      <v-layout column align-center justify-center class="black--text">
        <h1 class="attendanceCheckTitleEng text-xs-center">학생관리</h1>
        <h1 class="attendanceCheckTitleJap text-xs-center"></h1>
      </v-layout>
    </v-parallax>

    <v-layout column align-center>
      <v-flex xs12 sm4>
        <div class="text-xs-center">
          <h2 class="headline">학업관리</h2>
        </div>
        <!-- 학기 선택 하는 곳 -->
        <v-select :items="semester" v-model="e1" label="Select" single-line></v-select>
      </v-flex>
    </v-layout>

    <v-flex xs12>
      <v-container grid-list-xl>
        <v-layout row wrap align-center>
          <v-flex xs12 md12>
          <v-card class = "elevation-0">
            <v-card-title>
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
             :items="student_lists"
             :search="search"
             :pagination.sync="pagination"
             hide-actions
             >
           <template slot="items" slot-scope="props">
             <td class="text-xs-center">{{ props.item.id }}</td>
             <td class="text-xs-center">{{ props.item.name }}</td>
             <td class="text-xs-center">{{ props.item.achievement}}</td>
             <td class="text-xs-center">
               <v-btn color="light-green" slot="activator" normal>상세보기</v-btn>
             </td>
           </template>
          </v-data-table>
           <div class="text-xs-center pt-2">
             <v-pagination v-model="pagination.page" :length="pages"></v-pagination>
           </div>
            <v-alert slot="no-results" :value="true" color="error" icon="warning">
              Your search for "{{ search }}" found no results.
            </v-alert>
          </v-card>
        </v-flex>
        </v-layout>
      </v-container>
    </v-flex>

  </div>
</template>

<style>

</style>

<script>
export default {
   data () {
     return {
       search: '',
       pagination: {},
       selected: [],
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
       headers: [
         { text: '학번',
          value: 'studentNum',
          align: 'center'
         },
         {
           text: '이름',
           sortable: true,
           value: 'name',
           align: 'center'
         },
         { text: '학업성취도',
          value: 'gradePersent',
          sortable: true,
          align: 'center'
        },
        {
          text: '',
          value: 'detailInfo',
          align: 'center'
        }
       ],
       student_lists: []
     }
   },
   created() {
       this.student_lists = [];
       this.getData();
   },
   methods: {
     getData() {
       axios.get('/tutor/myclass/manage')
       .then((response) => {
         this.student_lists = response.data;
         console.log(this.student_lists);
       }).catch((error) => {
         console.log(error);
       });
     }
   },
   computed: {
     pages () {
       if (this.pagination.rowsPerPage == null ||
         this.pagination.totalItems == null
       ) return 0

       return Math.ceil(this.pagination.totalItems / this.pagination.rowsPerPage)
     }
   }
 }
</script>
