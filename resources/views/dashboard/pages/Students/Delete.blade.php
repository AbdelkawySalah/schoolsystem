<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_Student{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('Student_trans.Deleted_Student')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Student.destroy','test')}}" method="post">
                    @csrf
                    @method('DELETE')

                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('Student_trans.Deleted_Student_tilte')}}</h5>
                    <input type="text" readonly value="{{$student->name}}" class="form-control">
                    <input type="hidden" name="pagedelete_id" value="1">
                    <input type="text" name="deletedid" value="{{$student->id}}">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Student_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('Student_trans.Delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>