<?php

interface grDbInterface {
  public function getGrListId($userId, $name);
  public function setGrListId($userId, $name);
  public function getGrListItems($grListId);
  public function setItem(array $item);
}

?>