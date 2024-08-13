<div>
    <x-slot name="title">
        Department
    </x-slot>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-secondary justify-content-between mb-3">
                        <h4 class="">Departments</h4>
                        <li><a class="btn btn-info" href="{{ route('admin.createdepartment') }}"wire:navigate>Add
                                Department</a></li>
                    </ol>
                    <livewire:department-table />
                </nav>
            </div>
        </div>
    </div>
</div>
