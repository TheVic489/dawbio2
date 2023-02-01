<h2>Category management page</h2>
<?php if (isset($params['message'])): ?>
    <div class='alert alert-warning'>
        <strong>
            <?php echo $params['message']; ?>
        </strong>
    </div>
<?php endif ?>
<!-- <form method="post">
    <div class="row g-3 align-items-center">
        <span class="col-auto">
            <label for="search" class="col-form-label">Role to search</label>
        </span>
        <span class="col-auto">
            <input type="text" id="search" name="search" class="form-control" aria-describedby="searchHelpInline">
        </span>
        <span class="col-auto">
            <button class="btn btn-primary" type="submit" name="action" value="category/role">Search</button>
        </span>
        <span class="col-auto">
            <button class="btn btn-primary" type="submit" name="action" value="category/form">Add</button>
        </span>
    </div>
</form> -->
<?php
//display list in a table.
$list = $params['list'] ?? null;
if (isset($list)) {
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
    // $params contains variables passed in from the controller.
    foreach ($list as $elem) {
        echo <<<EOT
            <tr>
            <td><a href="index.php?action=category/edit&id={$elem->getId()}">{$elem->getCode()}</td>
            <td>{$elem->getDescription()}</a></td>
            <td><button class="btn btn-outline-dark" name="action" value="category/remove"><a href="index.php?action=category/formremove&id={$elem->getId()}">remove<a/></button></td>
            </tr>               
EOT;
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