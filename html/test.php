<?php
function test(){
  while ($row = fetch_array()){
  $url = $row['url'];

  echo '<li class="nav-item">
            <a class="nav-link" href="'.$url.'">About</a>
          </li>';
  } 
}
?>