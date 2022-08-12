<!DOCTYPE html>

<?php 
    if (!isset($_SESSION))
    {
        session_start(); 
    }

    $tableConfig = 
    [
        'ROWS'    => 20, 
        'COLUMNS' => 20
    ]
?> 

<html lang="en">
<head>
    <?php include_once "includes/head.include.php"; ?>
</head>

<body>

    <?php include_once "includes/header.include.php"; ?>

    <?php 
        $letters   = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        $words     = $_SESSION['words'] ?? [];
        $structure = [];

        for($i=0; $i < $tableConfig['ROWS']; $i++)
        {
            $structure[$i] = []; 

            for($j=0; $j < $tableConfig['COLUMNS']; $j++)
            {
                array_push($structure[$i], [ "value" => $letters[array_rand($letters)], "isEntry" => false ]);             
            }
        }

        foreach($words as $word )
        {
            $wordLength = strlen($word);
            
            //! CHECK IF OVERLAPPING 
            do  
            {
                $rowStart        = rand(0, $tableConfig['ROWS'] - $wordLength);
                $columnStart     = rand(0, $tableConfig['COLUMNS'] - $wordLength);
                
                $isOverlapping = false; 
                
                for ($i=0; $i < $wordLength; $i++)
                {
                    $row    = ($rowStart + $i); 
                    $column = ($columnStart + $i);
    
                    if ($structure[$row][$column]['isEntry'] == true) 
                    {
                        $isOverlapping = true; 
                    }
                }
            } 
            while ($isOverlapping == true);

            //! INSERT WORD
            for ($i=0; $i < $wordLength; $i++)
            {
                $row    = ($rowStart + $i); 
                $column = ($columnStart + $i);

                $structure[$row][$column] = 
                [
                    'value'   => $word[$i], 
                    'isEntry' => true, 
                ];  
            }
        } 
    ?>

    <div class="container my-2">
        <div class="row border-bottom py-2">
            <div class="col md-12">
                <a href="index.php" class="btn btn-primary">
                    Back To Page 1
                </a>
                <a href="page_2.php" class="btn btn-secondary">
                    Replay
                </a>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-12">
                <h3>Words To Find</h3>
                <ul class="list-group">
                    <?php foreach($words as $key=>$word) : ?>
                        <li class="list-group-item">
                            <?=$word?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <?php for($i=0; $i < $tableConfig['ROWS']; $i++) : ?>
                        <tr>
                            <?php for($j=0; $j < $tableConfig['COLUMNS']; $j++) : ?>
                                <td class="text-center <?=$structure[$i][$j]["isEntry"] ? 'bg-success text-white font-weight-bold text-uppercase' : '' ?>">
                                    <?=$structure[$i][$j]["value"]?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
        </div>
    </div>

    <?php include_once "includes/footer.include.php"; ?>
</body>
</html>