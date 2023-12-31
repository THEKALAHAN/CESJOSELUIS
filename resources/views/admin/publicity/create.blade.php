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
                <li class="breadcrumb-item">Administración de espacios publicitarios</li>
                <li class="breadcrumb-item active">Crear</li>
            </ol>
        </div>
    </div>
</div>
<form action="{{route('admin.publicity_place.store')}}" method="post" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-md-12">
        <div class="card-title">Crear espacio publicitario</div>
        <h6 class="card-subtitle">Todos los campos con * son obligatorios</h6>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Avatar</h4>
                <label for="input-file-now">En sugerencia subir una imagen con las dimenciones de 2:2 y fondo blanco</label>
                <input type="file" name="file" id="input-file-now" class="dropify" accept="image/*" />
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ubications">Ubicaciones *</label>
                            <input type="text" name="ubications" id="ubications" value="{{old('ubications')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Título *</label>
                            <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="value">Valor *</label>
                            <input type="text" name="value" id="value" value="{{old('value')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="publish">
                                <input type="checkbox" name="publish" id="publish" value="1" {{ old('publish') ? 'checked' : '' }}>
                                Pagina de espacios publicitarios
                            </label>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="description">Descripción *</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{old('description')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-primary">Guardar</button>
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