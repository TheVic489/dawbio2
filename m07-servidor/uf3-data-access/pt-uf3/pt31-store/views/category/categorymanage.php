<h2>Category management page</h2>
<?php if (isset($params['message'])): ?>
    <div class='alert alert-warning'>
        <strong>
            <?php echo $params['message']; ?>
        </strong>
    </div>
<?php endif ?>

<?php
//display list in a table.
$list = $params['list'] ?? null;

$session_started = isset($_SESSION['username']);

if (isset($list)) {
    if ($session_started) {
        echo <<<EOT
        <table class="table table-sm table-bordered table-striped table-hover caption-top table-responsive-sm">
        <caption>List of Categories</caption>
        <thead class='table-dark'>
        <tr>
            <th>code</th>
            <th>description</th>
            <th>actions</th>
        </tr>
        </thead>
        <tbody>
    EOT;
    } else {
        echo <<<EOT
        <table class="table table-sm table-bordered table-striped table-hover caption-top table-responsive-sm">
        <caption>List of Categories</caption>
        <thead class='table-dark'>
        <tr>
            <th>code</th>
            <th>description</th>
        </tr>
        </thead>
        <tbody>
    EOT;    
    }
    // $params contains variables passed in from the controller.
    
    foreach ($list as $elem) {
        if ($session_started) {
            echo <<<EOT
            <tr>
            <td><a href="index.php?action=category/edit&id={$elem->getId()}">{$elem->getCode()}</td>
            <td>{$elem->getDescription()}</a></td>
            <td><button class="btn btn-outline-dark" name="action" value="category/remove"><a href="index.php?action=category/formremove&id={$elem->getId()}">remove<a/></button></td>
            </tr>               
    EOT;
        } else {
            echo <<<EOT
            <tr>
            <td>{$elem->getCode()}</td>
            <td>{$elem->getDescription()}</a></td>
            </tr>               
    EOT;
        }
    }
    echo "</tbody>";
    echo "</table>";
    echo "<div class='alert alert-info' role='alert'>";
    echo count($list), " elements found.";
    echo "</div>";
} else {
    echo "No data found";
}

?>