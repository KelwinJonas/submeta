<!-- projeto -->
<div class="col-md-10" style="text-align: center; margin-top:2rem"><h4 style="margin-top: 1rem;">1º Passo</h4></div>
<div class="col-md-10" style="text-align: center;"><h5 style="margin-bottom:1rem;color:#909090">Preencha os campos com as informações do projeto</h5></div>
<div class="col-md-10">
  <div class="card" style="border-radius: 12px">
    
    <div class="card-body">
      <div class="container">
        <div class="form-row mt-3">
          <div class="col-md-12"><h5 style="color: #1492E6; margin-bottom:-0.4rem">Informações do projeto</h5></div>
          <div class="col-md-12" style="margin-bottom: -0.8rem;"><hr style="border-top: 1px solid#1492E6"></div>

          <div class="form-group col-md-12" style="margin-top: 10px">
              <label for="titulo" class="col-form-label">{{ __('Nome do Projeto') }} <span style="color: red; font-weight:bold">*</span></label>
              <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" placeholder="Digite o nome do projeto" value="{{old('titulo') ?? $projeto->titulo}}" autocomplete="titulo" maxlength="255"  >
              <span style="color: red; font-size: 12px" id="caracsRestantestitulo">
              </span>
              @error('titulo')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <div class="form-group col-md-4">
            <label for="grandeArea" class="col-form-label">{{ __('Grande Área') }} <span style="color: red; font-weight:bold">*</span></label>
              <select class="form-control @error('grandeArea') is-invalid @enderror" id="grandeArea" name="grande_area_id" onchange="areas()" >
                <option value="" disabled selected hidden>-- Grande Área --</option>
                @foreach($grandeAreas as $grandeArea)
                  <option @if($projeto->grande_area_id == $grandeArea->id ) selected @endif value="{{$grandeArea->id}}">{{$grandeArea->nome}}</option>
                @endforeach
              </select>
              @error('grande_area_id')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <div class="form-group col-md-4">
            <label for="area" class="col-form-label">{{ __('Área') }} <span style="color: red; font-weight:bold">*</span></label>
              <input type="hidden" id="oldArea" value="{{ old('area') }}" >
              <select class="form-control @error('area') is-invalid @enderror" id="area" name="area_id" onchange="subareas()" >
                @foreach($areas as $area)
                  <option @if($projeto->area_id == $area->id ) selected @endif value="{{$area->id}}">{{$area->nome}}</option>
                @endforeach
              </select>
              @error('area_id')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <div class="form-group col-md-4">
            <label for="subArea" class="col-form-label">{{ __('Subárea') }} </label>
              <input type="hidden" id="oldSubArea" value="{{ old('subArea') }}" >
              <select class="form-control @error('subArea') is-invalid @enderror" id="subArea" name="sub_area_id" >
                <@if ($projeto->subarea != null)
                  @foreach($subAreas as $subarea)
                    <option @if($projeto->sub_area_id == $subarea->id ) selected @endif value="{{$subarea->id}}">{{$subarea->nome}}</option>
                  @endforeach
                @endif
              </select>

              @error('sub_area_id')
              <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          
        </div>
    </div>
    </div>
  </div>
</div>
<!--X projeto X-->