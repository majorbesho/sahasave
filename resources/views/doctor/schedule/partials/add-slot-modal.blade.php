<!-- Add Slot Modal -->
<div class="modal fade custom-modal" id="add_slot">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Slots</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.schedule.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="day_of_week" id="day_of_week_input">

                    <div class="hours-info">
                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Start Time</label>
                                    <input type="time" name="start_time" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>End Time</label>
                                    <input type="time" name="end_time" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Slot Modal -->
