@extends('admin.layout')


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить категорию
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form method="POST" action="{{route('categories.store')}}">
                @csrf
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Добавляем категорию</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>

                            @endif
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url()->previous()}}" class="btn btn-default">Назад</a>
                    <button id="create" class="btn btn-success pull-right">Добавить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

<script>

    $('#create').on('click', function (e){
        e.preventDefault()
        alert(2)
    })

    $.ajax({
        url:'admin/categories ',
        method: 'post',
        data: {text:'sds'},
    }).done(function (data){
        console.log(data)
    })




</script>
