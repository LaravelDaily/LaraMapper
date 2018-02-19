<?php
namespace App\Http\Controllers\Admin;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStoresRequest;
use App\Http\Requests\Admin\UpdateStoresRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Category;
use App\City;

class StoresController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Store.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('store_access')) {
            return abort(401);
        }
        
        if (request('show_deleted') == 1) {
            if (! Gate::allows('store_delete')) {
                return abort(401);
            }
            $stores = Store::onlyTrashed()->get();
        } else {
            $stores = Store::all();
        }
        
        return view('admin.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating new Store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('store_create')) {
            return abort(401);
        }
        
        $categories = \App\Category::get()->pluck('name', 'id');
        
        $cities = \App\City::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        
        return view('admin.stores.create', compact('categories', 'cities'));
    }

    /**
     * Store a newly created Store in storage.
     *
     * @param \App\Http\Requests\StoreStoresRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoresRequest $request)
    {
        if (! Gate::allows('store_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $store = Store::create($request->all());
        $store->categories()->sync(array_filter((array) $request->input('categories')));
        
        foreach ($request->input('photo_id', []) as $index => $id) {
            $model = config('medialibrary.media_model');
            $file = $model::find($id);
            $file->model_id = $store->id;
            $file->save();
        }
        
        return redirect()->route('admin.stores.index');
    }

    /**
     * Show the form for editing Store.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('store_edit')) {
            return abort(401);
        }
        
        $categories = \App\Category::get()->pluck('name', 'id');
        
        $cities = \App\City::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        
        $store = Store::findOrFail($id);
        
        return view('admin.stores.edit', compact('store', 'categories', 'cities'));
    }

    /**
     * Update Store in storage.
     *
     * @param \App\Http\Requests\UpdateStoresRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoresRequest $request, $id)
    {
        if (! Gate::allows('store_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $store = Store::findOrFail($id);
        $store->update($request->all());
        $store->categories()->sync(array_filter((array) $request->input('categories')));
        
        $media = [];
        foreach ($request->input('photo_id', []) as $index => $id) {
            $model = config('medialibrary.media_model');
            $file = $model::find($id);
            $file->model_id = $store->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $store->updateMedia($media, 'photo');
        
        return redirect()->route('admin.stores.index');
    }

    /**
     * Display Store.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('store_view')) {
            return abort(401);
        }
        $store = Store::findOrFail($id);
        
        return view('admin.stores.show', compact('store'));
    }

    /**
     * Remove Store from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('store_delete')) {
            return abort(401);
        }
        $store = Store::findOrFail($id);
        $store->deletePreservingMedia();
        
        return redirect()->route('admin.stores.index');
    }

    /**
     * Delete all selected Store at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('store_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Store::whereIn('id', $request->input('ids'))->get();
            
            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }

    /**
     * Restore Store from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('store_delete')) {
            return abort(401);
        }
        $store = Store::onlyTrashed()->findOrFail($id);
        $store->restore();
        
        return redirect()->route('admin.stores.index');
    }

    /**
     * Permanently delete Store from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('store_delete')) {
            return abort(401);
        }
        $store = Store::onlyTrashed()->findOrFail($id);
        $store->forceDelete();
        
        return redirect()->route('admin.stores.index');
    }
}
