@extends('backend.layouts.index')
@section('text', 'Add Banner')
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
            <form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12 mb-10 mt-10">
                        <label for="exampleFormControlInput1" class="required form-label">Title</label>
                        <input type="text" class="form-control form-control-solid" name="title" value="{{old('title')}}" placeholder="Title"/>
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
                        <label for="exampleFormControlInput1" class="required form-label">Description</label>
                        <textarea class="form-control form-control-solid" id="description" name="description"  placeholder="Write someone your text">{{old('description')}} </textarea>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Condition</label>
                        <select class="form-select" data-control="select2" name="condition">
                            <option value="">--- Condition ---</option>
                            <option value="banner" {{old('condition') == 'banner' ? 'selected' : ' '}}>Banner</option>
                            <option value="promo" {{old('condition') == 'promo' ? 'selected' : ' '}}>Promo</option>
                        </select>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Description</label>
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
@endsection
