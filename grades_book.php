<?php
include("db.php");

//Pažymių knygelė
$sql = "SELECT s.name as na, s.surname as su, c.name as course_name, l.name as lecture_name, pazymys_id, p.name as partic FROM `grade_book` gr 
LEFT JOIN students s ON gr.studentas_id = s.id 
LEFT JOIN course c ON gr.kursas_id = c.id
LEFT JOIN lectures l ON gr.paskaitos_id = l.id
LEFT JOIN participation p ON gr.dalyvavo_id = p.value";
//pstm - pre-statement
$pstm = $pdo->prepare($sql);
$pstm->execute();
$rows = $pstm->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades book </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>

    <div class="container-fluid">
        <div class="d-flex justify-content-center mt-5">
            <h1>Pažymių knygelė</h1>
        </div>
        <div class="card mt-5 mb-3">
            <h5 class="card-header bg-primary">Studentų sąrašas:</h5>
            <?php if (count($rows) > 0) :
                $i = 1;
                $count=0;
            ?>
                <div class="card-body">
                    <table class="table table-striped table-hover mb-3">
                        <thead>
                            <tr>
                                <td><strong>Nr.</strong></td>                              
                                <td><strong>Studentas</strong></td>
                                <td><strong>Kursas</strong></td>
                                <td><strong>Paskaita</strong></td>
                                <td><strong>Pažymys</strong></td>
                                <td><strong>Lankomumas</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row) { ?>
                                <?php $count++ ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $row['na'] .' '.$row['su'] ?></td>
                                    <td><?= $row['course_name'] ?></td>
                                    <td><?= $row['lecture_name'] ?></td>
                                    <td><?= $row['pazymys_id'] ?></td>
                                    <td><?= $row['partic'] ?></td>
                                <?php } ?>
                                </tr>
                        </tbody>
                        <a href="new.php" class="btn  btn-primary float-end">Pridėti naują studentą</a>
                    </table>
                </div>
            <?php endif; ?>

        </div>
    </div>
</body>