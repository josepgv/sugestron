<?php

require("TopicData.php");

if(isset($_POST["id"]) && !empty($_POST["id"])) {
    $data = new TopicData();
    if($data->update($_POST)) {
        header("Location: /sugestron/public");
        exit;
    }
    else {
        echo "An error occurred";
        exit;
    }
}

if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
    echo "You must specify a numeric ID";
    exit;
}



$data = new TopicData();
$topic = $data->getTopic($_GET["id"]);

if($topic === false) {
    echo "Could not find specified ID";
    exit;
}


?>

<h2>Edit a topic</h2>

<form action="edit.php" method="POST">
    <label>
        Title: <input type="text" name="title" value="<?php echo $topic["title"];?>">
    </label>
    <br>
    <label>
        Description <br>
        <textarea name="description" cols="50" rows="20"><?php echo $topic["description"];?></textarea>
    </label>
    <br>
    <input type="hidden" name="id" value="<?php echo $topic["id"];?>">
    <input type="submit" value="Edit!">
</form>