<div class="modal fade modal-lg text-start" role="dialog" tabindex="-1" id="feedbackModal-{{ $saList->timelogId }}"  aria-hidden="true">
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
                                
                                <h5>Task {{ $taskId }}</h5>
                                <div style="padding-left: 5%;">
                                    <h6>Name: {{$saList->first_name}} {{$saList->last_name}}</h6>
                                    <h6>Start Date: {{$saList->start_date}}
                                        @if($saList->start_date == null)
                                            No Start date
                                        @else
                                            {{$saList->start_date}}
                                        @endif
                                    </h6>
                                    <h6>
                                        Time-In: 
                                        @if($saList->timein == null)
                                            No Time-In Yet
                                        @else
                                            {{$saList->timein}}
                                        @endif
                                    </h6>
                                    <h6>
                                        Time-Out:
                                        @if($saList->timeout == null)
                                            No Time-Out Yet
                                        @else
                                            {{$saList->timeout}}
                                        @endif                                                                                                                                                                                   
                                    </h6>

                                </div>
                                    
                                <div class="text-start" style="padding: 3em;width: 100%;height: 100%;">
                                    <div style="padding: 0% 2%;">
                                        <h5 class="text-start d-xl-flex">Feedback</h5>
                                        <textarea style="width: 100%;" name="feedback" placeholder="{{$saList->feedback ? $saList->feedback : 'Add Feedback'}}"></textarea>
                                        <input type="hidden" name="timelogId" value="{{ $saList->timelogId }}">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal-footer d-xl-flex justify-content-xl-center">
                            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn {{ $saList->feedback ? 'btn-info' : 'btn-warning '}}" type="submit"  >{{ $saList->feedback ? 'Update Feedback' : 'Add Feedback'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>