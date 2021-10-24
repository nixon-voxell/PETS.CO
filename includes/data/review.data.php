<?php

class Review
{
  /** @var string $feedback */
  private $feedback;
  /** @var int $rating */
  private $rating;

  function __construct($feedback, $rating)
  {
    $this->feedback = $feedback;
    $this->rating = $rating;
  }

  //// get data
  public function GetFeedback() { return $this->feedback; }
  public function GetRating() { return $this->rating; }
}