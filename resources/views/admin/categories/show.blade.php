@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.categories.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.categories.fields.name')</th>
                            <td field-key='name'>{{ $category->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#stores" aria-controls="stores" role="tab" data-toggle="tab">Stores</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="stores">
<table class="table table-bordered table-striped {{ count($stores) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.stores.fields.categories')</th>
                        <th>@lang('quickadmin.stores.fields.city')</th>
                        <th>@lang('quickadmin.stores.fields.name')</th>
                        <th>@lang('quickadmin.stores.fields.description')</th>
                        <th>@lang('quickadmin.stores.fields.address')</th>
                        <th>@lang('quickadmin.stores.fields.phone')</th>
                        <th>@lang('quickadmin.stores.fields.photo')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($stores) > 0)
            @foreach ($stores as $store)
                <tr data-entry-id="{{ $store->id }}">
                    <td field-key='categories'>
                                    @foreach ($store->categories as $singleCategories)
                                        <span class="label label-info label-many">{{ $singleCategories->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='city'>{{ $store->city->name or '' }}</td>
                                <td field-key='name'>{{ $store->name }}</td>
                                <td field-key='description'>{!! $store->description !!}</td>
                                <td field-key='address'>{{ $store->address_address }}</td>
                                <td field-key='phone'>{{ $store->phone }}</td>
                                <td field-key='photo'>@if($store->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $store->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $store->photo) }}"/></a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('store_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.stores.restore', $store->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('store_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.stores.perma_del', $store->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('store_view')
                                    <a href="{{ route('admin.stores.show',[$store->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('store_edit')
                                    <a href="{{ route('admin.stores.edit',[$store->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('store_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.stores.destroy', $store->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
