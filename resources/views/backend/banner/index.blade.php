@extends('backend.layouts.index')
@section('content')
@section('text', 'Banner')
<h5 class="float-right mt-2"><strong>Total Banner : {{$totalbanner}} </strong></h5>
<div class="col-lg-12">
    @include('backend.layouts.notification')
</div>
<table id="example" class="display">
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Description</th>
            <th>Photo</th>
            <th>Condition</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($banners as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->title}}</td>
                <td>{!! html_entity_decode($item->description) !!}</td>
                <td><img src="{{$item->photo}}" alt="" style="max-height: 90px; max-width: 120px"></td>
                <td>
                    @if ($item->condition == 'banner')
                        <span class="badge badge-success">{{$item->condition}}</span>
                        @else
                        <span class="badge badge-primary">{{$item->condition}}</span>
                    @endif
                </td>
                <td>
                    <input type="checkbox" name="toogle" value="{{$item->id}}" data-toggle="switchbutton" {{$item->status == 'active' ? 'checked' : '' }} data-onlabel="active" data-offlabel="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                </td>
                <td>
                    <a href="{{route('banner.edit', $item->id)}}" data-toggle="tooltip" title="edit" class="float-left ml-2 btn btn-sm btn-outline-warning" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form class="float-left" action="{{route('banner.destroy', $item->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="" data-toggle="tooltip" title="delete" data-id="{{$item->id}}" class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom"><i class="fas fa-trash-alt"></i></a>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.dltBtn').click(function (e) {
        var form = $(this).closest('form');
        var dataID = $(this).data('id');
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                form.submit();
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!");
            }
            });
    });
    </script>
    <script>
        $('input[name=toogle]').change(function () {
            var mode=$(this).prop('checked');
            var id=$(this).val();
            $.ajax({
                url:"{{route('banner.status')}}",
                type:"POST",
                data:{
                    _token:'{{csrf_token()}}',
                    mode:mode,
                    id:id,
                },
                success:function (response) {
                    if(response.status) {
                        alert(response.msg);
                    } else {
                        alert('Please try again !');
                    }
                }
            })
        });
    </script>
@endsection


