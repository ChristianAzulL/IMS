<?php
// Include the database connection and session management
include('../config/database.php');
include('../config/on_session.php');

// Get the current page number from the URL, default to page 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of rows per page
$offset = ($page - 1) * $limit;

// Get the warehouse filter and search query (if provided)
$warehouse = isset($_GET['warehouse']) ? $_GET['warehouse'] : '';
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the base query to fetch data for the current page
$query = "
    SELECT il.unique_key, u.user_fname, u.user_lname AS fullname, w.warehouse_name, s.supplier_name
    FROM inbound_logs il
    LEFT JOIN users u ON u.hashed_id = il.user_id
    LEFT JOIN warehouse w ON w.hashed_id = il.warehouse
    LEFT JOIN supplier s ON s.hashed_id = il.supplier
";

// Add WHERE conditions if search or warehouse filter is present
$whereClauses = [];
$params = [];
if (!empty($searchQuery)) {
    $whereClauses[] = "(u.user_fname LIKE :searchQuery OR u.user_lname LIKE :searchQuery OR w.warehouse_name LIKE :searchQuery OR s.supplier_name LIKE :searchQuery)";
    $params[':searchQuery'] = '%' . $searchQuery . '%';
}
if (!empty($warehouse)) {
    $whereClauses[] = "w.hashed_id = :warehouse";
    $params[':warehouse'] = $warehouse;
}

// Append WHERE conditions to the query if needed
if (count($whereClauses) > 0) {
    $query .= " WHERE " . implode(" AND ", $whereClauses);
}

$query .= " ORDER BY il.id DESC LIMIT :offset, :limit";

// Prepare and execute the query with pagination and filtering parameters
$stmt = $conn->prepare($query);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

// Bind any additional parameters for search or warehouse
foreach ($params as $key => $value) {
    $stmt->bindParam($key, $value);
}

$stmt->execute();

// Fetch all results
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total record count (for pagination)
$countQuery = "
    SELECT COUNT(*) AS total
    FROM inbound_logs il
    LEFT JOIN users u ON u.hashed_id = il.user_id
    LEFT JOIN warehouse w ON w.hashed_id = il.warehouse
    LEFT JOIN supplier s ON s.hashed_id = il.supplier
";

// Append WHERE conditions to the count query if needed
if (count($whereClauses) > 0) {
    $countQuery .= " WHERE " . implode(" AND ", $whereClauses);
}

$stmtCount = $conn->prepare($countQuery);
foreach ($params as $key => $value) {
    $stmtCount->bindParam($key, $value);
}

$stmtCount->execute();
$totalRecords = $stmtCount->fetchColumn();

// Calculate the total number of pages
$totalPages = ceil($totalRecords / $limit);

// Return the data and pagination info as JSON for the front-end
echo json_encode([
    'data' => $data,
    'totalPages' => $totalPages,
    'totalRecords' => $totalRecords
]);
?>
