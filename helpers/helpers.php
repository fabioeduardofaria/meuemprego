<?php

function dd($param = [])
{
    echo '<pre>';
    print_r($param);
    echo '</pre>';
    exit();
}

function getData()
{
    $data = getdate();
    $diaHoje = date('d');
    $array_meses = array(
        1 => "janeiro", 2 => "fevereiro", 3 => "março", 4 => "abril", 5 => "maio", 6 => "junho",
        7 => "julho", 8 => "agosto", 9 => "setembro", 10 => "outubro", 11 => "novembro", 12 => "dezembro"
    );
    $hora_agora = date('H:i');
    $mesgetdate = $data['mon'];
    $anoatual   = date('Y');

    // Array com os dias da semana
    $diasemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado');

    // Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
    $data = date('Y-m-d');

    // Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
    $diasemana_numero = date('w', strtotime($data));

    // Exibe o dia da semana com o Array
    //echo $diasemana[$diasemana_numero];

    return $diasemana[$diasemana_numero] . ', ' . $diaHoje . ' de ' . $array_meses[$mesgetdate] . ' de ' . $anoatual . ' às ' . $hora_agora . '';
}    //fim function getData()


//IMAGEM
function upload($imagem = [], $pasta)
{
    if ($imagem['size'] > 0) {
        // dd($imagem);
        // selecionou uma imagem
        // $imagem = $arquivo['file_imagem'];
        $nome_img = md5(uniqid(rand(), true)) . $imagem['name'];
        $pasta_img = "assets/uploads/" . $pasta;
        $dest_img = $pasta_img . "/" . $nome_img;

        if (!move_uploaded_file($imagem['tmp_name'], $dest_img)) { // Executa o comando do upload no servidor
            // echo "Não foi possível enviar a imagem!"; /* Caso não foi possível enviar o arquivo, mostra o erro. */
            return "";
        }

        return $nome_img;
    }
}

//Diferenca dias entre datas
function diasDatas($data_inicial, $data_final)
{

    if ($data_final == null) {
        $data_final = date("Y-m-d");
    }
    $diferenca = strtotime($data_final) - strtotime($data_inicial);
    $dias = floor($diferenca / (60 * 60 * 24));
    return $dias;
}

//formatar para moeda Real
function formatarMoeda($valor, $simbolo, $casasDecimais = 2)
{
    echo $simbolo . " " . number_format($valor, $casasDecimais, ",", ".");
}
