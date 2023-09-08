@extends('layouts.guest')
@section('title', 'Inicio')
@section('content')
    <style>
        .modal-body .row{
            overflow-y: scroll;
            max-height: 350px;
        }

    </style>
    <div class="mt-5">

        <div class="row">
            <div class="col-12">
                <p class="float-right"><span id="fecha-hora"></span></p>
            </div>
            <div class="col-12">

                <div class="card ">

                    <div class="card-header">
                        <h5 >Todos los Apuntes <span  class="float-right btn btn-primary" data-toggle="modal" data-target="#exampleModal">+</span></h5>
                    </div>
                    <div class="card-body">
                        <div class="d-none d-sm-none d-md-none d-lg-block d-xl-block">
                            <ul class="nav  nav-pills   mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-pendiente-tab" data-toggle="pill" href="#pills-pendiente" role="tab" aria-controls="pills-pendiente" aria-selected="true">Pendientes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-finalizados-tab" data-toggle="pill" href="#pills-finalizados" role="tab" aria-controls="pills-finalizados" aria-selected="false">Finalizado</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-urgentes-tab" data-toggle="pill" href="#pills-urgentes" role="tab" aria-controls="pills-urgentes" aria-selected="false">Urgentes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-borrados-tab" data-toggle="pill" href="#pills-borrados" role="tab" aria-controls="pills-borrados" aria-selected="false">Borrados</a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none">
                            <ul class="nav flex-column nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-pendiente-tab" data-toggle="pill" href="#pills-pendiente" role="tab" aria-controls="pills-pendiente" aria-selected="true">Pendientes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-finalizados-tab" data-toggle="pill" href="#pills-finalizados" role="tab" aria-controls="pills-finalizados" aria-selected="false">Finalizado</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-urgentes-tab" data-toggle="pill" href="#pills-urgentes" role="tab" aria-controls="pills-urgentes" aria-selected="false">Urgentes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-borrados-tab" data-toggle="pill" href="#pills-borrados" role="tab" aria-controls="pills-borrados" aria-selected="false">Borrados</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-pendiente" role="tabpanel" aria-labelledby="pills-pendiente-tab">
                                <div class="row">
                                    @foreach($notas as $nota)
                                        @if($nota->estado == 1)
                                            <div class="col-12 col-md-6 col-lg-3 mb-4">
                                                <div style="cursor: pointer" class="card"  data-toggle="modal" data-target="#editarApunte_{{$loop->iteration}}">
                                                    <div class="card-body text-black">
                                                        <p><span class="font-weight-bold">{{ ucfirst($nota->nombre) }}</span> -
                                                            @if($nota->estado == 1)
                                                                <span style="margin-left: 10px; padding: 1px 6px;border-radius: 5px; background: #3f3d3d; color: #fff;">Pendiente</span>
                                                            @elseif($nota->estado == 2)
                                                                <span style="margin-left: 10px; padding: 1px 6px;border-radius: 5px; background: #188325; color: #fff;">Finalizado</span>
                                                            @elseif($nota->estado == 3)
                                                                <span style="margin-left: 10px; padding: 1px 6px;border-radius: 5px;  background: red;color: #fff;">Urgente</span>
                                                            @endif
                                                        </p>
                                                        <span class="font-weight-bold">Creado:</span>
                                                        <p>{{ $nota->created_at->format('d M, Y - h:i a') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Editar-->
                                            <div class="modal fade" id="editarApunte_{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="container">
                                                            <form action="{{route('notas.update', $nota)}}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Apunte </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <label for="creacion"  class="font-weight-bold">Creado</label>
                                                                                <input type="text" class="form-control" disabled id="creacion" value="{{$nota->created_at}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <label for="nombre"  class="font-weight-bold">Nombre del Apunte:</label>
                                                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$nota->nombre}}" placeholder="Nombre">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p  class="font-weight-bold">Estados</p>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="estado" id="Pendiente" value="1" @if($nota->estado == 1) checked @endif>
                                                                                <label class="form-check-label d-flex align-items-center" for="Pendiente">
                                                                                    Pendiente <div style="margin-left: 10px; width: 25px; height: 10px; background: #3f3d3d"></div>
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="estado" id="Finalizado" value="2" @if($nota->estado == 2) checked @endif>
                                                                                <label class="form-check-label d-flex align-items-center" for="Finalizado">
                                                                                    Finalizado <div style="margin-left: 10px; width: 25px; height: 10px; background: #188325"></div>
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="estado" id="Urgente" value="3" @if($nota->estado == 3) checked @endif>
                                                                                <label class="form-check-label d-flex align-items-center" for="Urgente">
                                                                                    Urgente <div style="margin-left: 10px; width: 25px; height: 10px; background: red"></div>
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label for="summernote_{{$loop->iteration}}"  class="font-weight-bold">Descricion</label>
                                                                            <textarea id="summernote_{{$loop->iteration}}" name="descripcion">{{$nota->descripcion}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-warning">Editar</button>
                                                                    <a title="Eliminar" onclick="document.getElementById('eliminarApunte_{{ $loop->iteration }}').submit()" class="btn btn-danger space-icon-option-special">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </form>
                                                            <form action="{{route('notas.destroy',$nota)}}"  method="POST" id="eliminarApunte_{{ $loop->iteration }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-finalizados" role="tabpanel" aria-labelledby="pills-finalizados-tab">
                                <div class="row">
                                    @foreach($notas as $nota)
                                        @if($nota->estado == 2)
                                            <div class="col-12 col-md-6 col-lg-3 mb-4">
                                                <div style="cursor: pointer" class="card"  data-toggle="modal" data-target="#editarApunte_{{$loop->iteration}}">
                                                    <div class="card-body text-black">
                                                        <p><span class="font-weight-bold">{{ucfirst($nota->nombre)}}</span> -
                                                            @if($nota->estado == 1)
                                                                <span style="margin-left: 10px; padding: 1px 6px;border-radius: 5px; background: #3f3d3d; color: #fff;">Pendiente</span>
                                                            @elseif($nota->estado == 2)
                                                                <span style="margin-left: 10px; padding: 1px 6px;border-radius: 5px; background: #188325; color: #fff;">Finalizada</span>
                                                            @elseif($nota->estado == 3)
                                                                <span style="margin-left: 10px; padding: 1px 6px;border-radius: 5px;  background: red;color: #fff;">Urgente</span>
                                                            @endif
                                                        </p>
                                                        <span class="font-weight-bold">Creado:</span>
                                                        <p>{{ $nota->created_at->format('d M, Y - h:i a') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Editar-->
                                            <div class="modal fade" id="editarApunte_{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="container">
                                                            <form action="{{route('notas.update', $nota)}}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Apunte</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <label for="creacion"  class="font-weight-bold">Creado</label>
                                                                                <input type="text" class="form-control" disabled id="creacion" value="{{$nota->created_at}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <label for="nombre"  class="font-weight-bold">Nombre del Apunte:</label>
                                                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$nota->nombre}}" placeholder="Nombre">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p  class="font-weight-bold">Estados</p>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="estado" id="Pendiente" value="1" @if($nota->estado == 1) checked @endif>
                                                                                <label class="form-check-label d-flex align-items-center" for="Pendiente">
                                                                                    Pendiente <div style="margin-left: 10px; width: 25px; height: 10px; background: #3f3d3d"></div>
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="estado" id="Finalizado" value="2" @if($nota->estado == 2) checked @endif>
                                                                                <label class="form-check-label d-flex align-items-center" for="Finalizado">
                                                                                    Finalizado <div style="margin-left: 10px; width: 25px; height: 10px; background: #188325"></div>
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="estado" id="Urgente" value="3" @if($nota->estado == 3) checked @endif>
                                                                                <label class="form-check-label d-flex align-items-center" for="Urgente">
                                                                                    Urgente <div style="margin-left: 10px; width: 25px; height: 10px; background: red"></div>
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label for="summernote_{{$loop->iteration}}"  class="font-weight-bold">Descricion</label>
                                                                            <textarea id="summernote_{{$loop->iteration}}" name="descripcion">{{$nota->descripcion}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-warning">Editar</button>

                                                                    <a title="Eliminar" onclick="document.getElementById('eliminarApunte_{{ $loop->iteration }}').submit()" class="btn btn-danger space-icon-option-special">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </form>
                                                            <form action="{{route('notas.destroy',$nota)}}"  method="POST" id="eliminarApunte_{{ $loop->iteration }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-urgentes" role="tabpanel" aria-labelledby="pills-urgentes-tab">
                                <div class="row">
                                    @foreach($notas as $nota)
                                        @if($nota->estado == 3)
                                            <div class="col-12 col-md-6 col-lg-3 mb-4">
                                                <div style="cursor: pointer" class="card"  data-toggle="modal" data-target="#editarApunte_{{$loop->iteration}}">
                                                    <div class="card-body text-black">
                                                        <p><span class="font-weight-bold">{{ucfirst($nota->nombre)}}</span> -
                                                            @if($nota->estado == 1)
                                                                <span style="margin-left: 10px; padding: 1px 6px;border-radius: 5px; background: #3f3d3d; color: #fff;">Pendiente</span>
                                                            @elseif($nota->estado == 2)
                                                                <span style="margin-left: 10px; padding: 1px 6px;border-radius: 5px; background: #188325; color: #fff;">Finalizado</span>
                                                            @elseif($nota->estado == 3)
                                                                <span style="margin-left: 10px;  padding: 1px 6px;border-radius: 5px; background: red;color: #fff;">Urgente</span>
                                                            @endif
                                                        </p>
                                                        <span class="font-weight-bold">Creado:</span>
                                                        <p>{{ $nota->created_at->format('d M, Y - h:i a') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Editar-->
                                            <div class="modal fade" id="editarApunte_{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="container">
                                                            <form action="{{route('notas.update', $nota)}}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Apunte {{$nota->nombre}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <label for="creacion"  class="font-weight-bold">Creado</label>
                                                                                <input type="text" class="form-control" disabled id="creacion" value="{{$nota->created_at}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <label for="nombre"  class="font-weight-bold">Nombre del Apunte:</label>
                                                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$nota->nombre}}" placeholder="Nombre">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p  class="font-weight-bold">Estados</p>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="estado" id="Pendiente" value="1" @if($nota->estado == 1) checked @endif>
                                                                                <label class="form-check-label d-flex align-items-center" for="Pendiente">
                                                                                    Pendiente <div style="margin-left: 10px; width: 25px; height: 10px; background: #3f3d3d"></div>
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="estado" id="Finalizado" value="2" @if($nota->estado == 2) checked @endif>
                                                                                <label class="form-check-label d-flex align-items-center" for="Finalizado">
                                                                                    Finalizado <div style="margin-left: 10px; width: 25px; height: 10px; background: #188325"></div>
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="estado" id="Urgente" value="3" @if($nota->estado == 3) checked @endif>
                                                                                <label class="form-check-label d-flex align-items-center" for="Urgente">
                                                                                    Urgente <div style="margin-left: 10px; width: 25px; height: 10px; background: red"></div>
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label  class="font-weight-bold" for="summernote_{{$loop->iteration}}">Descricion</label>
                                                                            <textarea id="summernote_{{$loop->iteration}}" name="descripcion">{{$nota->descripcion}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-warning">Editar</button>

                                                                    <a title="Eliminar" onclick="document.getElementById('eliminarApunte_{{ $loop->iteration }}').submit()" class="btn btn-danger space-icon-option-special">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                                    </a>

                                                                </div>
                                                            </form>

                                                            <form action="{{route('notas.destroy',$nota)}}"  method="POST" id="eliminarApunte_{{ $loop->iteration }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-borrados" role="tabpanel" aria-labelledby="pills-borrados-tab"padding: 1px 6px;border-radius: 5px; >
                                <div class="row">
                                    @foreach($notasDelete as $notasD)
                                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                                            <div style="cursor: pointer" class="card"  data-toggle="modal" data-target="#deletedat_{{$loop->iteration}}">
                                                <div class="card-body text-black">
                                                    <p><span class="font-weight-bold">{{ucfirst($notasD->nombre)}}</span> -
                                                        @if($notasD->trashed())
                                                            <span style="margin-left: 10px;padding: 1px 6px;border-radius: 5px; background: #f00; color: #fff;">Borrado</span>
                                                        @elseif($notasD->estado == 1)
                                                            <span style="margin-left: 10px;padding: 1px 6px;border-radius: 5px; background: #3f3d3d; color: #fff;">Pendiente</span>
                                                        @elseif($notasD->estado == 2)
                                                            <span style="margin-left: 10px;padding: 1px 6px;border-radius: 5px; background: #188325; color: #fff;">Finalizado</span>
                                                        @elseif($notasD->estado == 3)
                                                            <span style="margin-left: 10px; padding: 1px 6px;border-radius: 5px; background: red;color: #fff;">Urgente</span>
                                                        @endif
                                                    </p>
                                                    <span class="font-weight-bold">Creado:</span>
                                                    <p>{{ $notasD->created_at->format('d M, Y - h:i a') }}</p>
                                                    <span class="font-weight-bold">Eliminado:</span>
                                                    <p>{{ $notasD->deleted_at->format('d M, Y - h:i a') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Editar-->
                                        <div class="modal fade" id="deletedat_{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="container">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"> Apunte Borrado.</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-floating mb-3">
                                                                        <label for="creacion"  class="font-weight-bold">Creado</label>
                                                                        <input type="text" class="form-control" disabled id="creacion" value="{{$notasD->created_at}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-floating mb-3">
                                                                        <label for="eliminacion"  class="font-weight-bold">Eliminado</label>
                                                                        <input type="text" class="form-control" disabled id="eliminacion" value="{{$notasD->deleted_at}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-floating mb-3">
                                                                        <label for="nombre"  class="font-weight-bold">Nombre del Apunte:</label>
                                                                        <input type="text" class="form-control" id="nombre" disabled name="nombre" value="{{$notasD->nombre}}" placeholder="Nombre">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p  class="font-weight-bold">Estados</p>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"  id="Pendiented" value="1"  @if($notasD->estado == 1) checked @endif>
                                                                        <label class="form-check-label d-flex align-items-center" for="Pendiented">
                                                                            Pendiente <div style="margin-left: 10px; width: 25px; height: 10px; background: #3f3d3d"></div>
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"  id="Finalizadod" value="2"  @if($notasD->estado == 2) checked @endif>
                                                                        <label class="form-check-label d-flex align-items-center" for="Finalizadod">
                                                                            Finalizado <div style="margin-left: 10px; width: 25px; height: 10px; background: #188325"></div>
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"  id="Urgented" value="3"  @if($notasD->estado == 3) checked @endif>
                                                                        <label class="form-check-label d-flex align-items-center" for="Urgented">
                                                                            Urgente <div style="margin-left: 10px; width: 25px; height: 10px; background: red"></div>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <label  class="font-weight-bold" for="deletedat_{{$loop->iteration}}">Descricion</label>
                                                                    {!! $notasD->descripcion !!}

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Crear-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="container">
                    <form action="{{route('notas.store')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Apunte</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <label for="creacion"  class="font-weight-bold">Creado</label>
                                        <input type="text" class="form-control" disabled id="creacion" value="{{ now()->format('Y-m-d H:i:s') }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <label for="nombre"  class="font-weight-bold">Nombre del Apunte:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p  class="font-weight-bold">Estados</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" id="Pendiente" value="1" checked>
                                        <label class="form-check-label d-flex align-items-center" for="Pendiente">
                                            Pendiente <div style="margin-left: 10px; width: 25px; height: 10px; background: #3f3d3d"></div>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" id="Finalizado" value="2">
                                        <label class="form-check-label d-flex align-items-center" for="Finalizado">
                                            Finalizado <div style="margin-left: 10px; width: 25px; height: 10px; background: #188325"></div>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" id="Urgente" value="3">
                                        <label class="form-check-label d-flex align-items-center" for="Urgente">
                                            Urgente <div style="margin-left: 10px; width: 25px; height: 10px; background: red"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="summernote"  class="font-weight-bold">Descricion</label>
                                    <textarea id="summernote" name="descripcion" ></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Crear Apunte</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        $('#summernote').summernote({
            placeholder: 'Descripción del Apunte...',
            tabsize: 2,
            height: 100
        });
        @foreach($notas as $nota)
        $('#summernote_{{$loop->iteration}}').summernote({
            placeholder: 'Descripción del Apunte...',
            tabsize: 2,
            height: 100
        });

        @endforeach
    </script>
    <script>
        function mostrarFechaHora() {
            const elementoFechaHora = document.getElementById('fecha-hora');

            function actualizarFechaHora() {
                const ahora = new Date();
                const diasSemana = ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"];
                const diaSemana = diasSemana[ahora.getDay()];
                const dia = ahora.getDate();
                const mes = ahora.toLocaleDateString('default', { month: 'short' });
                const anio = ahora.getFullYear();
                const hora = ahora.getHours();
                const minutos = ahora.getMinutes();
                const segundos = ahora.getSeconds();
                const ampm = hora >= 12 ? 'p.m.' : 'a.m.';
                const hora12 = hora % 12 || 12;

                const fechaHora = `${diaSemana}, ${dia} ${mes} - ${anio}, ${hora12}:${minutos}:${segundos} ${ampm}`;

                elementoFechaHora.textContent = fechaHora;
            }

            // Actualiza la fecha y hora cada segundo
            setInterval(actualizarFechaHora, 1000);

            // Llama a la función para mostrar la fecha y hora inicial
            actualizarFechaHora();
        }

        // Llama a la función cuando se carga la página
        window.addEventListener('load', mostrarFechaHora);
    </script>








@endsection
