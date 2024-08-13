<div>
    <x-slot name="title">
        Leave
    </x-slot>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-secondary justify-content-between">
                        <h4 class="">Leaves</h4>
                        <li><a href="{{ route('admin.applyleave') }}" wire:navigate class="btn btn-info">Apply for
                                Leave</a></li>
                    </ol>
                </nav>
                <livewire:leave-table/>
        
            </div>
        </div>
    </div>
</div>
