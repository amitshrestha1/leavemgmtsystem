<div>
    <x-slot name="title">
        Leave Management System
    </x-slot>
    <div class="row">
        <div class="col-sm-12">
            <div class="statistics-details d-flex align-items-center justify-content-between">
                @if ((Auth()->user()->role->name == 'SuperAdmin') | (Auth()->user()->role->name == 'Admin'))
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <div class="row">
                                <i class="fa-solid fa-user fa-2xl"></i>
                                <div class="d-flex justify-content-end">
                                    <h5 class="text-right card-title fw-bold">Staffs</h5>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <h6 class="card-text fw-bold">{{ $countstaff }}</h6>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <div class="row">
                                <i class="fa-solid fa-building-user fa-2xl"></i>
                                <div class="d-flex justify-content-end">
                                    <h5 class="text-right card-title fw-bold">Departments</h5>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <h6 class="card-text fw-bold">{{ $countdepartment }}</h6>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <div class="row">
                                <i class="fa-solid fa-envelope fa-2xl"></i>
                                <div class="d-flex justify-content-end">
                                    <h5 class="text-right card-title fw-bold">Leave Applications</h5>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <h6 class="card-text fw-bold">{{ $countleaves }}</h6>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                @else
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <div class="row">
                            <i class="fa-solid fa-envelope fa-2xl"></i>
                            <div class="d-flex justify-content-end">
                                <h5 class="text-right card-title fw-bold">Leave Applications</h5>
                            </div>
                            <div class="d-flex justify-content-end">
                                <h6 class="card-text fw-bold">{{ $countleaves }}</h6>
                            </div>
                        </div>
                       
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Leave Application</h4>
                    <div class="table-responsive">
                        <table class="table table-hover dashboardtable">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    @if (Auth()->user()->role->name == 'Admin' || Auth()->user()->role->name == 'SuperAdmin')
                                        <th>User</th>
                                    @endif
                                    <th>Leave Type</th>
                                    <th>Leave Reason</th>
                                    <th>Leave Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaves as $i => $leave)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        @if (Auth()->user()->role->name == 'Admin' || Auth()->user()->role->name == 'SuperAdmin')
                                            <td>
                                                {{ $leave->user->name }}
                                            </td>
                                        @endif
                                        <td>
                                            {{ $leave->types->name }}
                                        </td>
                                        <td>{{ $leave->reason }}</td>
                                        <td>
                                            @if ($leave->status == 'Pending')
                                                <label class="badge badge-warning">{{ $leave->status }}</label>
                                            @elseif ($leave->status == 'Approved')
                                                <label class="badge badge-success">{{ $leave->status }}</label>
                                            @else
                                                <label class="badge badge-danger">{{ $leave->status }}</label>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:navigated',event=>{
        let table = new DataTable('.dashboardtable');
    });
</script>
@endpush
