<?php

require_once(__DIR__.'/functions.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action === 'login') {
        $foundUser = login($_POST['username'], $_POST['password']);
        if ($foundUser === null) {
            header('Content-Type: application/json');
            $result = json_encode(['error' => 'Utente non trovato']);
            echo $result;
            return;
        }

        header('Content-Type: application/json');
        unset($foundUser['password']);
        $result = json_encode($foundUser);
        echo $result;
        return;
    }
}

 //1 - recuperare contenuto todo-list.json
$database = file_get_contents(__DIR__.'/todo-list.json'); //string
//$database = 'lettura da db';

//2 - convertire la stringa in un array associativo
$todo_list = json_decode($database, true); //array

$headers = getallheaders();
$username = $headers['Username'] ?? $headers['username'];

//GESTIONE AGGIUNTA
if(isset($_POST['add'])){
    //operazione add
    $todo_list = addTodo($todo_list, $_POST);
}

//GESTIONE CANCELLAZIONE
if(isset($_POST['delete'])){
    //operazione add
    $todo_list = deleteTodo($todo_list, $_POST['delete']);
}

//GESTIONE MODIFICA DATI

if(isset($_POST['edit'])){
    //operazione add
    $todo_list = editTodo($todo_list, $_POST);
}

$filteredTodoList = array_filter($todo_list, function ($todo) use ($username) {
    return $todo['username'] === $username;
});
$todo_list = $filteredTodoList;

// restituire dati json
header('Content-Type: application/json');
$result = json_encode($todo_list);
echo $result;


