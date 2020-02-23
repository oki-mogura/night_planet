<div id="wrapper">
    <div id="dash-board" class="container">
        <span id="dummy" style="display: hidden;"></span>
        <div class="row">
            <div class="col s12 m12 l12">
                <!-- 編集中の店舗 START-->
                <?= $this->element('now_edit_shop'); ?>
                <!-- 編集中の店舗 END-->
            </div>
            <div class="red darken-1 card-panel col s12 center-align">
                <p class="white-text recruit-label section-label"><span> 店舗 </span></p>
            </div>
            <div class="col s12 m6 l6 year-graph-section section">
                <div class="card-panel year-graph-shop section">
                    <canvas id="shopYearChart" height="300"></canvas>
                </div>
            </div>
            <div class="col s12 m6 l6 year-graph-section section">
                <div class="card-panel year-graph-shop section">
                    <!--描画箇所 -->
                    <canvas id="shopWeekChart" height="300"></canvas>
                    <!--凡例箇所 -->
                    <ul id="chart_legend"></ul>
                </div>
            </div>
            <div class="col s12 m6 l6 day-graph-section section">
                <div class="card-panel day-graph-shop section">
                    <!--描画箇所 -->
                    <canvas id="shopMonthChart" height="500"></canvas>
                    <!--凡例箇所 -->
                </div>
            </div>
            <div class="red darken-1 card-panel col s12 center-align">
                <p class="white-text recruit-label section-label"><span> スタッフ </span></p>
            </div>
            <div class="col s12">
                <p style="font-weight: bolder;">
                スタッフアクセスレポートは現在機能を停止中です。近日中に機能を再開いたしますので、それまでしばらくお待ちください。以下のグラフはダミーデータになります。</p>
            </div>
            <div class="col s12 m6 l6 day-graph-section section">
                <div class="card-panel day-graph-cast section">
                    <!--描画箇所 -->
                    <canvas id="castWeekChart" height="300"></canvas>
                    <!--凡例箇所 -->
                </div>
            </div>
            <div class="col s12 m6 l6 day-graph-section section">
                <div class="card-panel total-graph-cast section">
                    <!--描画箇所 -->
                    <canvas id="castTotalChartCast" height="300"></canvas>
                    <!--凡例箇所 -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>


    /**
     * 曜日別アクセス状況作成
     */
    var shopWeekChart = function (accessWeeks) {

        // データセット
        var data = [
            accessWeeks['monday_pageviews']
            , accessWeeks['tuesday_pageviews']
            , accessWeeks['wednesday_pageviews']
            , accessWeeks['thursday_pageviews']
            , accessWeeks['friday_pageviews']
            , accessWeeks['saturday_pageviews']
            , accessWeeks['sunday_pageviews']
        ]
        var ctx = document.getElementById("shopWeekChart");
        var shopWeekChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["月曜", "火曜", "水曜", "木曜", "金曜", "土曜", "日曜"],
                datasets: [{
                    backgroundColor: [
                        "#ff8cd1",
                        "#00ec5f",
                        "#ffeb00",
                        "#1995ff",
                        "#ff8303",
                        "#ff0000",
                        "#d800ff"
                    ],
                    data: data
                }]
            },
            options: {
                title: {
                    display: true,
                    text: ['曜日別 割合',
                    ]
                }
            }
        });
    }

    /**
    * 月間別アクセス状況作成
    */
    var shopYearChart = function (accessYears) {

        var data = [];
        var label = [];
        // データセット
        for (var i = 1; i <= 12; i++) {
            data.push(accessYears[i + '_pageviews']);
            label.push(i + ' 月');
        }
        var ctx = document.getElementById('shopYearChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: label,
                datasets: [{
                    label: '月間アクセス状況',
                    backgroundColor: 'rgb(255, 25, 102)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: data
                }]
            },

            // Configuration options go here
            options: {
                title: {
                    display: true,
                    text: accessYears['y'] + ' 年'
                }
            }
        });
    }

    /**
     * 日別アクセス状況作成
     */
    var shopMonthChart = function (accessMonths) {

        // 年月分割
        var arrayYm = accessMonths['ym'].split('-');
        const howManyDays = new Date(arrayYm[0], arrayYm[1], 0).getDate();
        var span = arrayYm[1] + " 月 1 日 ～ "
            + arrayYm[1] + " 月 " + howManyDays + " 日";
        var data = [];
        var label = [];
        // データセット
        for (var i = 1; i <= howManyDays; i++) {
            data.push(accessMonths[i + '_pageviews']);
            label.push(i + ' 日');
        }

        var ctx = document.getElementById('shopMonthChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'horizontalBar',

            // The data for our dataset
            data: {
                labels: label,
                datasets: [{
                    label: '日別アクセス状況',
                    backgroundColor: 'rgb(255, 25, 102)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: data
                }]
            },
            options: {
                title: {
                    display: true,
                    text: span
                }
                // responsive: true,
                // maintainAspectRatio: false,
                // 各種設定の記述
            }

        });
    }
    /**
     * 週別アクセス状況作成
     */
    var castWeekChart = function () {

        var ctx = document.getElementById('castWeekChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'horizontalBar',

            // The data for our dataset
            data: {
                labels: ['ユーザー１', 'ユーザー２', 'ユーザー３', 'ユーザー４', 'ユーザー５'],
                datasets: [{
                    label: '週別アクセス状況',
                    backgroundColor: 'rgb(255, 25, 102)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: ['９月３０～１０月６日',
                    ]
                }
                // responsive: true,
                // maintainAspectRatio: false,
                // 各種設定の記述
            }

        });
    }

    /**
     * 週別アクセス状況作成
     */
    var castTotalChartCast = function () {

        var ctx = document.getElementById('castTotalChartCast').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'horizontalBar',

            // The data for our dataset
            data: {
                labels: ['ユーザー１', 'ユーザー２', 'ユーザー３', 'ユーザー４', 'ユーザー５'],
                datasets: [{
                    label: 'トータルアクセス状況',
                    backgroundColor: 'rgb(255, 25, 102)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20]
                }]
            },
            options: {
                // responsive: true,
                // maintainAspectRatio: false,
                // 各種設定の記述
            }

        });
    }
    var accessYears = JSON.parse('<?php echo ($reports['access_years']); ?>');
    var accessMonths = JSON.parse('<?php echo ($reports['access_months']); ?>');
    var accessWeeks = JSON.parse('<?php echo ($reports['access_weeks']); ?>');
    shopYearChart(accessYears);
    shopWeekChart(accessWeeks);
    shopMonthChart(accessMonths);
    castWeekChart();
    castTotalChartCast();
    $(document).ready(function () {
        $(".card-panel").css("padding", "5px");
    });

</script>