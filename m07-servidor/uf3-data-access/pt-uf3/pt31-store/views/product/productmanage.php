<h2>Product management page</h2>
<?php if (isset($params['message'])): ?>
    <div class='alert alert-warning'>
        <strong>
            <?php echo $params['message']; ?>
        </strong>
    </div>
<?php endif ?>
<form method="post">
    <div class="row g-3 align-items-center">
        <span class="col-auto">
            <label for="search" class="col-form-label">Category to search</label>
        </span>
        <span class="col-auto">
            <input type="text" id="search" name="search" class="form-control" aria-describedby="searchHelpInline">
        </span>
        <span class="col-auto">
            <button class="btn btn-primary" type="submit" name="action" value="product/searchbycategory">Search</button>
        </span>
        <span class="col-auto">
            <button class="btn btn-primary" type="submit" name="action" value="product/form">Add</button>
        </span>
    </div>
</form>
<?php
//display list in a table.
$list = $params['list'] ?? null;
$session_started = isset($_SESSION['username']);

if (isset($list)) {
    if ($session_started) {
        echo <<<EOT
        <table class="table table-sm table-bordered table-striped table-hover caption-top table-responsive-sm">
        <caption>List of products</caption>
        <thead class='table-dark'>
        <tr>
            <th>code</th>
            <th>description</th>
            <th>price</th>
            <th>actions</th>
        </tr>
        </thead>
        <tbody> 
    EOT;    
    } else {
        echo <<<EOT
        <table class="table table-sm table-bordered table-striped table-hover caption-top table-responsive-sm">
        <caption>List of products</caption>
        <thead class='table-dark'>
        <tr>
            <th>code</th>
            <th>description</th>
            <th>price</th>
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
            <td>{$elem->getCode()}</td>
            <td>{$elem->getDescription()}</td>
            <td>{$elem->getPrice()}</td>
            <td>
                <button class="btn btn-outline-dark" name="action" value="product/stocks"><a href="index.php?action=product/stocks&id={$elem->getId()}">stocks<a/></button> 
                <button class="btn btn-outline-dark" name="action" value="product/edit"><a href="index.php?action=product/edit&id={$elem->getId()}">modify<a/></button>
                <button class="btn btn-outline-dark" name="action" value="product/remove"><a href="index.php?action=product/formremove&id={$elem->getId()}">remove<a/></button>
            </td>
            </tr>               
            EOT;
        }else {

            echo <<<EOT
            <tr>
            <td>{$elem->getCode()}</td>
            <td>{$elem->getDescription()}</td>
            <td>{$elem->getPrice()}</td>
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