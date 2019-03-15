<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div id="main" style="width: 600px;height:400px;"></div>

<!-- 以下为js代码 -->
<script src="{{ URL::asset('js/echarts.min.js') }}"></script>
<script type="text/javascript">
    // 获取数据的方法
    function getData() {
        $.get("{{ url('api/categories/1') }}", function (data) {
            console.log(data);
            var abc = data.data.name;
            chart(abc);
        });
    }
    getData();

    // 定义一个方法封装echarts实例，供给获取数据回调成功后调用。
    function chart(abc) {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        // console.log('------------开始调用---------', abc);
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

    // setTimeout('chart()', 1000);
</script>