<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Staff;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::paginate(20);

        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(StoreStaffRequest $request)
    {
        Staff::create($request->validated());

        return redirect()->route('admin.staff.index')->with('status', 'Đã tạo nhân viên.');
    }

    public function show(Staff $staff)
    {
        return redirect()->route('admin.staff.edit', $staff);
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $staff->update($request->validated());

        return redirect()->route('admin.staff.index')->with('status', 'Đã cập nhật nhân viên.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('status', 'Đã xóa nhân viên.');
    }
}
