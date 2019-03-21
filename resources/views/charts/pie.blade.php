<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div id="box" style="width: 600px;height:400px;"></div>

<!-- 以下为js代码 -->
<script src="{{ URL::asset('js/echarts/echarts.min.js') }}"></script>
<script type="text/javascript">
    // 获取数据的方法
    function getData() {
        $.get("{{ url('api/chartsinfo') }}", function (data) {
            console.log(data);
            // var abc = data;
            chart(data);
        });
    }
    getData();

    // 定义一个方法封装echarts实例，供给获取数据回调成功后调用。
    function chart(data) {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('box'), 'macarons');
        console.log('------------开始调用pie---------');
        // 指定图表的配置项和数据
        option = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient : 'vertical',
                x : 'left',
                data:['系统组','网络组','安全组','办公组','其他组','总行生产机房','同城生产机房','总行测试机房','总行设备库房','运行','停机','未知']
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    dataView : {show: false, readOnly: false},
                    magicType : {
                        show: true,
                        type: ['pie', 'funnel']
                    },
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            calculable : false,
            series : [
                {
                    name:'详细信息',
                    type:'pie',
                    selectedMode: 'single',
                    radius : [0, 70],

                    // for funnel
                    x: '20%',
                    width: '40%',
                    funnelAlign: 'right',
                    max: 1548,

                    itemStyle : {
                        normal : {
                            label : {
                                position : 'inner'
                            },
                            labelLine : {
                                show : false
                            }
                        }
                    },
                    data:[
                        {value:data.status1, name:'运行', selected:true},
                        {value:data.status2, name:'停机'},
                        {value:data.status3, name:'未知'}
                    ]
                },
                {
                    name:'详细信息',
                    type:'pie',
                    radius : [100, 140],

                    // for funnel
                    x: '60%',
                    width: '35%',
                    funnelAlign: 'left',
                    max: 1048,

                    data:[
                        {value:data.category1, name:'系统组'},
                        {value:data.category2, name:'网络组'},
                        {value:data.category3, name:'安全组'},
                        {value:data.category4, name:'办公组'},
                        {value:data.category5, name:'其他组'},

                    ]
                }
            ]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    }

    // setTimeout('chart()', 1000);
</script>