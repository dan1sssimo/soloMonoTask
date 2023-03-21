<h1>Побудоване дерево</h1>
<h3>Час виконнаня PHP скрипту: <?= $scriptTime ?> cекунд</h3>
<?php
function printData($data)
{
    print_r('<pre><p style="background-color: beige; color: maroon; padding: 10px; margin: 5px; border: 1px maroon solid;">');
    print_r($data);
    print_r('</p></pre>');
}

printData($tree);
