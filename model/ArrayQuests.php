<?php

function questions(): array{
    $arrayQuest = [
        ["quest" => "Quin és l'oceà més gran de la Terra?", "a)" => "Oceà Atlàntic", "b)" => "Oceà Índic", "c)" => "Oceà Pacífic", "resp" => "Oceà Pacífic"],
        ["quest" => "Quina és la muntanya més alta del món?", "a)" => "Mont Kilimanjaro", "b)" => "Mont Everest", "c)" => "Mont Fuji", "resp" => "Mont Everest"],
        ["quest" => "Quin és el símbol químic de l'or?", "a)" => "Ag", "b)" => "Au", "c)" => "Hg", "resp" => "Au"],
        ["quest" => "Quin és el planeta més gran del nostre sistema solar?", "a)" => "Terra", "b)" => "Júpiter", "c)" => "Saturn", "resp" => "Júpiter"],
        ["quest" => "Quin ésser viu té la vida més llarga?", "a)" => "Tortuga", "b)" => "Elefant", "c)" => "Formiga", "resp" => "Tortuga"],
        ["quest" => "Quina és la ciutat més poblada del món?", "a)" => "Xangai", "b)" => "Nova York", "c)" => "Tòquio", "resp" => "Xangai"],
        ["quest" => "Quin país té la bandera amb més colors del món?", "a)" => "Sud-àfrica", "b)" => "Brasil", "c)" => "Canadà", "resp" => "Sud-àfrica"],
        ["quest" => "Quin metall és el més conductor de l'electricitat?", "a)" => "Coure", "b)" => "Plata", "c)" => "Alumini", "resp" => "Plata"],
        ["quest" => "Quina és la flor nacional de Japó?", "a)" => "Cirerer en flor", "b)" => "Orquídia", "c)" => "Rosa", "resp" => "Cirerer en flor"],
        ["quest" => "Quina és la velocitat de la llum en el buit?", "a)" => "300,000 km/s", "b)" => "150,000 km/s", "c)" => "500,000 km/s", "resp" => "300,000 km/s"],
        ["quest" => "Quin animal té la mordedura més forta en relació amb el seu pes corporal?", "a)" => "Cocodril", "b)" => "Tauró blanc", "c)" => "Lleó", "resp" => "Cocodril"],
        ["quest" => "Quin és l'edifici més alt del món?", "a)" => "Burj Khalifa", "b)" => "Torre Eiffel", "c)" => "Empire State Building", "resp" => "Burj Khalifa"],
        ["quest" => "Quin país té el sistema de metro més llarg del món?", "a)" => "Xina", "b)" => "Japó", "c)" => "Estats Units", "resp" => "Xina"],
        ["quest" => "Quina és la batalla més gran de la Segona Guerra Mundial?", "a)" => "Batalla de Stalingrad", "b)" => "Batalla de Normandia", "c)" => "Batalla de Kursk", "resp" => "Batalla de Stalingrad"],
    ];
    return $arrayQuest;
}

function chooseQuest(int $questNumber): array{
    $questions = questions();
    return $questions[$questNumber];
}

function questAmount(): int{
    $questions = questions();
    return sizeof($questions);
}


function shuffleAnswers(array $question): array{
    $answers=[$question["a)"], $question["b)"], $question["c)"]];
    shuffle($answers);
    $question["a)"]=$answers[0];
    $question["b)"]=$answers[1];
    $question["c)"]=$answers[2];
    return $question;
}
