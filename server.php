<?php

require_once(__DIR__.'/functions.php');

 //1 - recuperare contenuto todo-list.json
$database = file_get_contents(__DIR__.'/todo-list.json'); //string
//$database = 'lettura da db';

//2 - convertire la stringa in un array associativo
$todo_list = json_decode($database, true); //array

//GESTIONE AGGIUNTA TODO
if(isset($_POST['add'])){
    //operazione add
    $todo_list = addTodo($todo_list, $_POST);
}

//GESTIONE CANCELLAZIONE TODO
if(isset($_POST['delete'])){
    //operazione add
    $todo_list = deleteTodo($todo_list, $_POST['delete']);
}

//GESTIONE MODIFICA DATI

if(isset($_POST['edit'])){
    //operazione add
    $todo_list = editTodo($todo_list, $_POST);
}


// restituire dati json
header('Content-Type: application/json');
$result = json_encode($todo_list);
echo $result;


