@extends('admin.main')

@section('head')
    <script src="{{asset('/public/ckeditor/ckeditor.js')}}"></script>
@stop

@section('content')
        <form action="" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                <label for="menu">Tên Danh Mục</label>
                <input name="name" value="{{ $menu -> name }}" type="text" class="form-control" placeholder="Nhập tên danh mục">
                </div>

                <div class="form-group">
                <label>Danh Mục</label>
                <select name="parent_id" class="form-control">
                    <option value="0" {{ $menu->panent_id == 0 ? 'selected' : '' }}>Danh Mục Cha</option>
                    @foreach($menus as  $menuParent)
                        <option value="{{$menuParent->id}}"
                        {{ $menu->parent_id == $menuParent->id ? 'selected' :'' }}>{{$menuParent->name}}</option>

                    @endforeach
                </select>
                </div>

                
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" class="form-control" id="">{{ $menu->description}}</textarea>
                </div>

                <div class="form-group">
                    <label>Mô tả chi tiết</label>
                    <textarea name="content" class="form-control" id="content">{{ $menu->content}}</textarea>
                </div>

                <div class="form-group">
                    <label for="menu">Ảnh Sản Phẩm</label>
                    <input type="file" class="form-control" id="upload">
                    <div id="image_show">
                        
                    </div>
                    <input type="hidden" name="thumb" id="thumb">
                </div>

                
                <div class="form-group">
                    <label>Kích Hoạt</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active" name="active" 
                        {{ $menu->active == 1 ? 'checked' : '' }}>
                        <label for="active" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $menu->active == 0 ? 'checked' : '' }}>
                        <label for="no_active" class="custom-control-label">Không</label>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Sửa Danh Mục</button>
            </div>
        </form>

        @section('footer')
            <script>
                    CKEDITOR.replace( 'content' );
            </script>
        @endsection
@endsection