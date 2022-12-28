<b>Choose Extra</b>
<table id="table{{$package->id}}" class="table text-center table-striped table-bordered">
<thead>
<th class="text-center">Sr.No</th>
<th class="text-center"><input type="checkbox" class="form-check-input" id="checkall{{$package->id}}" onclick="selectAll({{$package->id}})"></th>
<th class="text-center">Name</th>
<th class="text-center">Price</th>
</thead>
<tbody>
@foreach($package->extraservices as $key => $extra)
<tr>
    <td>{{$key+1}}</td>
    <td class="selectbox"><input onclick="selectextra(this,{{$package->id}},{{$extra->price}})" type="checkbox" data-price="{{$extra->price}}" class="form-check-input" id="check{{$package->id}}{{$extra->id}}" name="check{{$package->id}}{{$extra->id}}"></td>
    <td>{{$extra->name}}</td>
    <td class="price" data-price="{{$extra->price}}">{{getOption('currency_symbol').number_format($extra->price,2)}}</td>
</tr>
@endforeach
</tbody>
</table>