  <!-- add_modal_Grade -->
        <div class="modal fade" id="AddFeesTypeModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                            id="exampleModalLabel">
                            {{trans('Fees_Types _trans.Add_FeesType')}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('FeesType.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name"
                                           class="mr-sm-2">{{ trans('Fees_Types _trans.Name_ar') }}
                                        :</label>
                                    <input  type="text" name="Name_ar"  class="form-control" required>
                                </div>
                                <div class="col">
                                    <label for="Name_en"
                                           class="mr-sm-2">{{ trans('Fees_Types _trans.Name_en') }}
                                        :</label>
                                        <input  type="text" name="Name_en"  class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label
                                    for="exampleFormControlTextarea1">{{ trans('Fees_Types _trans.Decription') }}
                                    :</label>
                                <textarea class="form-control" name="Decsription" id="exampleFormControlTextarea1"
                                          rows="3"></textarea>
                            </div>
                            <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                        <button type="submit"
                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>