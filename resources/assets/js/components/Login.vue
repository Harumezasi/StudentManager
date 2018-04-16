<template>
  <v-app>
    <v-content class="login">

      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>

            <div class="text-xs-center">
              <img class = "logo-box" src="/images/logoShadow.png" />
            </div>
            <!-- Form ( card는 로그인 박스임 )-->
            <v-card class = "elevation-3">
              <v-card-text>
            <v-form action='/login' method='post'>
              <!-- 타입 지정 버튼 영역 -->
              <v-radio-group v-model="typeSelected" row name="type">
                <v-radio label="학생" value="student"></v-radio>
                <v-radio label="교수" value="professor"></v-radio>
              </v-radio-group>
              <!-- ID / PW 입력 영역 -->
              <v-text-field prepend-icon="person" name="id" label="Login" type="text" v-model="id"></v-text-field>
              <v-text-field prepend-icon="lock" name="password" label="Password" id="password" type="password" v-model="pw"></v-text-field>
              <!-- 회원가입 / 비밀번호 찾기 버튼 영역-->
              <router-link to = "/">회원등록</router-link>
              <br />
              <router-link to = "/">ID・PW 찾기</router-link>
              <!-- SUBMIT 실행 버튼 영역 -->
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="indigo" type='submit'>로그인</v-btn>
              </v-card-actions>
              <!-- END -->
            </v-form>
            </v-card-text>
            </v-card>

          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<style>
.login {
  background-color: rgb(255, 255, 255);
}
.logo-box {
  width: 300px;
  height: auto;
  margin-bottom: 30px;
}
</style>

<script>
export default {
  data() {
    return{
      drawer: null,
      typeSelected : null,
      id : null,
      pw : null
    }
  },
  props: {
    source: String
  }
}
</script>
