var navMenu = {
  student : [
    {title : '출결관리',link : '/attendanceManagement'},
    {title : '학업관리',link : '/gradeManagement'},
    {title : '상담관리',link : '/consultingManagement'},
  ],

  professor :[
    {title : 'Jclass' , link : '/attendanceCheck'},
    {title : '상담관리' , link : '/consultRequestCheck'},
  ],

  tutor :[
    {title : '출결관리',
      hover : [
       { title: '등/하교 출결', link : '/tutorAttendance' },
       { title: '알림 설정', link : '/attendanceSetting' },
      ]
    },
    {title : '학생관리', link : '/tutorStudentManagement'},
    {title : '설정/관리', link : '/tutorAttendance'},

  ]


}

export default navMenu;
