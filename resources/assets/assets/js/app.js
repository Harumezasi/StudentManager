/* import vue's */
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)

import VueRouter from 'vue-router'
Vue.use(VueRouter)
window.axios = require('axios')

import VueAxios from 'vue-axios'
import axios from 'axios'
Vue.use(VueAxios, axios)

import moment from 'moment'
Vue.use(moment)

import VModal from 'vue-js-modal'
Vue.use(VModal)

import VueChart from 'vue-chart-js'
Vue.use(VueChart)

/* 중계 라우터 */
import App from './App.vue';

/* 로그인 */
import Login from './components/Login.vue'

/* 회원가입 */

/* 학생 */
import studentMaster from './components/student/studentMaster.vue'
import studentMenu from './components/student/studentMenu.vue'
import studentMainBody from './components/student/studentMainBody.vue'
import studentAttendanceManagement from './components/student/studentAttendanceManagement.vue'
import studentGradeManagement from './components/student/studentGradeManagement.vue'
import studentConsultingManagement from './components/student/studentConsultingManagement.vue'

/* 교과목 교수 */
import professorMaster from './components/professor/professorMaster.vue'
import professorMenu from './components/professor/professorMenu.vue'
import professorMainBody from './components/professor/professorMainBody.vue'
import professorAttendanceCheck from './components/professor/professorAttendanceCheck.vue'
import professorAttendanceList from './components/professor/professorAttendanceList.vue'
import professorGradeRegister from './components/professor/professorGradeRegister.vue'
import professorConfirmGrade from './components/professor/professorConfirmGrade.vue'

/* 지도교수 */
import tutorMaster from './components/tutor/tutorMaster.vue'
import tutorMenu from './components/tutor/tutorMenu.vue'
import tutorMainBody from './components/tutor/tutorMainBody.vue'
import tutorRealTimeAttendance from './components/tutor/tutorRealTimeAttendance.vue'
import tutorStudentManagement from './components/tutor/tutorStudentManagement.vue'
import tutorAlertStudentSetting from './components/tutor/tutorAlertStudentSetting.vue'

/* 경로 설정 */
const routes = [
  /* 로그인 페이지 */
  {
    path: '/',
    component: Login
  },
  /* 학생 페이지 */
  {
  path: '/student/main',
  component: studentMaster,
  children : [
    {
    path : '',
    components : {
      menu : studentMenu,
      body : studentMainBody
      }
    }
  ]},
  {
  path: '/student/attendanceManagement',
  component: studentMaster,
  children : [
    {
    path : '',
    components : {
      menu : studentMenu,
      body : studentAttendanceManagement
      }
    }
  ]},
  {
  path: '/student/gradeManagement',
  component: studentMaster,
  children : [
    {
    path : '',
    components : {
      menu : studentMenu,
      body : studentGradeManagement
      }
    }
  ]},
  {
  path: '/student/consultingManagement',
  component: studentMaster,
  children : [
    {
    path : '',
    components : {
      menu : studentMenu,
      body : studentConsultingManagement
      }
    }
  ]},
  /* 교과목 교수 페이지 */
  {
  path: '/professor/main',
  component: professorMaster,
  children : [
    {
    path : '',
    components : {
      menu : professorMenu,
      body : professorMainBody
      }
    }
  ]},
  {
  path : '/professor/attendanceCheck',
  component: professorMaster,
  children : [
    {
    path : '',
    components : {
      menu : professorMenu,
      body : professorAttendanceCheck
      }
    }
  ]},
  {
  path : '/professor/attendanceList',
  component: professorMaster,
  children : [
    {
    path : '',
    components : {
      menu : professorMenu,
      body : professorAttendanceList
      }
    }
  ]},
  {
  path : '/professor/gradeRegister',
  component: professorMaster,
  children : [
    {
    path : '',
    components : {
      menu : professorMenu,
      body : professorGradeRegister
      }
    }
  ]},
  {
  path : '/professor/confirmGrade',
  component: professorMaster,
  children : [
    {
    path : '',
    components : {
      menu : professorMenu,
      body : professorConfirmGrade
      }
    }
  ]},
  /* 지도 교수 페이지 */
  {
  path : '/tutor/main',
  component: tutorMaster,
  children : [
    {
    path : '',
    components : {
      menu : tutorMenu,
      body : tutorMainBody
      }
    }
  ]},
  {
  path : '/tutor/attendance',
  component: tutorMaster,
  children : [
    {
    path : '',
    components : {
      menu : tutorMenu,
      body : tutorRealTimeAttendance
      }
    }
  ]},
  {
  path : '/tutor/studentManagement',
  component: tutorMaster,
  children : [
    {
    path : '',
    components : {
      menu : tutorMenu,
      body : tutorStudentManagement
      }
    }
  ]},
  {
  path : '/tutor/alertStudentSetting',
  component: tutorMaster,
  children : [
    {
    path : '',
    components : {
      menu : tutorMenu,
      body : tutorAlertStudentSetting
      }
    }
  ]}
];

const router = new VueRouter({mode: 'history', routes : routes});
new Vue(Vue.util.extend({ router }, App)).$mount('#main_div');
