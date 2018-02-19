@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.stores.title')</h3>
    @can('store_create')
    <p>
        <a href="{{ route('admin.stores.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('store_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.stores.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.stores.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">@lang('quickadmin.qa_list')
        </div>
	
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($stores) > 0 ? 'datatable' : '' }} @can('store_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('store_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('store_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='categories'>
                                    @foreach ($store->categories as $singleCategories)
                                        <span class="label label-info label-many">{{ $singleCategories->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='city'>{{ $store->city->name or '' }}</td>
                                <td field-key='name'>{{ $store->name }}</td>
                                <td field-key='description'>{!! substr($store->description, 0, 30) !!}</td>
                                <td field-key='address'>{{ $store->address_address }}</td>
                                <td field-key='phone'>{{ $store->phone }}</td>
                                <td field-key='photo'> @foreach($store->getMedia('photo') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ round($media->size / 1000000, 2) }} MB)</a>
                                </p>
                            @endforeach</td>
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
@stop

@section('javascript') 
    <script>
        @can('store_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.stores.mass_destroy') }}'; @endif
        @endcan
    </script>
@endsection