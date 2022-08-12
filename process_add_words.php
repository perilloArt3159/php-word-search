<?php 

if (!isset($_SESSION))
{
    session_start(); 
}

if (!isset($_SESSION['words']))
{
    $_SESSION['words'] = [];
}

$maxWords = 5; 

if (isset($_POST['submit']))
{
    $words = explode("\n", $_POST['words']);

    $maxWords = 5; 

    foreach ($words as $key=>$word)
    {
        $words[$key] = trim(explode(" ", $word)[0]);
    }

    if (count($words) > 5)
    {
        $words = array_slice($words, 0, $maxWords);
    }

    $_SESSION['words'] = $words;
}

header("Location: index.php", true);