@extends('admin.main')


@section('content')

<table class="table">
    <thead >
        <tr >
           
                <th >ID</th>
                <th>Tiêu Đề</th>
                <th>Đường Dẫn</th>
                <th>Ảnh</th>
                <th>Trạng Thái</th>
                <th>Cập Nhật</th>
                <th style="width: 100px">&nbsp;</th>
         
        </tr>
    </thead>
    
    <tbody>
        @foreach ($sliders as $key => $slider)
            

        <tr>
            <td>{{ $slider->id }}</td>
            <td>{{ $slider->name }}</td>
            <td>{{ $slider->url }}</td>
            <td>
                <a href="{{ $slider -> thumb }}" target="_blank">
                    <img src="{{ $slider -> thumb }}" height="40px">
                </a>
            </td>
            <td>{!! \App\Helper\Helper::active($slider->active) !!}</td>
            <td>{{ $slider->updated_at }}</td>

            <td>
                <a class="btn btn-primary btn-sm" href="/shoplaravel01/admin/sliders/edit/{{ $slider->id }}">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="#" class="btn btn-danger btn-sm"
                    onclick="removeRow({{ $slider->id }}, '/shoplaravel01/admin/sliders/destroy')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

    <div class="card-footer clearfix">
        {!! $sliders->links() !!}                              
    </div>

@stop