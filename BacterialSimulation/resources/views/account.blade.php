@extends('layouts.master-layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <label> Account type: 
            <input type= "text" name= "fn id="fn" /></label><br><br>
            <label> E-mail: 
            <input type= "text" name="em" id="em"/></lebel><br><br>
            <lable> Total Simulation run:
            <input type="text" name="nm" id="nm"/> </lable><br><br>
            <lable> Account since:
            <input type="text" name="dy" id="dy"/> </lable><br><br>  
            <input type="button" id= "edit" value="Edit information" onclick= "validate()"/>
            <input type="button" value="Delete Account"/>
        </div>
    </div>
</div>
@endsection
