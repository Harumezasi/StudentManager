<template>
<div>
  <v-parallax src="../images/grade.jpg" height="400">
    <v-layout column align-center justify-center class="black--text">
      <h1 class="attendanceCheckTitleEng text-xs-center">Grade Management</h1>
      <h1 class="attendanceCheckTitleJap text-xs-center">成績管理</h1>
    </v-layout>
  </v-parallax>

  <v-tabs fixed-tabs>
    <v-tab>
      성적등록
    </v-tab>
    <v-tab :to="{path:'confirmGrade'}">
      성적확인
    </v-tab>
  </v-tabs>

  <div class="contents">
    <v-layout column class="my-5" align-center>
      <v-flex xs12 sm4 class="my-3">
        <div class="text-xs-center">
          <h2 class="headline">두 가지 중 원하는 방식으로 성적을 입력 하십시오</h2>
        </div>
      </v-flex>

        <v-container grid-list-xl>
          <v-layout row wrap align-center>
            <v-flex xs12 md7>
              <v-card class="elevation-0 transparent">
                <!-- 엑셀 파일 -->
                <v-card-text class="text-xs-center">
                  <img src = "../images/excel.png" style="width:70px; height:auto;"/>
                </v-card-text>
                <!-- 엑셀 파일 설명 -->
                <v-card-title primary-title class="layout justify-center">
                  <div class="headline text-xs-center">엑셀 양식 다운로드 후, 파일 업로드</div>
                </v-card-title>
                <!-- 다운로드 버튼 -->
                <v-dialog v-model="dialog1" persistent max-width="600px">
                  <v-btn color="green darken-4" class="white--text" style="height: 100px;" slot="activator" normal>
                    엑셀 양식 다운로드
                    <v-icon right dark>cloud_download</v-icon>
                  </v-btn>
                  <!-- 모달창 메인 -->
                  <v-card>
                    <v-card-title>
                      <span class="headline">엑셀 양식 다운로드</span>
                    </v-card-title>
                    <v-flex d-flex xs12 sm6 md4>
                    <!-- form 양식 -->
                    <v-form action='/professor/scores/store/excel/export' method='post' enctype='multipart/form-data'>
                      <!-- <input type="hidden" name="_token" :value="csrf"> -->
                      <!-- 파일 이름 입력 -->
                      <v-chip color="secondary" text-color="white">파일 이름</v-chip>
                      <v-text-field type="text" name="file_name" maxlength="30" required=""></v-text-field>
                      <!-- 성적 유형 -->
                      <v-chip color="secondary" text-color="white">분류</v-chip>
                      <select name="score_type" id="score_type">
                        <option value="1">중간</option>
                        <option value="2">기말</option>
                        <option value="3" selected="">과제</option>
                        <option value="4">쪽지</option>
                      </select>
                      <!-- 만점 설정 -->
                      <v-chip color="secondary" text-color="white">만점</v-chip>
                      <v-text-field type="number" name="perfect_score" min="1" max="999" maxlength="3" required=""></v-text-field>
                      <!-- 성적 상세 내용 -->
                      <v-chip color="secondary" text-color="white">성적 내용</v-chip>
                      <v-text-field type="text" name="content" minlength="2" maxlength="30" required=""></v-text-field>
                      <!-- 출력 파일 유형 -->
                      <v-chip color="secondary" text-color="white">확장자</v-chip>
                      <select name="file_type" id="file_type">
                          <option value="xlsx">xlsx</option>
                          <option value="xls">xls</option>
                          <option value="csv">csv</option>
                      </select>
                      <!-- SUBMIT 실행 버튼 영역 -->
                      <v-btn color="indigo" type='submit'>양식 다운로드</v-btn>
                      <!-- END -->
                    </v-form>
                    <!-- form End-->
                    </v-flex>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click.native="dialog1 = false">Close</v-btn>
                      </v-card-actions>
                    </v-card>
                </v-dialog>
                <!-- 업로드 버튼 -->
                <v-dialog v-model="dialog2" persistent max-width="600px">
                  <v-btn color="green darken-4" class="white--text" style="height: 100px;" slot="activator" normal>
                    엑셀 파일 업로드
                    <v-icon right dark>cloud_upload</v-icon>
                  </v-btn>
                  <!-- 모달창 메인 -->
                  <v-card>
                    <v-card-title>
                      <span class="headline">엑셀로 성적 업로드</span>
                    </v-card-title>
                    <div>
                    <!-- form 양식 -->
                      <!-- 파일 등록 -->
                      <v-chip color="secondary" text-color="white">파일등록</v-chip>
                      <input type="file" id="file" ref='upload_file' required="" accept=".xlsx, .xls, .csv" v-on:change="handleFileUpload()" class="upload_input">
                      <button v-on:click="submitFile()" class="upload_button">성적 업로드</button>
                    </div>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="dialog2=false">Close</v-btn>
                      </v-card-actions>
                    </v-card>
                </v-dialog>
                <!-- 버튼 영역 끝 -->
              </v-card>
            </v-flex>
            <!-- 완료 메시지 모달창 -->
            <v-dialog v-model="dialog3" persistent max-width="600px">
              <!-- 모달창 메인 -->
              <v-card>
                <v-card-title>
                  <span class="headline">알림</span>
                </v-card-title>
                <v-flex d-flex xs12 sm6 md4>
                <!-- form 양식 -->
                <div v-if="reData">
                  성적 업로드에 성공하였습니다.
                </div>
                <div v-else>
                  성적 업로드에 실패하였습니다.
                </div>
                <!-- form End-->
                </v-flex>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="dialog3=false, dialog2=false">Close</v-btn>
                  </v-card-actions>
                </v-card>
            </v-dialog>
            <!-- 성적 직접 입력 부분 -->
            <v-flex xs12 md3>
              <v-card class="elevation-0 transparent">
                <v-card-text class="text-xs-center">
                  <img src = "../images/registration.png" style="width:70px; height:auto;"/>
                </v-card-text>
                <v-card-title primary-title class="layout justify-center">
                  <div class="headline text-xs-center">웹에서 직접 입력</div>
                </v-card-title>
                <v-btn outline large color="primary" class="white--text" style="height: 100px;">
                  등록
                  <v-icon right dark>add_box</v-icon>
                </v-btn>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-flex>
    </v-layout>
    </v-container>
  </div>
</div>
</template>
<script>
export default {
    data(){
      return {
        file: null,
        dialog1: false,
        dialog2: false,
        dialog3: false,
        reData : true
      }
    },
    methods: {
      submitFile(){
            let formData = new FormData();
            formData.append('upload_file', this.file);
            axios.post( '/professor/scores/store/excel/import',
                formData,
                {
                  headers: {
                      'Content-Type': 'multipart/form-data'
                    }
                }
            ).then((response)=>{
              this.reData = true;
              this.openWindow();
              console.log(response.data);
            })
            .catch((error)=>{
              console.log('FAILURE!!');
              this.reData = false;
              this.openWindow();
              console.log(response.data);
            });
      },
      handleFileUpload(){
        this.file = this.$refs.upload_file.files[0];
      },
      openWindow(){
        this.dialog3 = true;
      }
    }
  }

</script>



<style>
.upload_input {
    border: 1px solid black;
    width : 300px;
}

.upload_button {
    border: 1px solid black;
    width: 100px;
    height: 50px;
    border-radius: 10px;
    background-color: gray;
    font-weight: bold;
    font-size: 15px;
}

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
