@extends('admin.main');

@section('header')
    <script src="{{asset('/public/ckeditor/ckeditor.js')}}"></script>
@stop

@section('content')


              <form action="" method="POST">
                @csrf
                <div class="card-body">
                  
                  <div class="row">
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Tên Sản Phẩm</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Danh Mục</label>
                            <select class="form-control" name="menu_id">
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}" {{ $product -> menu_id === $menu->id ? 'selected' : ''}}>
                                        {{ $menu->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Giá Gốc</label>
                            <input type="number" name="price" value="{{ $product -> price}}"  class="form-control" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Giá Giảm</label>
                            <input type="number" name="price_sale" value="{{ $product -> price_sale}}"  class="form-control" >
                        </div>
                    </div>
                </div>
                 
                    <div class="form-group">
                        <label >Mô tả</label>
                        <textarea name="description"  class="form-control" id="" >{{ $product -> description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label >Mô tả chi tiết</label>
                        <textarea name="content"  class="form-control" id="content" >{{$product -> content}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="menu">Ảnh Sản Phẩm</label>
                        <input type="file"  class="form-control" id="upload">
                        <div id="image_show">
                            <a href="{{$product -> thumb}}" target="_blank">
                                <img src="{{$product -> thumb}} " alt="" width="100px">
                            </a>
                        </div>
                        <input type="hidden" value="{{$product -> thumb}}" name="thumb" id="thumb">
                    </div>

                    <div class="form-group">
                      <label>Kích Hoạt</label>
                      <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active" 
                          {{ $product->active == 1 ? 'checked' : '' }}
                          >
                          <label for="active" class="custom-control-label">Có</label>
                      </div>
                      <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                          {{ $product->active == 0 ? 'checked' : ''}}
                          >
                          <label for="no_active" class="custom-control-label">Không</label>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
                </div>
              </form>
            
@section('footer')
<script>
                CKEDITOR.replace( 'content' );
</script>
@stop

@stop