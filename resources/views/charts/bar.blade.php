<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div id="box1" style="width: 600px;height:400px;"></div>

<!-- 以下为js代码 -->
<script src="{{ URL::asset('js/echarts/echarts.min.js') }}"></script>
<script src="{{ URL::asset('js/echarts/macarons.js') }}"></script>
<script type="text/javascript">
    // 获取数据的方法
    function getData1() {
        $.get("{{ url('api/chartsinfo1') }}", function (data) {
            console.log(data);
            // var abc = data.data.text;
            chart1(data);
        });
    }
    getData1();

    // 定义一个方法封装echarts实例，供给获取数据回调成功后调用。
    function chart1(data) {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('box1'), 'macarons');
        console.log('------------开始调用bar---------');
        // 指定图表的配置项和数据
        option = {
            title : {
                text: ' ',
                subtext: ' '
            },
            tooltip : {
                trigger: 'axis'
            },
            legend: {
                data:['总行生产','同城生产','总行测试','总行库房']
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    dataView : {show: false, readOnly: false},
                    magicType : {show: true, type: ['line', 'bar']},
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            calculable : true,
            xAxis : [
                {
                    type : 'category',
                    data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name:'总行生产',
                    type:'bar',
                    data:[data.aa.a01, data.aa.a02, data.aa.a03, data.aa.a04, data.aa.a05, data.aa.a06, data.aa.a07, data.aa.a08, data.aa.a09, data.aa.a10, data.aa.a11, data.aa.a12],
                    markPoint : {
                        data : [

                        ]
                    },
                    markLine : {
                        data : [
                            {type : 'average', name: '平均值'}
                        ]
                    }
                },
                {
                    name:'同城生产',
                    type:'bar',
                    data:[data.bb.a01, data.bb.a02, data.bb.a03, data.bb.a04, data.bb.a05, data.bb.a06, data.bb.a07, data.bb.a08, data.bb.a09, data.bb.a10, data.bb.a11, data.bb.a12],
                    markPoint : {
                        data : [
                            {name : '年最高', value : 182.2, xAxis: 7, yAxis: 183, symbolSize:18},
                            {name : '年最低', value : 2.3, xAxis: 11, yAxis: 3}
                        ]
                    },
                    markLine : {
                        data : [
                            {type : 'average', name : '平均值'}
                        ]
                    }
                },
                {
                    name:'总行测试',
                    type:'bar',
                    data:[data.cc.a01, data.cc.a02, data.cc.a03, data.cc.a04, data.cc.a05, data.cc.a06, data.cc.a07, data.cc.a08, data.cc.a09, data.cc.a10, data.cc.a11, data.cc.a12],
                    markPoint : {
                        data : [

                        ]
                    },
                    markLine : {
                        data : [
                            {type : 'average', name: '平均值'}
                        ]
                    }
                },
                {
                    name:'总行库房',
                    type:'bar',
                    data:[data.ee.a01, data.ee.a02, data.ee.a03, data.ee.a04, data.ee.a05, data.ee.a06, data.ee.a07, data.ee.a08, data.ee.a09, data.ee.a10, data.ee.a11, data.ee.a12],
                    markPoint : {
                        data : [
                        ]
                    },
                    markLine : {
                        data : [
                            {type : 'average', name: '平均值'}
                        ]
                    }
                }
            ]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    }

    // setTimeout('chart()', 1000);
</script>