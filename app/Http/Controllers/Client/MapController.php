<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\City;
use App\Store;

class MapController extends Controller
{

    /**
     * Display a listing of Stores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $cities = City::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $category_id = $request->input('category_id');
        $city_id = $request->input('city_id');
        $search = $request->input('store_name');

        $stores = Store::with('city:id,name', 'categories:id,name', 'media')
            ->when($city_id, function ($q) use ($city_id) {
                $q->where('city_id', $city_id);
            })->when($category_id, function ($q) use ($category_id) {
                $q->whereHas('categories', function ($q2) use ($category_id) {
                    $q2->where('category_id', $category_id);
                });
            })->when($search, function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            })
            ->get();

        foreach ($stores as $key => $value) {
            $pos ['lat'][] = $value->address_latitude;
            $pos ['lng'][] = $value->address_longitude;
            $min_lat = min($pos['lat']);
            $max_lat = max($pos['lat']);
            $min_lng = min($pos['lng']);
            $max_lng = max($pos['lng']);
        }

        if (count($stores) > 0) {
            $default_center_latitude = (($min_lat + $max_lat) / 2);
            $default_center_longitude = (($min_lng + $max_lng) / 2);
            $default_zoom = config('app.default_zoom');
        } else {
            $default_center_latitude = config('app.default_center_latitude');
            $default_center_longitude = config('app.default_center_longitude');
            $default_zoom = config('app.aerial_zoom');
        }
        return view('client.map', compact('stores', 'categories', 'cities', 'default_center_latitude', 'default_center_longitude', 'default_zoom'));
    }
}
