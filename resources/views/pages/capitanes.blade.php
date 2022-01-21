@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row justify-content-center">
            <div class=" col ">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0 text-center"><b>AGREGAR CAPITANES</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="row icon-examples">
                            
                          <form action="{{ route('capitanes.store') }}" method="POST" name="formulariol" id="formulariol">
                            @csrf
                            <!-- Datos Basicos Referido -->
                            <h3 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                              Datos Básicos
                            </h3>
                
                            <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    
                                    <label for="nombre">Cédula</label>
                                    <input class="form-control" type="number" name="cedula" id="cedula" value="{{ old('cedula',"") }}" required/>
                                    @error('cedula')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">
                                    <label for="nombres">Nombres y Apellidos</label>
                                    <input class="form-control" type="text" name="nombres" id="nombres" value="{{ old('nombres',"") }}"  required/>
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
                                    <input class="form-control" type="text" name="depvot" id="depvot" value="{{ old('depvot',"") }}"  required/>
                                    @error('depvot')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="munvot">Municipio Votación</label>
                                    <input class="form-control" type="text" name="munvot" id="munvot" value="{{ old('munvot',"") }}"  required/>
                                    @error('munvot')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="lugvot">Lugar Votación</label>
                                    <input class="form-control" type="text" name="lugvot" id="lugvot" value="{{ old('lugvot',"") }}"  required/>
                                    @error('lugvot')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="cedula">Mesa de Votación</label>
                                    <input class="form-control" type="text" name="mesvot" id="mesvot" value="{{ old('mesvot',"") }}" required/>
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
                                    value="{{ old('celular',"") }}"  required/>
                                    @error('celular')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="munres">Municipio</label>
                                    <input class="form-control" type="text" name="municipio" id="municipio"  
                                    value="{{ old('municipio',"") }}" required/>
                                    @error('municipio')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="comuna">Comuna</label>
                                    <select class="form-control" id="comuna" name="comuna" required>
                                      <option value="">Seleccione...</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                    @error('comuna')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="barrio">Barrio</label>
                                    <input class="form-control" type="text" name="barrio" id="barrio" value="{{ old('barrio',"") }}" required/>
                                    @error('barrio')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="direccion">Direccion</label>
                                    <input class="form-control" type="text" name="direccion" id="direccion"  value="{{ old('direccion',"") }}"required/>
                                    @error('direccion')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="text" name="email" id="email" 
                                    value="{{ old('email',"") }}"  required/>
                                    @error('email')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="fecnac">Fecha de Nacimiento</label>
                                    <input class="form-control" type="date" name="fecnac" id="fecnac" 
                                    value="{{ old('fecnac',"") }}" required>
                                    @error('fecnac')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="genero">Genero</label>
                                    <select class="form-control" id="genero" name="genero"  required>
                                      
                                      <option {{ (old('genero','') == 'F' )?'selected':'' }} value="F">Femenino</option>
                                      <option {{ (old('genero','') == 'M' )?'selected':'' }} value="M">Masculino</option>
                                      <option {{ (old('genero','') == 'I' )?'selected':'' }} value="I">Indefinido</option>
                                    </select>
                                    @error('genero')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="poblacion">Población</label>
                                    <input class="form-control" type="text" name="poblacion" id="poblacion" value="{{ old('poblacion',"") }}" />
                                    @error('poblacion')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="ocupacion">Ocupación</label>
                                    <input class="form-control" type="text" name="ocupacion" id="ocupacion" value="{{ old('ocupacion',"") }}" required/>
                                    @error('ocupacion')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="profesion">Profesión</label>
                                    <input class="form-control" type="text" name="profesion" id="profesion" value="{{ old('profesion',"") }}" required/>
                                    @error('profesion')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">
                                    <label for="aporte">Aporte</label>
                                    <div class="form-group">
                                      <textarea class="form-control" id="aporte" name="aporte" rows="2" placeholder="Escriba los aportes del referido">{{ old('fecnac',"") }}</textarea>
                                      @error('aporte')
                                      <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                    </div>
                                  </div>
                                </div>
                
                              </div>
                
                              <div class="col-md-12 mt-2">
                                <label class="flex items-center dark:text-gray-400">
                                  <input type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required/>
                                  <span class="ml-2">
                                    Acepta
                                    <span class="underline">
                                      tratamiento de datos personales
                                    </span>
                                  </span>
                                </label>
                              </div>
                
                              <div class="col-md-12 mt-4 text-center">
                
                                <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Enviar">
                
                              </div>
                               
                
                
                        </div>
                
                        </form>
                            
                            
                            
                        </div> <!--  End Row -->
                    </div>
                </div><!--  End Card -->
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footers.auth')
    </div><!-- fin content -->

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
