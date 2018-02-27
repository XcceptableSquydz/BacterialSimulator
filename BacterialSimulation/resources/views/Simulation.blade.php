@extends('layouts.master-layout')
@section('title')
    <title>Run Simulation</title>
@endsection
@section('content')
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Run Simulation
            </div>
            <div class="form-horozontal">
                <div class="form-group">

                    //needs to be connected to database 
                    <div class="form-group{{ $errors->has('bacteria') ? ' has-error' : '' }}">
                            <label for="bacteria" class="col-md-4 control-label">Select Pathogen</label>

                            <div class="col-md-6">
                                <select id="bacteria" class="form-control" name="bacteria" value="{{ old('bacteria') }}" required>
                                    @foreach ($bacteria as $key=>$val)
                                    <option value="{{ $val->bacteria_code }}">{{$val->bacteria_name}}</option>
                                    @endforeach
                                </select>
                                
                                @if ($errors->has('bacteria'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bacteria') }}</strong>
                                    </span>
                                @endif
                            </div>

                             //needs to be connected to database 
                    <div class="form-group{{ $errors->has('food') ? ' has-error' : '' }}">
                            <label for="food" class="col-md-4 control-label">Select Food</label>

                            <div class="col-md-6">
                                <select id="food" class="form-control" name="food" value="{{ old('food') }}" required>
                                    @foreach ($food as $key=>$val)
                                    <option value="{{ $val->food }}">{{$val->food_name}}</option>
                                    @endforeach
                                </select>
                                
                                @if ($errors->has('food'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('food') }}</strong>
                                    </span>
                                @endif
                            </div>

                            //needs to be connected to database 
                            <div class="form-group{{ $errors->has('temp') ? ' has-error' : '' }}">
                            <label for="temp" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="temp" type="temp" class="form-control" name="temp" value="{{ old('temp') }}" required>

                                @if ($errors->has('temp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('temp') }}</strong>
                                    </span>
                                @endif
                            </div>

                            //needs a desired output for iteration 1

                            //how to add submit button?
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection