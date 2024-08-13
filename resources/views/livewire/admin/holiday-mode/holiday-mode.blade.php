<div>
    <x-slot name="title">
        Holiday Mode
    </x-slot>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="mb-3 breadcrumb bg-secondary justify-content-between">
                        <h4 class="">Holiday Modes</h4>
                    </ol>
                </nav>
                <form wire:submit='select'>

                    <div id="dynamicCheckboxContainer">
                        @foreach ($modes as $mode)
                            <div class="form-check">
                                <input class="form-check-input selectedbox" type="checkbox" name="selectedbox[]"
                                     style="margin-left: 0%" wire:model.live='selected_modes'value="{{$mode->id}}">
                                <label class="form-check-label" for='checkbox'>
                                    {{$mode->mode}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="text-white btn btn-primary save_btn" value="submit">Submit</button>
                </form>
                <div>
                    <p class="fw-bold">Selected Mode:
                        @foreach ($display_selected_mode as $modes)
                            
                        {{$modes->holidaymode->mode}} @endforeach</p>
                </div>
            </div>
        </div>
    </div>
</div>
