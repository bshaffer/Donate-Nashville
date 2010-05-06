<?php
/**
 * sfProgressBar
 * 
 * Draw a nifty progress bar for command-line tasks
 *
 * USAGE:
 * // Create Progress Bar instance, pass number of increments
 * $progressBar = new sfProgressBar($this->dispatcher);
 * $progressBar->start($numItems);
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
class sfProgressBar extends sfConsoleLogger
{
  private $escapeSequence = "\033[%sm";
  private $text           = '';
  private $steps          = 0;
  private $delim          = '';
  private $step           = 0;
  private $maxchars       = 70;
  private $open           = true;

  public function initialize(sfEventDispatcher $dispatcher, $options = array())
  {
    $options = array_merge(array('steps' => 100, 'text' => '', 'delim' => '*', 'maxchars' => 70), $options);
    $this->steps    = abs($options['steps']);
    $this->step     = 0;
    $this->text     = $options['text'];
    $this->delim    = $options['delim'];
    $this->maxchars = $options['maxchars'];
    
    parent::initialize($dispatcher, $options);
  }
  
  public function start($steps)
  {
    $this->steps = $steps;
    $this->open = true;

    if ($steps > 0)
    {
      $this->draw();
    }
  }

  public function update()
  {
    $this->step++;

    $this->redraw();
  }
  
  public function finish()
  {
    $this->open = false;
    echo "\n";
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

    $message = $this->text . ' ' . $complete .  ' [';

    if (0 < $dash)
    {
      $message .= str_repeat($this->delim, $dash);
    }
    else
    {
      $this->open = true;
    }

    if (0 < $free)
    {
      $message .= str_repeat('-', $free);
    }
    
    // Automatically close progress bar when finished
    if($this->step == $this->steps)
    {
      $this->open = false;
    }

    $message .= ']';
    
    $this->log($message);
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
  
  protected function doLog($message, $priority)
  {
    fwrite($this->stream, $message. ($this->open ? '' : PHP_EOL));
    flush();
  }
}
