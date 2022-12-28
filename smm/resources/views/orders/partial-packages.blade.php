@if( ! $packages->isEmpty() )
    <option value="">Select a package</option>
    @foreach( $packages as $package)
        @php
            $price = isset($userPackagePrices[$package->id]) ? $userPackagePrices[$package->id] : $package->price_per_item;
            //$price=$price * getOption('display_price_per');
            if (in_array($package->id, $package_ids)) {
		        $price=number_formats($price-($price/100)*$group->price_percentage,2);
		        $price=getConvertedRate($price);
		    }
        @endphp
        <option value="{{ $package->id }}"
                data-min="{{$package->minimum_quantity}}"
                data-max="{{$package->maximum_quantity}}"
                data-comments="{{$package->custom_comments}}"
                data-description="{{$package->description}}"
                data-features="{{$package->features}}"
                data-peritem="{{$price}}">
            @if ($package->maximum_quantity == $package->minimum_quantity )
            {{'ID:' .$package->id . '  ' .  $package->name . ' --' }} {{ getConversionSymbol(). ($price * $package->maximum_quantity). ' Per Package'}}
            @else 
            {{'ID:' .$package->id . '  ' .  $package->name . ' --' }} {{ getConversionSymbol(). ($price * getOption('display_price_per')). ' Per 1000'}}
            @endif
        </option>
    @endforeach
@endif