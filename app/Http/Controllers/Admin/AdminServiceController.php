<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAddService;
use App\Http\Requests\Admin\AdminDeleteService;
use App\Http\Requests\Admin\AdminUpdateService;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminServiceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(AdminAddService $request)
    {
        Service::query()->create($request->all());
        return back();

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateService $request, $id)
    {
       Service::find($id)->update($request->all());
       return back();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function destroy(AdminDeleteService $request, $id)
    {
        Service::query()->find($id)->delete();
        return back();
    }
}
