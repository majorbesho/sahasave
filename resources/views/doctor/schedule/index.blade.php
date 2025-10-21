@extends('frontend.layouts.master')


@section('content')


    <div class="content">
        <div class="container">

            <div class="row">
                <div class="dashboard-header">
                    <h3>Available Timings</h3>
                </div>





                @include('doctor.layouts.slide')



                <div class="col-lg-8 col-xl-9">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="card-header">
                                <h3>Select Available Slots</h3>
                            </div>

                            <div class="available-tab">
                                <label class="form-label">Select Available days</label>
                                <ul class="nav">
                                    @foreach ($daysOfWeek as $dayNum => $dayName)
                                        <li>
                                            <a href="#" class="{{ $loop->first ? 'active' : '' }}"
                                                data-bs-toggle="tab"
                                                data-bs-target="#day-{{ $dayNum }}">{{ $dayName }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="pt-0 tab-content">
                                @foreach ($daysOfWeek as $dayNum => $dayName)
                                    <!-- Slot for {{ $dayName }} -->
                                    <div class="tab-pane {{ $loop->first ? 'active show' : 'fade' }}"
                                        id="day-{{ $dayNum }}">
                                        <div class="slot-box">
                                            <div class="slot-header">
                                                <h5>{{ $dayName }}</h5>
                                                <ul>
                                                    <li>
                                                        <a href="#" class="add-slot" data-bs-toggle="modal"
                                                            data-bs-target="#add_slot" data-day-num="{{ $dayNum }}"
                                                            data-day-name="{{ $dayName }}">Add
                                                            Slots</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="slot-body">
                                                @if (isset($schedules[$dayNum]) && $schedules[$dayNum]->count() > 0)
                                                    <ul class="time-slots">
                                                        @foreach ($schedules[$dayNum] as $slot)
                                                            <li
                                                                class="d-flex align-items-center justify-content-between w-100">
                                                                <span>
                                                                    <i class="isax isax-clock"></i>
                                                                    {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}
                                                                    -
                                                                    {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                                                </span>
                                                                <form
                                                                    action="{{ route('doctor.schedule.destroy', $slot) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-danger-light"><i
                                                                            class="fa fa-trash"></i></button>
                                                                </form>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <p>No Slots Available</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Slot -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('modals')
        @include('doctor.schedule.partials.add-slot-modal')
    @endpush

    @push('scripts')
        <script>
            // Script to pass day info to the modal
            document.addEventListener('DOMContentLoaded', function() {
                var addSlotModal = document.getElementById('add_slot');
                addSlotModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var dayNum = button.getAttribute('data-day-num');
                    var dayName = button.getAttribute('data-day-name');

                    var modalTitle = addSlotModal.querySelector('.modal-title');
                    var dayInput = addSlotModal.querySelector('#day_of_week_input');

                    modalTitle.textContent = 'Add Slots for ' + dayName;
                    dayInput.value = dayNum;
                });
            });
        </script>


        @stack('scripts')
        @stack('modals')
    @endpush
