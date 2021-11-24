<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<form action="{{route('categories.update', $category->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Меняем категорию</h3>
        </div>
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Название</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                           value="{{$category->title}}">
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button class="btn btn-warning pull-right">Изменить</button>
        </div>
        <!-- /.box-footer-->
    </div>
</form>

<section class="content">

    <!-- Default box -->
    <form method="POST" action="{{route('categories.update', $category->id)}}">
        @csrf
        @method('PUT')
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Меняем категорию</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Название</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                               value="{{$category->title}}">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-warning pull-right">Изменить</button>
            </div>
            <!-- /.box-footer-->
        </div>
    </form>
    <!-- /.box -->

</section>


</body>
</html>
