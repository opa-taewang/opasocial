<form>
    <div class="form-group">
        <label for="service">Package</label>
        <input type="text" readonly class="form-control" value="{{$order->package->name}}">
    </div>
    <div class="form-group">
        <label for="amount">Total Amount</label>
        <input type="text" readonly class="form-control" value="{{convertCurrncy($order->total_amount)}}">
    </div>
    <div class="form-group">
        <label for="extra">Extra Services</label>
        <?php $extras=explode(',',$order->extra_services); { ?>
            <table id="table" class="table text-center table-striped table-bordered">
                <thead>
                <th class="text-center">Sr.No</th>
                <th class="text-center">Name</th>
                <th class="text-center">Price</th>
                </thead>
                <tbody>
        <?php for($i=0; $i<count($extras); $i++) {
                $extraservice=App\ExtraService::find($extras[$i]);
                if($extraservice) {
        ?>
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$extraservice->name}}</td>
                    <td class="price">{{getOption('currency_symbol').number_format($extraservice->price,2)}}</td>
                </tr>

        <?php } } if(!count($extras)) { ?>
        <tr>
            <td colspan="3" class="text-center">No Extra Service</td>
        </tr>
        <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
    <h4 class="text-center">Requirements</h4>
    <?php 
    $requirements = json_decode($order->requirements);
    if ($requirements instanceof \stdClass || is_array($requirements)) {
    foreach($requirements as $key => $requirement) {
        foreach($requirement as $key1 =>$req){ ?>
        <div class="form-group">
            <label>{{implode(" ",explode("-",$key1))}}</label>
            <textarea readonly class="form-control">{{$req}}</textarea>
        </div>
    <?php } } } else { ?>
    <p class="text-center">N/A</p>
    <?php  } ?>
    @if($order->dripfeed)
    <div class="form-group">
        <label class="control-label" for="dripfeedselect">DripFeed</label>
        <input class="magic-checkbox" type="checkbox" readonly value="1" checked>
    </div>
    <div class="form-group">
        <label for="runs" class="control-label">@lang('new.runs')</label>
        <input type="text" value="{{ $order->runs }}" class="form-control" readonly placeholder="Runs">
    </div>
    <div class="form-group{{ $errors->has('interval') ? ' has-error' : '' }}"  id="intervaldiv" style="display: none">
        <label for="interval" class="control-label">@lang('new.interval')</label>
        <input readonly type="text" value="{{ $order->intervals }}" class="form-control" placeholder="Intervals">
    </div>
    @endif
    <div class="form-group">
        <label>Status: {{$order->status}}</label>
    </div>
</form>