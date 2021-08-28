<?php

namespace phOMXPlayer;
/**
 * Timeout interval tool to prevent infinite loops on shell processes.
 */
class TimeoutInterval
{
  /**
   * @var int Contains the init time based on current system timestamp
   */
  private $start_time;
  /**
   * @var int The number of milliseconds to count before expiration.
   */
  private $interval;

  /**
   * Initializes the start time and the time to count until expiration.
   *
   * @param int $time_in_milliseconds The number of milliseconds to count before expiration.
   */
  public function __construct(int $time_in_milliseconds = null)
  {

    $this->interval = $time_in_milliseconds ?? Config::getTimeOutInterval();
    $this->start_time = round(microtime(true) * 1000);

  }

  /**
   * Timeout check.
   *
   * @return bool
   */
  public function expired(): bool
  {

    return round(microtime(true) * 1000) - $this->start_time > $this->interval;

  }

}
