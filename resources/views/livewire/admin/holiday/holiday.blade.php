<div>
    <x-slot name="title">
        Holiday
    </x-slot>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-secondary justify-content-between mb-3">
                        <h4 class="">Holidays</h4>
                        <li><a href="{{ route('admin.createholiday') }}"wire:navigate class="btn btn-info">Add Holiday</a>
                        </li>
                    </ol>
                </nav>
                <livewire:holiday-table/>
            </div>
        </div>
    </div>
</div>
