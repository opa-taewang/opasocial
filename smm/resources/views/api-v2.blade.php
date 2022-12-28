@extends('layouts.app')
@section('title', getOption('app_name') . ' - API Documentation')
@section('content')
<div class="inner-dashboard apiPage">
    <div class="row">
        <div class="col-sm-6">
            <div class="well">
                <div class="wellHeader">
                    <h2>API 2.0</h2>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        HTTP Method<b>POST</b>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        API URL<span class="badge badge-primary">{{url('/api/v2')}}</span>
                    </li>
                    @if(Auth::user()['role']=="USER")
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        API KEY<span >@if( ! is_null( Auth::user()->api_token )) {{Auth::user()->api_token}}</span>
                    @else
                    <form role="form" method="POST" action="{{ url('/account/api1') }}">
                    {{ csrf_field() }}
                        <button type="submit" class="btn btn-defaul btn-sm"value="{{ Auth::user()->api_token }}" id="api_key" onClick="this.setSelectionRange(0, this.value.length)">@lang('buttons.generate')</button>
                    </form>
                    @endif
                    </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Response Format<span>JSON</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Example Code<a target="_blank" class="btn btn-primary btn-sm" href="{{ url('/example.txt') }}">Example of PHP Code</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="well">
                <div class="wellHeader">
                    <h2>Method: balance</h2>
                </div>
                <small>Note: All API funds/prices will be in USD.</small>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th class="width-40">Parameters</th>
                                <th>Descriptions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>api_token</td>
                                <td>Your API token</td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>Method Name</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p><strong>Example Response:</strong></p>
                <pre class="prewa">
{
  "balance": "100.78",
  "currency": "USD"
}
                </pre>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="well">
                <div class="wellHeader">
                    <h2>Method: packages</h2>
                </div>
                <small>Note: All API funds/prices will be in USD.</small>
                <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th width="30%">Parameters</th>
                            <th width="70%">Descriptions</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>api_token</td>
                        <td>Your API token</td>
                    </tr>
                    <tr>
                        <td>action</td>
                        <td>Method Name</td>
                    </tr>
                </table>
                </div>
                <p style="margin-top: 10px; margin-bottom: 0">Example Response:</p>
                <pre class="prewa">
                        [
                          {
                              "id": 101,
                              "service_id": 1,
                              "name": "Real & Active Followers - Best Server",
                              "rate": "250.00",
                              "min": "100",
                              "max": "100000",
                              "service": "Instagram Followers",
                              "type": "default",
                              "desc": "0-3 Hours Start | Full Link | 20 Days Refill\r\nLink Format:\r\nhttps://www.instagram.com/official_social_sale/"
                          },
                          {
                              "id": 107,
                              "service_id": 1,
                              "name": "Indian Mixed Followers",
                              "rate": "150.00",
                              "min": "200",
                              "max": "10000",
                              "service": "Instagram Followers",
                              "type": "default",
                              "desc": "0-12 Hours Start | Full Link |\r\nLink Format:\r\nhttps://www.instagram.com/official_social_sale/"
                          },
                          {
                              "id": 30067,
                              "service_id": 1,
                              "name": "Instagram Followers - Worldwide",
                              "rate": "103.00",
                              "min": "100",
                              "max": "10000",
                              "service": "Instagram Followers",
                              "type": "default",
                              "desc": "10k/day\r\nMax - 55k\r\n8 Hours Start"
                          }
                        ]
                </pre>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="well">
                <div class="wellHeader">
                    <h2>Method: add</h2>
                </div>
                <small>Note: All API funds/prices will be in USD.</small>
                <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="width-40">Parameters</th>
                            <th>Descriptions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                                <td>api_token</td>
                                <td>Your API token</td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>Method Name</td>
                            </tr>
                            <tr>
                                <td>package</td>
                                <td>ID of package</td>
                            </tr>
                            <tr>
                                <td>link</td>
                                <td>Link to page</td>
                            </tr>
                            <tr>
                                <td>quantity</td>
                                <td>Needed quantity</td>
                            </tr>
                            <tr>
                                <td>custom_data</td>
                                <td>optional, needed for custom comments, mentions and other relaed packages only.<br/> each separated by '\n', '\n\r'</td>
                            </tr>
                    </tbody>
                </table>
                </div>
                <p><strong>Success Response:</strong></p>
                <pre class="prewa">
{
  "order":"23501"
}
                </pre>
            </div>
        </div>        
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="well">
                <div class="wellHeader">
                    <h2>Method: status</h2>
                </div>
                <small>Note: All API funds/prices will be in USD.</small>
                <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="width-40">Parameters</th>
                            <th>Descriptions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>api_token</td>
                            <td>Your API token</td>
                        </tr>
                        <tr>
                            <td>action</td>
                            <td>Method Name</td>
                        </tr>
                        <tr>
                            <td>order</td>
                            <td>Order ID</td>
                        </tr>
                    </tbody>
                </table>.
                </div>
                <p><strong>Success Response:</strong></p>
                <pre class="prewa">
                        {
                          "status": "Completed",
                          "start_counter": "600",
                          "remains": "600"
                        }
                </pre>
            </div>
        </div>
    </div>
</div> 

    
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
<script>
        $(function () {
            new ClipboardJS('.btn-sm');
        })
    </script>