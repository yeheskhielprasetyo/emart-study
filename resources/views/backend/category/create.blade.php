@extends('backend.layouts.index')
@section('text', 'Add Category')
@section('content')
<div class="col-10">
    <div class="card card-flush shadow-sm">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
        <div class="card-header">
            <form action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12 mb-10 mt-10">
                        <label for="exampleFormControlInput1" class="required form-label">Title</label>
                        <input type="text" class="form-control form-control-solid" name="title" value="{{old('title')}}" placeholder="Title"/>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Summary</label>
                        <textarea class="form-control form-control-solid" id="description" name="summary"  placeholder="Write someone your text">{{old('summary')}} </textarea>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Is Parent :</label>
                        <input id="is_parent" type="checkbox" name="is_parent" value="true" checked/>Yes
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-10 d-none" id="parent_cat_div">
                        <label for="exampleFormControlInput1">Parent Category</label>
                        <select class="form-select" data-control="select2" name="parent_id">
                            <option value="">--- Parent Category ---</option>
                            @foreach ($parent_cats as $pcats)
                            <option value="{{$pcats->id}}" {{old('parent_id') == $pcats->id ? 'selected' : ''}}>{{$pcats->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Upload Image</label>
                        <div class="input-group">
                                <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Status</label>
                        <select class="form-select" data-control="select2" name="status">
                            <option value="">--- Status ---</option>
                            <option value="active" {{old('status') == 'active' ? 'selected' : ' '}}>Active</option>
                            <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ' '}}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-mb-10 mb-10">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="submit" class="btn btn-secondary mr-5">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
        $('#lfm').filemanager('image');
</script>
    <script>
    $(document).ready(function() {
        $('#description').summernote();
    });
    </script>
    <script>
        $('#is_parent').change(function (e) {
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');
            // alert(is_checked);
            if(is_checked){
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            } else {
                $('#parent_cat_div').removeClass('d-none');
            }
        });
    </script>
@endsection
