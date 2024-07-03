<!-- Add Meeting Modal -->
<div class="modal fade" id="addMeetingsModal" tabindex="-1" aria-labelledby="addMeetingsModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h4 class="modal-title text-danger" id="addMeetingsModalLabel">Create Zoom Meeting </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addMeetings" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="mb-3">
                                <label for="edit_assigned_teacher" class="form-label">Assign Interviewer </label>

                                <select class="form-control" name="interviewer" id="edit_assigned_teacher" aria-label="Default select example">
                                    <option value="" id="diseaseNullValue" disabled selected>Select Interviewer</option>
                                    @foreach($interviewers as $interviewer)
                                    <option value="{{ $interviewer->id}}">{{ $interviewer->name  ?? ""}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="mb-3">
                                <label for="edit_assigned_teacher" class="form-label">Candidate </label>

                                <select class="form-control" name="candidate" id="edit_assigned_teacher" aria-label="Default select example">
                                    <option value="" id="diseaseNullValue" disabled selected>Select Candidate</option>
                                    @foreach($candidates as $candidate)
                                    <option value="{{ $candidate->id }}">{{ $candidate->name ?? ""}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="mb-3">
                                <label for="edit_assigned_teacher" class="form-label">Topic </label>
                                <input type="text" class="form-control" name="topic" id="topic" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="mb-3">
                                <label for="edit_assigned_teacher" class="form-label">Start Time</label>
                                <input type="text" class="form-control" name="start_time" id="start_time" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="mb-3">
                                <label for="edit_assigned_teacher" class="form-label">End Time</label>
                                <input type="text" class="form-control" name="end_time" id="end_time" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="mb-3">
                                <label for="edit_assigned_teacher" class="form-label">Duration</label>
                                <input type="text" class="form-control" name="duration" id="duration" placeholder="" value="" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="mb-3">
                                <label for="edit_assigned_teacher" class="form-label">Password </label>
                                <input type="password" class="form-control" name="meeting_password" id="meeting_password" placeholder="" value="">
                            </div>
                        </div>


                    </div>
                </div>
                <div class=" modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="addplanCloseBtn">Cancel</button>
                    <button type="submit" class="btn btn-danger me-1" id="addSkillBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>