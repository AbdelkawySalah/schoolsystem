  <!-- delete_modal_Grade -->
  <div class="modal fade" id="delete{{ $FeesType->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{trans('Fees_Types _trans.DeleteFees')}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('FeesType.destroy','test')}}" method="post">
                                                {{method_field('Delete')}}
                                                    @csrf
                                                    {{trans('Fees_Types _trans.DeleteFees')}}


                                                    @if (App::getLocale() == 'ar')
                                                    <input id="Name" type="text" name="Name_ar"
                                                                   class="form-control"
                                                                   value="{{$FeesType->getTranslation('Name', 'ar')}}"
                                                                   disabled>
                                                    @else
                                                     <input type="text" class="form-control"
                                                                   value="{{$FeesType->getTranslation('Name', 'en')}}"
                                                                   name="Name_en" disabled>
                                                    @endif
                                                    


                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $FeesType->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('Grades_trans.Delete') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
