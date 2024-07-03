@extends('candidate.layout.master')

@section('main-content-section')
    <style>

    </style>
    @php
    $interviewer = Auth::user()->role == \App\Models\User::INTERVIEWER 
    @endphp
     @include('interviewer.models.model')
    <div class="container">
        <br />
        <br />
        <div id="calendar"></div>
    </div>
@endsection
@push('script')
    <script>

// var isInterviewer = @json($interviewer);
  $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                events: '/candiate/get-meeting',
                dayRender: function(date, cell) {
                    if (date.isBefore(moment(), 'day')) {
                        $(cell).addClass('fc-past');
                    }
                },
                selectable: true,
                selectAllow: function(selectInfo) {
                    return moment().diff(selectInfo.start, 'days') <= 0;
                },
                dayClick: function(date, jsEvent, view) {
                    if (date.isSameOrAfter(moment(), 'day')) {
                        $('#addMeetingsModal').modal('show');
                        $('#start_time').val(date.format('YYYY-MM-DDTHH:mm'));
                    }
                }
            });

            // Submit form via AJAX
            $('#addMeetingsForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('interviewer.store') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#calendar').fullCalendar('refetchEvents');
                        $('#addMeetingsModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error here
                    }
                });
            });
        });
    </script>
@endpush