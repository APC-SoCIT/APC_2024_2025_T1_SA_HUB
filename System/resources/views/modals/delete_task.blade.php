<div class="modal " tabindex="-1" id="deleteTaskModal-{{ $task->id }}" aria-labelledby="deleteTaskModal-{{ $task->id }}-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-accent2">
                    <div class="modal-header border-0" >
                        <button type="button" class="btn-close border-accent2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('office.cancel', $task->id) }}" method="POST">
                        @csrf
                        <div class="modal-body" style="margin: auto;text-align: center;">
                            <svg class="bi bi-x-circle-fill" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="width: 60px;height: 60px;color: var(--bs-red);">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
                            </svg>
                            <h1 style="color: rgb(109,109,109);">Are you sure?</h1>
                            <p>
                                Do you really want to <strong class="text-danger fw-bolder"> DELETE </strong>this Task.<br />
                            </p>
                        </div>
                        <div class="modal-footer d-xl-flex justify-content-xl-center">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-danger" type="submit">Delete Task</button></div>
                        </div>
                    </form>
            </div>
        </div>
