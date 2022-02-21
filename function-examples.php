<?php

function getMessage($morning) {
  if ($morning) {
    return "good moming";
  } else {
    return "good dading";
  }
}

$message = getMessage(false);
echo $message;
