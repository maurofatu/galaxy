@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link href="/argon/css/style.css" rel="stylesheet" />


@include('layouts.headers.cards')

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class=" col ">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0 text-center"><b>CONSULTAS</b></h3>
                </div>
                <div class="card-body">
                    <div class="row icon-examples">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jugadores">Nombre de Jugadores</label>
                                <select class="form-control js-example-basic-single" id="jugadores" name="jugadores"
                                    onchange="infojugador(event)" required>
                                    <option value="" selected>Seleccione...</option>
                                    @foreach ($data['jugadoreslist'] as $iitem)
                                    <option value="{{ $iitem->cedula }}"> {{ $iitem->nombres }} </option>
                                    @endforeach
                                </select>
                                @error('jugadores')
                                <small style="color: #FF0000"> {{ $message }} </small>
                                @enderror
                            </div>
                        </div>

                    </div> <!--  End Row -->
                </div>
            </div><!--  End Card -->
        </div>
    </div>

    <!--  FORMULARIO EDITAR>  -->

    <form action="{{ route('jugadores.editarjugador') }}" method="POST" name="formulario" id="formulario">
        @csrf
        @method('PUT')
        <!-- Datos Basicos Referido -->
        <h3 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Datos Básicos
        </h3>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">

                    <label for="nombre">Cédula</label>
                    <input class="form-control" type="number" name="cedula" id="cedula" value="{{ old('cedula', '') }}"
                        readonly required />
                    @error('cedula')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nombres">Nombres y Apellidos</label>
                    <input class="form-control" type="text" name="nombres" id="nombres" value="{{ old('nombres', '') }}"
                        required />
                    @error('nombres')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Datos Votacion Referido -->
        <h3 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Datos Votación
        </h3>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="depvot">Departamento Votación</label>
                    <input class="form-control" type="text" name="depvot" id="depvot" value="{{ old('depvot', '') }}"
                        required />
                    @error('depvot')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="munvot">Municipio Votación</label>
                    <input class="form-control" type="text" name="munvot" id="munvot" value="{{ old('munvot', '') }}"
                        required />
                    @error('munvot')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="lugvot">Lugar Votación</label>
                    <input class="form-control" type="text" name="lugvot" id="lugvot" value="{{ old('lugvot', '') }}"
                        required />
                    @error('lugvot')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cedula">Mesa de Votación</label>
                    <input class="form-control" type="text" name="mesvot" id="mesvot" value="{{ old('mesvot', '') }}"
                        required />
                    @error('mesvot')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
        </div>


        <h3 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Datos Complementarios
        </h3>

        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input class="form-control" type="number" name="celular" id="celular"
                        value="{{ old('celular', '') }}" required />
                    @error('celular')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="whatsapp">Whatsapp</label>
                    <input class="form-control" type="number" name="whatsapp" id="whatsapp" onKeyPress="if(this.value.length==10) return false;"
                        value="{{ old('whatsapp', '') }}" required />
                    @error('whatsapp')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="municipio">Municipio</label>
                    <select class="form-control js-example-basic-single" id="municipio" name="municipio" onchange="fmunicipio(event)" required>
                        <option value="">Seleccione...</option>
                        @foreach ($data['municipio'] as $mitem)
                        <option value="{{ $mitem->codzon }}"> {{ $mitem->detalle }} </option>
                        @endforeach
                    </select>
                    @error('municipio')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3" id="domcomuna">
                <div class="form-group">
                    <label for="comuna">Comuna</label>
                    <select class="form-control js-example-basic-single" id="comuna" name="comuna" onchange="fcomuna(event)" required>
                        <option value="">Seleccione...</option>
                        @foreach ($data['comuna'] as $fitem)
                        <option value="{{ $fitem->comuna }}"> {{ $fitem->detalle }} </option>
                        @endforeach
                    </select>
                    @error('comuna')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3" id="domcomuna2">
                <div class="form-group" id="domcomuna">
                    <label for="comuna2">Comuna</label>
                    <input class="form-control" type="text" name="comuna2" id="comuna2" value="{{ old('comuna2', '') }}"
                        required />
                    @error('comuna2')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3" id="dombarrio">
                <div class="form-group">
                    <label for="barrio">Barrio</label>
                    <select class="form-control js-example-basic-single" id="barrio" name="barrio" required>
                        <option value="">Seleccione...</option>
                    </select>
                    @error('barrio')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3" id="dombarrio2">
                <div class="form-group">
                    <label for="barrio2">Barrio</label>
                    <input class="form-control" type="text" name="barrio2" id="barrio2" value="{{ old('barrio2', '') }}"
                        required />
                    @error('barrio2')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input class="form-control" type="text" name="direccion" id="direccion"
                        value="{{ old('direccion', '') }}" required />
                    @error('direccion')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ old('email', '') }}"
                        required />
                    @error('email')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fecnac">Fecha de Nacimiento</label>
                    <input class="form-control" type="date" name="fecnac" id="fecnac" value="{{ old('fecnac', '') }}"
                        required>
                    @error('fecnac')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="genero">Genero</label>
                    <select class="form-control" id="genero" name="genero" required>

                        <option {{ old('genero', '' )=='F' ? 'selected' : '' }} value="F">Femenino
                        </option>
                        <option {{ old('genero', '' )=='M' ? 'selected' : '' }} value="M">
                            Masculino</option>
                        <option {{ old('genero', '' )=='I' ? 'selected' : '' }} value="I">
                            Indefinido</option>
                    </select>
                    @error('genero')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="poblacion">Factor de Vulnerabilidad</label>
                    <select class="form-control js-example-basic-single" id="poblacion" name="poblacion" required>
                        <option value="">Seleccione...</option>
                        @foreach ($data['facvul'] as $fitem)
                        <option value="{{ $fitem->facvul }}"> {{ $fitem->detalle }} </option>
                        @endforeach
                    </select>
                    @error('poblacion')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="poblacion">Etnia</label>
                    {{-- <input class="form-control" type="text" name="poblacion" id="poblacion" --}} {{--
                        value="{{ old('poblacion', '') }}" /> --}}
                    <select class="form-control js-example-basic-single" id="etnia" name="etnia" required>
                        <option value="">Seleccione...</option>
                        @foreach ($data['etnia'] as $eitem)
                        <option value="{{ $eitem->etnia }}"> {{ $eitem->detalle }} </option>
                        @endforeach
                    </select>
                    @error('etnia')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nivedu">Nivel Educativo</label>
                    <select class="form-control js-example-basic-single" id="nivedu" name="nivedu" onchange="fpostgrado(event)" required>
                        <option value="">Seleccione...</option>
                        @foreach ($data['nivedu'] as $nitem)
                        <option value="{{ $nitem->nivedu }}"> {{ $nitem->detalle }} </option>
                        @endforeach
                    </select>
                    @error('nivedu')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3" id="divpostgrado">
                <div class="form-group">
                    <label for="postgrado">Titulo Postgrado</label>
                    <input class="form-control" type="text" name="postgrado" id="postgrado" value="{{ old('postgrado', '') }}" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="ocupacion">Ocupación</label>
                    {{-- <input class="form-control" type="text" name="ocupacion" id="ocupacion" --}} {{--
                        value="{{ old('ocupacion', '') }}" required /> --}}
                    <select class="form-control js-example-basic-single" id="ocupacion" name="ocupacion" required>
                        <option value="">Seleccione...</option>
                        @foreach ($data['ocupacion'] as $oitem)
                        <option value="{{ $oitem->codocu }}"> {{ $oitem->detalle }} </option>
                        @endforeach
                    </select>
                    @error('ocupacion')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="profesion">Profesión</label>
                    <select class="form-control js-example-basic-single" id="profesion" name="profesion"  required>
                        <option value="">Seleccione...</option>
                        @foreach ($data['profesion'] as $pitem)
                        <option value="{{ $pitem->profesion }}"> {{ $pitem->detalle }} </option>
                        @endforeach
                    </select>
                    @error('profesion')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="profesion">Vivienda</label>
                    <select class="form-control js-example-basic-single" id="vivienda" name="vivienda" required>
                        <option value="">Seleccione...</option>
                        @foreach ($data['vivienda'] as $vitem)
                        <option value="{{ $vitem->vivienda }}"> {{ $vitem->detalle }} </option>
                        @endforeach
                    </select>
                    @error('vivienda')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Zona</label>
                    <select class="form-control" id="zona" name="zona" required>
                        <option value="">Seleccione...</option>
                        <option value="U">Urbano</option>
                        <option value="R">Rural</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="profesion">Discapacidad</label>
                    <select class="form-control js-example-basic-single" id="tipdis" name="tipdis" required>
                        <option value="">Seleccione...</option>
                        @foreach ($data['discapacidad'] as $vitem)
                        <option value="{{ $vitem->tipdis }}"> {{ $vitem->detalle }} </option>
                        @endforeach
                    </select>
                    @error('tipdis')
                    <small style="color: #FF0000"> {{ $message }} </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Tipo de empleo</label>
                    <select class="form-control" id="empleado" name="empleado" onchange="fempleado(event)" required>
                        <option value="">Seleccione...</option>
                        <option value="F">FORMAL</option>
                        <option value="I">INFORMAL</option>
                        <option value="N">NO TIENE</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3" id="divcargo">
                <div class="form-group">
                    <label for="">Cargo</label>
                    <input class="form-control" type="text" name="cargo" id="cargo" value="{{ old('cargo', '') }}" />
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                    <label for="aporte">Aporte</label>
                    <div class="form-group">
                        <textarea class="form-control" id="aporte" name="aporte" rows="2"
                            placeholder="Escriba los aportes del referido">{{ old('fecnac', '') }}</textarea>
                        @error('aporte')
                        <small style="color: #FF0000"> {{ $message }} </small>
                        @enderror
                    </div>
                </div>
            </div>


        </div>

        <div class="col-md-12 mt-2">
            <label class="flex items-center dark:text-gray-400">
                <input type="checkbox"
                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    required />
                <span class="ml-2">
                    Acepta
                    <span class="underline">
                        tratamiento de datos personales
                    </span>
                </span>
            </label>
        </div>

        <div class="col-md-12 mt-4 text-center">

            <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Editar">

        </div>
    </form>
    <!--  FORMULARIO EDITAR>  -->


    <!-- Footer -->
    @include('layouts.footers.auth')
</div><!-- fin content -->

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('argon') }}/js/function.js"></script>
<script>
    $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $("#divcargo").hide();
            $("#divpostgrado").hide();
        });
</script>
@endpush
