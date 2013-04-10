<?php
class Sys {
    public static function excluirValor()
    {
        if (isset($_GET['id']))
        {
            $objeto = new $_GET['tipo']();
            $classe = get_class($objeto);
            $objeto = new $classe();
            $objeto->filtros = "where {$objeto->chave} = '{$_GET['id']}'";
            $objeto->selecionaTudo($objeto);
            if ($dados = $objeto->retornaDados())
            {
                $form = new Formulario("Excluir $classe");
                $form->start();

                $form->content("Você realmente deseja excluir esse $classe?");

                $form->back('Cancelar');
                $form->submit('Confirmar');
                $form->end();

                if ($form->requisicaoFeita())
                {

                    $dados = $form->capturaDados();

                    $objeto = new $classe();
                    $objeto->valorChave = $_GET['id'];
                    $objeto->deletar($objeto);
                    $aviso = new Aviso('success', "Exclusão realizada com sucesso!");
                    echo "<div class='fieldset'>{$aviso->aviso}
                            <input type='button' value='Voltar' onClick='javascript: history.go(-2)' />
                          </div>";
                }
                else
                {
                    $form->show();
                }
            }
            else
            {
                $aviso = new Aviso('error', "$classe selecionado não cadastrado");
                echo "<div class='fieldset'>{$aviso->aviso}
                        <input type='button' value='Voltar' onClick='javascript: history.go(-2)' />
                      </div>";
            }

        }
        else
        {
            
            $aviso = new Aviso("error", "Nenhum dado selecionado");
            echo "<div class='fieldset'>{$aviso->aviso}
                    <input type='button' value='Voltar' onClick='javascript: history.go(-2)' />
                  </div>";
        }
    }
}
?>

