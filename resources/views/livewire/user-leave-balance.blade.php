<div>
    <x-slot name='title'>
        User Leave Balance
    </x-slot>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-secondary justify-content-between">
                        <h4 class="">User Leave Balances</h4>
                    </ol>
                </nav>
                {{-- <livewire:user-leave-balance-table/> --}}
                <div class="table-responsive">
                    <table class="table table-striped userbalancetable">
                        <thead>

                            <tr>
                                <th>
                                    S.N
                                </th>
                                <th>
                                    Full Name
                                </th>
                                @foreach ($type as $item)
                                    <th>
                                        {{ $item->name }}
                                    </th>
                                @endforeach


                            </tr>


                        </thead>
                        <tbody>
                            @foreach ($users as $i => $user)
                                <tr>
                                    <td>
                                        {{ $i }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    @foreach ($remainingDays as $leaveTypeId => $leaveType)

                                    <td>

                                        @if (isset($leaveType['user'][$user->id]))

                                            {{ $leaveType['user'][$user->id]['days'] }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                @endforeach
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:navigated',event=>{
            let table = new DataTable('.userbalancetable');
        });
    </script>
@endpush
