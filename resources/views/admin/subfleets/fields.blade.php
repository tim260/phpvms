<!-- Airline Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('airline_id', 'Airline Id:') !!}
    {!! Form::select('airline_id', $airlines, null , ['class' => 'form-control select2']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Fuel Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fuel_type', 'Fuel Type:') !!}
    {!! Form::select('fuel_type', $fuel_types, null , ['class' => 'form-control select2']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="pull-right">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.subfleets.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>
