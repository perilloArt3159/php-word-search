<!DOCTYPE html>

<?php 
    if (!isset($_SESSION))
    {
        session_start(); 
    }
?> 

<html lang="en">
<head>
    <?php include_once "includes/head.include.php"; ?>
</head>

<body>

    <?php include_once "includes/header.include.php"; ?>

    <?php 
        $words = $_SESSION['words'] ?? [];
    ?>

    <div class="container my-2">
        <div class="row border-bottom py-2">
            <div class="col-md-12">
                <a href="page_2.php" class="btn btn-primary">
                    Go To Page 2
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <caption>Words</caption>
                    <thead>
                        <tr>
                            <th scope="col">
                                # 
                            </th>
                            <th scope="col">
                                Word
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($words as $key=>$word) : ?> 
                            <tr>
                                <th scope="row">
                                    <?= $key + 1 ?>
                                </th>
                                <td>
                                    <?= $word ?>
                                </ts>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <form action="process_add_words.php" method="post">
                    <div class="form-group">
                        <label for="textAreaWord">
                            Enter Words:
                        </label>
                        <br>
                        <textarea id="textAreaWord" @class="form-control" name="words" cols="40" rows="5"></textarea>
                    </div>
                    <button class="btn btn-primary my-2" name="submit">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php include_once "includes/footer.include.php"; ?>
</body>
</html>