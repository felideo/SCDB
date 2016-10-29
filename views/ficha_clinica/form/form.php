<div class="row-fluid">
    <div class="span12">
        <form method="post"
            id="lazy_view"
            <?php if(isset($this->cadastro)) : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/update/<?php echo $this->cadastro['id_ficha_clinica']; ?>"
            <?php else : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/create"
            <?php endif ?>
        >



            <div class="row">

                 <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Paciente
                        </div>
                        <div class="panel-body">
                            <div class="row-fluid">
                                <div class="form-group span12">
                                    <label>Nome do Paciente</label>
                                    <input class="form-control" value="<?php echo $this->cadastro['nome_paciente']; ?>" disabled >
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="form-group span12">
                                    <label>Nome do Pai</label>
                                   <input class="form-control" value="<?php echo $this->cadastro['nome_pai_paciente']; ?>" disabled >
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="form-group span12">
                                    <label>Nome da Mãe</label>
                                    <input class="form-control" value="<?php echo $this->cadastro['nome_mae_paciente']; ?>" disabled >
                                </div>
                            </div>

                            <div class="row-fluid">
                                <div class="form-group span3" style="position: relative;">
                                    <label>Data de Nascimento</label>
                                    <input class="form-control" class="mascara_data"  value="<?php echo date('d/m/Y', strtotime($this->cadastro['nascimento_paciente'])); ?>" disabled >

                                </div>
                                <div class="form-group span2">
                                    <label>Sexo</label>
                                    <br>
                                    <select disabled >
                                        <option <?php if(isset($this->cadastro) && $this->cadastro['sexo'] == 1 ){echo ' selected ';} ?> value="1">Masculino</option>
                                        <option <?php if(isset($this->cadastro) && $this->cadastro['sexo'] == 0 ){echo ' selected ';} ?> value="0">Feminino</option>
                                    </select>
                                </div>
                                <div class="form-group span7">
                                    <label>Hipótese de Patologia</label>
                                    <input class="form-control somente_letras" value="<?php echo $this->cadastro['patologia_paciente']; ?>" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ZZZ: Contato e endereços somente para admin -->
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Contatos
                        </div>
                        <div class="panel-body">
                            <div class="form-group span4">
                                <label>Telefone</label>
                                <input class="form-control mascara_telefone" value="<?php echo $this->cadastro['contato'][0]['contato']; ?>" disabled >
                            </div>
                            <div class="form-group span4">
                                <label>Celular</label>
                                <input class="form-control mascara_celular" value="<?php echo $this->cadastro['contato'][1]['contato']; ?>" disabled >
                            </div>
                            <div class="form-group span4">
                                <label>Email</label>
                                <input class="form-control" value="<?php echo $this->cadastro['contato'][2]['contato']; ?>" disabled >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ZZZ: Contato e endereços somente para admin -->
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Endereço
                        </div>
                        <div class="panel-body">
                            <div class="row-fluid">
                                <div class="form-group span2">
                                    <label>CEP</label>
                                    <input class="form-control mascara_cep" value="<?php echo $this->cadastro['endereco']['cep']; ?>" disabled >
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="form-group span10">
                                    <label>Rua</label>
                                    <input class="form-control" value="<?php echo $this->cadastro['endereco']['rua']; ?>" disabled >
                                </div>
                                <div class="form-group span2">
                                    <label>Numero</label>
                                    <input class="form-control" value="<?php echo $this->cadastro['endereco']['numero']; ?>" disabled >
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="form-group span12">
                                    <label>Complemento</label>
                                    <input class="form-control" value="<?php echo $this->cadastro['endereco']['complemento']; ?>" disabled >
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="form-group span5">
                                    <label>Bairro</label>
                                    <input class="form-control somente_letras" value="<?php echo $this->cadastro['endereco']['bairro']; ?>" disabled >
                                </div>
                                <div class="form-group span5">
                                    <label>Cidade</label>
                                    <input class="form-control somente_letras" value="<?php echo $this->cadastro['endereco']['cidade']; ?>" disabled >
                                </div>
                                <div class="form-group span2">
                                    <label>UF</label>
                                    <input class="form-control somente_letras" value="<?php echo $this->cadastro['endereco']['uf']; ?>" disabled >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Descrição do Caso
                        </div>
                        <div class="panel-body">
                            <div class="row-fluid marginB10">
                                <textarea class="form-control" rows="3" disabled ><?php echo $this->cadastro['paciente_descricao']; ?><?php echo $this->cadastro['paciente_descricao']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>














                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Encefalopatia Crônica Infantil não Progressiva
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-lg-12 col-md-12">
                                <label>Classificação Topográfica</label>
                                <input class="form-control somente_letras autosave" title="classificacao_topografica" name="<?php echo $this->modulo['modulo']; ?>[classificacao_topografica]" value="<?php echo $this->cadastro['classificacao_topografica']; ?>">
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label>Classificação Clínica</label>
                                <input class="form-control somente_letras autosave" title="classificacao_clinica" name="<?php echo $this->modulo['modulo']; ?>[classificacao_clinica]"  value="<?php echo $this->cadastro['classificacao_clinica']; ?>">
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>Nível</label>
                                <br>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[classificacao_clinica_nivel]" value="1" type="radio" <?php if($this->cadastro['classificacao_clinica_nivel'] == 1){ echo " checked "; } ?> >Leve
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[classificacao_clinica_nivel]" value="2" type="radio" <?php if($this->cadastro['classificacao_clinica_nivel'] == 2){ echo " checked "; } ?> >Moderado
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[classificacao_clinica_nivel]" value="3" type="radio" <?php if($this->cadastro['classificacao_clinica_nivel'] == 3){ echo " checked "; } ?> >Grave
                                </label>
                                <label>
                                    <label class="radio-inline">
                                        <input name="<?php echo $this->modulo['modulo']; ?>[classificacao_clinica_nivel]" id="4" value="gmfcs" type="radio" <?php if($this->cadastro['classificacao_clinica_nivel'] == 4){ echo " checked "; } ?> >GMFCS
                                    </label>
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <div class="form-group col-lg-12 col-md-12">
                                    <label>Nível GMFCS</label>
                                    <input class="form-control somente_letras autosave" name="<?php echo $this->modulo['modulo']; ?>[classificacao_clinica_nivel_nivel]" value="<?php echo $this->cadastro['classificacao_clinica_nivel_nivel']; ?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            História da Moléstia Atual/Pregressa
                        </div>
                        <div class="panel-body">
                           <div class="form-group col-lg-12 col-md-12">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[molestia_atual_pregressa]"><?php echo $this->cadastro['molestia_atual_pregressa']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Patologias ou Distúrbios Associados
                        </div>
                        <div class="panel-body">
                           <div class="form-group col-lg-12 col-md-12">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[patologia_disturbio_associado]"><?php echo $this->cadastro['patologia_disturbio_associado']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Medicamentos em Uso/Motivo
                        </div>
                        <div class="panel-body">
                           <div class="form-group col-lg-12 col-md-12">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[medicamento_uso_motivo]"><?php echo $this->cadastro['medicamento_uso_motivo']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Exames Complementares
                        </div>
                        <div class="panel-body">
                           <div class="form-group col-lg-12 col-md-12">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[exames_complementares]"><?php echo $this->cadastro['exames_complementares']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Órteses/Próteses e Adaptações
                        </div>
                        <div class="panel-body">
                           <div class="form-group col-lg-12 col-md-12">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[orteses_proteses_adaptacoes]"><?php echo $this->cadastro['orteses_proteses_adaptacoes']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Características Sindrômicas
                        </div>
                        <div class="panel-body">
                           <div class="form-group col-lg-12 col-md-12">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[caracteristicas_sindromicas]"><?php echo $this->cadastro['caracteristicas_sindromicas']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Avaliação do Desenvolvimento Motor
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-lg-12 col-md-12">
                                <label>Visão</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_visao]" value="1" type="radio" <?php if($this->cadastro['desenvolvimento_motor_visao'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_visao]" value="2" type="radio" <?php if($this->cadastro['desenvolvimento_motor_visao'] == 2){ echo " checked "; } ?> >Ausente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_visao]" value="3" type="radio" <?php if($this->cadastro['desenvolvimento_motor_visao'] == 3){ echo " checked "; } ?> >Parcial (Acompanha objeto mas não fixa)
                                </label>
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label>Audição</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_audicao]" value="1" type="radio" <?php if($this->cadastro['desenvolvimento_motor_audicao'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_audicao]" value="2" type="radio" <?php if($this->cadastro['desenvolvimento_motor_audicao'] == 2){ echo " checked "; } ?> >Ausente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_audicao]" value="3" type="radio" <?php if($this->cadastro['desenvolvimento_motor_audicao'] == 3){ echo " checked "; } ?> >Parcial (Acompanha Sons)
                                </label>
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label>Linguagem</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_linguagem]" value="1" type="radio" <?php if($this->cadastro['desenvolvimento_motor_linguagem'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_linguagem]" value="2" type="radio" <?php if($this->cadastro['desenvolvimento_motor_linguagem'] == 2){ echo " checked "; } ?> >Ausente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_linguagem]" value="3" type="radio" <?php if($this->cadastro['desenvolvimento_motor_linguagem'] == 3){ echo " checked "; } ?> >Parcial (Se comunica com gestos)
                                </label>
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label>Cognitivo</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_cognitivo]" value="1" type="radio" <?php if($this->cadastro['desenvolvimento_motor_cognitivo'] == 1){ echo " checked "; } ?> >Adequado para a idade
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_cognitivo]" value="2" type="radio" <?php if($this->cadastro['desenvolvimento_motor_cognitivo'] == 2){ echo " checked "; } ?> >Inadequado para a idade
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[desenvolvimento_motor_cognitivo]" value="3" type="radio" <?php if($this->cadastro['desenvolvimento_motor_cognitivo'] == 3){ echo " checked "; } ?> >Entende ordens simples
                                </label>
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>Contato</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[contato]" value="1" type="radio" <?php if($this->cadastro['contato'] == 1){ echo " checked "; } ?> >Não Contactua
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[contato]" value="2" type="radio" <?php if($this->cadastro['contato'] == 2){ echo " checked "; } ?> >Contactua

                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Qual Resposta</label>
                                <input class="form-control somente_letras" name="<?php echo $this->modulo['modulo']; ?>[contato_resposta]"  value="<?php echo $this->cadastro['contato_resposta']; ?>" >
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>Reflexos Primitivos</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[reflexos_primitivos]" value="1" type="radio" <?php if($this->cadastro['reflexos_primitivos'] == 1){ echo " checked "; } ?> >Integrados
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[reflexos_primitivos]" value="2" type="radio" <?php if($this->cadastro['reflexos_primitivos'] == 2){ echo " checked "; } ?> >Presente
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Qual</label>
                                <input class="form-control somente_letras" name="<?php echo $this->modulo['modulo']; ?>[reflexos_primitivos_presente]"  value="<?php echo $this->cadastro['reflexos_primitivos_presente']; ?>" >
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label>Controle Cervical</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[controle_cervical]" value="1" type="radio" <?php if($this->cadastro['controle_cervical'] == 1){ echo " checked "; } ?> >Ausente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[controle_cervical]" value="2" type="radio" <?php if($this->cadastro['controle_cervical'] == 2){ echo " checked "; } ?> >Incompleto
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[controle_cervical]" value="3" type="radio" <?php if($this->cadastro['controle_cervical'] == 3){ echo " checked "; } ?> >Presente
                                </label>
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>Linha Media</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[linha_media]" value="1" type="radio" <?php if($this->cadastro['linha_media'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[linha_media]" value="2" type="radio" <?php if($this->cadastro['linha_media'] == 2){ echo " checked "; } ?> >Ausente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[linha_media]" value="3" type="radio" <?php if($this->cadastro['linha_media'] == 3){ echo " checked "; } ?> >Incompleto
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Incompleto</label>
                                <input name="<?php echo $this->modulo['modulo']; ?>[linha_media_incompleto]" value="1" type="radio" <?php if($this->cadastro['linha_media_incompleto'] == 1){ echo " checked "; } ?> >Direito
                                <input name="<?php echo $this->modulo['modulo']; ?>[linha_media_incompleto]" value="2" type="radio" <?php if($this->cadastro['linha_media_incompleto'] == 2){ echo " checked "; } ?> >Esquerdo
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label>Simetria</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[simetria]" value="1" type="radio" <?php if($this->cadastro['simetria'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[simetria]" value="2" type="radio" <?php if($this->cadastro['simetria'] == 2){ echo " checked "; } ?> >Ausente
                                </label>
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label>Alinhamento</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[alinhamento]" value="1" type="radio" <?php if($this->cadastro['alinhamento'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[alinhamento]" value="2" type="radio" <?php if($this->cadastro['alinhamento'] == 2){ echo " checked "; } ?> >Ausente
                                </label>
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label>Movimentação Ativa</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[movimentacao_ativa]" value="1" type="radio" <?php if($this->cadastro['movimentacao_ativa'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[movimentacao_ativa]" value="2" type="radio" <?php if($this->cadastro['movimentacao_ativa'] == 2){ echo " checked "; } ?> >Ausente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[movimentacao_ativa]" value="3" type="radio" <?php if($this->cadastro['movimentacao_ativa'] == 3){ echo " checked "; } ?> >Hipoativa
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[movimentacao_ativa]" value="4" type="radio" <?php if($this->cadastro['movimentacao_ativa'] == 4){ echo " checked "; } ?> >Agitação
                                </label>
                                <br>
                                <label>Observações</label>
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[movimentacao_ativa_observacoes]"><?php echo $this->cadastro['movimentacao_ativa_observacoes']; ?></textarea>
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>Rolar</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[rolar]" value="1" type="radio" <?php if($this->cadastro['rolar'] == 1){ echo " checked "; } ?> >Realiza
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[rolar]" value="2" type="radio" <?php if($this->cadastro['rolar'] == 2){ echo " checked "; } ?> >Não Realiza
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[rolar]" value="3" type="radio" <?php if($this->cadastro['rolar'] == 3){ echo " checked "; } ?> >Inicia, porém incompleto
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[rolar]" value="4" type="radio" <?php if($this->cadastro['rolar'] == 4){ echo " checked "; } ?> >Uso de Padrão Patológico
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Qual</label>
                                <input class="form-control somente_letras" name="<?php echo $this->modulo['modulo']; ?>[rolar_padrao_patologico]"  value="<?php echo $this->cadastro['rolar_padrao_patologico']; ?>" >
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Inicia, porém incompleto (Decubito)</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[rolar_inicia_porem_incompleto]" value="1" type="radio" <?php if($this->cadastro['rolar_inicia_porem_incompleto'] == 1){ echo " checked "; } ?> >Direito
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[rolar_inicia_porem_incompleto]" value="2" type="radio" <?php if($this->cadastro['rolar_inicia_porem_incompleto'] == 2){ echo " checked "; } ?> >Esquerdo
                                </label>
                            </div>



                            <div class="form-group col-lg-12 col-md-12">
                                <label>Controle de Tronco</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[controle_tronco]" value="1" type="radio" <?php if($this->cadastro['controle_tronco'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[controle_tronco]" value="2" type="radio" <?php if($this->cadastro['controle_tronco'] == 2){ echo " checked "; } ?> >Ausente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[controle_tronco]" value="3" type="radio" <?php if($this->cadastro['controle_tronco'] == 3){ echo " checked "; } ?> >Inconpleto
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Postura de Quadril</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[postura_quadril]" value="1" type="radio" <?php if($this->cadastro['postura_quadril'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[postura_quadril]" value="2" type="radio" <?php if($this->cadastro['postura_quadril'] == 2){ echo " checked "; } ?> >Ausente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[postura_quadril]" value="4" type="radio" <?php if($this->cadastro['postura_quadril'] == 4){ echo " checked "; } ?> >Retroversao
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[postura_quadril]" value="5" type="radio" <?php if($this->cadastro['postura_quadril'] == 5){ echo " checked "; } ?> >Anteversao
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[postura_quadril]" value="3" type="radio" <?php if($this->cadastro['postura_quadril'] == 3){ echo " checked "; } ?> >Inclinada
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                    <label>Inclinada</label>
                                    <label class="radio-inline">
                                        <input name="<?php echo $this->modulo['modulo']; ?>[postura_quadril_inclinada]" value="1" type="radio" <?php if($this->cadastro['postura_quadril_inclinada'] == 1){ echo " checked "; } ?> >Direita
                                    </label>
                                    <label class="radio-inline">
                                        <input name="<?php echo $this->modulo['modulo']; ?>[postura_quadril_inclinada]" value="2" type="radio" <?php if($this->cadastro['postura_quadril_inclinada'] == 2){ echo " checked "; } ?> >Esquerda
                                    </label>
                                </label>
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label>Deformidade da Coluna</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[deformidade_coluna]" value="1" type="radio" <?php if($this->cadastro['deformidade_coluna'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[deformidade_coluna]" value="2" type="radio" <?php if($this->cadastro['deformidade_coluna'] == 2){ echo " checked "; } ?> >Postural
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[deformidade_coluna]" value="3" type="radio" <?php if($this->cadastro['deformidade_coluna'] == 3){ echo " checked "; } ?> >Fixa
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[deformidade_coluna]" value="4" type="radio" <?php if($this->cadastro['deformidade_coluna'] == 4){ echo " checked "; } ?> >Presente
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Qual</label>
                                    <input class="form-control somente_letras" name="<?php echo $this->modulo['modulo']; ?>[deformidade_coluna_presente]"  value="<?php echo $this->cadastro['deformidade_coluna_presente']; ?>" >
                                </label>
                            </div>


                            <div class="form-group col-lg-6 col-md-6">
                                <label>Deformidade de Quadril</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[deformidade_quadril]" value="1" type="radio" <?php if($this->cadastro['deformidade_quadril'] == 1){ echo " checked "; } ?> >Ausente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[deformidade_quadril]" value="2" type="radio" <?php if($this->cadastro['deformidade_quadril'] == 2){ echo " checked "; } ?> >Inconpleto
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[deformidade_quadril]" value="3" type="radio" <?php if($this->cadastro['deformidade_quadril'] == 3){ echo " checked "; } ?> >Presente
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Presente (Galeazzi)</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[deformidade_quadril_presente]" value="1" type="radio" <?php if($this->cadastro['deformidade_quadril_presente'] == 1){ echo " checked "; } ?> >Direito
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[deformidade_quadril_presente]" value="2" type="radio" <?php if($this->cadastro['deformidade_quadril_presente'] == 2){ echo " checked "; } ?> >Esquerdo
                                </label>
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label>Ortostatismo</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[ortostatismo]" value="1" type="radio" <?php if($this->cadastro['ortostatismo'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[ortostatismo]" value="2" type="radio" <?php if($this->cadastro['ortostatismo'] == 2){ echo " checked "; } ?> >Ausente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[ortostatismo]" value="3" type="radio" <?php if($this->cadastro['ortostatismo'] == 3){ echo " checked "; } ?> >Sustento Parcial
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[ortostatismo]" value="4" type="radio" <?php if($this->cadastro['ortostatismo'] == 4){ echo " checked "; } ?> >Base de Apoio Aumentada
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[ortostatismo]" value="5" type="radio" <?php if($this->cadastro['ortostatismo'] == 5){ echo " checked "; } ?> >Base de Apoio Diminuída
                                </label>
                                <br>
                                <label>Posicionamento dos Pés</label>
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[ortostatismo_posicionamento_pes]"><?php echo $this->cadastro['ortostatismo_posicionamento_pes']; ?></textarea>
                            </div>

                            <div class="form-group col-lg-12 col-md-12">
                                <label>Marcha</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[marcha]" value="1" type="radio" <?php if($this->cadastro['marcha'] == 1){ echo " checked "; } ?> >Realiza
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[marcha]" value="2" type="radio" <?php if($this->cadastro['marcha'] == 2){ echo " checked "; } ?> >Não Realiza
                                </label>
                                <br>
                                <label>Observações</label>
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[marcha_observacoes]"><?php echo $this->cadastro['marcha_observacoes']; ?></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Trocas Posturais
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[trocas_posturais]"><?php echo $this->cadastro['trocas_posturais']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>















                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Avaliação do Tônus
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                                <input name="<?php echo $this->modulo['modulo']; ?>[avaliacao_tonus]" value="1" type="radio" <?php if($this->cadastro['avaliacao_tonus'] == 1){ echo " checked "; } ?> >Hipertonia Elastica
                                <br><br>
                                <label class="col-lg-12 col-md-12">
                                    Grupos Musculares
                                    <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[hipertonia_elastica_grupos_musculares]"><?php echo $this->cadastro['hipertonia_elastica_grupos_musculares']; ?></textarea>
                                </label>
                            </div>
                            <div class="form-group">
                                <input name="<?php echo $this->modulo['modulo']; ?>[hipertonia_plastica]" value="1" type="radio" <?php if($this->cadastro['hipertonia_plastica'] == 1){ echo " checked "; } ?> >Hipertonia Plástica
                                <br><br>
                                <label class="col-lg-12 col-md-12">
                                    Localização
                                    <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[hipertonia_plastica_localizacao]"><?php echo $this->cadastro['hipertonia_plastica_localizacao']; ?></textarea>
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Sinais Clinicos</label>
                                <input class="form-control somente_letras" name="<?php echo $this->modulo['modulo']; ?>[sinais_clinicos]"  value="<?php echo $this->cadastro['sinais_clinicos']; ?>" >
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Asworth</label>
                                <input class="form-control somente_letras" name="<?php echo $this->modulo['modulo']; ?>[asworth]"  value="<?php echo $this->cadastro['asworth']; ?>" >
                            </div>


                            <div class="form-group col-lg-6 col-md-6">
                                <label>Discinesias (Flutuações Tônicas)</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[discinesias]" value="1" type="radio" <?php if($this->cadastro['discinesias'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Qual?</label>
                                <input name="<?php echo $this->modulo['modulo']; ?>[discinesias_atetose]" value="1" type="radio" <?php if($this->cadastro['discinesias_atetose'] == 1){ echo " checked "; } ?> >Atetose
                                <input name="<?php echo $this->modulo['modulo']; ?>[discinesias_coréia]" value="2" type="radio" <?php if($this->cadastro['discinesias_coréia'] == 2){ echo " checked "; } ?> >Coréia
                                <input name="<?php echo $this->modulo['modulo']; ?>[discinesias_distonia]" value="1" type="radio" <?php if($this->cadastro['discinesias_distonia'] == 1){ echo " checked "; } ?> >Distonia
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label class="col-lg-12 col-md-12">
                                    Localização
                                    <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[discinesias_localizacao]"><?php echo $this->cadastro['discinesias_localizacao']; ?></textarea>
                                </label>
                            </div>
                            <div class="form-group">
                                <input name="<?php echo $this->modulo['modulo']; ?>[hipotonia]" value="1" type="radio" <?php if($this->cadastro['hipotonia'] == 1){ echo " checked "; } ?> >Hipotonia
                                <br><br>
                                <label class="col-lg-12 col-md-12">
                                    Localização
                                    <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[hipotonia_localizacao]"><?php echo $this->cadastro['hipotonia_localizacao']; ?></textarea>
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Incoordenação de Movimentos</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[incoordenaco_de_movimentos]" value="1" type="radio" <?php if($this->cadastro['incoordenaco_de_movimentos'] == 1){ echo " checked "; } ?> >Presente
                                </label>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label>Qual?</label>
                                <input name="<?php echo $this->modulo['modulo']; ?>[incoordenaco_de_movimentos_ataxia]" value="1" type="radio" <?php if($this->cadastro['incoordenaco_de_movimentos_ataxia'] == 1){ echo " checked "; } ?> >Ataxia
                                <input name="<?php echo $this->modulo['modulo']; ?>[incoordenaco_de_movimentos_dismetría]" value="2" type="radio" <?php if($this->cadastro['incoordenaco_de_movimentos_dismetría'] == 2){ echo " checked "; } ?> >Dismetría
                                <input name="<?php echo $this->modulo['modulo']; ?>[incoordenaco_de_movimentos_hipometria]" value="1" type="radio" <?php if($this->cadastro['incoordenaco_de_movimentos_hipometria'] == 1){ echo " checked "; } ?> >Hipometria
                                <input name="<?php echo $this->modulo['modulo']; ?>[incoordenaco_de_movimentos_hipermetria]" value="1" type="radio" <?php if($this->cadastro['incoordenaco_de_movimentos_hipermetria'] == 1){ echo " checked "; } ?> >Hipermetria

                            </div>

                        </div>
                    </div>
                </div>


















                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Encurtamento Musculares e Deformidades
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[encurtamento_musculares_deformidades]"><?php echo $this->cadastro['encurtamento_musculares_deformidades']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>


                força muscular

                Mecanismos reflexo postural

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Atividades de Vida Diária
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label>Alimentação</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[alimentacao]" value="1" type="radio" <?php if($this->cadastro['alimentacao'] == 1){ echo " checked "; } ?> >Dependente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[alimentacao]" value="2" type="radio" <?php if($this->cadastro['alimentacao'] == 2){ echo " checked "; } ?> >Semi-dependente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[alimentacao]" value="3" type="radio" <?php if($this->cadastro['alimentacao'] == 3){ echo " checked "; } ?> >Independente
                                </label>
                                <br>
                                <label>Observações</label>
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[alimentacao_observacoes]"><?php echo $this->cadastro['alimentacao_observacoes']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Higiene</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[higiene]" value="1" type="radio" <?php if($this->cadastro['higiene'] == 1){ echo " checked "; } ?> >Dependente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[higiene]" value="2" type="radio" <?php if($this->cadastro['higiene'] == 2){ echo " checked "; } ?> >Semi-dependente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[higiene]" value="3" type="radio" <?php if($this->cadastro['higiene'] == 3){ echo " checked "; } ?> >Independente
                                </label>
                                <br>
                                <label>Observações</label>
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[higiene_observacoes]"><?php echo $this->cadastro['higiene_observacoes']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Vestuário</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[vestuario]" value="1" type="radio" <?php if($this->cadastro['vestuario'] == 1){ echo " checked "; } ?> >Dependente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[vestuario]" value="2" type="radio" <?php if($this->cadastro['vestuario'] == 2){ echo " checked "; } ?> >Semi-dependente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[vestuario]" value="3" type="radio" <?php if($this->cadastro['vestuario'] == 3){ echo " checked "; } ?> >Independente
                                </label>
                                <br>
                                <label>Observações</label>
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[vestuario_observacoes]"><?php echo $this->cadastro['vestuario_observacoes']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Locomoção</label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[locomocao]" value="1" type="radio" <?php if($this->cadastro['locomocao'] == 1){ echo " checked "; } ?> >Dependente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[locomocao]" value="2" type="radio" <?php if($this->cadastro['locomocao'] == 2){ echo " checked "; } ?> >Semi-dependente
                                </label>
                                <label class="radio-inline">
                                    <input name="<?php echo $this->modulo['modulo']; ?>[locomocao]" value="3" type="radio" <?php if($this->cadastro['locomocao'] == 3){ echo " checked "; } ?> >Independente
                                </label>
                                <br>
                                <label>Observações</label>
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[locomocao_observacoes]"><?php echo $this->cadastro['locomocao_observacoes']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Sistema Respiratório
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[sistema_respiratorio]"><?php echo $this->cadastro['sistema_respiratorio']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Condutas
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[condutas]"><?php echo $this->cadastro['condutas']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Evolução do Período
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                                <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[evolucao_periodo]"><?php echo $this->cadastro['evolucao_periodo']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>









            </div>






            <div class="row-fluid">
                <div class="form-group span12">
                    <button type="submit" class="btn btn-primary" style="float: right;">
                        <?php if(isset($this->cadastro)) : ?>
                            Editar <?php echo $this->modulo['send']; ?>
                        <?php else : ?>
                            Cadastrar Novo <?php echo $this->modulo['send']; ?>
                        <?php endif?>
                    </button>
                </div>
            </div>


        </form>
    </div>
</div>
<script type="text/javascript">
    autosize(document.querySelectorAll('textarea'));

    $(document).ready(function(){
        // while(true){
        //     setTimeout(function(){
        //         // createJSON();
        //         // $.ajax({
        //         //     type: 'POST',
        //         //     url: "/evento_ecommerce_base/carregar_todos_enderecos_completos",
        //         //     data: {
        //         //         id_cliente_cadastro: $('#id_afiliado_select2').val()
        //         //     },
        //         //     dataType: 'json',
        //         //     async: false,
        //         //     success: function(dados) {

        //         //         if(tem_enderecos_cadastrados == 1){
        //         //             cadastrar_os_enderecos_do_evento_no_select(dados);
        //         //         }

        //         //         if(ja_tinha_evento == 1){
        //         //             cadastrar_novos_enderecos(dados);
        //         //         } else {
        //         //             cadastrar_novos_enderecos(dados);
        //         //         }
        //         //     }
        //         // });
        //     }, 3000);
        // }
    });

    function createJSON() {
        jsonObj = [];
        $(".autosave").each(function() {

            var id = $(this).attr("title");
            var input = $(this).val();

            item = {}
            item ["title"] = id;
            item ["value"] = input;

            jsonObj.push(item);
        });

        console.log(jsonObj);
    }
</script>

