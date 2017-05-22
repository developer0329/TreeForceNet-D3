<?php
    
    $file = fopen("data.csv","r");

    if($_POST["type"] == 'delete'){
        $list = array();
        while(! feof($file))
        {
            $line = fgetcsv($file);
            if($line[0] !== $_POST["old_name"] && $line[1] !== $_POST["old_name"]){
                $comma_separated = implode(",", $line);
                array_push($list, $comma_separated);
            }            
        }
        fclose($file);
        $newfile = fopen("data.csv","w");
        foreach ($list as $newline)
        {
            fputcsv($newfile, explode(',',$newline));
        }
        fclose($newfile);

        if (file_exists("img/".$_POST["old_name"].".png")) {
            unlink("img/".$_POST["old_name"].".png");
        }
    }

    if($_POST["type"] == 'edit'){
        $list = array();
        while(! feof($file))
        {
            $line = fgetcsv($file);
            $exist = false;
            if($line[0] == $_POST["old_name"]){
                $line[0] = $_POST["node_name"];
                $exist = true;
            }

            if($line[1] == $_POST["old_name"]){
                $line[1] = $_POST["node_name"];
                $exist = true;
            }

            if($exist && file_exists("img/".$_POST["old_name"].".png")){
                rename("img/".$_POST["old_name"].".png", "img/".$_POST["node_name"].".png");
            }
            $comma_separated = implode(",", $line);
            array_push($list, $comma_separated);
        }
        fclose($file);
        $newfile = fopen("data.csv","w");
         foreach ($list as $newline)
        {
            fputcsv($newfile, explode(',',$newline));
        }
        fclose($newfile);
    }
    
    
?>