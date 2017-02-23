<?php
/**
 * Created by PhpStorm.
 * User: justryit
 * Date: 16/5/22
 * Time: 14:34
 */

function getArtWork($id,$db) {
    /**
     * get Artwork
     * @param $id integer
     * @param $db PDO
     */
    $genresql = "SELECT GenreName FROM artworkgenres INNER JOIN genres ON artworkgenres.GenreID=genres.GenreID WHERE ArtworkID=$id";
    $subjectsql = "SELECT SubjectName FROM artworksubjects INNER JOIN subjects ON subjects.SubjectId=artworksubjects.SubjectId WHERE ArtworkID=$id";
    $authorsql = "SELECT FirstName,LastName FROM artworks INNER JOIN artists ON artworks.ArtistId=artists.ArtistId WHERE ArtworkID=$id";

    $genreres=$db->query($genresql);
    $subjectres=$db->query($subjectsql);
    $authorres=$db->query($authorsql);
    $genre=array();$subject=array();
    while($row = $genreres->fetch()) {
        $genre[] = $row['GenreName'];
    }
    while($row = $subjectres->fetch()) {
        $subject[] = $row['SubjectName'];
    }

    $othersql = "SELECT Views,quantity,ImageFileName,Title,Description,YearOfWork,Width,Height,Medium,OriginalHome,MSRP,addtime From artworks WHERE ArtWorkID=$id";
    $otherres=$db->query($othersql);
    $row = $otherres->fetch();
    $authorname= $authorres->fetch();
    $title=$row['Title'];$path=$row['ImageFileName'];$desc=$row['Description'];
    $year=$row['YearOfWork'];$width=$row['Width'];$height=$row['Height'];
    $medium=$row['Medium'];$home=$row['OriginalHome'];$price=$row['MSRP'];
    $author=$authorname['FirstName']." ".$authorname['LastName'];
    $views=$row['Views'];$quantity=$row['quantity'];$addtime=$row['addtime'];
    $artwork=new ArtWork($id,$author,$title,$path,$desc,$year,$width,$height,$medium,$home,$price,$genre,$subject,$views,$quantity,$addtime);
    return $artwork;
}

function getArtWorks($artids,$db) {
    $artworks=array();
    for($i=0;$i<count($artids);$i++) {
        $artworks[]=getArtWork($artids[$i], $db);
    }
    return $artworks;
}

function findartworks($querystr,$db,$offset,$count,$sortbystr="Views",$ad="DESC") {
    if(stripos($querystr,"GenreName")!=false) {
        $sql = "SELECT artworks.ArtWorkID FROM genres INNER JOIN (artworkgenres INNER JOIN artworks ON artworks.ArtWorkID=artworkgenres.ArtWorkID) ON artworkgenres.GenreID=genres.GenreID ". $querystr . "ORDER BY " . $sortbystr . " " . $ad;
    }
    else if(stripos($querystr,"SubjectName")!=false){
        $sql = "SELECT artworks.ArtWorkID FROM subjects INNER JOIN (artworksubjects INNER JOIN artworks ON artworks.ArtWorkID=artworksubjects.ArtWorkID) ON subjects.SubjectId=artworksubjects.SubjectId ". $querystr . " ORDER BY " . $sortbystr . " " . $ad;
    }
    else {
        $sql = "SELECT artworks.ArtWorkID FROM artworks INNER JOIN artists ON artworks.ArtistId=artists.ArtistId " . $querystr . " ORDER BY " . $sortbystr . " " . $ad;
    }
    $res=$db->query($sql);
    $ids=array();
    while($row = $res->fetch()) {
        $ids[] = $row['ArtWorkID'];
    }
    $realids=array();
    for($i=$offset;$i<$offset+$count;$i++) {
        if(isset($ids[$i])) {
            $realids[] = $ids[$i];
        }
    }
    return $realids;
}
