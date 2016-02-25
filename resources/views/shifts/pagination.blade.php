<?php

?>

<nav class="pull-right">
  @if ( $week != 0 )
  <a class="btn btn-primary pull-left" style="margin: 20px 20px 0 20px;" href="?week=0">Go to current week</a>
  @endif
  <ul class="pagination">
    <li>
      <a href="?week={!! $week - 1 !!}" aria-label="Previous">
        <span aria-hidden="true">Previous</span>
      </a>
    </li>
    <!-- <li><a href="?week=0">current</a></li> -->
    <li>
      <a href="?week={!! $week + 1 !!}" aria-label="Next">
        <span aria-hidden="true">Next</span>
      </a>
    </li>
  </ul>
</nav>

