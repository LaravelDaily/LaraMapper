@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.stores.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.stores.fields.categories')</th>
                            <td field-key='categories'>
                                @foreach ($store->categories as $singleCategories)
                                    <span class="label label-info label-many">{{ $singleCategories->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stores.fields.city')</th>
                            <td field-key='city'>{{ $store->city->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stores.fields.name')</th>
                            <td field-key='name'>{{ $store->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stores.fields.description')</th>
                            <td field-key='description'>{!! $store->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stores.fields.address')</th>
                            <td field-key='address'>{{ $store->address_address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stores.fields.phone')</th>
                            <td field-key='phone'>{{ $store->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.stores.fields.photo')</th>
                            <td field-key='photo'> @foreach($store->getMedia('photo') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ round($media->size / 1000000, 2) }} MB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.stores.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
