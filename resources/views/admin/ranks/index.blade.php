@extends('admin.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Pilot Ranks</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.ranks.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('admin.ranks.table')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function () {
    $(document).on('submit', 'form.add_rank', function (event) {
        event.preventDefault();
        $.pjax.submit(event, '#ranks_table_wrapper', {push: false});
    });
});
</script>
@endsection
