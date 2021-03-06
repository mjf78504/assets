<div class="col-sm-6">
    <div class="form-group ">
        <label class="col-sm-2 control-label">{{ $label }}</label>
        <div class="col-sm-8">
            @if($wrapped)
                <div class="box box-solid box-default no-margin box-show">
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if($escape)
                            {{ $content }}&nbsp;
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