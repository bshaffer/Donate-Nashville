<?php
/**
 * sfProgressBar
 * 
 * Draw a nifty progress bar for command-line tasks
 *
 * USAGE:
 * // Create Progress Bar instance, pass number of increments
 * $progressBar = new sfProgressBar($numItems);
 * 
 * // Update Progress Bar with each increment
 * foreach($numItems as $item) { $progressBar->update(); }
 *
 * EXAMPLE:
 * 17% [************---------------------------------------------------]
 *
 * @package default
 * @author Brent Shaffer
 */
class sfProgressBar extends sfConsole
{
  private $escapeSequence = "\033[%sm";
  private $text           = '';
  private $steps          = 0;
  private $delim          = '';
  private $step           = 0;
  private $maxchars       = 70;

  public function __construct($steps = 100, $text = '', $delim = '*', $maxchars = 70)
  {
    $this->steps    = abs($steps);
    $this->step     = 0;
    $this->text     = $text;
    $this->delim    = $delim;
    $this->maxchars = $maxchars;

    $this->draw();
  }

  public function update()
  {
    $this->step++;

    $this->redraw();
  }

  public function draw($text = '')
  {
    $procCalc = round(($this->step / $this->steps) * 100, 0);
    $proc     = (100 < $procCalc ? '100' : $procCalc);
    $complete = $proc . '%';
    $isuse    = strlen($complete) + 4 + strlen($this->text);
    $max      = $this->maxchars - $isuse;
    $dash     = round($max * ($proc / 100) + 1);
    $free     = $max - $dash;

    echo $this->text . ' ' . $complete .  ' [';

    if (0 < $dash)
    {
      echo str_repeat($this->delim, $dash);
    }

    if (0 < $free)
    {
      echo str_repeat('-', $free);
    }

    echo ']';
  }

  public function redraw()
  {
    $this->toPos();
    $this->draw();
  }

  public function toPos($row = 1, $column = 1)
  {
    echo "\033[{$column}G";
  }
}
