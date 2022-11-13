<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* ... COMPLETAR ... */



/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    //array $coleccionPalabras
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "FRESA", "DULCE", "LIBRO", "GLOBO", "BOLSA"
    ];

    return ($coleccionPalabras);
}
/**
 * Permite ingresar un numero de partida y si el numero es valido devuelve el resumen de esa partida jugada
 * @param array $coleccionPartidas
 */
function mostrarPartida ($coleccionPartidas, $numeroPartida) 
{
    echo"********************************** \n";
    echo"Partida WORDIX " .$numeroPartida. ": palabra ".$coleccionPartidas[$numeroPartida]["palabraWordix"]. "\n";
    echo"Jugador: ".$coleccionPartidas[$numeroPartida]["jugador"];
    echo"\nPuntaje: " .$coleccionPartidas [$numeroPartida]["puntaje"];
    if ($coleccionPartidas[$numeroPartida]["intentos"] > 0){
        echo"\nIntento: Adivinó la palabra en " .$coleccionPartidas[$numeroPartida]["intentos"] ." intentos";
    } else {
        echo "\nIntento: No se adivinó la palabra";
    }
    echo"\n**********************************";
}
/**
 * Ingresa por parametros la coleccion de palabras jugables y una palabra nueva para que se pueda jugar
 * @param array $coleccionPalabras
 * @param string $palabraAgregada
 * @return array
 */
function agregarPalabra ($coleccionPalabras, $palabraAgregada){
    //int $i, $rango, $numeroPalabra
    $i = 0;
    $rango = count($coleccionPalabras);
    $esAgregable = true;
    while($coleccionPalabras[$i] != $palabraAgregada && $i < $rango - 1){  
        $i = $i + 1;
    }
    if($coleccionPalabras[$i] == $palabraAgregada){
        $esAgregable = false;
    } 
    if($esAgregable == true){
    $numeroPalabra = count($coleccionPalabras); //numero de la nueva palabra
    $coleccionPalabras [$numeroPalabra] = $palabraAgregada;
    echo "\nLa palabra " .$coleccionPalabras[$numeroPalabra]. " fue agregada\n";
    } else {
        echo"La palabra ya existe\n";
    }
    return $coleccionPalabras; 
}

/**
 * Ingresa por parametros la coleccion de partidas y el nombre de un jugador para retornar el indice de su primera partida ganada
 * en caso de que no haya ganado ninguna partida retorna un -1
 * @param array $coleccionPartidas
 * @param string $nombre
 * @return int
 */
function mostrarPrimerPartidaGanada ($coleccionPartidas, $nombre)
{
//int $numeroPartida $maxRango
//boolean $esPartidaGanada, $existeJugador
$numeroPartida = 1;
$indice = -1;
$esPartidaGanada = false;
$existeJugador = false;
$maxRango = count($coleccionPartidas); // maximo rango de busqueda
do{
    $numeroPartida = $numeroPartida + 1;
    $indice = $indice + 1;
    if ($coleccionPartidas[$indice]["intentos"] > 0 && $coleccionPartidas[$indice]["jugador"] == $nombre){ //analiza si se gano la partida
        $esPartidaGanada = true;
    }
    if ($coleccionPartidas[$indice]["jugador"] == $nombre){ // analiza si existe el jugador
        $existeJugador = true;
    }
} while (($coleccionPartidas[$indice]["jugador"] != $nombre || !$esPartidaGanada == true) && $numeroPartida <= $maxRango); // analiza si existe un jugador con el nombre y si gano o si no existe el jugador
    //resultados en caso de que no existe el jugador o nunca gano una partida
    if($existeJugador == false){ 
        $indice = -2;
    }
    if($esPartidaGanada == false  && $existeJugador == true){ 
        $indice = -1;
    }
return $indice;
}
/**
 * Ingresa por parametros la coleccion de partidas y el nombre de un jugador para retornar el resumen del jugador almacenado en una variable
 * @param array $resumenJugador
 * @param string $nombreJugador
 * @return string
 */
function mostrarEstadisticasJugador ($resumenJugador, $nombreJugador){
    //int $iteradora, $indice
    //string $resumen
    //float $porcentaje
    $iteradora = 0;
    $indice = -1;
    $porcentaje = 0;
        do{
            $indice = $indice + 1;
            if ($resumenJugador[$indice]["nombre"] == $nombreJugador) { //si el nombre coincide con el nombre del jugador devuelve $resumen con las estadisticas del jugador
                $porcentaje = $resumenJugador[$indice]["victorias"] * 100 / $resumenJugador[$indice]["partidas"];
                 $resumen = "Jugador:" .$resumenJugador[$indice]["nombre"];
                 $resumen = $resumen ."\nPartidas:".$resumenJugador[$indice]["partidas"];
                 $resumen = $resumen ."\nPuntaje total:".$resumenJugador[$indice]["puntaje"];
                 $resumen = $resumen . "\nVictorias:".$resumenJugador[$indice]["victorias"];
                 $resumen = $resumen . "\nPorcentaje Victorias:".$porcentaje. "%";
                 $resumen = $resumen . "\nIntento 1:".$resumenJugador[$indice]["intento1"];
                 $resumen = $resumen . "\nIntento 2:".$resumenJugador[$indice]["intento2"];
                 $resumen = $resumen . "\nIntento 3:".$resumenJugador[$indice]["intento3"];
                 $resumen = $resumen . "\nIntento 4:".$resumenJugador[$indice]["intento4"];
                 $resumen = $resumen . "\nIntento 5:".$resumenJugador[$indice]["intento5"];
                $resumen = $resumen . "\nIntento 6:".$resumenJugador[$indice]["intento6"];
             } else {
                $resumen = "No existe el jugador";
             }
             $iteradora = $iteradora + 1;
        }while($resumenJugador[$indice]["nombre"] != $nombreJugador && $iteradora < count($resumenJugador));
        return $resumen;
        }

/** solicita el nombre de un jugador, verifica que el primer caracter no sea un numero y pone en minuscula el nombre, retorna el nombre del usuario en minuscula
 *  @return string
*/
function solicitarJugador(){
    do{
        //string $nombreUsuario
        //boolean $esCaracter
        echo"Ingrese su nombre de usuario \n";
        $nombreUsuario = trim(fgets(STDIN));
        $esCaracter = ctype_alpha($nombreUsuario[0]);
    }while($esCaracter == false);
    $nombreUsuario = strtolower($nombreUsuario);
    return $nombreUsuario;
}
/**
 * Ingresa una letra y calcula el puntaje, si es una vocal suma un punto, si es una consonante hasta inclusive la m 2, y el resto de consonantes 3 puntos
 * @param string $letra
 * @return int
 */
function PuntosAbecedario ($letra){
    //array $abecedario
    // int $i, $puntos
    $abecedario = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    $i = 0;
    $puntos = 0;
    while ($abecedario[$i] != $letra){
        $i = $i + 1;
    }
    if ($abecedario[0] == $letra || $abecedario[4] == $letra|| $abecedario[8] == $letra|| $abecedario[14] == $letra|| $abecedario[20] == $letra)
    {
        $puntos = 1;
    } else if ($i <= 12){
        $puntos = 2;
    } else if ($i > 12){
        $puntos = 3;
    }
    return $puntos;
}

/**
 * Carga las estadisticas de los jugadores
 * @return array
 */
function cargarEstadisticas () {
    //array $jugador0, $jugador1, $jugador2, $jugador3, $resumenJugador
    $jugador0 = ["nombre" => "juan" ,"partidas" => 4 , "puntaje" => 35 , "victorias" => 3 , "intento1" => 1 , "intento2" => 1 , "intento3" => 0 , "intento4" => 1 , "intento5" => 0
    , "intento6" => 0];
    $jugador1 = ["nombre" => "alan" ,"partidas" => 2 , "puntaje" => 8 , "victorias" => 1 , "intento1" => 0 , "intento2" => 0 , "intento3" => 1 , "intento4" => 0 , "intento5" => 0
    , "intento6" => 0];
    $jugador2 = ["nombre" => "marcos" ,"partidas" => 3 , "puntaje" => 24 , "victorias" => 2 , "intento1" => 0 , "intento2" => 1 , "intento3" => 0 , "intento4" => 0 , "intento5" => 1
    , "intento6" => 0];
    $jugador3 = ["nombre" => "alejo" ,"partidas" => 1 , "puntaje" => 14 , "victorias" => 1 , "intento1" => 1 , "intento2" => 0 , "intento3" => 0 , "intento4" => 0 , "intento5" => 0
    , "intento6" => 0];
    $resumenJugador[0] = $jugador0;
    $resumenJugador[1] = $jugador1;
    $resumenJugador[2] = $jugador2;
    $resumenJugador[3] = $jugador3;
    return $resumenJugador;
}

/** Carga las partidas jugadas y retorna el array con las partidas
 * 
 * @return array
*/
function cargarPartidas(){
    //array $partida0, $partida1 $partida2, $partida3, $partida4, $partida5, $partida6, $partida7, $partida8, $partida9, $coleccionPartidas
    $partida0 = ["palabraWordix" => "MELON", "jugador" => "juan", "intentos" => 1 , "puntaje" => 13];
    $partida1 = ["palabraWordix" => "FUEGO", "jugador" => "alan", "intentos" => 3 , "puntaje" => 8];
    $partida2 = ["palabraWordix" => "CASAS", "jugador" => "marcos", "intentos" => 2 , "puntaje" => 13];
    $partida3 = ["palabraWordix" => "GATOS", "jugador" => "alejo", "intentos" => 1 , "puntaje" => 14];
    $partida4 = ["palabraWordix" => "TINTO", "jugador" => "juan", "intentos" => 0 , "puntaje" => 0];
    $partida5 = ["palabraWordix" => "NAVES", "jugador" => "marcos", "intentos" => 5 , "puntaje" => 11];
    $partida6 = ["palabraWordix" => "VERDE", "jugador" => "alan", "intentos" => 0 , "puntaje" => 0];
    $partida7 = ["palabraWordix" => "PIANO", "jugador" => "marcos", "intentos" => 0 , "puntaje" => 0];
    $partida8 = ["palabraWordix" => "LIBRO", "jugador" => "juan", "intentos" => 2 , "puntaje" => 12];
    $partida9 = ["palabraWordix" => "GLOBO", "jugador" => "juan", "intentos" => 4 , "puntaje" => 10];
    $coleccionPartidas [0] = $partida0;
    $coleccionPartidas [1] = $partida1;     
    $coleccionPartidas [2] = $partida2;
    $coleccionPartidas [3] = $partida3;
    $coleccionPartidas [4] = $partida4;
    $coleccionPartidas [5] = $partida5;
    $coleccionPartidas [6] = $partida6;
    $coleccionPartidas [7] = $partida7;
    $coleccionPartidas [8] = $partida8;
    $coleccionPartidas [9] = $partida9;
    return $coleccionPartidas;
}

/** Muestra por pantalla un menu de opciones y permite elegir la opcion que guste utilizar el usuario, en caso de que no se ingrese una opcion valida
 *  se le muestra devuelta el menu. retorna el numero de la opcion elegida por el usuario
 * @return int
 *
*/
function seleccionarOpcion (){
    //int $opcion
    $opcion = 0;
    do {
    echo"\nMenu de opciones: \n";
    echo"1) Jugar al Wordix con una palabra elegida \n";
    echo"2) Jugar al Wordix con una palabra aleatoria \n";
    echo"3) Mostrar una partida \n";
    echo"4) Mostrar la primer partida ganadora \n";
    echo"5) Mostrar resumen de Jugador \n";
    echo"6) Mostrar listado de partidas ordenadas por jugador y por palabra \n";
    echo"7) Agregar una palabra de 5 letras a Wordix \n";
    echo"8) Salir \n";
    $opcion = trim(fgets(STDIN));
    } while($opcion < 0 && $opcion > 8);
    return $opcion;
}

/**
 * Ingresa la coleccion de partidas, el nombre de un usuario y la palabra para analizar si el usuario no ha utilizado esa palabra para jugar antes, y devuelve un boolean
 * true si es jugable y false si no lo es
 * @param array $coleccionPartidas
 * @param string $nombreUsuario
 * @param string $palabra
 * @return boolean
 */
function partidaJugable ($coleccionPartidas, $nombreUsuario, $palabra){
    // int $i, $rangoDePartida
    // boolean $esJugable
    $i = 0;
    $esJugable = false;
    $rangoDePartida= count($coleccionPartidas);
    while (($coleccionPartidas[$i]["palabraWordix"] != $palabra || $coleccionPartidas[$i]["jugador"] != $nombreUsuario ) && $i < $rangoDePartida - 1){
        $i = $i + 1;
    }
    if($coleccionPartidas[$i]["palabraWordix"] == $palabra && $coleccionPartidas[$i]["jugador"] == $nombreUsuario){ //analiza si una palabra es jugable
        $esJugable = false;
    } else {
        $esJugable = true;
    }
    return $esJugable;
}

/** Agrega la partida jugada a las estadisticas de un jugador, en caso de que no existiese el jugador agrega sus estadisticas y la retorna agregado
 * @param array $resumenPartidas
 * @param array $partidaJugada
 * @return array
 */
function agregarEstadisticas($resumenPartidas, $partidaJugada){
    //int $i , $rango, $nvoJugador, $puntos
    //boolean $yaExiste
    $i = 0;
    $rango = count($resumenPartidas);
    $nvoJugador = 0;
    $yaExiste = false;
    while ($resumenPartidas[$i]["nombre"] != $partidaJugada["jugador"] && $i < $rango - 1){ //analiza si un jugador ya existe
        $i = $i + 1;
        if($resumenPartidas[$i]["nombre"] == $partidaJugada["jugador"]){
            $yaExiste = true;
        }
    } 
    if(!$yaExiste) { //si el jugador no existe crea las estadisticas de el, caso contrario suma las nuevas estadisticas del usuario
        $nvoJugador = count($resumenPartidas);
        $resumenPartidas[$nvoJugador]["nombre"] = $partidaJugada ["jugador"];
        $resumenPartidas[$nvoJugador]["partidas"] = 1;
        $resumenPartidas[$nvoJugador]["puntaje"] = $partidaJugada ["puntaje"];
        $resumenPartidas[$nvoJugador]["victorias"] = 0;
        $resumenPartidas[$nvoJugador]["intento1"] = 0;
        $resumenPartidas[$nvoJugador]["intento2"] = 0;
        $resumenPartidas[$nvoJugador]["intento3"] = 0;
        $resumenPartidas[$nvoJugador]["intento4"] = 0;
        $resumenPartidas[$nvoJugador]["intento5"] = 0;
        $resumenPartidas[$nvoJugador]["intento6"] = 0;
        switch($partidaJugada["intentos"]){ //Analiza en que intento se gano para sumar 1 en el intento que sea correcto
            case 1:
                $resumenPartidas[$nvoJugador]["intento1"] = 1;
                $resumenPartidas[$nvoJugador]["victorias"] = 1;
                break;
            case 2:
                $resumenPartidas[$nvoJugador]["intento2"] = 1;
                $resumenPartidas[$nvoJugador]["victorias"] = 1;         
                break;
            case 3:
                $resumenPartidas[$nvoJugador]["intento3"] = 1;
                $resumenPartidas[$nvoJugador]["victorias"] = 1;
                 break;
            case 4:
                $resumenPartidas[$nvoJugador]["intento4"] = 1;  
                $resumenPartidas[$nvoJugador]["victorias"] = 1;              
                break;
            case 5:
                $resumenPartidas[$nvoJugador]["intento5"] = 1;   
                $resumenPartidas[$nvoJugador]["victorias"] = 1;           
                break;    
            case 6:
                $resumenPartidas[$nvoJugador]["intento6"] = 1;
                $resumenPartidas[$nvoJugador]["victorias"] = 1;
                break;
            }
        } else { 
            $puntos = $resumenPartidas[$i]["puntaje"];
            $resumenPartidas[$i]["puntaje"] = $puntos + $partidaJugada["puntaje"];
            $resumenPartidas[$i]["partidas"] = $resumenPartidas[$i]["partidas"] + 1;
            switch($partidaJugada["intentos"]){ //Analiza en que intento se gano para sumar la victoria segun el intento
                case 1:
                   
                    $resumenPartidas[$i]["intento1"] = $resumenPartidas[$i]["intento1"] + 1;
                    $resumenPartidas[$i]["victorias"] = $resumenPartidas[$i]["victorias"] + 1;
                    break;
                case 2:
                    
                    $resumenPartidas[$i]["intento2"] = $resumenPartidas[$i]["intento2"] + 1;  
                    $resumenPartidas[$i]["victorias"] = $resumenPartidas[$i]["victorias"] + 1;
                    break;
                case 3:
                  
                    $resumenPartidas[$i]["intento3"] = $resumenPartidas[$i]["intento3"] + 1;
                    $resumenPartidas[$i]["victorias"] = $resumenPartidas[$i]["victorias"] + 1;
                     break;
                case 4:
                  
                    $resumenPartidas[$i]["intento4"] = $resumenPartidas[$i]["intento4"] + 1;  
                    $resumenPartidas[$i]["victorias"] = $resumenPartidas[$i]["victorias"] + 1;        
                    break;
                case 5:  
                    $resumenPartidas[$i]["intento5"] = $resumenPartidas[$i]["intento5"] + 1;  
                    $resumenPartidas[$i]["victorias"] = $resumenPartidas[$i]["victorias"] + 1;
                    break;    
                case 6:
                    $resumenPartidas[$i]["intento6"] = $resumenPartidas[$i]["intento6"] + 1;
                    $resumenPartidas[$i]["victorias"] = $resumenPartidas[$i]["victorias"] + 1;
                    break;
                }
        }
    return $resumenPartidas;
}
/**
 * Permite el ingreso de una coleccion de partidas y muestra el listado por pantalla ordenada por nombre del jugador y por palabra
 * @param array $coleccionPartidas
 */
function mostrarColeccionPartidasOrd ($coleccionPartidas){
    function comparacion($a, $b, ){
        return ($a < $b) ? -1 : 1;
    }
    uasort($coleccionPartidas,'comparacion'); //ordena un array segun una funcion de comparacion dada
    function comparacion1($a, $b, ){
        return ($a < $b) ? -1 : 1;
    }
    uasort($coleccionPartidas,'comparacion1');
    print_r($coleccionPartidas); //print_r imprime un array completo por pantalla 
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
//string $jugador , $palabra , $estadisticasJugador , $palabraNueva, $palabraAleatoria
//int $rangoMax ,$numeroDePartida , $nroNuevaPartida , $partidaAMostrar , $numeroPalabraNueva , $nvoResumen, $nroRandom
//array $coleccionPartidas , $coleccionPalabras

//Inicialización de variables:
$coleccionPartidas = cargarPartidas();
$coleccionPalabras = cargarColeccionPalabras();
$resumenJugador = cargarEstadisticas();
$jugador = "";
$palabra = "";
$estadisticasJugador = "";
$palabraNueva = "";
$rangoMax = 0;
$numeroDePartida = 0;
$nroNuevaPartida = 0;
$partidaAMostrar = 0;
$numeroPalabraNueva = 0;
$nvoResumen = 0;
//Proceso:

do {
    $opcion = seleccionarOpcion();

    /*la sentencia switch es similar a las estructuras alternativas, se utiliza en ocasiones las cuales se quiere comparar una variable 
    con muchos valores diferentes y ejecutar codigo segun el valor
    */
    switch ($opcion) {
        case 1: //jugar partida con una palabra elegida
            $jugador = solicitarJugador();
            $rangoMax = count($coleccionPalabras) - 1;
            echo"Ingrese un numero de partida que desea jugar desde el 0 al " .$rangoMax. "\n";
            do{
            $numeroDePartida = solicitarNumeroEntre(0 , $rangoMax);
            $palabra = $coleccionPalabras [$numeroDePartida];
            if(!partidaJugable ($coleccionPartidas, $jugador, $palabra)){
                echo"Numero de partida ya jugado, seleccione otro\n";
            }
            }while(!partidaJugable ($coleccionPartidas, $jugador, $palabra));
            $nroNuevaPartida = count($coleccionPartidas);
            $coleccionPartidas [$nroNuevaPartida] = jugarWordix($palabra , $jugador); //guarda la nueva partida en la coleccion de partidas
            $resumenJugador = agregarEstadisticas($resumenJugador,$coleccionPartidas [$nroNuevaPartida]); //agrega las estadisticas de la partida finalizada
            break;
        case 2: // jugar partida con una palabra aleatoria
            $jugador = solicitarJugador();
            $nroRandom = 0;
            $palabraAleatoria = $coleccionPalabras[$nroRandom];
            while(!partidaJugable ($coleccionPartidas, $jugador, $palabraAleatoria)){
                $nroRandom = $nroRandom + 1;
                $palabraAleatoria = $coleccionPalabras[$nroRandom];
            }
            $nroNuevaPartida = count($coleccionPartidas);
            $coleccionPartidas [$nroNuevaPartida] = jugarWordix($palabraAleatoria, $jugador); //guarda la nueva partida en la coleccion de partidas
            $resumenJugador = agregarEstadisticas($resumenJugador,$coleccionPartidas [$nroNuevaPartida]); //agrega las estadisticas de la partida finalizada
            break;
        case 3:  // Muestra una partida elegida por el usuario
            $rangoMax = count($coleccionPartidas) - 1; //rango de las partidas
            echo"Ingrese un número entre 0 y ".$rangoMax. " para ver la partida\n";
            $numeroPartida = solicitarNumeroEntre(0 , $rangoMax);
            mostrarPartida ($coleccionPartidas, $numeroPartida);
            break;
        case 4: // Muestra la primer partida ganadora de un jugador
            $jugador = solicitarJugador();
            $partidaAMostrar = mostrarPrimerPartidaGanada ($coleccionPartidas, $jugador);
            if($partidaAMostrar == -1){ // en casos de que no haya ganado 
                echo $jugador." no gano ninguna partida";
            } else if ($partidaAMostrar == -2){ // si no existe el jugador
                echo"No existe el jugador";
            } else {
                mostrarPartida($coleccionPartidas, $partidaAMostrar);
            }
            break;
        case 5: //Muestra las estadisticas de un jugador
            $jugador = solicitarJugador();
            $estadisticasJugador = mostrarEstadisticasJugador ($resumenJugador, $jugador);
            echo $estadisticasJugador;
            break;
        case 6: //Muestra el listado de partidas ordenadas por jugador y palabra
            mostrarColeccionPartidasOrd($coleccionPartidas);
            break;
        case 7: //agregar una palabra a wordix
                echo "Agregar nueva palabra \n";
                $palabraNueva = leerPalabra5Letras();
                $numeroPalabraNueva = count($coleccionPalabras);         
                $coleccionPalabras = agregarPalabra($coleccionPalabras,$palabraNueva);
            break; 
    }
} while ($opcion != 8); 
