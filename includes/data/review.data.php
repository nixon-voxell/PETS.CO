<?php

class Review
{
  public $feedback;
  public $rating;

  function __construct($feedback, $rating)
  {
    $this->feedback = $feedback;
    $this->rating = $rating;
  }
}