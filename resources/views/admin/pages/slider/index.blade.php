@extends('eliteadmin.layout')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Administración de página</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                <li class="breadcrumb-item">Administración de página</li>
                <li class="breadcrumb-item active">Carusel</li>
            </ol>
            @can('Crear galeria de carrucel')
                <a href="{{route('admin_slider.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Crear</a>
            @endcan
        </div>
    </div>
</div>
<div class="row el-element-overlay">
    <div class="col-md-12">
        <h4 class="card-title">Carusel</h4>
        <h6 class="card-subtitle m-b-20 text-muted">Tu puedes hacer una galeria para el carrusel principal, puedes programar su comienzo y fin de la publicación</h6>
    </div>
    @foreach ($sliders as $item)
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="el-card-item">
                    <div class="el-card-avatar el-overlay-1">
                        <img src="{{$item->file->url.$item->file->name}}" alt="user" />
                        <div class="el-overlay">
                            <ul class="el-info">
                                @can('Ver galeria de carrucel')
                                    <li>
                                        <a class="btn default btn-outline image-popup-vertical-fit show-modal">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </li>
                                @endcan
                                @can('Editar galeria de carrucel')
                                    <li>
                                        <a href="{{route('admin_slider.edit',$item->id)}}" class="btn default btn-outline image-popup-vertical-fit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </li>
                                @endcan
                                @can('Eliminar galeria de carrucel')
                                    <li>
                                        <a href="#" id="idItem-{{$item->id}}" class="btn default btn-outline image-popup-vertical-fit delete-modal">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                    <div class="el-card-content">
                        <h3 class="box-title">{{$item->title}}</h3> <small class="date">{{$item->startdate}}{{ $item->enddate ? ' - '.$item->enddate : '' }}</small>
                        <div class="hide">{{$item->text}}</div>
                        <br/>
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
        $('.show-modal').click(function () {
            let src = $(this).parent().parent().parent().parent().children('img').attr('src');
            let title = $(this).parent().parent().parent().parent().parent().children('.el-card-content').children('.box-title').text();
            let date = $(this).parent().parent().parent().parent().parent().children('.el-card-content').children('.date').text();
            let text = $(this).parent().parent().parent().parent().parent().children('.el-card-content').children('.hide').text();

            Swal.fire({
                title: title,
                text: text,
                footer: date,
                imageUrl: src
            });
        });
        $('.delete-modal').click(function (e) {
            e.preventDefault();
            let id = this.id.split('-')[this.id.split('-').length - 1];
            Swal.fire({
                title: '¿Está seguro?',
                text: "¡Si elimina la imagen no prodrás revertirlo!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    var jqxhr = $.post('/admin/carrucel/'+id, function name(data) {
                        $('#idItem-'+id).parent().parent().parent().parent().parent().parent().parent().remove();
                        Swal.fire(
                            'Eliminado!',
                            'El post ha sido eliminado',
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
