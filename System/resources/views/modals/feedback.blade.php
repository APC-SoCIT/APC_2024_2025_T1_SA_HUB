<div class="modal fade modal-lg text-start" role="dialog" tabindex="-1" id="feedbackModal-{{ $saList->timelogId }}"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('office.feedback') }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        @php
                            $date = \Carbon\Carbon::parse($saList->time_in);
                            $time_in = \Carbon\Carbon::parse($saList->time_in);
                            $time_out = \Carbon\Carbon::parse($saList->time_out);
                        @endphp
                        <h5>Task {{ $taskId }}</h5>
                        <div style="padding-left: 5%;">
                            <h6>Name: {{ $saList->user->saProfile->first_name }}
                                {{ $saList->user->saProfile->last_name }}</h6>
                            <h6>Start Date: {{ $date->format('M-d-Y') }}
                            </h6>
                            <h6>
                                Time-In:
                                @if ($saList->time_in == null)
                                    No Time-In Yet
                                @else
                                    {{ $time_in->format('h:i a') }}
                                @endif
                            </h6>
                            <h6>
                                Time-Out:
                                @if ($time_out == null)
                                    No Time-Out Yet
                                @else
                                    {{ $time_out->format('h:i a') }}
                                @endif
                            </h6>

                        </div>

                        <div class="text-start" style="padding: 3em;width: 100%;height: 100%;">
                            <div style="padding: 0% 2%;">
                                <h5 class="text-start d-xl-flex">Feedback</h5>
                                <textarea style="width: 100%;" name="feedback"
                                    placeholder="{{ $saList->feedback ? $saList->feedback : 'Add Feedback' }}"></textarea>
                                <input type="hidden" name="timelogId" value="{{ $saList->timelogId }}">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer d-xl-flex justify-content-xl-center">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn {{ $saList->feedback ? 'background-accent1 text-accent2' : 'background-accent2 text-accent1 ' }}"
                        type="submit">{{ $saList->feedback ? 'Update Feedback' : 'Add Feedback' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
