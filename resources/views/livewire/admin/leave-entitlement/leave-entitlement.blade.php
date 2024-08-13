<div>
    <x-slot name='title'>
        Leave Entitlement
    </x-slot>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-secondary justify-content-between mb-3">
                        <h4 class="">Leave Entitlement</h4>
                        <li><a class="btn btn-info" href="{{ route('admin.createleaveentitlement') }}"wire:navigate>Add Entitlement</a></li>
                    </ol>
                    <livewire:leave-entitlement-table/>
                </nav>
            </div>
        </div>
    </div>
</div>
