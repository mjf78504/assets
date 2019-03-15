<!--

<div class="box box-{{ $style }}">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>

        <div class="box-tools">
            {{ $tools}}
        </div>
    </div>

-->
    <!-- /.box-header -->
    <!-- form start -->
    <div class="form-horizontal">

        <div class="box-body">
            
            <!--此处开始是表单域 -->
        
            <div class="row" >
                <div class="col-sm-6" > <!-- 第一列开始 -->
                @foreach($columns1 as $key => $column)
                    <div class="fields-group">
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">{{ $key }}</label>
                            <div class="col-sm-8">
                                @if($wrapped)
                                <div class="box box-solid box-default no-margin box-show">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        @if($escape)
                                            {{ $column }}&nbsp;
                                        @else
                                            {!! $content !!}&nbsp;
                                        @endif
                                    </div><!-- /.box-body -->
                                </div>
                                @else
                                    @if($escape)
                                        {{ $content }}
                                    @else
                                        {!! $content !!}
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach <!-- 第一列结束 -->
                </div>

                <!-- 这是第二列了 -->
                <div class="col-sm-6" > <!-- 第二列开始 -->
                @foreach($columns2 as $key => $column)
                    <div class="fields-group">
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">{{ $key }}</label>
                            <div class="col-sm-8">
                                @if($wrapped)
                                <div class="box box-solid box-default no-margin box-show">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        @if($escape)
                                            {{ $column }}&nbsp;
                                        @else
                                            {!! $content !!}&nbsp;
                                        @endif
                                    </div><!-- /.box-body -->
                                </div>
                                @else
                                    @if($escape)
                                        {{ $content }}
                                    @else
                                        {!! $content !!}
                                    @endif
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach 
                </div>  <!-- 第二列结束 -->

            </div>
        </div>
    </div>
<!--
</div>
-->