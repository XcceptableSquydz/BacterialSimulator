@extends('layouts.master-layout')
@section('title')
<title>Account</title>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Account Information: </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="account_type" class="col-md-6 control-label">Account Type: </label>
                                <?php $user = Auth::user()?>
                                <label name="account_type" id="account_type" class="control-label">
                                    @if ($user->user_type == 1) Educator
                                    @elseif ($user->user_type == 2) Student
                                    @else General Public
                                    @endif
                                </label>                                
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-6 control-label col-centered">E-mail: </label>
                                
                                <label name="email" id="email" class="control-label"> {{ $user->email }}</label>                                
                            </div>
                            <div class="form-group">
                                <label for="total" class="col-md-6 control-label col-centered">Total Simulation run: </label>
                                <label name="total" id="total" class="control-label">{{ $user->total_sims_run }}</label>
                            </div>
                            <div class="form-group">
                                <label for="creation" class="col-md-6 control-label col-centered">Account since: </label>
                                <label name="creation" id="creation" class="control-label">{{ $user->created_at }}</label>
                                
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-centered">
                                    <a role="button" class="btn btn-info" id='edit-link' href="/edit_account">
                                        Edit Account
                                    </a>
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <div class="col-md-8 col-centered">
                                    <button type="submit" class="btn btn-danger" id='delete-button'>
                                        Delete Account
                                    </button>
                                </div>
                            </div>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
