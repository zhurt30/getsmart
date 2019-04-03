<nav>
    <?php

    $menu_data = $pdo->query('SELECT label, pageKey FROM navmenu JOIN page ON navmenu.pageId = page.pageId ORDER BY menuOrder');

    foreach ($menu_data as $row) {
      echo '<a href="?p=' . $row['pageKey'] . '">'
        . $row['label'] . '</a>';
    }

    ?>
</nav> 