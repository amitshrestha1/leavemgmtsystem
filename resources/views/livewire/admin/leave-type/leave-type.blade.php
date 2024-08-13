<div>
    <x-slot name="title">
        Leave Type
    </x-slot>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-secondary justify-content-between">
                        <h4 class="">Leave Types</h4>
                        <li><a href="/typecreate"wire:navigate class=" btn btn-info">Add Leave Type</a></li>
                    </ol>
                </nav>
                <livewire:leave-type-table/>
            </div>
        </div>
    </div>
</div>
