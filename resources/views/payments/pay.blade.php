<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>
        <style>
            span > strong{
                color: red;
            }
        </style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if (session('status'))
                        <span class="help-block">
                            <small>{{ session('status') }}</small>
                        </span>
                        @endif
                
                <div class="panel-heading">Pay</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('pay', ['job' => $job]) }}">
                        @csrf

                        <div class="form-group @error('money') has-error @enderror">
                            <label for="email" class="col-md-4 control-label">Payment Method</label>
                            
                            <div class="col-md-6">
                               Mobile money: <input id="email" type="checkbox"  name="money" value="mobile money" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                               @error('money')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group @error('pno') has-error @enderror">
                            <label for="password" class="col-md-4 control-label">Phone contact</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="pno" placeholder="07xxxxxxxx" >
                                
                                @error('pno')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group @error('amount') has-error @enderror">
                            <label for="password" class="col-md-4 control-label">Amount</label>

                            <div class="col-md-6">
                                <input id="password" type="number" class="form-control" name="amount" >
                                <small> The fee for the job is <strong>{{ $job->price }}</strong> </small>
                                @error('amount')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (session('no_match'))
                                    <span class="help-block">
                                        <strong>{{ session('no_match') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @error('pin') has-error @enderror">
                            <label for="password" class="col-md-4 control-label">Pin</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="pin" >
                                @error('pin')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
</html>
