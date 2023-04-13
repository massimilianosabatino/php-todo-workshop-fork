<?php
/**********
 * Funzioni applicativo
 **********/

//funzione per aggiungere un todo
function addTodo($todo_list, $params){

    $backup_todo_list = $todo_list;

    $todo = [
        'text' => $params['todo'],
        'done' => false
    ];

    $todo_list[] = $todo; //array php associativo

    //salvare la nuova todo list nel file dei todo (il nostro db)
    saveFile('todo-list.json', json_encode($backup_todo_list), json_encode($todo_list)); //salviamo la stringa json
    return $todo_list;
}

//funzione per cancellare un todo
function deleteTodo($todo_list, $index){

    //esempio dato di bk
    $backup_todo_list = $todo_list;

    //cancellazione elemento - valutare splice
    unset($todo_list[$index]);

    saveFile('todo-list.json', json_encode($backup_todo_list), json_encode($todo_list)); //salviamo la stringa json
    return $todo_list;
}

//funzione per modificare un todo
function editTodo($todo_list, $params){
    //esempio dato di bk
    $backup_todo_list = $todo_list;

    $index = $params['edit'];
    $todo_list[$index]  = array(
        'text' => $params['text'],
        'done' => false
    );

    //salvare la nuova todo list nel file dei todo (il nostro db)
    saveFile('todo-list.json', json_encode($backup_todo_list), json_encode($todo_list)); //salviamo la stringa json
    return $todo_list;
}

//salvataggio file e creazione backup
function saveFile($file, $old_data = NULL, $new_data = NULL){
    
    //definizione cartelle
    $default_dir = __DIR__;
    $bk_dir = __DIR__.'/bk';


    //salvataggio file di backup
    if($old_data !== NULL){
        if (!is_dir($bk_dir)) {
            // dir doesn't exist, make it
            mkdir($bk_dir);
          }
        $filename = $bk_dir.'/'.date("YmdHis").'-'.$file;
        file_put_contents($filename, $old_data); //salviamo la stringa json
    }

    //salvataggio nuovo file
    if($new_data !== NULL){
        $filename = $default_dir.'/'.$file;
        file_put_contents($filename, $new_data); //salviamo la stringa json
    }
}