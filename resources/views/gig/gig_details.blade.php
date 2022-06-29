@extends('layouts.base')

@section('content')
<style>
    .row{
        display: block;
        width: 100%;

    }
    </style>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Gig title</h3><br>
                    {{-- Gig count --}}
                    <p> Some obviously silly job</p>
                    
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>About This Gig</h4>
                </div>
                <div class="panel-body">
                    <h3>Gig description</h3>
                    <p>Some funny job just figure it out by yourself ;)</p>
                    <p>Price: 5grand</p>
                    <p>Bids: _/_</p>
                    <p>Status: active/closed</p>
                </div>
            </div>
            <form action="#" method="post">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
                    Bid
                </button>
            </form>
            {{-- <div class="panel panel-default">
                
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        
                            
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form method="POST" action="#">
                                                    
                                                    <input name="gig_id" value="" hidden>
                                                    <input name="to_user_id" value="" hidden>
                                                    <div class="form-group">
                                                        <label for="email">Price:</label>
                                                        <input type="number" required name="price" min="5" max="5000" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Total days:</label>
                                                        <input type="number" required name="days" min="1" max="30" class="form-control">
                                                    </div>
                                                    <button type="submit" class="btn btn-success btn-block">
                                                        Bid
                                                    </button>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        
    </div>

@endsection