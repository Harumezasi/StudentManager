<?php
/**
 * Created by PhpStorm.
 * 페이지 설명: <학생> 학업관리 메인 페이지
 * User: Seungmin Lee
 * Date: 2018-04-02
 * Time: 오후 6:47
 */
?>
@extends('layouts.student_master')
@section('body.section')
    <div>
        <span>@lang('lecture.title')</span>
        <span>
            <input type="button" value="@lang('pagination.previous')">
            <span>2018년 1학기</span>
            <input type="button" value="@lang('pagination.next')">
        </span>
    </div>
<hr>
    <div>
        @forelse($lecture_list as $lecture)
            <div>{{$lecture}}</div>
        @empty
            <span>현재 수강중 과목 없음</span>
        @endforelse
    </div>
<hr>
<!-- 최상위 div -->
    <div class="lecture_div">
      <!-- 과목 사진 -->
      <div class="lecture_info">
        <div class='lecture_img'>
          <img src="#">
        </div>
        <div class='lecture_name'>
          안드로이드
        </div>
      </div>
      <!-- 성적 테이블 -->
      <div class="lecture_grade">
        <div class="lecture_grade_table">
        <table>
          <!-- 목록 -->
          <tr>
            <td></td>
            <th> 횟수 </th>
            <th> 취득가능점수 </th>
            <th> 취득점수 </th>
            <th> 평균 </th>
            <th> 반영비율 </th>
          </tr>
          <!-- 중간 -->
          <tr>
            <td> 중간 </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
          </tr>
          <!-- 기말 -->
          <tr>
            <td> 기말 </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
          </tr>
          <!-- 과제 -->
          <tr>
            <td> 과제 </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
          </tr>
          <!-- 쪽지 -->
          <tr>
            <td> 쪽지 </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
          </tr>
        </table>
      </div>
      <!-- 학업 성취도 -->
        <div class="lecture_grade_bar">
          <reactive :chart-data="datacollection" :width="800" :height="100"></reactive>
        </div>
      </div>
    <!-- 상세보기 부분 / 간략히 버튼 -->
      <div class=lecture_view>
        <div v-if="number == true">
          <button v-on:click="pageChange">상세보기</button>
        </div>
        <div v-else>
          <table class=lecture_view_table>
            <tr>
              <th> 날짜 </th>
              <th> 분류 </th>
              <th> 득점/점수 </th>
            </tr>
          <!-- for문이 들어갈 부분 / 상세보기의 모든 성적을 추출 -->
            <tr>
              <td> 18-03-05 </td>
              <td> 과제 </td>
              <td> 70/100 </td>
            </tr>
          <!-- for문 종료 -->
          </table>
          <button v-on:click="pageChange">간략히</button>
        </div>
      </div>
  </div>
@endsection
@section('script')
<script>
  /* 상세보기 기능 */
  new Vue({
      el: ".lecture_view",
      data : {
        number : true
      },
      methods: {
        pageChange : function(){
          if(this.number == true){
            this.number = false;
          }else{
            this.number = true;
          }
          console.log(this.number);
        }
      }
    })

  /* 막대 그래프 */
  Vue.component('reactive', {
  extends: VueChartJs.HorizontalBar,
  mixins: [VueChartJs.mixins.reactiveProp],
  data: function () {
      return {
          options: {
            legend: {
                display: false,
            },
            scales: {
              xAxes: [{
                ticks: {
                    beginAtZero: true,
                    min: 0,
                    max: 100
                }
              }]
            }
          }
      }
  },
  mounted () {

  // this.chartData is created in the mixin
  this.renderChart(this.chartData, this.options)
  }
})

var vm = new Vue({
    el: '.lecture_grade_bar',
    data () {
        return {
        datacollection: null
        }
    },
    created () {
        this.fillData()
    },
    methods: {
        fillData () {
        this.datacollection = {
          labels: ['학업성취도'],
          datasets: [
            {
              backgroundColor: '#6799FF',
              data: [{x:57.5}]
            }
          ]
        }
      }
    }
})

</script>
@endsection
@section('style')
<style>
  .lecture_div {
    width : 1300px;
    min-height: 650px;
    border : 1px solid black;
  }

  .lecture_info {
    width: 400px;
    height: 400px;
    float: left;
    margin: 10px;
    align-content: center;
  }

  .lecture_img img {
    width: 400px;
    height: 300px;
  }

  .lecture_name{
    font-size: 50px;
    text-align: center;
    width: 400px;
    height: 100px;
  }

  .lecture_grade {
  }

  .lecture_grade_bar {
    float: left;
  }

  .lecture_grade_table table, th, td {
    border : 1px solid black;
    padding: 0px;
  }

  .lecture_grade_table th, td {
    width : 150px;
    height: 75px;
  }

  .lecture_view {
    display: inline-block;
  }

  .lecture_view button {
    width : 300px;
    height: 100px;
  }


  .lecture_view_table th, td {
    font-size: 30px;
    width: 350px;
    height: 75px;
  }

</style>
@endsection
