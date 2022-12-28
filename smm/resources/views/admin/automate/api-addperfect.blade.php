@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - New API')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/admin/automate/api-list') }}"> @lang('menus.api_list')</a></li>
                <li class="active">@lang('menus.new')</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="login-form">
                <form
                        role="form"
                        method="POST"
                        action="{{ url('/admin/automate/api/add') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Edit API</legend>
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text"
                                   class="form-control"
                                   value=""
                                   data-validation="required"
                                   id="name"
                                   name="name">
                                                    </div>
                        <div class="form-group">
                            <label for="rate" class="control-label">Currency Conversion Rate</label>
                            <input type="text"
                                   class="form-control"
                                   data-validation="number"
                                   placeholder="00.00000"
                                   data-validation-allowing="float"
                                   id="rate"
                                   value="1.0000000"
                                   name="rate">
                                                    </div>   
                        <hr>
                        <div class="fieldset-outline">
                            <h6>Order Place API</h6>
                            <div class="form-group">
                                <label for="order_end_point" class="control-label">API URL</label>
                                <input type="text"
                                       class="form-control"
                                       value=""
                                       data-validation="url"
                                       id="order_end_point"
                                       name="order_end_point">
                                                            </div>
                            <div class="form-group">
                                <label for="order_method" class="control-label">HTTP Method</label>
                                <select class="form-control" style="width:auto" name="order_method" id="order_method">
                                    <option value="POST" selected>POST</option>
                                    <option value="GET" >GET</option>
                                </select>
                                                            </div>
                            <div class="form-group">
                                <label for="order_request_body" class="control-label">Request parameters</label>
                                <table class="table table-bordered" id="tbl-order-request">
                                    <thead>
                                    <tr>
                                        <th>Parameter</th>
                                        <th>Parameter Type</th>
                                        <th>Value</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                                                                                                                                                    <tr>
                                                <td>
                                                    <input type="text" name="order_key[]" value="key" class="form-control order-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="order_key_type[]" class="form-control order-key-type" data-validation="required">
                                                        <option value="table_column" >Order Column</option>
                                                        <option value="custom" selected>Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <input type="text" class="form-control order-key-value" value="" name="order_key_value[]" data-validation="required">
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm order-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                            <tr>
                                                <td>
                                                    <input type="text" name="order_key[]" value="action" class="form-control order-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="order_key_type[]" class="form-control order-key-type" data-validation="required">
                                                        <option value="table_column" >Order Column</option>
                                                        <option value="custom" selected>Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <input type="text" class="form-control order-key-value" value="add" name="order_key_value[]" data-validation="required">
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm order-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                            <tr>
                                                <td>
                                                    <input type="text" name="order_key[]" value="link" class="form-control order-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="order_key_type[]" class="form-control order-key-type" data-validation="required">
                                                        <option value="table_column" selected>Order Column</option>
                                                        <option value="custom" >Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <select name="order_key_value[]" class="form-control order-key-value" data-validation="required">
                                                            <option value="id"  >id</option>
                                                            <option value="link" selected >link</option>
                                                            <option value="price" >price</option>
                                                            <option value="package_id" >package_id</option>
                                                            <option value="start_counter" >start_counter</option>
                                                            <option value="quantity"  >quantity</option>
                                                            <option value="custom_comments"  >custom_data</option>
                                                        </select>
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm order-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                            <tr>
                                                <td>
                                                    <input type="text" name="order_key[]" value="quantity" class="form-control order-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="order_key_type[]" class="form-control order-key-type" data-validation="required">
                                                        <option value="table_column" selected>Order Column</option>
                                                        <option value="custom" >Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <select name="order_key_value[]" class="form-control order-key-value" data-validation="required">
                                                            <option value="id"  >id</option>
                                                            <option value="link"  >link</option>
                                                            <option value="price" >price</option>
                                                            <option value="package_id" >package_id</option>
                                                            <option value="start_counter" >start_counter</option>
                                                            <option value="quantity" selected >quantity</option>
                                                            <option value="custom_comments"  >custom_data</option>
                                                        </select>
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm order-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                            <tr>
                                                <td>
                                                    <input type="text" name="order_key[]" value="service" class="form-control order-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="order_key_type[]" class="form-control order-key-type" data-validation="required">
                                                        <option value="table_column" selected>Order Column</option>
                                                        <option value="custom" >Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <select name="order_key_value[]" class="form-control order-key-value" data-validation="required">
                                                            <option value="id"  >id</option>
                                                            <option value="link"  >link</option>
                                                            <option value="price" >price</option>
                                                            <option value="package_id" selected>package_id</option>
                                                            <option value="start_counter" >start_counter</option>
                                                            <option value="quantity"  >quantity</option>
                                                            <option value="custom_comments"  >custom_data</option>
                                                        </select>
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm order-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                            <tr>
                                                <td>
                                                    <input type="text" name="order_key[]" value="comments" class="form-control order-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="order_key_type[]" class="form-control order-key-type" data-validation="required">
                                                        <option value="table_column" selected>Order Column</option>
                                                        <option value="custom" >Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <select name="order_key_value[]" class="form-control order-key-value" data-validation="required">
                                                            <option value="id"  >id</option>
                                                            <option value="link"  >link</option>
                                                            <option value="price" >price</option>
                                                            <option value="package_id" >package_id</option>
                                                            <option value="start_counter" >start_counter</option>
                                                            <option value="quantity"  >quantity</option>
                                                            <option value="custom_comments" selected >custom_data</option>
                                                        </select>
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm order-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button
                                                    type="button"
                                                    class="btn btn-primary btn-sm order-key-add">
                                                <span class="fui-plus"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                                                            </div>
                            <div class="form-group">
                                <label for="order_success_response" class="control-label">Success Response: (JSON)</label>
                                <br>
                                <small>Validate Json here: <a rel="noopener noreferrer" href="https://jsonlint.com/" target="_new">https://jsonlint.com/</a></small>
                                <textarea
                                        class="form-control"
                                        data-validation="required"
                                        id="order_success_response"
                                        style="height: 150px;"
                                        name="order_success_response">{
    &quot;order&quot;: 23501
}</textarea>
                                                            </div>
                            <div class="form-group">
                                <label for="order_id_key" class="control-label">Response Key Name equal OrderID</label>
                                <input type="text"
                                       class="form-control"
                                       value="order"
                                       data-validation="required"
                                       style="width:auto"
                                       id="order_id_key"
                                       name="order_id_key">
                                                            </div>
                        </div>
                        <hr>
                        <div class="fieldset-outline">
                            <h6>Order Status API</h6>
                            <div class="form-group">
                                <label for="status_end_point" class="control-label">API URL</label>
                                <input type="text"
                                       class="form-control"
                                       value=""
                                       data-validation="url"
                                       id="status_end_point"
                                       name="status_end_point">
                                                            </div>
                            <div class="form-group">
                                <label for="status_method" class="control-label">HTTP Method</label>
                                <select class="form-control" style="width:auto" name="status_method" id="status_method">
                                    <option value="POST" selected>POST</option>
                                    <option value="GET" >GET</option>
                                </select>
                                                            </div>
                            <div class="form-group">
                                <label for="status_request_body" class="control-label">Request parameters</label>
                                <table class="table table-bordered" id="tbl-status-request">
                                    <thead>
                                    <tr>
                                        <th>Parameter</th>
                                        <th>Parameter Type</th>
                                        <th>Value</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <tr>
                                                <td>
                                                    <input type="text" name="status_key[]" value="key" class="form-control status-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="status_key_type[]" class="form-control status-key-type" data-validation="required">
                                                        <option value="table_column" >Order Column</option>
                                                        <option value="custom" selected>Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <input type="text" class="form-control status-key-value" value="" name="status_key_value[]" data-validation="required">
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm status-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                            <tr>
                                                <td>
                                                    <input type="text" name="status_key[]" value="action" class="form-control status-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="status_key_type[]" class="form-control status-key-type" data-validation="required">
                                                        <option value="table_column" >Order Column</option>
                                                        <option value="custom" selected>Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <input type="text" class="form-control status-key-value" value="status" name="status_key_value[]" data-validation="required">
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm status-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                            <tr>
                                                <td>
                                                    <input type="text" name="status_key[]" value="order" class="form-control status-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="status_key_type[]" class="form-control status-key-type" data-validation="required">
                                                        <option value="table_column" selected>Order Column</option>
                                                        <option value="custom" >Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <select name="status_key_value[]" class="form-control status-key-value" data-validation="required">
                                                            <option value="id" selected >id</option>
                                                            <option value="link"  >link</option>
                                                            <option value="price" >price</option>
                                                            <option value="package_id" >package_id</option>
                                                            <option value="start_counter" >start_counter</option>
                                                            <option value="quantity"  >quantity</option>
                                                            <option value="custom_comments"  >custom_data</option>
                                                        </select>
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm status-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                                                                                                                                                                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button
                                                    type="button"
                                                    class="btn btn-primary btn-sm status-key-add">
                                                <span class="fui-plus"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                                                            </div>
                            <div class="form-group">
                                <label for="status_success_response" class="control-label">Success Response: (JSON)</label>
                                <br>
                                <small>Validate Json here: <a rel="noopener noreferrer" href="https://jsonlint.com/" target="_new">https://jsonlint.com/</a></small>
                                <textarea
                                        class="form-control"
                                        data-validation="required"
                                        id="status_success_response"
                                        style="height: 150px;"
                                        name="status_success_response">{
    &quot;charge&quot;: &quot;0.27819&quot;,
    &quot;start_count&quot;: &quot;3572&quot;,
    &quot;status&quot;: &quot;Partial&quot;,
    &quot;remains&quot;: &quot;157&quot;,
    &quot;currency&quot;: &quot;USD&quot;
}</textarea>
                                                            </div>
                            <div class="form-group">
                                <label for="start_counter_key" class="control-label">Response key Name equal start_counter</label>
                                <input type="text"
                                       class="form-control"
                                       value="start_count"
                                       data-validation="required"
                                       style="width:auto"
                                       id="start_counter_key"
                                       name="start_counter_key">
                                                            </div>
                            <div class="form-group">
                                <label for="status_key_equal" class="control-label">Response key Name equal status</label>
                                <input type="text"
                                       class="form-control"
                                       value="status"
                                       data-validation="required"
                                       style="width:auto"
                                       id="status_key_equal"
                                       name="status_key_equal">
                                                            </div>
                            <div class="form-group">
                                <label for="remains_key" class="control-label">Response key Name equal remains</label>
                                <input type="text"
                                       class="form-control"
                                       value="remains"
                                       data-validation="required"
                                       style="width:auto"
                                       id="remains_key"
                                       name="remains_key">
                                                            </div>
                        </div>
                        <hr>
                        <div class="fieldset-outline">
                            <h6>Package List API</h6>
                            <div class="form-group">
                                <label for="package_end_point" class="control-label">API URL</label>
                                <input type="text"
                                       class="form-control"
                                       value=""
                                       data-validation="url"
                                       id="package_end_point"
                                       name="package_end_point">
                                                            </div>
                            <div class="form-group">
                                <label for="package_method" class="control-label">HTTP Method</label>
                                <select class="form-control" style="width:auto" name="package_method" id="package_method">
                                    <option value="POST" selected>POST</option>
                                    <option value="GET" >GET</option>
                                </select>
                                                            </div>
                            <div class="form-group">
                                <label for="package_request_body" class="control-label">Request parameters</label>
                                <table class="table table-bordered" id="tbl-package-request">
                                    <thead>
                                    <tr>
                                        <th>Parameter</th>
                                        <th>Parameter Type</th>
                                        <th>Value</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody class="0">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <tr class="1">
                                                <td>
                                                    <input type="text" name="package_key[]" value="key" class="form-control package-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="package_key_type[]" class="form-control package-key-type" data-validation="required">
                                                        <option value="table_column" >Order Column</option>
                                                        <option value="custom" selected>Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <input type="text" class="form-control package-key-value" value="" name="package_key_value[]" data-validation="required">
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm package-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                            <tr class="1">
                                                <td>
                                                    <input type="text" name="package_key[]" value="action" class="form-control package-key" data-validation="required">
                                                </td>
                                                <td>
                                                    <select name="package_key_type[]" class="form-control package-key-type" data-validation="required">
                                                        <option value="table_column" >Order Column</option>
                                                        <option value="custom" selected>Custom Value</option>
                                                    </select>
                                                </td>
                                                <td>
                                                                                                            <input type="text" class="form-control package-key-value" value="services" name="package_key_value[]" data-validation="required">
                                                                                                    </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm package-key-remove">
                                                        <span class="fui-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                                                                                                                                                                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button
                                                    type="button"
                                                    class="btn btn-primary btn-sm package-key-add">
                                                <span class="fui-plus"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                                                            </div>
                            <div class="form-group">
                                <label for="package_id_key" class="control-label">Package ID Key</label>
                                <input type="text"
                                       class="form-control"
                                       value="service"
                                       style="width:auto"
                                       id="package_id_key"
                                       name="package_id_key">
                                                            </div>
                            <div class="form-group">
                                <label for="package_name" class="control-label">Package Name Key</label>
                                <input type="text"
                                       class="form-control"
                                       value="name"
                                       style="width:auto"
                                       id="package_name"
                                       name="package_name">
                                                            </div>
                            <div class="form-group">
                                <label for="rate_key" class="control-label">Rate Key</label>
                                <input type="text"
                                       class="form-control"
                                       value="rate"
                                       style="width:auto"
                                       id="rate_key"
                                       name="rate_key">
                                                            </div>
                            <div class="form-group">
                                <label for="min_key" class="control-label">Minimum Key</label>
                                <input type="text"
                                       class="form-control"
                                       value="min"
                                       style="width:auto"
                                       id="min_key"
                                       name="min_key">
                                                            </div>
                            <div class="form-group">
                                <label for="max_key" class="control-label">Maximum Key</label>
                                <input type="text"
                                       class="form-control"
                                       value="max"
                                       style="width:auto"
                                       id="max_key"
                                       name="max_key">
                                                            </div>
                            <div class="form-group">
                                <label for="service_key" class="control-label">Service Key</label>
                                <input type="text"
                                       class="form-control"
                                       value="category"
                                       style="width:auto"
                                       id="service_key"
                                       name="service_key">
                                                            </div>
                            <div class="form-group">
                                <label for="type_key" class="control-label">Type Key</label>
                                <input type="text"
                                       class="form-control"
                                       value="type"
                                       style="width:auto"
                                       id="type_key"
                                       name="type_key">
                                                            </div>
                            <div class="form-group">
                                <label for="desc_key" class="control-label">Description Key</label>
                                <input type="text"
                                       class="form-control"
                                       value="desc"
                                       style="width:auto"
                                       id="desc_key"
                                       name="desc_key">
                                                            </div>
                            <div class="form-group">
                                <label for="process_all_order" class="control-label">Process all orders auto</label>
                                <span class="help-block" style="margin-top: -5px">
                                    (In case of Cancel and Refund Status, System will refund amount to user)                                </span>
                                <select
                                        class="form-control"
                                        data-validation="required"
                                        style="width:auto"
                                        id="process_all_order"
                                        name="process_all_order">
                                    <option
                                            value="1"
                                            selected>Yes
                                    </option>
                                    <option
                                            value="0"
                                            >No
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </fieldset>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    var tableColumns = '<select name="order_key_value[]" class="form-control order-key-value" data-validation="required">' +
        '<option value="link">link</option>' +
        '<option value="price">price</option>' +
        '<option value="package_id">package_id</option>' +
        '<option value="start_counter">start_counter</option>' +
        '<option value="quantity">quantity</option>' +
        '<option value="custom_comments">custom_data</option>' +
        '</select>';
    var custom = '<input type="text" class="form-control order-key-value" name="order_key_value[]" data-validation="required">';

    $(function () {
        $('.order-key-remove').on('click', function () {
            if ($('#tbl-order-request > tbody tr').length > 1) {
                $(this).parents('tr').remove();
            }
        });

        $('.order-key-add').on('click', function () {
            var tr = $('#tbl-order-request tbody tr:last').clone(true, true);
            tr.find('input').val('');

            // Making select box selected
            $(tr).find(".order-key-type").val($('#tbl-order-request tbody tr:last').find(".order-key-type").val());


            $(tr).appendTo('#tbl-order-request > tbody');
        });

        $('.order-key-type').on('change', function () {
            var v = $(this).val();
            td = $(this).parents('td').siblings().eq(1);

            if (v === "table_column") {
                td.html(tableColumns);
            } else {
                td.html(custom);
            }
        });


        var tableColumnsStatus = '<select name="status_key_value[]" class="form-control status-key-value" data-validation="required">' +
            '<option value="id">id</option>' +
            '<option value="link">link</option>' +
            '<option value="price">price</option>' +
            '<option value="package_id">package_id</option>' +
            '<option value="start_counter">start_counter</option>' +
            '<option value="quantity">quantity</option>' +
            '<option value="custom_comments">custom_data</option>' +
            '</select>';
        var customStatus = '<input type="text" class="form-control status-key-value" name="status_key_value[]" data-validation="required">';

        $('.status-key-remove').on('click', function () {
            if ($('#tbl-status-request > tbody tr').length > 1) {
                $(this).parents('tr').remove();
            }
        });

        $('.status-key-add').on('click', function () {
            var tr = $('#tbl-status-request tbody tr:last').clone(true, true);
            tr.find('input').val('');

            // Making select box selected
            $(tr).find(".status-key-type").val($('#tbl-status-request tbody tr:last').find(".status-key-type").val());


            $(tr).appendTo('#tbl-status-request > tbody');
        });

        $('.status-key-type').on('change', function () {
            var v = $(this).val();
            td = $(this).parents('td').siblings().eq(1);

            if (v === "table_column") {
                td.html(tableColumnsStatus);
            } else {
                td.html(customStatus);
            }
        });

        var tableColumnsPackage = '<select name="package_key_value[]" class="form-control package-key-value" data-validation="required">' +
            '<option value="api_order_id">api_order_id</option>' +
            '<option value="link">link</option>' +
            '<option value="price">price</option>' +
            '<option value="package_id">package_id</option>' +
            '<option value="start_counter">start_counter</option>' +
            '<option value="quantity">quantity</option>' +
            '<option value="custom_comments">custom_data</option>' +
            '</select>';
        var customPackage = '<input type="text" class="form-control package-key-value" name="package_key_value[]" data-validation="required">';

        $('.package-key-remove').on('click', function () {
            if ($('#tbl-package-request > tbody tr').length > 1) {
                $(this).parents('tr').remove();
            }
        });

        $('.package-key-add').on('click', function () {
            var tr = $('#tbl-package-request tbody tr:last').clone(true, true);
            tr.find('input').val('');

            // Making select box selected
            $(tr).find(".package-key-type").val($('#tbl-package-request tbody tr:last').find(".package-key-type").val());


            $(tr).appendTo('#tbl-package-request > tbody');
        });

        $('.package-key-type').on('change', function () {
            var v = $(this).val();
            td = $(this).parents('td').siblings().eq(1);

            if (v === "table_column") {
                td.html(tableColumnsPackage);
            } else {
                td.html(customPackage);
            }
        });
        
    });
</script>
@endpush