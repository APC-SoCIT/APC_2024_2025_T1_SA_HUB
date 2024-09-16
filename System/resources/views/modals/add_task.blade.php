<div class="modal fade modal-lg" role="dialog" tabindex="-1" id="addTask">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Add Task</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('office.add') }}" method="POST" id="addTaskForm">
                        @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div>
                                    <div>
                                        <div class="row">
                                            <div class="col" style="margin: 1em;">
                                                <div><label class="form-label"><strong>Date *</strong></label></div>
                                                <div><input id="start_date" name="start_date" type="date" style="width: 200px;font-size: 20px;">
                                                </div>
                                            </div>
                                            <div class="col" style="margin: 1em;">
                                                <div><label class="form-label"><strong>Time *</strong></label></div>
                                                <div class="d-xl-flex align-items-xl-center">
                                                    <input id="start_time" name="start_time" type="time" style="width: 150px;margin: auto;">
                                                    <input id="end_time" name="end_time" type="time" style="width: 150px;margin: auto;">
                                                </div>
                                                
                                            </div>
                                            <div>
                                                <div class="col" style="margin: 1em;">
                                                    <div><label class="form-label"><strong>No. of Student Assistant *</strong></label></div>
                                                    <div><input id="number_of_sa" name="number_of_sa" type="number" style="width: 5em;font-size: 20px;"></div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col" style="margin: 1em;">
                                                <div><label class="form-label"><strong>Program </strong>(optional)</label></div>
                                                <div>
                                                    <select class="form-select" id="preffred_program" name="preffred_program" aria-label="Default select example">
                                                        <option selected disable>Select a Program</option>
                                                        @foreach($courses as $course)
                                                            <option value="{{$course->name}}">{{$course->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <div>
                                        <div class="row">
                                            <div class="col" style="margin: 1em;">
                                                <div><label class="form-label">
                                                    <strong>Task Assignment Type </strong>*</label>
                                                </div>
                                                <div id="assignment_type" class="d-xl-flex align-items-xl-center" >
                                                    <div class="form-check" style="margin: auto;"> 
                                                        <input class="form-check-input" type="radio"  name="assignment_type" id="formCheck-3" value="1" >
                                                        <label class="form-check-label" for="formCheck-3" >Auto Assignment</label></div>
                                                    <div class="form-check" style="margin: auto;">
                                                        <input class="form-check-input" type="radio"  name="assignment_type" id="formCheck-4" value="2" >
                                                        <label class="form-check-label" for="formCheck-4">Voluntary</label></div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col" style="margin: 1em;">
                                                <div><label class="form-label"><strong>Tasks to be done</strong> (optional)</label></div>
                                                <div class="d-xl-flex align-items-xl-center">
                                                    <input id="to_be_done" name="to_be_done" type="text" style="width: 20em;height: 5em;"></div>
                                                    
                                            </div>
                                            <div class="col" style="margin: 1em;">
                                                <div><label class="form-label"><strong>Note </strong>(contact person, what to bring, etc.)</label></div>
                                                <div class="d-xl-flex align-items-xl-center">
                                                    <input id="note" name="note" type="text" style="width: 20em;height: 5em;"></div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                <div id="start_date_error"></div>
                                <div id="start_time_error"></div>
                                <div id="end_time_error"></div> 
                                <div id="number_of_sa_error"></div>
                                <div id="preffered_program_error"></div>
                                <div id="assignment_type_error"></div>
                                <div id="to_be_done_error"></div>
                                <div id="note_error"></div>
                    </div>
                    <div class="modal-footer d-xl-flex justify-content-xl-center">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn " type="submit" style="background: rgb(248,190,91);color: rgb(0,0,0);">Add Task</button></div>
                    </div>
                </form>
            </div>
        </div>
        