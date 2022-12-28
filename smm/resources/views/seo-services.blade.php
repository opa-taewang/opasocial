@extends('layouts.app')
@section('title', getOption('app_name') . ' - Seo Services')
@section('content')

<style>
    .search {
  width: 100%;
  position: relative;
  display: flex;
}
.text-center-desc {
    margin: 0 auto;
    display: table;
}
.favorite{
    cursor: pointer;
}
.well.wellHeader {
    color: #000000;
}
.like {
    color: red;
}
.searchTerm {
  width: 100%;
  border: 3px solid #FFD700;
  border-right: none;
  padding: 5px;
  height: 36px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #FFD700;
}

.wellHeader{
  color: #D2691E;
}
.searchTerm:focus{
  color: #FFD700;
}

.searchButton {
  width: 40px;
  height: 36px;
  border: 1px solid #FFD700;
  background: #FFD700;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
}
form {
    display: contents;
}
</style>
</br>
   



    @foreach($services as $k => $service)
       <tr class="cateRow">
                                    <td colspan="7"><div class="cate-head">{{ $service->name }}</div></td>
                                </tr>
                                </br>
        <!--SERVICE NAME TABLE-->
        <div class="row">
            <div class="col-sm-12">
                <div class="well">
                    <div class="table-responsive">
                        <table class="serviceTable table table-striped table-sm ">
                            <thead class="thead-dark">
                                <tr>
                                  <th class="nowrap"><i class="material-icons">format_list_numbered</i >Sr.No</th>
                                  <th><i class="material-icons">storage</i> Name</th>
                                  <th class="nowrap"> DripFeed</th>
                                  <th class="nowrap"><i class="material-icons">favorite</i> Extras</th>
                                  <th class="nowrap"><i class="material-icons">bar_chart</i> Price</th>
                                  <th class="nowrap"><i class="fa fa-list-alt"></i> Category</th>
                                  <th><i class="material-icons">format_align_left</i> @lang('general.description')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($service->packages as $k1 => $package)
                                <tr>
                                    <td data-th="@lang('general.package_id')">{{ $k1+1 }}</td>
                                    <td>{{ $package->name }}</td>
                                    <td>{{ ($package->dripfeed)?'Yes':'No' }}</td>
                                    <td>
                                        @if($package->extra)
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#extrasdetails{{ $package->id }}"><i class="fa fa-eye"></i></button>
                                        <div class="modal fade" id="extrasdetails{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">{{ $package->name }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                  <table class="table table-responsive table-bordered">
                                                      <thead>
                                                          <th>#</th>
                                                          <th>Name</th>
                                                          <th>Price</th>
                                                      </thead>
                                                      <tbody>
                                                          @foreach($package->extraservices as $key=> $extra)
                                                          <tr>
                                                              <td>{{$key+1}}</td>
                                                              <td>{{$extra->name}}</td>
                                                              <td>{{ getOption('currency_symbol') . number_formats($extra->price,2) }}</td>
                                                          </tr>
                                                          @endforeach
                                                      </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td><span style="color:#4510c2;">{{ getOption('currency_symbol') . number_formats($package->price,2) }}</span></td>
                                    <td><span style="color:#2096f3;">{{ $package->service->category->name }}</span></td>
                                    <td data-th="@lang('general.description')">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#serviceDesc{{ $package->id }}">Read More</button>
                                        <div class="modal fade" id="serviceDesc{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">{{ $package->name }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                  {{ $package->description }}
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if(!count($service->packages))
                                <tr>
                                    <td class="text-center" colspan="6">No Package</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

<script>function aClass( classname, element ) {var cn = element.className;if( cn.indexOf( classname ) != -1 ) {return;}if( cn != '' ) {classname = ' '+classname;}element.className = cn+classname;}function rClass( classname, element ) {var cn = element.className;var rxp = new RegExp( "\\s?\\b"+classname+"\\b", "g" );cn = cn.replace( rxp, '' );element.className = cn;}function addToFavorite(sid,pid,element) {
        $("#p"+pid+" > i.favorite").css("visibility","hidden");
        $("#p"+pid).append('<i id="spin'+pid+'" class="fa fa-spinner fa-spin" style="font-size:20px;margin-right: 26px;"></i>');$.ajax({type: "POST",url: document.location.origin+"/addtofavorite",data: {sid:sid,pid:pid, _token: '{{csrf_token()}}'},success: function(data){if(data=="true"){aClass("like",element);}else{rClass("like",element);}$("#p"+pid+" > i#spin"+pid).remove();$("#p"+pid+" > i.favorite").css("visibility","visible");}, error: function (error) {$("#p"+pid+" > i#spin"+pid).remove();$("#p"+pid+" > i.favorite").css("visibility","visible");}});}</script>
