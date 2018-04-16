<?php
/**
 * Created by PhpStorm.
 * 페이지 설명: <학생> 출결 관리 페이지
 * User: Seungmin Lee
 * Date: 2018-03-30
 * Time: 오전 10:00
 */
?>
@extends('layouts.student_master')
@section('body.section')
    <div>
        <!-- 페이지 이름 -->
        <div>@lang('attendance.come_leave')</div>
        <!-- 기간 조작 버튼 - 이전 / 이후 -->
        <div>
            <span>
                <input type="button" id="button_prev" value="@lang('pagination.previous')">
            </span>
            <!-- 현재 설정된 기간 -->
            <span id="date">{{ $date }}</span>
            @if(!is_null($next_date))
                <span>
                    <input type="button" id="button_next" value="@lang('pagination.next')">
                </span>
            @endif
        </div>
        <!-- 주간, 월간 설정 버튼-->
        <div>
            <input type="button" id="button_weekly" value="@lang('interface.weekly')"
                   @if($period == 'weekly') disabled @endif>
            <input type="button" id="button_monthly" value="@lang('interface.monthly')"
                   @if($period == 'monthly') disabled @endif>
        </div>
    </div>
    <!-- 출석정보 -->
    <div>
        <span>
            <!-- 출석률 -->
            <div>@lang('attendance.attendance_rate')</div>
            <div>{{ $attendance_rate }}%</div>
        </span>
        <span>
            <!-- 출석 -->
            <span>@lang('attendance.attendance'): {{ $attendance }}</span>
            <!-- 지각 -->
            <span>@lang('attendance.late'): {{ $late }}</span>
            <!-- 결석 -->
            <span>@lang('attendance.absence'): {{ $absence }}</span>
            <!-- 조퇴 -->
            <span>@lang('attendance.early'): {{ $early }}</span>
        </span>
    </div>
    <!-- 출석률 그래프 -->
    <div id="check_in">
      <check-in-chart :chart-data="datacollection"></check-in-chart>
    </div>
    <!-- 그래프 -->
    <div id="check_in_All">
        <reactive :chart-data="datacollection"></reactive>
    </div>
    <!-- 출결 현황 표 -->
    <div>
        <table border="1">
            <th colspan="8">@lang('interface.details')</th>
            <tr>
                <td>@lang('attendance.attendance')</td><td>{{ $attendance }}</td>
                <td>@lang('attendance.late')</td><td>{{ $late }}</td>
                <td>@lang('attendance.absence')</td><td>{{ $absence }}</td>
                <td>@lang('attendance.early')</td><td>{{ $early }}</td>
            </tr>
            <tr>
                <td>@lang('attendance.nearest_attendance')</td><td>{{ $nearest_attendance }}</td>
                <td>@lang('attendance.nearest_late')</td><td>{{ $nearest_late }}</td>
                <td>@lang('attendance.nearest_absence')</td><td>{{ $nearest_absence }}</td>
                <td>@lang('attendance.nearest_early')</td><td>{{ $nearest_early }}</td>
            </tr>
        </table>
    </div>
@endsection
@section('script')
<script>
    /* 도넛 그래프 */
    Vue.component('check-in-chart', {

      extends: VueChartJs.Pie,
      mixins: [VueChartJs.mixins.reactiveProp],

      data: function () {
          return {
              options: {
                  responsive: false,
                  height: 200
              }
          }
      },
      mounted () {
          // this.chartData is created in the mixin
          this.renderChart(this.chartData, this.options)
      }
    })

    var vm = new Vue({
    el: '#check_in',
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
          labels: ['출석률'],
          datasets: [
            {
              backgroundColor: ['#6799FF', '#D5D5D5'],
              data: [ {{ $attendance_rate }}, 100-{{$attendance_rate}} ]
            }
          ]
        }
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
                responsive: false,
                maintainAspectRatio: false,
                height: 200
            }
        }
    },
    mounted () {
        // this.chartData is created in the mixin
        this.renderChart(this.chartData, this.options)
    }
})

var vm = new Vue({
    el: '#check_in_All',
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
          labels: ['출석', '지각', '결석', '조퇴'],
          datasets: [
            {
              backgroundColor: ['#6799FF', '#FFE400', '#FF0000', '#000000'],
              data: [ {{ $attendance }}, {{ $late }}, {{ $absence  }}, {{ $early }} ]
            }
          ]
        }
      }
    }
})
</script>

    <script language="JavaScript">
        // 기간 변경 이벤트
        function changePeriod(event) {
            let period = '';
            if(event.target.id === 'button_weekly') {
                period = 'weekly';
            } else if (event.target.id === 'button_monthly') {
                period = 'monthly';
            }
            location.replace('{{route('student.attendance')}}/' + period);
        }

        $('#button_weekly').click(changePeriod);
        $('#button_monthly').click(changePeriod);

        // 이전 기간 조회
        $('#button_prev').click(function() {
            // 01. 변수 설정
            let nowDate = new Date

        });

        // 다음 기간 조회
        $('#button_next').click(function() {
        });
        </script>
@endsection
