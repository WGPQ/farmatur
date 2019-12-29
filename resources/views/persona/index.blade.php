{{-- calling layouts \ app.blade.php --}}
@extends('layouts2.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Simple Laravel CRUD Ajax</h1>
    </div>
</div>

<div class="row">
    <div class="table table-responsive">
        <table class="table table-bordered" id="table">
            <tr>
                <th width="150px">No</th>
                <th>Nombre</th>
                <th>Cedula</th>
                <th>Create At</th>


                <th class="text-center" width="150px">
                    <a href="#" class="create-modal btn btn-success btn-sm">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>
                </th>

            </tr>
            {{ csrf_field() }}
            <?php  $no=1; ?>
            @foreach ($persona as $value)
            <tr class="persona{{$value->id}}">
                <td>{{ $no++ }}</td>
                <td>{{ $value->nombre }}</td>
                <td>{{ $value->cedula }}</td>
                <td>{{ $value->created_at }}</td>
                <td>
                    <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}"
                        data-nombre="{{$value->nomre}}" data-cedula="{{$value->cedula}}">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}"
                        data-nombre="{{$value->nombre}}" data-cedula="{{$value->cedula}}">
                        <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                    <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}"
                        data-nombre="{{$value->nombre}}" data-cedula="{{$value->cedula}}">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    {{$persona->links()}}
</div>


{{-- Modal Form Create Post --}}
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group row add">
                        <label class="control-label col-sm-2" for="title">Nombre :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Ingrese su nombre" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="body">Cedula :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cedula" name="cedula"
                                placeholder="Ingrese su cedula" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="submit" id="add">
                    <span class="glyphicon glyphicon-plus"></span>Save Post
                </button>
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remobe"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>



{{-- Modal Form Show POST --}}
<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">ID :</label>
                    <b id="i" />
                </div>
                <div class="form-group">
                    <label for="">Nombre :</label>
                    <b id="ti" />
                </div>
                <div class="form-group">
                    <label for="">Cedula :</label>
                    <b id="by" />
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Form Edit and Delete Post --}}
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fid" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Nombre</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="t">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="body">Cedula</label>
                        <div class="col-sm-10">
                            <textarea type="name" class="form-control" id="b"></textarea>
                        </div>
                    </div>
                </form>
                {{-- Form Delete Post --}}
                <div class="deleteContent">
                    Are You sure want to delete <span class="title"></span>?
                    <span class="hidden id"></span>
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn actionBtn" data-dismiss="modal">
                    <span id="footer_action_button" class="glyphicon"></span>
                </button>

                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon"></span>close
                </button>

            </div>
        </div>
    </div>
</div>
@endsection