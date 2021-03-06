<?php

class Review
{
  /** @var string $username */
  private $username;
  /** @var int $rating */
  private $rating;
  /** @var string $feedback */
  private $feedback;

  function __construct($username, $rating, $feedback)
  {
    $this->username = $username;
    $this->rating = $rating;
    $this->feedback = $feedback;
  }

  //// get data
  public function GetUsername() { return $this->username; }
  public function GetRating() { return $this->rating / 5 * 100; }
  public function GetFeedback() { return $this->feedback; }
}