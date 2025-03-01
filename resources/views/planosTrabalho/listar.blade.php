@extends('layouts.app')

@section('content')

<div class="container">
	@if (session('sucesso'))
		<div class="alert alert-success" role="alert">
			{{ session('sucesso') }}
		</div>
	@endif

    <div class="row justify-content-center titulo-menu mb-0">
		<h4>Planos de Trabalho </h4>
	</div>
	<div class="card-body" style="width: 75% !important;margin: auto;">
			<table class="table table-bordered table-hover" style="display: block; overflow-x: visible; white-space: nowrap; border-radius:10px; margin-bottom:0px">

                <thead>
                    <tr>
						<th scope="col" style="width:200px; text-align: center;">Título</th>
						<th scope="col" style="width:200px; text-align: center;">Discente</th>
                        <th scope="col" style="width:200px; text-align: center;">Relatório Parcial</th>
                        <th scope="col" style="width:200px; text-align: center;">Relatório Final</th>
                    </tr>
				</thead>

					@foreach($arquivos as $arquivo)
                        <tbody>

						<td style="text-align: center;" title="{{$arquivo->titulo}}">{{$arquivo->titulo}}</td>
						<td style="text-align: center;" title="{{$arquivo->participante->user->name}}">{{$arquivo->participante->user->name}}</td>
						<td style="text-align: center;">
							@if((Auth::user()->proponentes != null) && ($arquivo->relatorioParcial == null) &&
 								($arquivo->trabalho->evento->dt_inicioRelatorioParcial <= $hoje) && ($hoje <= $arquivo->trabalho->evento->dt_fimRelatorioParcial))
								<!-- Button trigger modal -->
								<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#modalRelatorioParcial{{ $arquivo->id }}">
									Enviar
								</button>
							@else
								<!-- Button trigger modal -->
								<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#modalRelatorioParcial{{ $arquivo->id }}">
									@if($arquivo->relatorioParcial!=null)Visualizar @else Pendente @endif
								</button>
							@endif
						</td>

						<td style="text-align: center;">
							@if((Auth::user()->proponentes != null) && ($arquivo->relatorioFinal == null) &&
								 ($arquivo->trabalho->evento->dt_inicioRelatorioFinal <= $hoje) && ($hoje <= $arquivo->trabalho->evento->dt_fimRelatorioFinal))
								<!-- Button trigger modal -->
									<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#modalRelatorioFinal{{ $arquivo->id }}">
										Enviar
									</button>
							@else
								<!-- Button trigger modal -->
									<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#modalRelatorioFinal{{ $arquivo->id }}">
										@if($arquivo->relatorioFinal!=null)Visualizar @else Pendente @endif
									</button>
								@endif
						</td>

						<!-- Modal Relatorio Parcial-->
						<div class="modal fade" id="modalRelatorioParcial{{ $arquivo->id }}" tabindex="-1" role="dialog" aria-labelledby="modalRelatorioParcialLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Relatório Parcial (.pdf)</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="dt_inicioRelatorioParcial" class="col-form-label">{{ __('Início do Relatório Parcial:') }}</label>
                                                <input id="dt_inicioRelatorioParcial" type="date" class="form-control" name="dt_inicioRelatorioParcial" value="{{$arquivo->trabalho->evento->dt_inicioRelatorioParcial}}" required autocomplete="dt_inicioRelatorioParcial" disabled autofocus>

                                            </div>
                                            <div class="col-6">
                                                <label for="dt_fimRelatorioParcial" class="col-form-label">{{ __('Fim do Relatório Parcial:') }}</label>
                                                <input id="dt_fimRelatorioParcial" type="date" class="form-control" name="dt_fimRelatorioParcial" value="{{$arquivo->trabalho->evento->dt_fimRelatorioParcial}}" required autocomplete="dt_fimRelatorioParcial" disabled autofocus>

                                            </div>
                                        </div>
                                    </div>
                                    <br>
									<form id="formRelatParcial" method="post" action="{{route('planos.anexar.relatorio')}}" enctype="multipart/form-data">
										@csrf
										<input type="hidden" value="{{ $arquivo->id }}" name="arqId">
										<input type="hidden" value="{{ $arquivo->trabalhoId }}" name="projId">
										<div class="col-12">
											<div class="row">
												@if($arquivo->relatorioParcial)
													<div class="col-sm-2">Arquivo: </div>
													<div class="col-sm-1">
														<a href="{{ route('baixar.documentosParticipante', ['pathDocumento' => $arquivo->relatorioParcial]) }}"><i class="fas fa-file-pdf fa-2x"></i></a>
													</div>
												@else
													<label class="control-label col-6">Nenhum arquivo carregado</label>
												@endif
											</div>
											<br>

                                            @if((Auth::user()->proponentes != null) &&
                                                ($arquivo->trabalho->evento->dt_inicioRelatorioParcial <= $hoje) && ($hoje <= $arquivo->trabalho->evento->dt_fimRelatorioParcial))
												<input type="file" class="input-group-text" value="" name="relatorioParcial" accept=".pdf" placeholder="Relatorio Parcial" id="relatorioParcial{{$arquivo->id}}" required/>
												@error('relatorioParcial')
													<span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											@endif
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            @if((Auth::user()->proponentes != null) &&
                                                ($arquivo->trabalho->evento->dt_inicioRelatorioParcial <= $hoje) && ($hoje <= $arquivo->trabalho->evento->dt_fimRelatorioParcial))
												<button type="submit" class="btn btn-success">Salvar</button>
											@endif
										</div>

									</form>
								</div>
							</div>
						</div>

						<!-- Modal Relatorio Final-->
						<div class="modal fade" id="modalRelatorioFinal{{ $arquivo->id }}" tabindex="-1" role="dialog" aria-labelledby="modalRelatorioFinalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Relatório Final (.pdf)</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="dt_inicioRelatorioFinal" class="col-form-label">{{ __('Início do Relatório Final:') }}</label>
                                                <input id="dt_inicioRelatorioFinal" type="date" class="form-control" name="dt_inicioRelatorioFinal" value="{{$arquivo->trabalho->evento->dt_inicioRelatorioFinal}}" required autocomplete="dt_inicioRelatorioFinal" disabled autofocus>

                                            </div>
                                            <div class="col-6">
                                                <label for="dt_fimRelatorioFinal" class="col-form-label">{{ __('Fim do Relatório Final:') }}</label>
                                                <input id="dt_fimRelatorioFinal" type="date" class="form-control" name="dt_fimRelatorioFinal" value="{{$arquivo->trabalho->evento->dt_fimRelatorioFinal}}" required autocomplete="dt_fimRelatorioFinal" disabled autofocus>

                                            </div>
                                        </div>
                                    </div>
                                    <br>
									<form id="formRelatFinal" method="post" action="{{route('planos.anexar.relatorio')}}" enctype="multipart/form-data">
										@csrf
										<input type="hidden" value="{{ $arquivo->id }}" name="arqId">
										<input type="hidden" value="{{ $arquivo->trabalhoId }}" name="projId">
										<div class="col-12">
											<div class="row">
												@if($arquivo->relatorioFinal)
													<div class="col-sm-2">Arquivo: </div>
													<div class="col-sm-1">
														<a href="{{ route('baixar.documentosParticipante', ['pathDocumento' => $arquivo->relatorioFinal]) }}"><i class="fas fa-file-pdf fa-2x"></i></a>
													</div>
												@else
													<label class="control-label col-6">Nenhum arquivo carregado</label>
												@endif
											</div>
											<br>
                                            @if((Auth::user()->proponentes != null) &&
                                                ($arquivo->trabalho->evento->dt_inicioRelatorioFinal <= $hoje) && ($hoje <= $arquivo->trabalho->evento->dt_fimRelatorioFinal))
												<input type="file" class="input-group-text" value="" name="relatorioFinal" accept=".pdf" placeholder="Relatorio Final" id="relatorioFinal{{$arquivo->id}}" required/>
												@error('relatorioFinal')
												<span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											@endif
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            @if((Auth::user()->proponentes != null) &&
                                                ($arquivo->trabalho->evento->dt_inicioRelatorioFinal <= $hoje) && ($hoje <= $arquivo->trabalho->evento->dt_fimRelatorioFinal))
												<button type="submit" class="btn btn-success">Salvar</button>
											@endif
										</div>

									</form>
								</div>
							</div>
						</div>
                        </tbody>
					@endforeach

			</table>
	</div>
</div>

	<style>
		td {
			max-width: 25ch;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}
	</style>


@endsection
