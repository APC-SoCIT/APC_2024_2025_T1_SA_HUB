<div class="modal fade modal-sm text-start" role="dialog" tabindex="-1" id="editHoursModal-{{ $saList->timelogId }}"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    
                    <form action="{{ route('sa.manager.addHours') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="d-xl-flex align-items-xl-center" style="padding: 3em;">
                                <h5 style="margin: 5%;">Edit Hour/s:</h5>
                                <input type="number" name="add_hours" style="width: 5em;margin: 5%;" />
                                <input type="hidden" name="timelog_id"  value="{{$saList->timelogId}}"/>
                            </div>
                        </div>
                    <div class="modal-footer d-xl-flex justify-content-xl-center">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" style="background: rgb(248,190,91);color: rgb(0,0,0);border-style: none;">OK</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>