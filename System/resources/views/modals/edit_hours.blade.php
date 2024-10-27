<div class="modal fade modal-sm text-start" role="dialog" tabindex="-1" id="editHoursModal-{{ $saList->timelogId }}"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <form action="{{ route('sa.manager.addHours') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="d-xl-flex align-items-xl-center">
                                <h5>Edit Hour/s:</h5>
                                <input class="form-control" type="number" name="add_hours" />
                                <input type="hidden" name="timelog_id"  value="{{$saList->timelogId ? $saList->timelogId : $saList->id}}"/>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button class="btn background-accent1" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn background-accent2 text-accent1" type="submit" >OK</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
