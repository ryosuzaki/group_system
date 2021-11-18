@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                
                <h1>これまでの記録</h1>
                <div>
                    <table border="0px none">
                        <tr>
                            <th class="noborder"><button class="btn btn-primary" id="condition" onclick="condition()">調子</button></th>
                            <th class="noborder"><button class="btn btn-primary" id="food" onclick="food()">食欲</button></th>
                            <th class="noborder"><button class="btn btn-primary" id="through" onclick="through()">お通じ</button></th>
                        </tr>
                    </table>

                </div>

                <div class="wrapper">
                    <!-- xxxx年xx月を表示 -->
                    <h1 id="header"></h1>
                    <h2 id="text1">調子</h2>
                    <!-- ボタンクリックで月移動 -->
                    <div>
                        <button class="btn btn-primary" id="prevmonth" onclick="prev()"></button>
                        <button class="btn btn-primary" id="nowmonth" onclick="now()">今月に戻る</button>
                        <button class="btn btn-primary" id="nextmonth" onclick="next()"></button>
                    </div>

                    <!-- カレンダー -->
                    <div id="calendar"></div>
                </div>
                </input>

                <p style="color:white;">
                    <span id="good" style="background-color:blue;">良い</span>
                    <span id="normal" style="background-color:green;">普通</span>
                    <span id="rock" style="background-color:brown;"></span>
                    <span id="bad" style="background-color:red;">悪い</span>
                </p>
                <br><br>
                <p>
                    <div>
                        <table>
                            <tr>
                                <th class="noborder"><button class="btn btn-primary" id="taion" style="background:red" onclick="taion()">体温</button></th>
                                <th class="noborder"><button class="btn btn-primary" id="blood" onclick="blood()">血圧</button></th>
                                <th class="noborder"><button class="btn btn-primary" id="weight" onclick="weight()">体重</button></th>
                            </tr>
                        </table>
                    </div>
                    <h2 id="text2">体温</h2>
                    <div id="next-prev-button">
                        <button class="btn btn-primary" id="prevweek" onclick="prev_line()">次の週</button>
                        <button class="btn btn-primary" id="nowweek" onclick="now_line()">今週に戻る</button>
                        <button class="btn btn-primary" id="nextweek" onclick="next_line()">前の週</button>
                    </div>

                    <style>
                        #ex_chart {max-width:640px;max-height:480px;}
                    </style>
                    <div class="chart-container" style="position: relative; width:60vw; height:50vh">
                        <canvas id="ex_chart" style="background-color:white;"></canvas>
                    </div>

                </p>
                
            </div>
        </div>
    </div>
</div>
<script>    //カレンダーの処理
    const week = ["日", "月", "火", "水", "木", "金", "土"];
    const today = new Date();
    // 月末だとずれる可能性があるため、1日固定で取得
    var showDate = new Date(today.getFullYear(), today.getMonth(), 1);
    var nowday = today.getDate() - 1;
    console.log(nowday);
    //これまでの記録の1つ気分のデータ
    var condition_ary = [""];
    var food_ary = [""];
    var through_ary = [""];
    //表示する情報の記録を格納
    var result = condition_ary;
    // 初期表示
    $(document).ready( function(){
        condition_ary[nowday] = "{{$info['feeling']}}";
        food_ary[nowday] = "{{$info['syokuyoku']}}";
        through_ary[nowday] = "{{$info['otuzi']}}";
        showProcess(today, calendar);
    });

    function condition(){
        document.getElementById("text1").textContent = "調子";
        result = condition_ary;
        showDate.setMonth(showDate.getMonth());
        showProcess(showDate);
        document.getElementById("rock").innerHTML = "";
        document.getElementById("bad").innerHTML = "悪い";
        document.getElementById("good").innerHTML = "良い";
    }
    function food(){
        document.getElementById("text1").textContent = "食欲";
        result = food_ary;
        showDate.setMonth(showDate.getMonth());
        showProcess(showDate);
        document.getElementById("rock").innerHTML = "";
        document.getElementById("bad").innerHTML = "悪い";
        document.getElementById("good").innerHTML = "良い";
    }
    function through(){
        document.getElementById("text1").textContent = "お通じ";
        result = through_ary;
        showDate.setMonth(showDate.getMonth());
        document.getElementById("rock").innerHTML = "固い";
        document.getElementById("bad").innerHTML = "出ない";
        document.getElementById("good").innerHTML = "形がない";
        showProcess(showDate);
    }

    // 前の月表示
    function prev(){
        showDate.setMonth(showDate.getMonth() - 1);
        showProcess(showDate);
    }

    function now(){
        showProcess(today);
    }

    // 次の月表示
    function next(){
        showDate.setMonth(showDate.getMonth() + 1);
        showProcess(showDate);
    }

    // カレンダー表示
    function showProcess(date) {
        document.getElementById("prevmonth").textContent = date.getMonth() + "月";
        document.getElementById("nextmonth").textContent = (date.getMonth() + 2) + "月";
        var year = date.getFullYear();
        var month = date.getMonth();
        document.querySelector('#header').innerHTML = year + "年 " + (month + 1) + "月";

        var calendar = createProcess(year, month);
        document.querySelector('#calendar').innerHTML = calendar;
    }

    // カレンダー作成
    function createProcess(year, month) {
        // 曜日
        var calendar = "<table id='calendertb' style='background-color:white;'><tr class='dayOfWeek'>";
        for (var i = 0; i < week.length; i++) {
            calendar += "<th class='dayOfWeek'>" + week[i] + "</th>";
        }
        calendar += "</tr>";

        var value = 0;
        var startDayOfWeek = new Date(year, month, 1).getDay();
        var endDate = new Date(year, month + 1, 0).getDate();
        var lastMonthEndDate = new Date(year, month, 0).getDate();
        var row = Math.ceil((startDayOfWeek + endDate) / week.length);

        // 1行ずつ設定
        for (var i = 0; i < row; i++) {
            calendar += "<tr>";
            // 1colum単位で設定
            for (var j = 0; j < week.length; j++) {
                if (i == 0 && j < startDayOfWeek) {
                    // 1行目で1日まで先月の日付を設定
                    calendar += "<td class='disabled calendertd'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
                } else if (value >= endDate) {
                    // 最終行で最終日以降、翌月の日付を設定
                    value++;
                    calendar += "<td class='disabled calendertd'>" + (value - endDate) + "</td>";
                } else {
                    // 当月の日付を曜日に照らし合わせて設定
                    value++;
                    if(result[value-1] == "良い" || result[value-1] == "形がない"){
                        calendar += "<td class='calendertd' style='background-color:blue; color:white;'>" + value + "</td>";
                    }else if(result[value-1] == "普通"){
                        calendar += "<td class='calendertd' style='background-color:green; color:white;'>" + value + "</td>";
                    }else if(result[value-1] == "悪い" || result[value-1] == "出ない"){
                        calendar += "<td class='calendertd' style='background-color:red; color:white;'>" + value + "</td>";
                    }else if(result[value-1] == "固い"){
                        calendar += "<td class='calendertd' style='background-color:brown; color:white;'>" + value + "</td>";
                    }else{
                            calendar += "<td class='calendertd'>" + value + "</td>";
                    }
                }
            }
            calendar += "</tr>";
        }
        return calendar;
    }
</script>

<style type="text/css">		//カレンダーのcss
		#calendar {
		    text-align: center;
		    width: 100%;
		}
		#calendertb {
		    border-collapse: collapse;
		    width: 100%;
		}
		th.dayOfWeek {
		    color: #000;
		}
		th.dayOfWeek, td.calendertd {
		    border: 1px solid #000;
		    padding-top: 10px;
		    padding-bottom: 10px;
		    text-align: center;
		}
		/*前後月の日付*/
		td.disabled {
		    color: #ccc;
		}
		/*本日*/
		td.today {
		    background-color: #D65E72;
		    color: #fff;
            text-align: center;
		}

		/*ボタン*/
        #nowmonth{
            margin-left: 18%;
        }
        #nowweek {
            margin-left: 15%;
        }
		#prevweek,#prevmonth {
		    float: left;
		}
		#nextweek,#nextmonth {
		    float: right;
		}
		.noborder{
			border: 0px none;
		}
</style>

<script>                    //グラフの処理
    var ctx = document.getElementById('ex_chart');
    var day = new Date();
    var day_write = [];
    function days(){
        for(var i = 0; i < 7;i++){
            day_write[i] = day.getMonth() + 1 + "/" + day.getDate();
            day.setDate(day.getDate() - 1);
        }
    }
    console.log(day_write);
    var taion_date = [""];
    var blood_max = [""];
    var blood_min = [""];
    var weight_date = [""];
    var result_date1 = taion_date;
    var result_date2;
    var label_text1 = "体温";
    var label_text2 = "";
    var bo_co2 = [0,0,0,0];

    function prev_line(){
        day.setDate(day.getDate() + 14);
        gl_line();
    }
    function next_line(){
        gl_line();
    }
    function now_line(){
        day = new Date();
        gl_line();
    }
    function taiondate(){
        var temp = ["{{$info['taion']}}"];
        for(var count=0;count < 7;count++){
            if(temp[count] == null){
            }else if(temp[count].match(/低い/)){
                taion_date[count] = "1";
            }else if(temp[count].match(/36.0/)){
                taion_date[count] = "2";
            }else if(temp[count].match(/36.1/)){
                taion_date[count] = "3";
            }else if(temp[count].match(/36.6/)){
                taion_date[count] = "4";
            }else if(temp[count].match(/37.1/)){
                taion_date[count] = "5";
            }else if(temp[count].match(/37.6/)){
                taion_date[count] = "6";
            }else if(temp[count].match(/38.1/)){
                taion_date[count] = "7";
            }else if(temp[count].match(/38.6/)){
                taion_date[count] = "8";
            }else if(temp[count].match(/高い/)){
                taion_date[count] = "9";
            }else if(temp[count].match(/測ってない/)){
                taion_date[count] = "0";
            }
        }
    }
    function taion(){
        document.getElementById("taion").style.backgroundColor = "red";
        document.getElementById("blood").style.backgroundColor = "#9c27b0";
        document.getElementById("weight").style.backgroundColor = "#9c27b0";
        document.getElementById("text2").innerHTML = "体温";
        day = new Date();
        bo_co2 = [0,0,0,0];
        taiondate();
        gl_line();
    }

    function blood(){
        document.getElementById("taion").style.backgroundColor = "#9c27b0";
        document.getElementById("blood").style.backgroundColor = "red";
        document.getElementById("weight").style.backgroundColor = "#9c27b0";
        document.getElementById("text2").innerHTML = "血圧";
        day = new Date();
        bo_co2 = [100,100,255,1];
        gl_line();
        
    }

    function weight(){
        document.getElementById("taion").style.backgroundColor = "#9c27b0";
        document.getElementById("blood").style.backgroundColor = "#9c27b0";
        document.getElementById("weight").style.backgroundColor = "red";
        document.getElementById("text2").innerHTML = "体重";
        day = new Date();
        bo_co2 = [0,0,0,0];
        gl_line();
        
    }

    function gl_line(){
        days();
        if(document.getElementById("text2").innerHTML == "体温"){
            var data = {
            labels: day_write,
            datasets: [{
                label: "体温",
                data: taion_date,
                borderColor: 'rgba(255, 100, 100, 1)',
                lineTension: 0,
                fill: false,
                borderWidth: 1.0,
                pointStyle: 'text'
            }]
            };
            var options = {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 10,
                            autoSkip: true,
                            maxTicksLimit: 10,
                            callback: function(value, index, values) {
                                var label;
                                if(index == 10){
                                    label = "測ってない";
                                }
                                if (index == 9) {
                                    label = '35.5℃より低い';
                                }
                                if(index == 8){
                                    label = '35.5～36.0';
                                }
                                if(index == 7){
                                    label = '36.1～36.5';
                                }
                                if(index == 6){
                                    label = '36.6～37.0';
                                }
                                if(index == 5){
                                    label = '37.1～37.5';
                                }
                                if(index == 4){
                                    label = '37.6～38.0';
                                }
                                if(index == 3){
                                    label = '38.1～38.5';
                                }
                                if(index == 2){
                                    label = '38.6～39.0';
                                }
                                if(index == 1){
                                    label = '39.0℃より高い';
                                };
                                return label;
                            }                    
                        }
                    }]
                }
            };
            var ex_chart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
            });
        }else if(document.getElementById("text2").innerHTML == "血圧"){
            var data = {
                labels: day_write,
                datasets: [{
                    label: "最高血圧",
                    data: blood_max,
                    borderColor: 'rgba(255, 100, 100, 1)',
                    lineTension: 0,
                    fill: false,
                    borderWidth: 3,
                    pointStyle: 'text'
                },{
                    label: "最低血圧",
                    data: blood_min,
                    borderColor: 'rgba(' + bo_co2 + ')',
                    lineTension: 0,
                    fill: false,
                    borderWidth: 3,
                    pointStyle: 'text'
                }]
            };
            
            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                                                
                        }
                    }]
                }
            };
                
            var ex_chart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: options
            });
        }else{
            var data = {
                labels: day_write,
                datasets: [{
                    label: "体重",
                    data: weight_date,
                    borderColor: 'rgba(255, 100, 100, 1)',
                    lineTension: 0,
                    fill: false,
                    borderWidth: 3,
                    pointStyle: 'text'
                }]
            };
            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                                                
                        }
                    }]
                }
            };
                
            var ex_chart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: options
            });
        }
    }
    $(document).ready( function(){
        taiondate();
        blood_max[0] = "{{$info['ketuatu_saikou']}}";
        blood_min[0] = "{{$info['ketuatu_saitei']}}";
        weight_date = ["{{$info['taiju']}}","66","65.2","66.4"];
        gl_line();
    });
</script>

@endsection
