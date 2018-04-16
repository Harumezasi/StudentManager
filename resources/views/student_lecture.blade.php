<?php
/**
 * Created by PhpStorm.
 * 페이지 설명: <학생> 학업관리 메인 페이지
 * User: Seungmin Lee
 * Date: 2018-04-02
 * Time: 오후 6:47
 */

use App\Http\DbInfoEnum;
?>
@extends('layouts.student_master')
@section('body.section')
    <div>
        <span>@lang('lecture.title')</span>
        <!-- 기간 설정 버튼 -->
        <span>
            <input type="button" value="@lang('pagination.previous')"
                   onclick="location.assign('{{ route('student.lecture.main', $prev_term) }}')">
            <span>@lang('lecture.term', ['year' => $year, 'term' => $term])</span>
            @if(!is_null($next_term))
                <input type="button" value="@lang('pagination.next')"
                       onclick="location.assign('{{ route('student.lecture.main', $next_term) }}')">
            @endif
        </span>
    </div>
    <!-- 몸체 -->
    <div style="overflow-y: auto; height: 800px;">
        @forelse($lecture_list as $lecture)
            <div class="lecture_div">
                <span>
                    <div class='lecture_img'>교수님이미지</div>
                    <div class='lecture_name'>@lang('lecture.subject_name'): {{ $lecture['title'] }}</div>
                </span>
                <div class="lecture_grade">
                  <div class="lecture_grade_table">
                    <table border="1">
                        <thead>
                            <tr>
                                <th></th>
                                <th>@lang('lecture.count')</th>
                                <th>@lang('lecture.gettable_score')</th>
                                <th>@lang('lecture.gained_score')</th>
                                <th>@lang('lecture.average')</th>
                                <th>@lang('lecture.reflection')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($lecture['score'] as $gainedScore)
                            <tr>
                                <td>{{ $gainedScore['type'] }}</td>
                                <td>{{ $gainedScore['count'] }}</td>
                                <td>{{ $gainedScore['perfect_score'] }}</td>
                                <td>{{ $gainedScore['gained_score'] }}</td>
                                <td>{{ $gainedScore['average'] }}</td>
                                <td>{{ $gainedScore['reflection'] }}%</td>
                            </tr>
                        @endforeach
                        </tbody>
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
                  @if(!is_null($lecture['gained_score']))
                  <table class=lecture_view_table>
                    <thead>
                        <tr>
                            <th>@lang('interface.date')</th>
                            <th>@lang('lecture.type')</th>
                            <th>@lang('lecture.score_content')</th>
                            <th>@lang('lecture.gained_score')/@lang('lecture.gettable_score')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lecture['gained_score'] as $gained_score)
                            <tr>
                                <td>{{ $gained_score['reg_date'] }}</td>
                                <td>{{ $gained_score['type'] }}</td>
                                <td>{{ $gained_score['content'] }}</td>
                                <td>{{ $gained_score['score'].'/'.$gained_score['perfect_score'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button v-on:click="pageChange">간략히</button>
              </div>
                @else
                    @lang('lecture.not_exists_scores')
                @endif
            </div>
            <hr>
        @empty
            <span>@lang('lecture.not_exists_lecture')</span>
        @endforelse

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

  .lecture_img {
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
