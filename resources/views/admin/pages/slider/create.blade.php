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
                <li class="breadcrumb-item">Carusel</li>
                <li class="breadcrumb-item active">Crear post</li>

            </ol>
        </div>
    </div>
</div>
<form action="{{route('admin_slider.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-md-12">
        <h4 class="card-title">Crear post</h4>
        <h6 class="card-subtitle m-b-20 text-muted">Aquí puedes crear y programar post para el carrusel de entrada de la página</h6>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Imagen</h4>
                <label for="input-file-now">En sugerencia subir una imagen con las dimenciones de 1100*500</label>
                <input type="file" name="file" id="input-file-now" class="dropify" accept="image/*" />
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="text">Texto</label>
                    <textarea name="text" id="text" cols="30" rows="2" class="form-control">{{old('text')}}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="startdate">Fecha de publicación</label>
                            <input type="datetime-local" name="startdate" id="startdate" value="{{old('startdate')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="enddate">Fecha de terminación</label>
                            <input type="datetime-local" name="enddate" id="enddate" value="{{old('enddate')}}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('eliteadmin/assets/node_modules/dropify/dist/css/dropify.min.css')}}">
@endsection

@section('js')
    <script src="{{asset('eliteadmin/assets/node_modules/dropify/dist/js/dropify.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify({
                messages: {
                    default: 'arrastre y suelte un archivo aquí o haga clic',
                    replace: 'Arrastra y suelta o haz clic para reemplazar ',
                    remove: 'Eliminar',
                    error: 'Vaya, se agregó algo incorrecto.'
                }
            });
        });
    </script>
@endsection