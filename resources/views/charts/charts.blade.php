<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div id="main" style="width: 600px;height:400px;"></div>
<p>来吧哥哥- {{ $lailai }}</p>

<!-- 以下为js代码 -->
<script src="{{ URL::asset('js/echarts.min.js') }}"></script>
<script type="text/javascript">

    // 获取数据的方法
    var abc = '';

    function getData() {
        $.get("{{ url('api/test') }}", function (data) {
            console.log(data);
            abc = data.abc;
        });
    }

    getData();


    // 基于准备好的dom，初始化echarts实例
    function chart() {
        var myChart = echarts.init(document.getElementById('main'));
        console.log('------------开始调用---------');
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: abc
            },
            tooltip: {},
            legend: {
                data: ['销量']
            },
            xAxis: {
                data: ["衬衫", "羊毛衫", "雪纺衫", "裤子", "高跟鞋", "袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    }

    setTimeout('chart()', 1000);
</script>