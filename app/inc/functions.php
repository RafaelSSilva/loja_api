<?php 
function printData($data, $die = TRUE) {
  print '<pre>';
  if (is_object($data) || is_array($data))
   print_r($data);
  else
    print $data;

  print '</pre>';

  if ($die)
    die(PHP_EOL. 'TERMINADO'. PHP_EOL);
}

?>