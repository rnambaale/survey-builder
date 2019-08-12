<form method="post" action="/surveys/{{$survey->id}}" autocomplete="off">

    @csrf
    @method('PATCH')

    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Survey</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Survey Title</label>
                    <input type="" name="title" class="form-control" value="{{ $survey->title }}" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>

</form>