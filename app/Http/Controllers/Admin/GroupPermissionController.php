<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GroupPermission;
use App\Http\Requests\GroupPermissionRequest;


class GroupPermissionController extends Controller
{

    public function __construct()
    {
        view()->share([
            'group_permission' => 'active',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissionGroups = GroupPermission::orderBy('id', 'DESC')->paginate(10);

        $viewData = [
            'permissionGroups' => $permissionGroups
        ];
        return view('admin.group-permission.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.group-permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupPermissionRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->createOrUpdate($request);
            \DB::commit();
            return redirect()->back()->with('success', 'Thêm mới thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $permissionGroup = GroupPermission::find($id);
        if (!$permissionGroup) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.group-permission.edit', compact('permissionGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupPermissionRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->createOrUpdate($request, $id);
            \DB::commit();
            return redirect()->back()->with('success', 'Chỉnh sửa thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $permissionGroup = GroupPermission::find($id);
        if (!$permissionGroup) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $permissionGroup->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function createOrUpdate($request , $id ='')
    {
        $groupPermission = new GroupPermission();

        if ($id)
        {
            $groupPermission = GroupPermission::findOrFail($id);
        }

        $groupPermission->name        = $request->name;
        $groupPermission->description = $request->description;

        $groupPermission->save();
    }
}
