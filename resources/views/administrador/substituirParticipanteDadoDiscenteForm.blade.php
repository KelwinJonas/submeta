<form method="POST" id="SubParticForm" action="{{route('trabalho.infoTrocaParticipante')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="editalId" value="{{$edital->id}}">
    <input type="hidden" name="participanteId" value="{{$participante->id}}">
    <input type="hidden" name="projetoId" value="{{$projeto->id}}">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3" hidden>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="check" id="apenasPlano{{$participante->id}}" name="substituirApenasPlanoCheck" onchange="substituirApenasPlano(this)">
                <label class="form-check-label" for="apenasPlano{{$participante->id}}">
                    Substituir apenas o plano de trabalho
                </label>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <h5>Dados do discente</h5>
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Nome completo'])
                <input type="text" class="form-control " @value="" name="name" placeholder="Nome Completo" maxlength="150" id="nome{{$participante->id}}" required />
                <span style="color: red; font-size: 12px" id="caracsRestantesnome{{$participante->id}}">
                </span>
                @error("name")
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'E-mail'])
                <input type="email" class="form-control" value="" name="email" placeholder="E-mail" maxlength="150" id="email{{$participante->id}}" required />
                <span style="color: red; font-size: 12px" id="caracsRestantesemail{{$participante->id}}">
                </span>
                @error('email')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Data de nascimento'])
                <input type="date" class="form-control" value="" name="data_de_nascimento" placeholder="Data de nascimento" id="nascimento{{$participante->id}}" required />
                @error('data_de_nascimento')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>

            <div class="col-6 {{ $errors->has('cpf') ? ' has-error' : '' }}">
                @component('componentes.input', ['label' => 'CPF'])
                    <input type="text" class="form-control cpf @error('cpf') is-invalid @enderror" value=""
                           onchange="checarCPFdoCampo(this)"
                           name="cpf" placeholder="CPF" id="cpf{{$participante->id}}" required autofocus autocomplete="cpf"/>

                    @error('cpf')
                    <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'RG'])
                <input type="text" class="form-control rg" value="" name="rg" placeholder="RG" id="rg{{$participante->id}}" required />
                @error('rg')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Celular'])
                <input type="tel" class="form-control celular" value="" name="celular" placeholder="Celular" id="celular{{$participante->id}}" required />
                @error('celular')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Data de Entrada'])
                    <input type="date" class="form-control" value="" name="data_entrada" placeholder="Data de Entrada" id="dt_entrada{{$participante->id}}" required />
                    @error('data_entrada')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                @endcomponent
            </div>
            <div class="form-group col-md-6">
                @component('componentes.input', ['label' => 'Link do currículo Lattes'])
                <input class="form-control @error('linkLattes') is-invalid @enderror" type="text" name="linkLattes" placeholder="Link do currículo Lattes do estudante" id="linkLattes{{$participante->id}}" required >
                <small>Ex.: http://lattes.cnpq.br/8363536830656923</small>
                @error('linkLattes')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>

            <div class="col-md-12">
                <h5>Endereço</h5>
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'CEP'])
                <input type="text" class="form-control cep" value="" name="cep" placeholder="CEP" id="cep{{$participante->id}}" required />
                @error('cep')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.select', ['label' => 'Estado'])
                <select name="uf" class="form-control" style="visibility: visible" id="estado{{$participante->id}}" required>
                    <option value="" selected>-- Selecione uma opção --</option>
                    @foreach ($estados as $sigla => $nome)
                    <option value="{{ $sigla }}">{{ $nome }}</option>
                    @endforeach
                </select>
                @error('uf')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>

            <div class="col-6">
                @component('componentes.input', ['label' => 'Cidade'])
                <input type="text" class="form-control" value="" name="cidade" placeholder="Cidade" maxlength="50" id="cidade{{$participante->id}}" required />
                <span style="color: red; font-size: 12px" id="caracsRestantescidade{{$participante->id}}">
                </span>
                @error('cidade')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Bairro'])
                <input type="text" class="form-control" value="" name="bairro" placeholder="Bairro" maxlength="50" id="bairro{{$participante->id}}" required />
                <span style="color: red; font-size: 12px" id="caracsRestantesbairro{{$participante->id}}">
                </span>
                @error('bairro')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Rua'])
                <input type="text" class="form-control" value="" name="rua" placeholder="Rua" maxlength="100" id="rua{{$participante->id}}" required />
                <span style="color: red; font-size: 12px" id="caracsRestantesrua{{$participante->id}}">
                </span>
                @error('rua')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Número'])
                <input type="text" class="form-control" value="" name="numero" placeholder="Número" id="numero{{$participante->id}}" required />
                @error('numero')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class=" control-label" for="firstname">Complemento</label>
                    <input type="text" class="form-control" value="" name="complemento" placeholder="Complemento" maxlength="75" id="complemento{{$participante->id}}" />
                    <span style="color: red; font-size: 12px" id="caracsRestantescomplemento{{$participante->id}}">
                    </span>
                    @error('complemento')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <h5>Dados do curso</h5>
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Instituição de Ensino'])
                <select style="display: inline" onchange="showInstituicao(this)" class="form-control" name="instituicao" id="instituicao[{{$participante->id}}]" required>
                    <option value="" disabled selected hidden>-- Instituição --</option>
                    <option value="UFAPE">Universidade Federal do Agreste de Pernambuco - UFAPE</option>
                    <option value="Outra">Outra</option>
                </select>
                @error('instituicao')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6" id="displayinstituicao[{{$participante->id}}]" style='display:none'>
                @component('componentes.input', ['label' => 'Digite a Instituição'])
                <input id="outrainstituicao[{{$participante->id}}]" type="text" class="form-control @error('instituicao') is-invalid @enderror" name="outrainstituicao" value="" placeholder="Digite o nome da Instituição" autocomplete="instituicao" autofocus>
                @error('outrainstituicao')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>

            <div class="col-6">
                @component('componentes.input', ['label' => 'Curso'])
                <select style="display: inline" class="form-control" name="curso" onchange="showCurso(this)" id="curso[{{$participante->id}}]" required>
                    <option value="" disabled selected hidden>-- Selecione uma opção--</option>
                    <option value="Bacharelado em Agronomia">Bacharelado em Agronomia</option>
                    <option value="Bacharelado em Ciência da Computação">Bacharelado em Ciência da Computação</option>
                    <option value="Bacharelado em Engenharia de Alimentos">Bacharelado em Engenharia de Alimentos</option>
                    <option value="Bacharelado em Medicina Veterinária">Bacharelado em Medicina Veterinária</option>
                    <option value="Bacharelado em Zootecnia">Bacharelado em Zootecnia</option>
                    <option value="Licenciatura em Letras">Licenciatura em Letras</option>
                    <option value="Licenciatura em Pedagogia">Licenciatura em Pedagogia</option>
                    <option value="Outro">Outro</option>
                </select>
                @error('curso')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6" id="displaycurso[{{$participante->id}}]" style='display:none'>
                @component('componentes.input', ['label' => 'Digite o nome do curso'])
                <input id="outrocurso[{{$participante->id}}]" type="text" class="form-control" name="outrocurso" value="" placeholder="Digite o nome do curso" autocomplete="curso" autofocus>
                @error('outrocurso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>

            <div class="col-6">
                @component('componentes.select', ['label' => 'Turno'])
                <select name="turno" class="form-control" id="turno{{$participante->id}}" required>
                    <option value="" selected>-- Selecione uma opção --</option>
                    @foreach ($enum_turno as $key => $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('turno')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            @php
            $options = array('3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7,'8' => 8,'9' => 9,'10' => 10,'11' => 11,'12' => 12);
            @endphp
            <div class="col-6">
                @component('componentes.select', ['label' => 'Total de períodos/anos do curso'])
                <select name="total_periodos" class="form-control" onchange="gerarPeriodo(this)" id="periodosTotal{{$participante->id}}" required>
                    <option value="" selected>-- Selecione uma opção --</option>
                    @foreach ($options as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('total_periodos')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>

            <div class="col-6">
                @component('componentes.select', ['label' => 'Período/Ano atual'])
                <select name="periodo_atual" class="form-control" id="periodo{{$participante->id}}" required>
                    <option value="" selected>-- Selecione uma opção --</option>

                </select>
                @error('periodo_atual')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>

            <div class="col-6">
                @component('componentes.select', ['label' => 'Ordem de prioridade'])
                <select name="ordem_prioridade" class="form-control" id="ordem{{$participante->id}}" required>
                    <option value="" selected>-- ORDEM --</option>
                    @for($j = 1; $j <= 3; $j++) <option value="{{ $j }}">{{ $j }}</option>
                        @endfor

                </select>
                @error('ordem_prioridade')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Coeficiente de rendimento (média geral)'])
                <input type="number" class="form-control media" value="" name="media_do_curso" min="0" max="10" step="0.01" id="media{{$participante->id}}" required>
                @error('media_do_curso')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>

            <div class="col-md-12">
                <h5>Documentação Complementar</h5>
            </div>

            <div class="col-6">
                @component('componentes.input', ['label' => 'Termo de Compromisso (.pdf)'])
                <input type="file" class="input-group-text pdf" value="" name="anexoTermoCompromisso" accept=".pdf" placeholder="Anexo do Termo de Compromisso" id="anexoTermoCompromisso{{$participante->id}}" required />
                @error('anexoTermoCompromisso')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Comprovante de Matrícula (.pdf)'])
                <input type="file" class="input-group-text pdf" value="" name="anexoComprovanteMatricula" accept=".pdf" placeholder="Anexo do Comprovante de Matrícula" id="anexoComprovanteMatricula{{$participante->id}}" required />
                @error('anexoComprovanteMatrícula')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                @component('componentes.input', ['label' => 'Currículo Lattes (.pdf)'])
                <input type="file" class="input-group-text pdf" value="" name="anexoCurriculoLattes" accept=".pdf" placeholder="Anexo do Currículo Lattes" id="anexoCurriculoLattes{{$participante->id}}" required />
                @error('anexoCurriculoLattes')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6">
                <label class="control-label">Autorização dos Pais (.pdf)</label>
                <input type="file" class="input-group-text pdf" value="" name="anexoAutorizacaoPais" accept=".pdf" placeholder="Anexo da Autorização dos Pais" id="anexoAutorizacaoPais{{$participante->id}}" />
                @error('anexoAutorizacaoPais')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span style="font-size:small">Anexo obrigatório para discentes menores de 18 anos</span>
            </div>
            <div class="col-6">
                <label class="control-label">Comprovante Bancário (.pdf, .jpg, .jpeg, .png)</label>
                <input type="file" class="input-group-text" value="" name="anexoComprovanteBancario" accept=".jpeg,.jpg,.png,.pdf" placeholder="Anexo do Comprovante Bancário" id="anexoComprovanteBancario{{$participante->id}}"/>
                <small>Anexo obrigatório para bolsistas, mas não obrigatório para voluntários</small>
                @error('anexoComprovanteBancario')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div hidden>
            <div class="col-12 mb-3 mt-3">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="check" id="{{$participante->id}}" name="manterPlanoCheck" checked>
                <label class="form-check-label" for="{{$participante->id}}">
                    Manter o plano de trabalho
                </label>
                </div>
            </div>

            <div class="col-md-12" >
                <h5>Plano de trabalho</h5>
            </div>
            <div class="col-12" id="arqParticipante" >
                @component('componentes.input', ['label' => 'Título'])
                <input type="text" class="form-control" value="" name="nomeDiscentePlanoTrabalho" placeholder="Digite o título do plano de trabalho" maxlength="255" id="nomeDiscentePlanoTrabalho{{$participante->id}}" disabled>
                <span style="color: red; font-size: 12px" id="caracsRestantesnomePlanoTrabalho{{$participante->id}}">
                </span>
                @error('nomeDiscentePlanoTrabalho')
                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endcomponent
            </div>
            <div class="col-6" id="arqDiscenteAtual" >
                @component('componentes.input', ['label' => 'Anexo (.pdf)'])
                    <a href="" id="arquivo{{$participante->id}}" style="padding-left: 20px"><i class="fas fa-file-pdf fa-2x"></i></a>
                @endcomponent
            </div>
            </div>

            <h1 id="teste"></h1>
            <div class="col-md-12">
                <h5>Observações</h5>
            </div>
            <div class="col-12">
                <textarea class="form-control" id="observacaoTextArea" rows="3" name="textObservacao" ></textarea>
            </div>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-success" id="idButtonSubmitParticipante">Salvar</button>

            </div>

        </div>
    </div>
</form>