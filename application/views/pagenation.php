<nav aria-label="Page navigation">
  <ul class="pagination">
  <?if($pages['prev']['disabled']):?>
    <li class="disabled">
      <span aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </span>
    </li>
  <?else:?>
    <li>
      <a href="<?=$pages["prev"]['link']?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
  <?endif;?>
  <?foreach($pages['items'] as $item):?>
    <?if($item['active']):?>
      <li class="active">
        <span><?=$item['number']?></a>
      </li>
    <?else:?>
      <li>
        <a href="<?=$item['link']?>"><?=$item['number']?></a>
      </li>
    <?endif;?>
  <?endforeach;?>
  <?if($pages['next']['disabled']):?>
    <li class="disabled">
      <span aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </span>
    </li>
  <?else:?>
    <li>
      <a href="<?=$pages["next"]['link']?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  <?endif;?>
  </ul>
</nav>