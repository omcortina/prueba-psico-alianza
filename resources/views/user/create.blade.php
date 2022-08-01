<title>Usuarios</title>
@extends('layouts.index')

@section('breadcumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Usuarios</h3>
    </div>
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(array('method' => 'POST', 'id' => 'frmCreate')) !!}
                    @if (session('message_error_user_create'))
                        <div id="msg" class="alert alert-danger" >
                            <li>{{session('message_error_user_create')}}</li>
                        </div>
                        <script>
                            setTimeout(function(){ $('#msg').fadeOut() }, 4000);
                        </script>
                    @endif
                    <h4 class="card-title"><b>Formulario de registro</b></h4>
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" class="form-control" name="first_name" id="first_name">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" name="last_name" id="last_name">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Identificación</label>
                                <input type="text" class="form-control" name="identification" id="identification">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" name="phone" id="phone">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Departamento</label>
                                <select onchange="searchCity(this.value)" name="id_deparment" id="select_deparment" class="form-control">
                                    <option value="">...</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Ciudad</label>
                                <input type="hidden" name="city" id="city">
                                <select name="id_city" id="select_city" class="form-control">
                                    <option value="">...</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label><b>Cargos</b></label>
                                @foreach ($chargues as $item)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="chargues[]" value="{{ $item->id }}" type="checkbox" value="" id="chargue_{{ $item->id }}">
                                        <label class="form-check-label" for="chargue_{{ $item->id }}">
                                        {{ $item->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <button onclick="create()" style="width: 100%;" type="button" class="btn btn-primary">Registrar</button>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var departments = [];
        var cities = [];
        var chargues = [] 
        $( document ).ready(function() {
            getDepartments()

            @foreach($chargues as $item)
                chargues.push({
                    id: {{ $item->id }},
                    name: '{{ $item->name }}'
                })
            @endforeach
        });

        function getDepartments(){
            $.get('https://www.datos.gov.co/resource/xdk5-pm3f.json', (response) => {
                this.cities = response
                let array_list = []
                response.forEach((item) => {
                    array_list.push({
                        id: parseInt(item.c_digo_dane_del_departamento),
                        name: item.departamento
                    })
                })

                this.departments = removeDuplicates(array_list, "name")

                let option = "<option>Seleccione...</option>"
                this.departments.forEach((item) => {
                    option += `<option value="${item.id}">${item.name}</option>`
                })
                $("#select_deparment").html(option)
            })
        }

        function removeDuplicates(originalArray, prop) {
            var newArray = [];
            var lookupObject  = {};

            for(var i in originalArray) {
                lookupObject[originalArray[i][prop]] = originalArray[i];
            }

            for(i in lookupObject) {
                newArray.push(lookupObject[i]);
            }
            return newArray;
        }

        function searchCity(id_deparment){
            let resultArray = this.cities.filter(item => parseInt(item.c_digo_dane_del_departamento) == id_deparment)
            let option = "<option value=''>Seleccione...</option>"
            resultArray.forEach((item) => {
                option += `<option value="${item.c_digo_dane_del_municipio}">${item.municipio}</option>`
            })
            $("#select_city").html(option)
        }

        function create(){
            let first_name = $("#first_name").val()
            let last_name = $("#last_name").val()
            let identification = $("#identification").val()
            let phone = $("#phone").val()
            let address = $("#address").val()
            let id_deparment = $("#select_deparment").val()
            let id_city = $("#select_city").val()
            
            if(first_name == "" || last_name == "" || identification == "" || phone == "" || address == "" || id_deparment == "" || id_city == ""){
                tata.error('PsicoAlianza', 'Todos los campos son obligatorios', {
                    duration: 2000
                })
                return false
            }

            let contador = 0
            this.chargues.forEach((item) => {
                if($('#chargue_'+item.id)[0].checked){
                    contador++
                }
            })

            if(contador == 0){
                tata.error('PsicoAlianza', 'No hay cargos seleccionados', {
                    duration: 2000
                })
                return false
            }

            let city = this.cities.find(item => item.c_digo_dane_del_municipio == id_city)
            $("#city").val(city.municipio)
            $("#frmCreate").submit()
        }
    </script>
@endsection
