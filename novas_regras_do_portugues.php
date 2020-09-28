<!DOCTYPE html>
<?php
include_once 'automato.php';

function getTitulo($estado) {
    $automato = criaAutomato();
    //echo $automato->estados[$estado]->descricao . " - Novas Regras do Portugues";
    if ($estado == '')
        return $automato->getEstadoInicial()->descricao;
    return $automato->estados[$estado]->descricao;
}

function getConteudo($estado) {
    $automato = criaAutomato();
    $links = '';

    if ($estado == '') {
        foreach ($automato->getEstadoInicial()->transicoes as $key => $value) {
            $links .= "<br><a href=index.php?estado=$key> $value->descricao</a>";
        }
        return $automato->getEstadoInicial()->conteudo . "<br>" . $links;
    }

    foreach ($automato->estados[$estado]->transicoes as $key => $value) {
        $links .= "<br><a href=index.php?estado=$key> $value->descricao</a>";
    }
    return $automato->estados[$estado]->conteudo . "<br>" . $links;
}

function criaAutomato() {
    $meuAutomato = new Automato();

    $meuAutomato->adicionaEstado("home", "Home", "
            Novas regras do português.<br>
            Fonte: professor Sérgio Nogueira - www.g1.com.br");
    
    $meuAutomato->adicionaEstado("alfabeto", "Alfabeto", "Ganha três letras.<br>
        <table border='1'>
            <tr>
                <td>Antes</td>
                <td>Depois</td>
            </tr>
            <tr>
                <td>23 Letras</td>
                <td>26 Letras: Entram <b>k</b>, <b>w</b> e <b>y</b>.</td>
            </tr>
       </table>
    ");
    $meuAutomato->adicionaEstado("trema", "Trema", "Desaparece em todas as palavras.<br>
        <table border='1'>
            <tr>
                <td>Antes</td>
                <td>Depois</td>
            </tr>
            <tr>
                <td>Freqüente, lingüiça, agüentar</td>
                <td>Frequente, linguiça, aguentar</td>
            </tr>
       </table>
       <font color='#ff0000;'>* Fica o acento em nomes como Müller</font>
    ");

    $meuAutomato->adicionaEstado("acentuacao", "Acentuação", "");
    $meuAutomato->adicionaEstado("acentuacao1", "Ditongos abertos éi e ói das palavras paroxítonas", "Somem
        <table border='1'>
            <tr>
                <td>Antes</td>
                <td>Depois</td>
            </tr>
            <tr>
                <td>Européia, idéia, heróico, apóio, bóia, asteróide, Coréia,
                    estréia, jóia, platéia, paranóia, jibóia, assembléia</td>
                <td>Europeia, ideia, heroico, apoio, boia, asteroide, Coreia,
                    estreia, joia, plateia, paranoia, jiboia, assembleia</td>
            </tr>
       </table>
        <font color='#ff0000;'>* Herói, papéis, troféu mantêm o acento (porque têm a última sílaba mais forte)</font>
    ");

    $meuAutomato->adicionaEstado("acentuacao2", "Acento no i e no u fortes 
          depois de ditongos, em palavras paroxítonas", "Somem
        <table border='1'>
            <tr>
                <td>Antes</td>
                <td>Depois</td>
            </tr>
            <tr>
                <td>Baiúca, bocaiúva, feiúra</td>
                <td>Baiuca, bocaiuva, feiura</td>
            </tr>
       </table>
        <font color='#ff0000;'>* Se o <b>i</b> e o <b>u</b> estiverem na última sílaba, o acento continua como em: tuiuiú ou Piauí</font>
    ");

    $meuAutomato->adicionaEstado("acentuacao3", "Acento circunflexo das palavras
         terminadas em êem e ôo (ou ôos)", "Somem
        <table border='1'>
            <tr>
                <td>Antes</td>
                <td>Depois</td>
            </tr>
            <tr>
                <td>Crêem, dêem, lêem, vêem, prevêem, vôo, enjôos</td>
                <td>Creem, deem, leem, veem, preveem, voo, enjoos</td>
            </tr>
       </table>
    ");

    $meuAutomato->adicionaEstado("acentuacao4", "Acento diferencial", "Somem
        <table border='1'>
            <tr>
                <td>Antes</td>
                <td>Depois</td>
            </tr>
            <tr>
                <td>Pára, péla, pêlo, pólo, pêra, côa</td>
                <td>Para, pela, pelo, polo, pera, coa</td>
            </tr>
       </table>
        <font color='#ff0000;'>* Não some o acento diferencial em <b>pôr</b> (verbo) / por (preposição) e pôde (pretérito) / pode (presente). Fôrma, para diferenciar de forma, pode receber<br>
acento circunflexo
</font>
    ");

    $meuAutomato->adicionaEstado("acentuacao5", "Acento agudo no u forte nos grupos
        gue, gui, que, qui, de verbos como averiguar, apaziguar, arguir, redarguir, enxaguar", "
        - Somem
        <table border='1'>
            <tr>
                <td>Antes</td>
                <td>Depois</td>
            </tr>
            <tr>
                <td>Averigúe, apazigúe, ele argúi, enxagúe você</td>
                <td>Averigue, apazigue, ele argui, enxague você</td>
            </tr>
       </table>
        <font color='#ff0000;'><b>Observação:</b> as demais regras de acentuação permanecem as mesmas</font>
    ");

    $meuAutomato->adicionaEstado("hifen", "Hífen", "Veja como ficam as principais regras do hífen com prefixos:
        <table border='1'>
            <tr>
                <td>Prefixos</td>
                <td>Usa hífen</td>
                <td>Não usa hífen</td>
            </tr>
            <tr>
                <td>Agro, ante, anti, arqui, auto,<br>
                    contra, extra, infra, intra, macro,<br>
                    mega, micro, maxi, mini, semi, <br>
                    sobre, supra, tele, ultra...</td>
                <td><b>Quando a palavra seguinte começa<br>
                    com h ou com vogal igual à última</b><br>
                    do prefixo: auto-hipnose, auto-observação,<br>
                    anti-herói, anti-imperalista,<br> 
                    micro-ondas, mini-hotel
                </td>
                <td><b>Em todos os demais casos:</b><br>
                        autorretrato, autossustentável, autoanálise,<br>
                        autocontrole, antirracista, antissocial,<br>
                        antivírus, minidicionário, minissaia,<br>
                        minirreforma, ultrassom
                </td>
            </tr>
            <tr>
                <td>Hiper, inter, super</td>
                <td><b>Quando a palavra seguinte<br>
                    começa com h ou com r:</b><br>
                    super-homem, inter-regional<br>
                </td>
                <td><b>Em todos os demais casos:</b><br>
                       hiperinflação, supersônico
                </td>
            </tr>
            <tr>
                <td>Sub</td>
                <td><b>Quando a palavra seguinte<br>
                    começa com b, h ou r:</b><br>
                    sub-base, sub-reino, sub-humano
                </td>
                <td><b>Em todos os demais casos:</b><br>
                    subsecretário, subeditor
                </td>
            </tr>
            <tr>
                <td>Vice</td>
                <td><b>Sempre:</b>vice-rei, vice-presidente</td>
                <td></td>
            </tr>
            <tr>
                <td>Pan, circum</td>
                <td><b>Quando a palavra seguinte<br>
                    começa com h, m, n ou vogais:</b><br>
                    pan-americano, circum-hospitalar</td>
                <td><b>Em todos os demais casos:</b><br>
                    pansexual, circuncisão
                </td>
            </tr>
       </table>
    ");

    $meuAutomato->setEstadoInicial("home");

    $meuAutomato->adicionaTransicao("home", "alfabeto, trema, acentuacao, hifen");
    $meuAutomato->adicionaTransicao("alfabeto", "home, trema, acentuacao, hifen");
    $meuAutomato->adicionaTransicao("trema", "home, alfabeto, acentuacao, hifen");
    $meuAutomato->adicionaTransicao("hifen", "home, alfabeto, trema, acentuacao");
    $meuAutomato->adicionaTransicao("acentuacao", "home, acentuacao1, acentuacao2, acentuacao3, acentuacao4, acentuacao5");
    $meuAutomato->adicionaTransicao("acentuacao1", "acentuacao, acentuacao2, acentuacao3, acentuacao4, acentuacao5");
    $meuAutomato->adicionaTransicao("acentuacao2", "acentuacao, acentuacao1, acentuacao3, acentuacao4, acentuacao5");
    $meuAutomato->adicionaTransicao("acentuacao3", "acentuacao, acentuacao1, acentuacao2, acentuacao4, acentuacao5");
    $meuAutomato->adicionaTransicao("acentuacao4", "acentuacao, acentuacao1, acentuacao2, acentuacao3, acentuacao5");
    $meuAutomato->adicionaTransicao("acentuacao5", "acentuacao, acentuacao1, acentuacao2, acentuacao3, acentuacao4");
    

    return $meuAutomato;
}
?>
