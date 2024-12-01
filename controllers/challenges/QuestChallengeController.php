<?php session_start();

include_once '../../model/ArrayQuests.php';

$QUESTCHALLENGEPARAMS = [
    'initPts' => 100,
    'penalty' => 20,
    'objective' => 5,
];


function challengeStart(){
    global $QUESTCHALLENGEPARAMS;
    
    $_SESSION['inQuest'] = 1;
    $_SESSION['streak'] = 0;
    $_SESSION['attempts'] = 0;
    $_SESSION['currentPts'] = $QUESTCHALLENGEPARAMS['initPts'];
    
    setcookie('inQuest', '1', 0, "/", 'localhost');
    setcookie('streak', '0', 0, "/", 'localhost');
    setcookie('currentPts', $_SESSION['currentPts'], 0, '/', 'localhost');
    setcookie('success', '-1', 0, "/", 'localhost');
}


function setInitialCookies(){
    global $QUESTCHALLENGEPARAMS;
    
    setcookie('objective', $QUESTCHALLENGEPARAMS['objective'], 0, '/', 'localhost');
    setcookie('penalty', $QUESTCHALLENGEPARAMS['penalty'], 0, '/', 'localhost');
}

// Genera l'ordre de preguntes sense repeticions que van a apareixer
function getQuestSeq(): array{
    if (!isset($_SESSION['questSeq'])){
        $questAmount = questAmount();
        $questSeq = [];
        
        for ($i=0; $i<$questAmount;$i++){
            $questSeq[] = $i;
        }
        shuffle($questSeq);
        $_SESSION['questSeq'] = $questSeq;
        
        return $questSeq;
    }
    else{
        $questSeq = $_SESSION['questSeq'];
        return $_SESSION['questSeq'];
    }
}

function nextStep($questSeq){
    if (sizeof($questSeq)==0){
        unset($_SESSION['questSeq']);
        $questSeq = getQuestSeq();
    }
    
    $nextSeqNum = array_shift($questSeq);
    $nextQuest = chooseQuest($nextSeqNum);
    $answers = shuffleAnswers($nextQuest);
    $_SESSION['result'] = $answers['resp'];
    $_SESSION['questSeq'] = $questSeq;
    $_SESSION['questNum'] = $nextSeqNum;
    
    setcookie('nextQuest', $answers['quest'], 0, '/', 'localhost');
    setcookie('answer1', $answers['a)'], 0, '/', 'localhost');
    setcookie('answer2', $answers['b)'], 0, '/', 'localhost');
    setcookie('answer3', $answers['c)'], 0, '/', 'localhost');
    setcookie('attempts', $_SESSION['attempts'], 0, '/', 'localhost');
}

function getPoints(){
    global $QUESTCHALLENGEPARAMS;
    
    if ($_SESSION['streak'] == $QUESTCHALLENGEPARAMS['objective']) {
        // Calcul de punts. Punts donats son igual als punts inicials multiplicats per l'objetiu. 
        // Tambe es divideix entre els intents que el jugador ha tardat en fer-ho, menys els cinc primers
        $divisor = ($_SESSION['attempts']>5) ? $_SESSION['attempts'] : 1;
        return ($QUESTCHALLENGEPARAMS['initPts'] * $QUESTCHALLENGEPARAMS['objective'] / $divisor);
    }
    else {
        return 0;
    }
}

function challengeEnd(){
    $level = filter_input(INPUT_COOKIE, 'level');
    $points = filter_input(INPUT_COOKIE, 'points') + getPoints();
    
    if ($_SESSION['currentPts']!=0){
        setcookie('points', $points, 0 , '/', 'localhost');
        setcookie('score', getPoints(), 0, '/', 'localhost');
        
        if ($level >= 3) {
            setcookie('level', ($level+1), 0 , '/', 'localhost');
        }
    }
    
    unset($_SESSION['inQuest']);
    unset($_SESSION['questSeq']);
    unset($_SESSION['loadCancel']);
    setcookie('inQuest', '0', 0, '/', 'localhost');
}


function createLog(){
    $user = filter_input(INPUT_COOKIE, 'user');
    $questNum = $_SESSION['questNum']+1;
    $nextQuest = filter_input(INPUT_COOKIE, 'nextQuest');
    $answer1 = filter_input(INPUT_COOKIE, 'answer1');
    $answer2 = filter_input(INPUT_COOKIE, 'answer2');
    $answer3 = filter_input(INPUT_COOKIE, 'answer3');
    $result = $_SESSION['result'];
    $punts = $_SESSION['currentPts'];
    $answer = filter_input(INPUT_POST, 'answer');

    $logName = '../../logs/' . $user . '_QuestChallenge_' . date('d_m_Y_H_i_s') . '.log';
    $logContents = date('d/m/Y_H:i:s') . ';pregunta' . $questNum . ':' . $nextQuest . ';resposta_a:' . $answer1 . ';resposta_b:' . $answer2 . ';resposta_c:' . $answer3 . ';solució:' . $result . ';resposta:' . $answer . ';punts:' . $punts;

    $log = fopen($logName, 'w');
    fwrite($log, $logContents);
    fclose($log);
}


function saveExists(string $file): bool{
    if (file_exists($file)){
        $fileContents = file_get_contents($file);
        if ($fileContents == ''){
            return false;
        }
        else{
            return true;
        }
    }
    else{
        return false;
    }
}


function saveGame(string $saveFile){
    $file = fopen($saveFile, 'w');
    $data = 'Streak:'.$_SESSION['streak'].PHP_EOL.
            'Attempts:'.$_SESSION['attempts'].PHP_EOL.
            'Points:'.$_SESSION['currentPts'];
    fwrite($file, $data);
    fclose($file);
}


function parseSaveFile(string $saveFile): array{
    $file = explode(PHP_EOL, file_get_contents($saveFile));
    $data = [];
    
    foreach ($file as $line){
        $line = explode(':', $line);
        $data[$line[0]] = $line[1];
    }
    
    return $data;
}


function loadGame(array $data){
    
    $_SESSION['streak'] = intval($data['Streak']);
    $_SESSION['attempts'] = intval($data['Attempts']);
    $_SESSION['currentPts'] = intval($data['Points']);
    $_SESSION['inQuest'] = 1;
    
    setcookie('inQuest', '1', 0, "/", 'localhost');
    setcookie('streak', $_SESSION['streak'], 0, "/", 'localhost');
    setcookie('currentPts', $_SESSION['currentPts'], 0, '/', 'localhost');
    setcookie('success', '-1', 0, "/", 'localhost');
}

// Obtenir la sequencia de preguntes
$questSeq = getQuestSeq();

// Establir els parametres inicials
setInitialCookies();

// Variables per a la carga de la partida
$user = filter_input(INPUT_COOKIE, 'user');
$saveFile = '../../saves/'.$user.'.ini';
$isLoadingGame = filter_input(INPUT_POST, 'continueGame');

// Switch que determina que va a passar a partir del boton presionat a LoadSessionView.php
switch ($isLoadingGame){
    case 'load': // Cargar la partida guardada
        $data = parseSaveFile($saveFile);
        loadGame($data);
        nextStep($questSeq);
        $_SESSION['loadCancel'] = true;
        break;
    case 'delete': // El jugador vol esborrar la partida guardada
        $file = fopen($saveFile, 'w');
        fclose($file);
        $_SESSION['loadCancel'] = true;
        break;
    case 'continue': // El jugador vol començar una nova partida sense esborrar la que té guardada
        $_SESSION['loadCancel'] = true;
        break;
    default:
        break;
}

// if que redirecciona a LoadSessionView si hi ha info al .ini Y si la key 
// 'loadCancel' del session es falsa.
if (saveExists($saveFile) AND $_SESSION['loadCancel']==false){
    header("Location: ../../views/challenges/LoadSessionView.php");
    exit;
}


// Algoritmo de control del juego
if (isset($_SESSION['inQuest']) == null OR $_SESSION['inQuest'] == 0){
    // Inicia el challenge y el continua
    challengeStart();
    nextStep($questSeq);
}
elseif (filter_input(INPUT_POST, 'saveGame') == true){
    saveGame($saveFile);
}// Challenge en proceso, codigo siguiente lo continua:
else{
    // Comprova que hi ha una resposta
    if (($answer = filter_input(INPUT_POST, 'answer')) != null){
        
        // Si resposta correcta
        if ($answer == $_SESSION['result']){
            setcookie('success', '1', 0, '/', 'localhost');
            $_SESSION['streak']++;
        } // Si es incorrecta
        else{
            $_SESSION['streak'] = 0;
            $_SESSION['currentPts'] -= $QUESTCHALLENGEPARAMS['penalty'];
            
            setcookie('currentPts', $_SESSION['currentPts'], 0, '/', 'localhost');
            setcookie('success', '0', 0, '/', 'localhost');
            
            unset($_SESSION['questSeq']);
        }
        
        $_SESSION['attempts']++;
        setcookie('streak', $_SESSION['streak'], 0, '/', 'localhost');
        
        // Generate log file
        createLog();
        
        // End the game if objective was reached, or go to next step if not
        if ($_SESSION['streak'] == $QUESTCHALLENGEPARAMS['objective'] OR $_SESSION['currentPts'] <= 0){
            challengeEnd();
        }
        else{
            nextStep($questSeq);
        }
    }
}


header("Location: ../../views/challenges/QuestChallengeView.php", false);
