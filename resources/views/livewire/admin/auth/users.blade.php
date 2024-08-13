<div>
    <x-slot name="title">
        Users
    </x-slot>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-secondary justify-content-between">
                        <h4 class="">Users</h4>
                        <li><a class="btn btn-info" href="{{ route('admin.createuser') }}"wire:navigate type="button">Add
                                User</a></li>
                    </ol>
                </nav>
                <livewire:user-table />
            </div>
        </div>
    </div>

</div>
