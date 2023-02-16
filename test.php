<?php
include_once 'DbConfig.php';
include_once 'Crud.php';
//getdbconnection();

// $crud=new Crud();
// $data_array=['gnr_name'=>'Drama'];
// $crud->delete("DELETE FROM movies WHERE mv_id=3 ");

//var_dump('https://www.omdbapi.com/?s=titanic&apikey=2b67a2f7');
if (($_SERVER['REQUEST_METHOD'] == 'POST')) {

    $search = $_POST['search'];

    $payload = file_get_contents('https://www.omdbapi.com/?s=' . $search . '&apikey=2b67a2f7');
    $data = json_decode($payload, true);
    
    echo $counter = 0;
    // foreach ($data['Search'] as $key => $row) {
    //     $id = $counter++;
    //     echo $id;
    //     echo '<br>';
    //     $title = $row['Title'] . PHP_EOL;
    //     echo $title;
    //     echo '<br>';
    //     $poster =  $row['Poster'] . PHP_EOL;
    //     echo $poster;
    //     echo '<br>';
    //     $year =  $row['Year'] . PHP_EOL;
    //     echo '<br>';
         $image = $row['Poster'];
         $imageData = base64_encode(file_get_contents($image));
         $img = '<img src="data:image/jpeg;base64,' . $imageData . '">';
         echo $img;
    //     echo '<br>';
    //     //#################################

    // }
   // header ("Location: test2.php");
}





// print_r($data['Search'][0]);
// echo '<br>';
// print_r($data['Search'][0]['Title']);
// echo '<br>';
// print_r($data['Search'][0]['Year']);
// echo '<br>';
// print_r($data['Search'][0]['Poster']);
// echo '<br>';
// echo $data['Search'][0]['Year'];


//$image = 'https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg ';

// $image = 'https://m.media-amazon.com/images/M/MV5BMGJkNDJlZWUtOGM1Ny00YjNkLThiM2QtY2ZjMzQxMTIxNWNmXkEyXkFqcGdeQXVyMDM2NDM2MQ@@._V1_SX300.jpg ';
// $imageData = base64_encode(file_get_contents($image));
// echo '<img src="data:image/jpeg;base64,'.$imageData.'">';



//SELECT mv_id,mv_title,gnr_name, GROUP_CONCAT(gnr_name) genres,mv_year_released FROM `movies` LEFT JOIN mv_genres ON mvg_ref_movie = mv_id LEFT JOIN genres ON mvg_ref_genre = gnr_id;

?>
<br>
<br>
<br>
<br>
<form action="#" method="post">
    <div class="mb-3">
        <label for="search1" class="form-label">Search</label>
        <input type="text" class="form-control" id="search1" name="search">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<form action="" method="get">

<table id="movies">
                                    <tr>
                                        <th>ID</th>
                                        <th>Movie Title</th>
                                        <th>Genre(s)</th>
                                        <th>Year Released</th>
                                        <th>Cover Image</th>
                                        <th>Actions</th>
                                    </tr>
                                 <?php   foreach ($data['Search'] as $key => $row) { ?>
                                    <?php var_dump($data[0]['Title']); ?>
                                        <tr>
                                      
                                            <td>
                                                <?= ++$counter . PHP_EOL; ?>
                                            </td>
                                            <td>
                                                <?= $row['Title'] . PHP_EOL; ?>
                                            </td>
                                            <td>
                                                <?= $row['year'] . PHP_EOL; ?>
                                            </td>
                                            <td>
                                                <?= $row['poster'] . PHP_EOL; ?>
                                            </td>
                                           <?php 
                                                         $image = $row['Poster'];
                                                         $imageData = base64_encode(file_get_contents($image));
                                                         $img = '<img src="data:image/jpeg;base64,' . $imageData . '">';
                                   
                                           ?>
                                            <td ><?= $img; ?></td>

                                            <td>
                                                <a href="test.php?id=<?= $counter ?>">Add</a>
                                            </td>
                                                
                                              
                                                
                                            </td>
                                        </tr>
                                 <?php } ?>

                                </table>




<!-- <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="">

</div>
<div class="mb-3">
    <label for="year" class="form-label">Year</label>
    <input type="text" class="form-control" id="year" name="year" aria-describedby="emailHelp">

</div>
<div class="mb-3">
    <label for="year" class="form-label">Link</label>
    <input type="text" class="form-control" id="link" name="link" aria-describedby="emailHelp">

</div>
<div class="mb-3">
    <label for="img" class="form-label">Image</label>
    <input type="text" class="form-control" id="img" name="img" aria-describedby="emailHelp">

</div> -->



</form>
