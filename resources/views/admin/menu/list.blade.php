@extends('admin.main')


@section('content')
<table class="table">
    <thead >
        <tr >
           
                <th >ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 100px">&nbsp;</th>
         
        </tr>
    </thead>
    
    <tbody>

        {!! App\Helper\Helper::menu($menus) !!}
        
    </tbody>
</table>


@stop