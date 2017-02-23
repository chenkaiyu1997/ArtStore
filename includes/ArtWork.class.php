<?php

/**
 * Created by PhpStorm.
 * User: justryit
 * Date: 16/5/22
 * Time: 14:37
 */
class ArtWork
{
    public $id,$title,$path,$desc,$year,$width,$height,$medium,$home,$price,$genre,$subject,$author,$views,$quantity,$addtime;

    public function __construct($id,$author,$title, $path, $desc, $year, $width, $height, $medium, $home, $price, $genre, $subject,$views,$quantity,$addtime)
    {
        $this->id= $id;
        $this->author=$author;
        $this->title = $title;
        $this->path = $path;
        $this->desc = $desc;
        $this->year = $year;
        $this->width = $width;
        $this->height = $height;
        $this->medium = $medium;
        $this->home = $home;
        $this->price = $price;
        $this->genre = $genre;
        $this->subject = $subject;
        $this->views=$views;
        $this->quantity=$quantity;
        $this->addtime=$addtime;
    }
}