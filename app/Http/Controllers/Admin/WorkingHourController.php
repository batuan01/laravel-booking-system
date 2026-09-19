<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkingHourRequest;
use App\Http\Requests\UpdateWorkingHourRequest;
use App\Staff;
use App\WorkingHour;

class WorkingHourController extends Controller
{
    public function index()
    {
        $workingHours = WorkingHour::with('staff')
            ->orderBy('staff_id')
            ->orderBy('day_of_week')
            ->paginate(20);

        return view('admin.working-hours.index', compact('workingHours'));
    }

    public function create()
    {
        $staffList = Staff::orderBy('name')->get();

        return view('admin.working-hours.create', compact('staffList'));
    }

    public function store(StoreWorkingHourRequest $request)
    {
        WorkingHour::create($request->validated());

        return redirect()->route('admin.working-hours.index')->with('status', 'Đã thêm giờ làm việc.');
    }

    public function show(WorkingHour $workingHour)
    {
        return redirect()->route('admin.working-hours.edit', $workingHour);
    }

    public function edit(WorkingHour $workingHour)
    {
        $staffList = Staff::orderBy('name')->get();

        return view('admin.working-hours.edit', compact('workingHour', 'staffList'));
    }

    public function update(UpdateWorkingHourRequest $request, WorkingHour $workingHour)
    {
        $workingHour->update($request->validated());

        return redirect()->route('admin.working-hours.index')->with('status', 'Đã cập nhật giờ làm việc.');
    }

    public function destroy(WorkingHour $workingHour)
    {
        $workingHour->delete();

        return redirect()->route('admin.working-hours.index')->with('status', 'Đã xóa giờ làm việc.');
    }
}
