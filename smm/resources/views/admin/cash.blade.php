@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - Cash')
@section('content')
   
  
  
  
  
  

  
  
  
  
  
    <div class="row">
        <div class="col-md-12 mtn10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mydatatable table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                       @for ($i = 0; $i < $c; $i++)

                                      <tr>
                                        <td>{{ $datas[$i]->name }}</td>
                                        <td><span class="label label-success user-fund-top" style="font-size: 15px;">{{ $balance[$i]->currency }} : {{ $balance[$i]->balance }}</span></td>
                                       
                                    </tr>
                       @endfor
                                
                                    
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
   
   
   
   
   
   

   
   
   
   
   
   
   
   
   
   
   
   
   
@endsection