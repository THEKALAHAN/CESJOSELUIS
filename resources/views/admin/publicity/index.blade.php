@extends('eliteadmin.layout')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Administración de espacios publicitarios</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                <li class="breadcrumb-item active">Administración de espacios publicitarios</li>
            </ol>
            @can('Crear espacios publicitarios')
                <a href="{{route('admin.publicity_place.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Crear</a>
            @endcan
        </div>
    </div>
</div>
<div class="row el-element-overlay">
    <div class="col-sm-12">
        <h4 class="card-title">Espacios publicitarios</h4>
        <h6 class="card-subtitle">Lista de espacios publicitarios</h6>
    </div>
    @foreach ($publicities as $item)
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="el-card-item">
                    <div class="el-card-avatar el-overlay-1"> <img src="{{asset('storage/avatar/publicity_place/'.$item->avatar)}}" alt="user" />
                        <div class="el-overlay">
                            <ul class="el-info">
                                @can('Ver espacios publicitarios')
                                    <li>
                                        <a href="{{route('admin.publicity_place.show',$item->id)}}" class="btn default btn-outline image-popup-vertical-fit">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </li>
                                @endcan
                                @can('Editar espacios publicitarios')
                                    <li>
                                        <a href="{{route('admin.publicity_place.edit',$item->id)}}" class="btn default btn-outline image-popup-vertical-fit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </li>
                                @endcan
                                @if ($item->status)
                                    @can('Rentar espacios publicitarios')    
                                        <li>
                                            <a href="{{route('admin.publicity_place.add',$item->id)}}" class="btn default btn-outline image-popup-vertical-fit">
                                                <i class="fa fa-user-plus"></i>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('Eliminar espacios publicitarios')
                                        @if (!$item->details || count($item->details) == 0)
                                            <li>
                                                <a id="idItem-{{$item->id}}" class="btn default btn-outline image-popup-vertical-fit delete-modal">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </li>
                                        @endif
                                    @endcan
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="el-card-content">
                        <h3 class="box-title">{{$item->title}}</h3>
                        <span class="badge badge-pill badge-cyan">Habilitado</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('css')
    <link href="{{asset('eliteadmin/inverse/dist/css/pages/user-card.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-modal').click(function () {
            let id = this.id.split('-')[this.id.split('-').length - 1];
            Swal.fire({
                title: '¿Está seguro?',
                text: "¡Si elimina el espacio publicitario no prodrás revertirlo!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                        $('#idItem-'+id).parent().parent().parent().parent().parent().parent().parent().remove();
                    var jqxhr = $.post('/admin/servicios/espacios_publicitarios/'+id, function name(data) {
                        Swal.fire(
                            'Eliminado!',
                            'El espacio publicitario ha sido eliminado',
                            'success'
                        )
                    })
                    .fail(function() {
                        alert( "error" );
                    });
                }
            })
        });
    </script>
@endsection