<?php

class sfConsole
{
  const TARGET_OUTPUT = 'php://output';
  const TARGET_STDOUT = 'php://stdout';
  const TARGET_STDERR = 'php://stderr';
  const TARGET_STDIN  = 'php://stdin';

  protected static $color = array('gray'        => '30',
                                  'black'       => '30',
                                  'red'         => '31',
                                  'green'       => '32',
                                  'yellow'      => '33',
                                  'blue'        => '34',
                                  'magenta'     => '35',
                                  'cyan'        => '36',
                                  'white'       => '37',
                                  'default'     => '39');

  protected static $bgcolor = array('gray'     => '40',
                                    'black'    => '40',
                                    'red'      => '41',
                                    'green'    => '42',
                                    'yellow'   => '43',
                                    'blue'     => '44',
                                    'magenta'  => '45',
                                    'cyan'     => '46',
                                    'white'    => '47',
                                    'default'  => '49');

  protected static $style = array('default'           => '0',
                                  'bold'              => '1',
                                  'faint'             => '2',
                                  'normal'            => '22',
                                  'italic'            => '3',
                                  'notitalic'         => '23',
                                  'underlined'        => '4',
                                  'doubleunderlined'  => '21',
                                  'notunderlined'     => '24',
                                  'blink'             => '5',
                                  'blinkfast'         => '6',
                                  'noblink'           => '25',
                                  'negative'          => '7',
                                  'positive'          => '27');

  private $text = '';

  // ==========
  // = Output =
  // ==========
  public function draw($text = '')
  {
    echo $this->text . $text;
    $this->text = '';

    return $this;
  }

  // =========
  // = Input =
  // =========
  public function readNumeric()
  {
    $stdin = fopen('php://stdin', 'r');
    $line = trim(fgets($stdin));

    fscanf($stdin, "%d\n", $number);

    return $number;
  }

  public function readString()
  {
    $stdin = fopen('php://stdin', 'r');
    $line = trim(fgets($stdin));

    fscanf($stdin, "%s\n", $string);

    return $string;
  }

  // =========
  // = Sound =
  // =========
  public function beep()
  {
    echo "\007";

    return $this;
  }

  public function setSoundHerz($herz = 100)
  {
    echo "\033[10;{$herz}]";

    return $this;
  }

  public function setSoundLong($milliseconds = 500)
  {
    echo "'033[11;{$milliseconds}]";

    return $this;
  }

  // ===================
  // = Cursor Position =
  // ===================
  public function toPos($row = 1, $column = 1)
  {
    echo "\033[{$row};{$column}H";

    return $this;
  }

  public function cursorUp($lines = 1)
  {
    echo "\033[{$lines}A";

    return $this;
  }

  public function cursorDown($lines = 1)
  {
    echo "\033[{$lines}B";

    return $this;
  }

  public function cursorRight($columns = 1)
  {
    echo "\033[{$columns}C";

    return $this;
  }

  public function cursorLeft($columns = 1)
  {
    echo "\033[{$columns}D";

    return $this;
  }

  // ===============
  // = Text Colors =
  // ===============
  public function setStyle($style = 'default')
  {
    $this->text .= "\033[" . $this->style[$style] . "m";

    return $this;
  }

  public function setColor($color = 'default')
  {
    $this->text .= "\033[" . $this->color[$color];

    return $this;
  }

  public function setBgColor($color = 'default') 
  {
    $this->text .= "\033[" . $this->bgcolor[$color];

    return $this;
  }

  // ===============
  // = Application =
  // ===============
  public function setAppName($name = '')
  {
    echo "\033]0;{$name}\007";

    return $this;
  }

  public function setTitle($name = '')
  {
    echo "\033]2;{$name}\007";

    return $this;
  }

  public function setIcon($name = '')
  {
    echo "\033]1;{$name}\007";

    return $this;
  }

  // =========
  // = Other =
  // =========
  public function clear()
  {
    echo "\033c";

    return $this;
  }

  public function console($num = 1)
  {
    echo "\033[12;{$num}]";

    return $this;
  }
}
